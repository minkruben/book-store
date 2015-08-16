$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind('load resize', function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $('#page-wrapper').css('min-height', (height) + 'px');
        }
    });

    var url = window.location.href;
    var active = '';
    $('#side-menu a').each(function() {
        var href = $(this).attr('href');
        if (url.indexOf(href) == 0 && href.length > active.length) {
            active = href;
        }
    });
    var element = $("#side-menu a[href='" + active + "']").addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }

    $('table #checkall').click(function () {
        if ($(this).is(':checked')) {
            $('tbody input[type=checkbox]').each(function () {
                $(this).prop('checked', true);
            });
        } else {
            $('tbody input[type=checkbox]').each(function () {
                $(this).prop('checked', false);
            });
        }
    });

    $("#form-delete").submit(function () {
        var list = [];
        $('tbody input[type=checkbox]').each(function () {
            if ($(this).is(':checked')) {
                list.push($(this).data('id'));
            }
        });
        if (list.length === 0) {
            alert('No item selected');
            return false;
        }
        $('input[name=checked]').val(list);
    });

    $('div.alert').not('.alert-danger').delay(3000).slideUp(300);

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
});
