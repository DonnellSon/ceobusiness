(function(){
    $('.square-radio-label').on('click',function(){
        $('input[type:"radio"]',$(this).parent()).click()
    })
})()