export function AjaxJson(method, url, data = null) {

    var URL_WEB = $('meta[name="url-app"]').attr('content');
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    let paramResponse =

        $.ajax({
            method: method,
            url: URL_WEB + '/' + url,
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
              xhr.setRequestHeader('X-CSRF-Token', CSRF_TOKEN)
            },
        })
            .done(function (data) {
                return data;
            })
            .fail(function (jqXHR, error, errorThrown) {
                return jqXHR;
            });

    return paramResponse;

}

export function AjaxSimple(method, url, data = null) {

    var URL_WEB = $('meta[name="url-app"]').attr('content');
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    let paramResponse =

        $.ajax({
            method: method,
            url: URL_WEB + '/' + url,
            data: data,
            beforeSend: function(xhr) {
              xhr.setRequestHeader('X-CSRF-Token', CSRF_TOKEN)
            },
        })
            .done(function (data) {
                return data;
            })
            .fail(function (jqXHR, error, errorThrown) {
                return jqXHR;
            });

    return paramResponse;
}
