$('.gymSlider').owlCarousel({
    "items":2,
    "nav":false,
    "slideSpeed":300,
    "dots":true,
    "rtl":is_rtl,
    "paginationSpeed":400,
    "navText":["",""],
    "margin":30,
    "touchDrag":true,
    "responsive":{
        "0":{
            "items":1
        },
        "480":{
            "items":1
        },
        "768":{
            "items":1
        },
        "992":{
            "items":2
        },
        "1200":{
            "items":2
        }
    }
})

$('.bannerTwoSlider').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})