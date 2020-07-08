<?php


namespace Whitemore\Menu\src\Models;


use Form;
use Whitemore\Menu\Models\Menu;

class MenuBuilder
{
    protected $result;

    public function getTree($node)
    {
        $this->result .= '<ul id="menu-tree" class="ui-sortable" data-csrf-token="' . csrf_token() . '"
               data-url="' . route('menu.order') . '">';

        foreach ($node as $position => $item) {
            $this->addItem($item, $position);
        }
        $this->result .= '</ul>';

        return $this->result;
    }

    protected function addItem(Menu $item, $position)
    {

        $this->result .= '<li data-id="' . $item->id . '" data-old-position="' . $position . '">';
        $this->result .= '<div class="list-group-item">
                                <div class="handle ui-sortable-handle"><i class="fas fa-arrows-alt-v"></i></div>'
            . '<a href="/' . $item->getUrl() . '" target="_blank">' . $item->title . '</a>' . $this->getControls($item) .

            '</div>';

        $item->children->isNotEmpty() ? $this->getSubTree($item->children) : '';

        $this->result .= '</li>';
    }

    protected function getSubTree($node)
    {
        $this->result .= '<ul class="ui-sortable">';

        foreach ($node as $position => $item) {
            $this->addItem($item, $position);
        }
        $this->result .= '</ul>';
    }

    protected function getControls(Menu $node)
    {
        return '<div class="control">'
            . $node->showMenuIcon()
            . $node->showChildrenIcon() .
            '<a href="' . route('menu.create', ['parent' => $node]) . '"><i class="fas fa-plus"></i></a>
                                    <a href="' . route('menu.edit',
                $node) . '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><i class="fas fa-pen"></i></a>' .
            Form::open()->route('menu.destroy',
                [$node])->method('delete')->attrs(['class' => 'pull-right admin-delete-form']) .
            Form::submit('<i class="fas fa-times"></i>')->attrs(['data-confirm' => 'Вы уверены?']) .
            Form::close() .
            '</div>';
    }


}
