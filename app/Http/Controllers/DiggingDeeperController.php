<?php

namespace App\Http\Controllers;

use App\Models\Blog\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();

        // dd(__METHOD__,$eloquentCollection, $eloquentCollection->toArray());

        $collection = collect($eloquentCollection->toArray());
        // dd(__METHOD__, get_class($eloquentCollection), get_class($collection), $collection);

//        $first = $collection->first();
//        $last = $collection->last();
//        // dd($first, $last);
//        $select = $collection->where('category_id', 10)->values()->keyBy('id');
//
//        $result['where']['count'] = $select->count();
//        $result['where']['isEmpty'] = $select->isEmpty();
//        $result['where']['isNotEmpty'] = $select->isNotEmpty();
//
//        $result['where_first'] = $collection->firstWhere('deleted_at', '>', '2022-08-15 01:01:01');
//
//        // Базовая коллекция не меняется, возвращается новая
//        $result['map']['all'] = $collection->map(function ($item) {
//                $newItem = new \stdClass();
//                $newItem->item_id = $item['id'];
//                $newItem->item_name = $item['title'];
//                $newItem->exists = is_null($item['deleted_at']);
//                return $newItem;
//        });
//        $result['map']['deleted'] = $result['map']['all']->where('exists', false)->values()->keyBy('item_id');
//        dd($result);

        // Меняется базовая коллекция
        $collection = $collection->transform(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

//        $item1 = new \stdClass();
//        $item2 = new \stdClass();
//        $item1->id = 1111;
//        $item2->id = 2222;
//
//        // вставка элемента в начало коллекции причем ->first() означает получить первый элемент (если получать
//        // не надо можно без него)
//        $newItemFirst = $collection->prepend($item1)->first();
//
//        // вставка элемента в конец коллекции причем ->last() означает получить последний элемент (если получать
//        // не надо можно без него)
//        $newItemLast = $collection->push($item2)->last();
//
//        // забрать элемент из коллекции (не копия, а прям вырезает)
//        $pulledItem = $collection->pull(1);
//
//        dd($collection, $newItemFirst, $newItemLast, $pulledItem);
//
//        $filtered = $collection->filter(function ($item) {
//           $byDay = $item->created_at->isMonday();
//           return $byDay;
//        });
//        dd($filtered);

        $sortedSimpleCollection = collect([1, 546, 445, 4 , 4, 2, 122])->sort()->values();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');
    }
}
