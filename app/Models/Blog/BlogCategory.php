<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 *
 * @package App\Models\Blog
 *
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string $description
 */
class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];
    /**
     * Получить родительскую категорию
     * @return BlogCategory
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     *
     * @return Attribute
     */
    public function parentTitle(): Attribute
    {
        $title = $this->parentCategory->title ?? ($this->id === 1 ? 'Корень' : '???');
        return Attribute::make(
            get: fn () => $title,
        );
    }
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
