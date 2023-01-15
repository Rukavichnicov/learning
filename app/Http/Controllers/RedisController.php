<?php

namespace App\Http\Controllers;

class RedisController extends Controller
{
    /**
     * @throws \RedisException
     */
    public function index()
    {
        $redis = new \Redis();
        $redis->pconnect(
            env('REDIS_HOST', '127.0.0.1'),
            env('REDIS_PORT', '6379'),
        );
        $redis->set('name:1', 'Misha');
        $redis->set('name:2', 'Sergey');
        $redis->set('name:3', 'Dasha');
        $array = [];
        $array[] = $redis->get('name:1');
        $array[] = $redis->get('name:2');
        $array[] = $redis->get('name:3');
        return view('redis', compact('array'));
    }
}
