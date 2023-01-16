<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Redis;
use RedisException;

class RedisController extends Controller
{
    /**
     * @throws RedisException
     */
    public function index(): View
    {
        $redis = new Redis();
        $array = [];
        $redis->pconnect(
            env('REDIS_HOST', '127.0.0.1'),
            env('REDIS_PORT', '6379'),
        );
        $redis->mSet(
            [
                'age:1' => 24,
                'age:2' => 50,
                'age:3' => 80,
            ]
        );
        for ($i = 1; $i <= 3; ++$i) {
            $redis->set("name:$i", "Misha$i", 10);
            $redis->setnx('name:1', 'Mom');
            $redis->persist('name:2');
            $redis->expire('name:3', 3600);
        }
        $redis->incr('age:1');
        $redis->decr('age:2');
        for ($i = 1; $i <= 3; ++$i) {
            $array["getName$i"] = $redis->get("name:$i");
            $array["ttlName$i"] = $redis->ttl("name:$i");
        }
        $array = array_merge($array, $redis->mGet(["age:1", "age:2", "age:3",]));


        $redis->close();
        return view('redis', compact('array'));
    }
}
