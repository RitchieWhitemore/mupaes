<?php


namespace Whitemore\Menu\src\Models;


use Form;

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

    protected function addItem($item, $position)
    {

        $this->result .= '<li data-id="' . $item->id . '" data-old-position="' . $position . '">';
        $this->result .= '<div class="list-group-item">
                                <div class="handle ui-sortable-handle"><i class="fas fa-arrows-alt-v"></i></div>'
            . $item->title .
            '<div class="control">
                                    <a href="' . route('menu.create', ['parent' => $item]) . '"><i class="fas fa-plus"></i></a>
                                    <a href="' . route('menu.show', $item) . '" title="Просмотр" aria-label="Просмотр" data-pjax="0"><i class="far fa-eye"></i></a>
                                    <a href="' . route('menu.edit',
                $item) . '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><i class="fas fa-pen"></i></a>' .
            Form::open()->route('menu.destroy',
                [$item])->method('delete')->attrs(['class' => 'pull-right admin-delete-form']) .
            Form::submit('<i class="fas fa-times"></i>')->attrs(['data-confirm' => 'Вы уверены?']) .
            Form::close() .
            '</div>
                         </div>';

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

}
