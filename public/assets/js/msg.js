$(document).ready(function () {
    $('.msg-style > button').on('click',function(){
        $('.box',$(this).parent('.msg-style')).addClass('opened')
    })
    $('.msg-style .close').on('click',function(){
        $('.box',$(this).parents('.msg-style')).removeClass('opened')
    })
});