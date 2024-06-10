(async function(){
    const res = await fetch('https://gatenews.africa/api/posts/latest')
    const news = await res.json()
    console.log(news,'CONTRIES')
    var gatenews=document.querySelectorAll('.gatenews-sld .sld-parent')
    var footerNews=document.querySelectorAll('.footer-news')
    gatenews.forEach(function(g){
        g.innerHTML=""
        news.forEach(function(n){
            g.innerHTML+=`<a href="/" class="sld d-flex align-items-center gap-10">
            <img class="d-block" src="${n.photoUrl}" alt="CEO Business Forum">
            <h1 class="m-0">${n.title}</h1>
        </a>`
        })
    })
    footerNews.forEach(function(g){
        g.innerHTML=""
        news.slice(0, -2).forEach(function(n){
            g.innerHTML+=`<li>
            <a href="${n.url}" class="latest-news-link-preview d-flex">
                <div class="img position-relative">
                    <img class="position-absolute"
                        src="${n.photoUrl}"
                        alt="">
                </div>
                <div class="capt">
                    <h4 class="ttl line-clamp-2">${n.title}</h4>
                    <small class="ttl line-clamp-2">${n.content}</small>
                </div>
            </a>
        </li>`
        })
    })
})()