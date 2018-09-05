'use strict';
jQuery(window).load( function() {

    jQuery('#s').attr('placeholder','Type and hit enter...');
    // LIGHTBOX VIDEO
    jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });

//PRELOADER
    /** Loader */
    var loader = jQuery(".loader");
    var wHeight = jQuery(window).height();
    var wWidth = jQuery(window).width();
    var o = 0;

    loader.css({
        top: wHeight / 2 - 2.5,
        left: wWidth / 2 - 200
    })

    do {
        loader.animate({
            width: o
        }, 10)
        o += 3;
    } while (o <= 400)
    if (o === 402) {
        loader.animate({
            left: 0,
            width: '100%'
        })
        loader.animate({
            top: '0',
            height: '100vh'
        })
    }

    setTimeout(function() {
        jQuery(".loader-wrapper").fadeOut('fast');
        (loader).fadeOut('fast');
    }, 3500);


    if (jQuery('.isotope_items').length) {

        // PORTFOLIO ISOTOPE
        var jQuerycontainer = jQuery('.isotope_items');
        jQuerycontainer.isotope();

        jQuery('.portfolio_filter ul li').on("click", function(){
            jQuery(".portfolio_filter ul li").removeClass("select-cat");
            jQuery(this).addClass("select-cat");
            var selector = jQuery(this).attr('data-filter');
            jQuery(".isotope_items").isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false,
                }
            });
            return false;
        });

    }

}); // window load end



jQuery(document).ready( function() {


    // WOW JS
    new WOW({ mobile: false }).init();



    //SMOOTH SCROLL
    jQuery(document).on("scroll", onScroll);
    jQuery('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        jQuery(document).off("scroll");

        jQuery('a').each(function () {
            jQuery(this).removeClass('active');
            if (jQuery(window).width() < 768) {
                jQuery('.nav-menu').slideUp();
            }
        });

        jQuery(this).addClass('active');

        var target = this.hash,
            menu = target;
        target = jQuery(target);
        jQuery('html, body').stop().animate({
            'scrollTop': target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target.selector;
            jQuery(document).on("scroll", onScroll);
        });
    });


    function onScroll(event){
        if (jQuery('#home').length) {
            var scrollPos = jQuery(document).scrollTop();
            jQuery('nav ul li a').each(function () {
                var currLink = jQuery(this);
                var refElement = jQuery(currLink.attr("href"));
                if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                    jQuery('nav ul li a').removeClass("active");
                    currLink.addClass("active");
                }
                else{
                    currLink.removeClass("active");
                }
            });
        }
    }


    //NAVBAR SHOW - HIDE
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        var homeheight = jQuery(".one-page-section .home").height() -86;

        if (scroll > homeheight ) {
            jQuery("nav").slideDown(100);
        } else {
            jQuery("nav").slideUp(100);
        }
    });


    // RESPONSIVE MENU
    jQuery('.responsive').on('click', function (e) {
        jQuery('.nav-menu').slideToggle();
    });


    // HOME PAGE HEIGHT
    function centerInit() {
        var hometext = jQuery('.one-page-section .home')

        hometext.css({
            "height": jQuery(window).height() + "px"
        });
    }
    centerInit();
    jQuery(window).resize(centerInit);


    // HOME TYPED JS
    if (jQuery('.element').length) {
        jQuery('.element').each(function () {
            jQuery(this).typed({
                strings: [jQuery(this).data('text1'), jQuery(this).data('text2')],
                loop: jQuery(this).data('loop') ? jQuery(this).data('loop') : false ,
                backDelay: jQuery(this).data('backdelay') ? jQuery(this).data('backdelay') : 2000 ,
                typeSpeed: 10,
            });
        });
    }

    jQuery(function(){
        jQuery("#P1").YTPlayer();
    });

    //SUPER SLIDER
    jQuery('#slides').superslides({
        animation: 'fade',
        play: 3000
    });

    // MAGNIFIC POPUP FOR PORTFOLIO PAGE
    jQuery('.link').magnificPopup({
        type:'image',
        gallery:{enabled:true},
        zoom:{enabled: true, duration: 300}
    });

    //Tooltip
    jQuery('[data-toggle="tooltip"]').tooltip();

    // OWL CAROUSEL GENERAL JS
    var owlcar = jQuery('.owl-carousel');
    if (owlcar.length) {
        owlcar.each(function () {
            var jQueryowl = jQuery(this);
            var itemsData = jQueryowl.data('items');
            var autoPlayData = jQueryowl.data('autoplay');
            var paginationData = jQueryowl.data('pagination');
            var navigationData = jQueryowl.data('navigation');
            var stopOnHoverData = jQueryowl.data('stop-on-hover');
            var itemsDesktopData = jQueryowl.data('items-desktop');
            var itemsDesktopSmallData = jQueryowl.data('items-desktop-small');
            var itemsTabletData = jQueryowl.data('items-tablet');
            var itemsTabletSmallData = jQueryowl.data('items-tablet-small');
            jQueryowl.owlCarousel({
                items: itemsData
                , pagination: paginationData
                , navigation: navigationData
                , autoPlay: autoPlayData
                , stopOnHover: stopOnHoverData
                , navigationText: ["<", ">"]
                , itemsCustom: [
                    [0, 1]
                    , [500, itemsTabletSmallData]
                    , [710, itemsTabletData]
                    , [992, itemsDesktopSmallData]
                    , [1199, itemsDesktopData]
                ]
                , });
        });
    }

    //PORTFOLIO WOW CANCEL
    jQuery(".portfolio_filter li").click(function(){
        jQuery('.wow').addClass('wow-removed').removeClass('wow').removeClass('fadeInUp');
    });


}); // document ready end


