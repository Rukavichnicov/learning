<?php

namespace App\Repositories;

use App\Models\Blog\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * @param int|null $countPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(int $countPage = null)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
                       ->select($columns)
                       ->orderBy('id', 'DESC')
                       ->with(['category:id,title', 'user:id,name'])
                       ->paginate($countPage);
        return $result;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }
}
