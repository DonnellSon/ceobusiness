(function () {
    var form = document.getElementById('user_reg')
    form.addEventListener('submit', function (e) {
        e.preventDefault()
        grecaptcha.ready(function () {
            grecaptcha.execute('6LdtHv0pAAAAAA-tZsT1OpYtI7ZI6WYsg2acMJ9c', { action: 'submit' }).then(function (token) {
                var captchaInpt = document.createElement('input')
                captchaInpt.setAttribute('name','g-recaptcha-response')
                captchaInpt.setAttribute('value',token)
                captchaInpt.setAttribute('type','hidden')
                form.appendChild(captchaInpt)
                form.submit()
            })
        })

    })
})()