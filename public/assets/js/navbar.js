
var menu = document.querySelector('.menu');
var menuBtn = document.querySelector('.menu-btn');
var closeBtn = document.querySelector('.close-btn');
let navBtns=document.querySelectorAll('.menu .nav-btn');

menuBtn.addEventListener("click", () => {
    menu.classList.add('active');
});

closeBtn.addEventListener("click", () =>{
    menu.classList.remove('active');
});
navBtns.forEach(function(nav){
    nav.addEventListener("click", () =>{
        menu.classList.remove('active');
    })
})