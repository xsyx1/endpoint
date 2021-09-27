<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StreamPositionController extends BaseController
{
    public function __invoke(Request $request)
    {
        $data = Channel::query()
        ->with(['watchedTimes' => function($query){
            $query->select(
                'watched_times.channels_id',
                'users.id',
                'users.name',
                'watched_times.date',
                DB::raw('RANK() OVER ( ORDER BY MAX(watched_times.minutes) DESC) position'),
                DB::raw('MAX(watched_times.minutes) as max_minutes')
            )
            ->join('users', 'users.id', '=', 'watched_times.users_id')
            ->groupBy('users.id', 'watched_times.channels_id')
            ->orderBy('max_minutes', 'desc');
        }])
        ->get();

        return response()->json($data);

    }
}