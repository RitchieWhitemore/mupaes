$(document).ready(function () {
    $('.ui-sortable').sortable({
        cursor: 'move',
        opacity: 0.6,
        update: function (event, ui) {
            sendOrderToServer(ui.item);
        },
    });

    function sendOrderToServer(item) {

        $.ajax({
            type: "POST",
            dataType: "json",
            cache: false,
            url: $("#menu-tree").data('url'),
            data: {
                position: item.index(),
                oldPosition: $(item).attr('data-old-position'),
                id: $(item).data('id'),
                _token: $("#menu-tree").data('csrf-token')
            }
        }).done(function (response) {
            if (response.status == "success") {
                $this = $('li[data-id="' + response.id + '"]');

                $this.attr('data-old-position', response.newPosition);

                $this.siblings().each(function (index, element) {
                    $(element).attr('data-old-position', index);
                })
                console.log($('li[data-id="' + response.id + '"]'));
            } else {
                console.log(response);
            }
        }).fail(function (response) {
            console.log(response);
        });
    }
})

