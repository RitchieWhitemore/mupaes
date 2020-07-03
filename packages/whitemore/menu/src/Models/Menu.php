<?php

namespace Whitemore\Menu\Models;

use App\Models\Page;
use App\Traits\HiddenInterface;
use App\Traits\HiddenTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model implements HiddenInterface
{
    use HiddenTrait;

    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    const TYPE_PAGE = 0;

    protected $table = 'menu';

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'type',
        'item',
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

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }

    public function getParentTitle()
    {
        return isset($this->parent) ? $this->parent->title : '';
    }

    public function item()
    {
        return $this->hasOne(Page::class);
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
}
