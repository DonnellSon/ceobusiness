//navbar sticky
window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    if(window.document.scrollingElement.scrollTop > 700){
        header.classList.add('sticky');
    }
    else{
        header.classList.remove('sticky');
    }
});


//nabar responsive navigation
var menu = document.querySelector('.menu');
var menuBtn = document.querySelector('.menu-btn');
var closeBtn = document.querySelector('.close-btn');

menuBtn.addEventListener("click", () => {
    menu.classList.add('active');
});

closeBtn.addEventListener("click", () =>{
    menu.classList.remove('active');
});