//
$('#add-category').submit(function (e) {
    e.preventDefault();
    let data = $(this)
    let action = $(this).attr('action')

    $.ajax({
        type: "POST",
        url: `${action}`,
        data: data.serialize()
    }).done(function (message) {
        $('.success-message').html('Категория добавлена')
        $('.success-message').parent().fadeIn()
        setTimeout(function () {
            $('.success-message').parent().fadeOut()
            $('.success-message').html('')
            data.trigger("reset");
        }, 1000);
    });
    return false;
})

$('.del-category').on('click', function (e) {
    e.preventDefault();
    let data = $(this)
    let action = $(this).attr('action')
    let tr = $(this).closest('.cat-item')

    $.ajax({
        type: "post",
        url: `${action}`,
        data: data.serialize()
    }).done(function (message) {
        if(message){
            tr.fadeOut()
        }
    });
    return false;
})