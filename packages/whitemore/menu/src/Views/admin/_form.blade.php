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
        {!!Form::select('type', 'Тип меню', Whitemore\Menu\Models\Menu::TYPE_LIST)->id('type') !!}
    </div>

    <div class="col-12">
        {!!Form::select('item_type', 'Модуль', Whitemore\Menu\Models\Menu::MODULES)->id('modules') !!}
    </div>

    <div class="col-12">
        {!!Form::select('item_id', 'Элемент', isset($model) ? $model->getItemsAsDropdown() : \App\Models\Page::asDropdown())->attrs(['class' => 'selectpicker'])->id('items') !!}
    </div>

    <div class="col-12">
        {!!Form::text('link', 'Внешняя ссылка') !!}
    </div>

    <div class="col-12">
        {!!Form::select('show_menu', 'Показывать в меню', \Whitemore\Menu\Models\Menu::getHiddenArray())!!}
    </div>

    <div class="col-12">
        {!!Form::select('hide_children', 'Скрыть вложеные элементы', \Whitemore\Menu\Models\Menu::getHiddenArray())!!}
    </div>

    <div class="col-12">
        {!! Form::select('hidden', 'Скрыто', \Whitemore\Menu\Models\Menu::getHiddenArray()) !!}
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $('#modules').change(function () {
                var url;
                var value = $(this).val();
                if (value == "{{addslashes(\App\Models\Page::class)}}") {
                    url = '{{route('admin.page.items')}}'
                } else {
                    url = '{{route('admin.category.items')}}'
                }

                $.ajax({
                    url: url,
                    cache: false,
                    success: function (response) {
                        if (response.items) {
                            // $('#items').select2('data', null).trigger('change');
                            $('#items').html('').select2({
                                data: response.items
                            }).trigger('change');
                        }
                    }
                })
            })
        })
    </script>
@endsection
