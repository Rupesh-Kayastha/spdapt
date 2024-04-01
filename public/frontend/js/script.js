$(document).ready(function () {
    "use strict";
    //MOBILE MENU
    var mobileClass = true;
    $(".mobile-menu-btn").click(function () {
        $('.header-menu').toggleClass('header-menu-open');
        mobileClass = false;
    });
    $(".header-menu").click(function () {
        mobileClass = false;
    });
    $("html").click(function () {
        if (mobileClass) {
            $(".header-menu").removeClass('header-menu-open');
        }
        mobileClass = true;
    });


    //PROFILE MENU
    var accountClass = true;
    $(".account-login .account-login-link").click(function () {
        $('.account-popup').toggleClass('account-popup-open');
        accountClass = false;
    });
    $(".account-popup").click(function () {
        accountClass = false;
    });
    $("html").click(function () {
        if (accountClass) {
            $(".account-popup").removeClass('account-popup-open');
        }
        accountClass = true;
    });
    
     $(".mob-btn").click(function () {
        $(this).parent('.product-list').toggleClass("mob-d-menu");
    });


    var banner_slider = $(".banner-slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
    });
    // Custom Navigation Events
    $('.next').click(function () {
        banner_slider.trigger('next.owl.carousel');
    });
    $('.prev').click(function () {
        banner_slider.trigger('prev.owl.carousel');
    });

    var tes_slider = $(".tes-slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        autoplay: false,
        autoplayHoverPause: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
    });
    // Custom Navigation Events
    $('.next').click(function () {
        tes_slider.trigger('next.owl.carousel');
    });
    $('.prev').click(function () {
        tes_slider.trigger('prev.owl.carousel');
    });

    // TAB PART
    jQuery('.tabs .tab-links a').on('click', function (e) {
        var currentAttrValue = jQuery(this).attr('href');
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });
    // TAB PART

    var items = $(".product-reviews-part .product-reviews-list");
    var numItems = items.length;
    var perPage = 6;
    items.slice(perPage).hide();
    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });
    var buttonPlus = $(".qty-btn-plus");
    var buttonMinus = $(".qty-btn-minus");
    var incrementPlus = buttonPlus.click(function () {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        $n.val(Number($n.val()) + 1);
    });
    var incrementMinus = buttonMinus.click(function () {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        var amount = Number($n.val());
        if (amount > 0) {
            $n.val(amount - 1);
        }
    });
});

$(document).ready(function () {
    var bigimage = $("#big");
    var thumbs = $("#thumbs");
    var syncedSecondary = true;
    bigimage
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: true,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            ]
        })
        .on("changed.owl.carousel", syncPosition);
    thumbs
        .on("initialized.owl.carousel", function () {
            thumbs
                .find(".owl-item")
                .eq(0)
                .addClass("current");
        })
        .owlCarousel({
            items: 4,
            dots: false,
            nav: false,
            margin: 12,
            navText: [
                '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            ],
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: 4,
            responsiveRefreshRate: 100
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        //to this
        thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = thumbs.find(".owl-item.active").length - 1;
        var start = thumbs
            .find(".owl-item.active")
            .first()
            .index();
        var end = thumbs
            .find(".owl-item.active")
            .last()
            .index();
        if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
        }
    }
    thumbs.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        bigimage.data("owl.carousel").to(number, 300, true);
    });
    
    
    
    $('#default-demo').slickLightbox();
    
    
    
});
