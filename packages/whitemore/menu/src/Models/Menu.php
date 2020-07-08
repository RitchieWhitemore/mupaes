<?php

namespace Whitemore\Menu\Models;

use App\Models\Category;
use App\Models\Page;
use App\Traits\HiddenInterface;
use App\Traits\HiddenTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Whitemore\Menu\Models\Menu
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $type
 * @property string|null $item_type
 * @property int|null $item_id
 * @property string|null $link
 * @property int $hide_children
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property int $hidden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\Whitemore\Menu\Models\Menu[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $item
 * @property-read \Whitemore\Menu\Models\Menu|null $parent
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu d()
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu findSimilarSlugs($attribute, $config, $slug)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|\Whitemore\Menu\Models\Menu newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\Whitemore\Menu\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu notHidden()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\Whitemore\Menu\Models\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereHideChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $show_menu
 * @method static \Illuminate\Database\Eloquent\Builder|\Whitemore\Menu\Models\Menu whereShowMenu($value)
 */
class Menu extends Model implements HiddenInterface
{
    use HiddenTrait;

    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    const TYPE_MODULE = 0;
    const TYPE_LINK = 1;
    const TYPE_EMPTY = 2;

    const TYPE_LIST = [
        self::TYPE_MODULE => 'Модуль',
        self::TYPE_LINK => 'Внешняя ссылка',
        self::TYPE_EMPTY => 'Пустой элемент',
    ];

    const MODULES = [
        Page::class => 'Страницы',
        Category::class => 'Категории страниц',
    ];

    protected $table = 'menu';

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'type',
        'link',
        'item_type',
        'item_id',
        'show_menu',
        'hide_children',
        'hidden',
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
                'source' => 'title'
            ]
        ];
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }

    public function isEmpty()
    {
        return $this->type === self::TYPE_EMPTY;
    }

    public function getParentTitle()
    {
        return isset($this->parent) ? $this->parent->title : '';
    }

    public function getItemsAsDropdown()
    {
        switch ($this->item_type) {
            case Page::class:
                return Page::asDropdown();
            case Category::class:
                return Category::asDropdown();
        }
    }

    public function getUrl()
    {
        $result = self::defaultOrder()->ancestorsAndSelf($this->id)->pluck('slug');

        $result->shift();

        return $result->implode('/', 'slug');
    }

    public static function asDropdown()
    {
        $menu = self::defaultOrder()->select(['id', 'title'])->withDepth()->get();

        foreach ($menu as $item) {
            $indent = '';
            for ($i = 0; $i < $item->depth; $i++) {
                $indent .= ' &mdash; ';
            }

            $item->title = $indent . $item->title;
        }

        $result = $menu->mapWithKeys(function ($item) {
            return [$item['id'] => $item['title']];
        });

        return $result;
    }

    public function showMenuIcon()
    {
        return $this->show_menu ? '<i class="far fa-eye"></i> ' : '<i class="far fa-eye-slash"></i> ';
    }

    public function showChildrenIcon()
    {
        return $this->hide_children ? '<i class="fas fa-users-slash"></i> ' : '<i class="fas fa-users"></i> ';
    }
}
