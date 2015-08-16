$(function() {
    $('#search input').keypress(function (event) {
        if (event.which == 13) {
            var url = $(this).data('url');
            window.location.href = url + '/' + $(this).val();
        }
    });

    $('#search button').click(function () {
        var url = $('#search input').data('url');
        window.location.href = url + '/' + $('#search input').val();
    });

    var width = 0;
    $('.modal').on('show.bs.modal', function() {
        $(this).css('display', 'block');
        var dialog = $(this).find('.modal-dialog');
        var offset = ($(window).height() - dialog.height()) / 2;
        dialog.css('margin-top', offset);
        if (width == 0) {
            width = $('.modal-dialog img').width();
        };
        dialog.css('width', width);
    });

    $(window).on('resize', function () {
        $('.modal:visible').each(function() {
            $(this).css('display', 'block');
            var dialog = $(this).find('.modal-dialog');
            var offset = ($(window).height() - dialog.height()) / 2;
            dialog.css('margin-top', offset);
            width = 0;
        });
    });
});
