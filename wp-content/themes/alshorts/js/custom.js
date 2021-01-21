$('.prodect-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                arrows: false,
                dots: false,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                arrows: false,
                dots: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                arrows: false,
                dots: false,
            }
        }
    ]
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('.prodect-slider').slick('setPosition');
})
$(".mobile-menu").click(function () {
    $(".header-menu").slideToggle("active");
});

$(".mobile-menu").click(function () {
    $(".mobile-menu span").toggleClass("active");
});

jQuery(document).ready(function () {
    $(window).scroll(function () {
        var sticky = $('#main-header');
        var scroll = $(window).scrollTop();
        if (scroll > 50)
            sticky.addClass('sticky');
        else
            sticky.removeClass('sticky');
    });

    $(document).on('click', ".contact_deadline_div", function () {
        let dateToday = new Date();
        this.todayDate = dateToday.toISOString().slice(0, 10);
        (document.getElementById("contact_deadline")).min = this.todayDate;
    });

    /**
     * Remvie the empty p tags.
     */
    $('p:empty').remove();
});