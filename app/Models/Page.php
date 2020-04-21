<?php


namespace App\Models;

use App\Traits\HiddenInterface;
use App\Traits\HiddenTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Str;

/**
 * Class Page
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
 * @property int $id
 * @property int $category_id
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMenuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page notHidden()
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page isArticles()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page isPromotions()
 */
class Page extends Model implements HiddenInterface, HasMedia
{
    use Sluggable, HiddenTrait, HasMediaTrait;

    protected $fillable = [
        'category_id',
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


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryName()
    {
        if ($this->category) {
            return $this->category->name;
        }
        return '';
    }

    public function scopeIsArticles()
    {
        return $this->whereHas('category', function (Builder $query) {
            $query->where('slug', '=', 'articles');
        })->with('category');
    }

    public function scopeIsPromotions()
    {
        return $this->whereHas('category', function (Builder $query) {
            $query->where('slug', '=', 'promotions');
        })->with('category');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb-admin')
            ->width(100)
            ->height(100);

        $this->addMediaConversion('public')
            ->width(350)
            ->height(370)
            ->crop(Manipulations::CROP_TOP, 350, 370);

        $this->addMediaConversion('promo-small')
            ->width(270)
            ->height(385)
            ->crop(Manipulations::CROP_TOP, 270, 385);
    }

    /**
     * @param $attribute
     * @param Request $request
     * @param $collectionName
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
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
                ->toMediaCollection($collectionName);
        }
    }

    public function getSEOTitle(): string
    {
        return $this->meta_title ?? $this->name;
    }

    public function getSEODescription(): string
    {
        return $this->meta_description ?? '';
    }

    public function getSEOKeywords(): string
    {
        return $this->meta_keywords ?? '';
    }
}
