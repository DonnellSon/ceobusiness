let mer = document.getElementById('mer');
let ciel = document.getElementById('ciel');
let bulding = document.getElementById('bulding');
let ceo = document.getElementById('ceo');
let section = document.getElementById('section');
let acceuil = document.getElementById('acceuil');

window.addEventListener('scroll', function () {
    let value = window.scrollY;
    let scale = 1;

    if (scale + (value / 2000) < window.innerWidth * 2) {
        mer.style.top = value * 6.05 + 'px'
        mer.style.transform = `scale(${scale + (value / 100)})`;
    }
    if (scale + (value / 1000) < window.innerWidth * 2) {
        bulding.style.transform = `scale(${scale + (value / 2000)})`;
        bulding.style.buttom = value * 0.5 + 'px';
    }

    ceo.style.transform = `scale(${scale - (value / 2000)}) translate(-50vw, -50vh) !important`;

})