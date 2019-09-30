// /**
//  * Выбор языка
//  */

function lang(lang) {
    console.log("lang " + lang);
    $.ajax({
        type: 'post',
        url: '/home/lang',
        data: {
            lang: lang,
        },
        // dataType: 'JSON',
        success: function(rsp) {
            document.location.href = "/";
        },
        error: function(data, errorThrown) {
            alert('lang :' + errorThrown);
        }
    });
}