<?php

namespace App\Repositories;

use App\Models\Blog\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @param int $id
     * @return Model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * @return Collection
     */
    public function getForComboBox()
    {
        $columns = implode(', ', ['id', 'title']);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;

    }

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
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with(
                'parentCategory:id,title'
            )
            ->paginate($countPage);
        return $result;
    }
}
