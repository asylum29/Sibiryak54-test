$(document).ready(function () {
    var loading  = $('#loading');
    var error    = $('#error');
    var entry    = $('#ipinfo');
    var template = $('#ipinfotmpl').html();
    $('#getipinfo').on('click', function (e) {
        e.preventDefault();
        entry.not('#ipinfotmpl').empty();
        error.hide();
        loading.show();
        var ip = $(e.target).closest('form').find("input[name='ip']").val();
        $.ajax({
            type: 'get',
            url: '/api/ip/' + ip,
            dataType: 'json',
            success: function (data) {
                if (data && !$.isEmptyObject(data)) {
                    entry.append(
                        Mustache.render(template, { 'ipinfo': data })
                    );
                } else {
                    error.show();
                }
            },
            error: function () {
                error.show();
            },
            complete: function () {
                loading.hide();
            }
        });
    });
});
