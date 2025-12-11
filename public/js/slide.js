$(document).ready(function(){
    $('.book-grid').slick({
        infinite: true,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    infinite: true,              }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    infinite: true,
                }
            },
        ],
    });
});

var rellax = new Rellax('.rellax');
