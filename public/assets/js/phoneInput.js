(function () {
    const inputs = document.querySelectorAll(".phone-inpt");
    array.forEach(elem => {
        inputs.intlTelInput(elem, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js",
        });
    });
    
})()