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
//        $redis->mSet(
//            [
//                'age:1' => 24,
//                'age:2' => 50,
//                'age:3' => 80,
//            ]
//        );
//        for ($i = 1; $i <= 3; ++$i) {
//            $redis->set("name:$i", "Misha$i", 10);
//            $redis->setnx('name:1', 'Mom');
//            $redis->persist('name:2');
//            $redis->expire('name:3', 3600);
//        }
//        $redis->incr('age:1');
//        $redis->decr('age:2');
//        for ($i = 1; $i <= 3; ++$i) {
//            $array["getName$i"] = $redis->get("name:$i");
//            $array["ttlName$i"] = $redis->ttl("name:$i");
//        }
//        $array = array_merge($array, $redis->mGet(["age:1", "age:2", "age:3",]));
//        $redis->lPush('list:1', 4);
//        $redis->lPush('list:1', 3);
//        $redis->lPush('list:1', 2);
//        $redis->lPush('list:1', 1);
//        $redis->lPush('list:2', 4, 2, 3);
//        $redis->lTrim('list:1', 0, 2);
//        $array[] = $redis->rPop('list:1');
//        $array[] = $redis->rPop('list:1');
//        $array[] = $redis->rPop('list:1');
//        $array['list1'] = $redis->lLen('list:1');
//        $array['list2'] = $redis->lLen('list:2');
//        $redis->del('list:2');
//
//        $redis->set('foo', 'bar');
//
//        // Получить значение по ключу, и перезаписать его новым значением
//        $array['foo'] = $redis->getSet('foo', 'new');
//        $array['foo_new'] = $redis->get('foo');

//        $redis->sAdd('set:1', 1);
//        $redis->sAdd('set:1', 2);
//        $redis->sAdd('set:1', 3);
//        $redis->sAdd('set:1', 4);
//
//        $redis->sAdd('set:2', 10);
//        $redis->sAdd('set:2', 11);
//        $redis->sAdd('set:2', 12);
//        $redis->sAdd('set:2', 15);
//

//        $redis->hSet('hash:1', 'name', 'Misha');
//        $redis->hSet('hash:1', 'age', '24');
//        $redis->hSet('hash:1', 'email', 'local@local.com');
//        $redis->hMSet('hash:1', ['age' => '24', 'email' => 'local@local.com']);
//        $redis->hIncrBy('hash:1', 'age', 10);
//        dd($redis->hGetAll('hash:1'));

//        $redis->zAdd('sorted:set:1', 100, 'Vasya');
//        $redis->zAdd('sorted:set:1', 500, 'Petya');
//        $redis->zAdd('sorted:set:1', 50, 'Misha');

//        dd($redis->zRange('sorted:set:1', 0, -1, true));
//        dd($redis->zRevRank('sorted:set:1', 'Petya'));

//        Удаляет все данные из редиса
//        $redis->flushAll();
        $redis->xAdd('stream', '*', ['temp_f'=>'1', 'data'=>'1', 'time' => now()]);
        $redis->xRange('stream', 1674233417927, now()->getTimestampMs());
        $redis->xTrim('stream', 20, false);
        dd($redis->xRead(['stream' => '1674233417927']));
        $redis->close();
        return view('redis', compact('array'));
    }
}
