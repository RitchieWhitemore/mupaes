<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Str;

/**
 * Class Category
 *
 * @package App\Models
 * @property string $name
 * @property string $menu_name
 * @property string $slug
 * @property string $text
 * @property string $meta_title
 * @property string $meat_description
 * @property string $meta_keywords
 * @property integer $hidden
 * @property int|null $parent_id
 * @property int $depth
 * @property Category $parent
 * @property Category[] $children
 * @property Page[] $pages
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read int|null $pages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category d()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category findSimilarSlugs($attribute, $config, $slug)
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Category newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Category newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMenuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements HasMedia
{
    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    use HasMediaTrait;

    const HIDDEN_NO = 0;
    const HIDDEN_YES = 1;

    protected $fillable = [
        'parent_id',
        'name',
        'menu_name',
        'text',
        'hidden',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_categories';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }

    public static function getHiddenArray()
    {
        return [
            self::HIDDEN_NO => 'Нет',
            self::HIDDEN_YES => 'Да'
        ];
    }

    public function getHiddenAttribute($value)
    {
        return \Arr::get(Category::getHiddenArray(), $value);
    }

    public function getParentName()
    {
        return isset($this->parent) ? $this->parent->name : '';
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb-admin')
            ->width(100)
            ->height(100);
    }

    /**
     * @param $attribute
     * @param Request $request
     * @param $collectionName
     */
    public function uploadImage($attribute, Request $request, $collectionName)
    {
        if (isset($request[$attribute])) {
            $fileName = Str::before($request->file($attribute)->getClientOriginalName(),
                '.' . $request->file($attribute)->getClientOriginalExtension());
            $fileName = Str::slug($fileName);

            $this->clearMediaCollectionExcept($collectionName, $this->getFirstMedia());
            $this->addMediaFromRequest($attribute)
                ->preservingOriginal()
                ->usingName($fileName)
                ->usingFileName($fileName . '.' . $request->file($attribute)->getClientOriginalExtension())
                ->toMediaCollection($collectionName, 'category');
        }
    }

    /**
     * @return Category[]
     */
    public static function getCategoriesForDropdown()
    {
        $categories = self::defaultOrder()->select(['id', 'name'])->withDepth()->get();

        foreach ($categories as $category) {
            $indent = '';
            for ($i = 0; $i < $category->depth; $i++) {
                $indent .= ' &mdash; ';
            }

            $category->name = $indent . $category->name;
        }

        //$categories->prepend('Выберите категорию', '');

        return $categories->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }
}
