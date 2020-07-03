<div class="row">
    {!! Form::hidden('id') !!}
    <div class="col-12">
        {!!Form::select('parent_id', 'Категория', \Whitemore\Menu\Models\Menu::asDropdown()->toArray(), $parentId ?? null) !!}
    </div>
    <div class="col-12">
        {!!Form::text('title', 'Наименование')!!}
    </div>
    <div class="col-12">
        {!!Form::text('slug', 'Псевдоним')!!}
    </div>

    <div class="col-12">
        {!!Form::select('item', 'Элемент', \App\Models\Page::asDropdown()) !!}
    </div>

    <div class="col-12">
        {!!Form::select('hide_children', 'Скрыть вложеные элементы', \Whitemore\Menu\Models\Menu::getHiddenArray())!!}
    </div>

    <div class="col-12">
        {!! Form::select('hidden', 'Скрыто', \Whitemore\Menu\Models\Menu::getHiddenArray()) !!}
    </div>
</div>
