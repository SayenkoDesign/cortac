$(document).ready(function () {
    $('.main-menu').css('min-height', $(window).height());
    $('.menu-icon').on('click', function () {
        $('.main-menu').fadeToggle(10);
        $('body').toggleClass('overflow-hidden');
    });
    var servicesItem = $('a[href="/#services"]');
    $('.menu-icon.close').on('click', function () {
        $('.main-menu').fadeOut(10);
        $('body').css('overflow-y', 'auto');
        $('body').removeClass('overflow-hidden');
    });
    //jQuery for owl Carousel starts here

    var owl = $("#owl-demo-2");

    owl.owlCarousel({
        navigationText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"],
        autoplay: true,
        dots: false,
        navigation: false,
        autoplayTimeout: 10000,
        navText: ['&#xf053;', '&#xf054;'],
        autoplayHoverPause: true,
        items: 5,
        loop: true,
        center: false,
        rewind: false,

        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        freeDrag: false,

        margin: 10,
        stagePadding: 80,

        merge: false,
        mergeFit: true,
        autoWidth: false,

        startPosition: 0,
        rtl: false,

        dragEndSpeed: false,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            480: {
                items: 2,
                nav: false
            },
            768: {
                items: 2,
                nav: true,
                loop: true
            },
            992: {
                items: 3,
                nav: true,
                loop: true
            }
        },
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,

        fallbackEasing: 'swing',

        info: false,

        nestedItemSelector: false,
        itemElement: 'div',
        stageElement: 'div',

        refreshClass: 'owl-refresh',
        loadedClass: 'owl-loaded',
        loadingClass: 'owl-loading',
        rtlClass: 'owl-rtl',
        responsiveClass: 'owl-responsive',
        dragClass: 'owl-drag',
        itemClass: 'owl-item',
        stageClass: 'owl-stage',
        stageOuterClass: 'owl-stage-outer',
        grabClass: 'owl-grab',
        autoHeight: false,
        lazyLoad: false,
        animateOut: 'fadeOut'
    });

    // Go to the next item
    $('.next').click(function () {
        owl.trigger('next.owl.carousel');
    })
    // Go to the previous item
    $('.prev').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger('prev.owl.carousel', [300]);
    })

    //jquery for owl Carousel ends here

    var myNavBar = {
        flagAdd: true,
        elements: [],
        init: function (elements) {
            this.elements = elements;
        },
        add: function () {
            if (this.flagAdd) {
                for (var i = 0; i < this.elements.length; i++) {
                    document.getElementById(this.elements[i]).className += " fixed-theme";
                }
                this.flagAdd = false;
            }
        },
        remove: function () {
            for (var i = 0; i < this.elements.length; i++) {
                document.getElementById(this.elements[i]).className =
                        document.getElementById(this.elements[i]).className.replace(/(?:^|\s)fixed-theme(?!\S)/g, '');
            }
            this.flagAdd = true;
        }
    };
    myNavBar.init([
        "header",
        "header-container",
        "brand"
    ]);
    function offSetManager() {
        var yOffset = 0;
        var currYOffSet = window.pageYOffset;
        if (yOffset < currYOffSet) {
            myNavBar.add();
        }
        else if (currYOffSet == yOffset) {
            myNavBar.remove();
        }
    }
    window.onscroll = function (e) {
        offSetManager();
    }
    offSetManager();

    $('.modal.modal-video').on('hidden.bs.modal', function (ev) {
            $(this).find("iframe")[0].src = $(".video > iframe")[0].src.toString().replace('?autoplay=1', '');
            $(this).find("iframe")[0].src += "?autoplay=0";
            ev.preventDefault();
        });
    $('.modal.modal-video').on('shown.bs.modal', function (ev) {
            $(this).find("iframe")[0].src = $(".video > iframe")[0].src.toString().replace('?autoplay=0', '');
            $(this).find('iframe').attr('src', $('.video > iframe').attr("src") + '?autoplay=1');
            ev.preventDefault();
        });


    $('body').keydown(function (e) {
        if (e.keyCode == 27) {
            $('.main-menu').fadeOut(10);
            $('body').css('overflow-y', 'auto');
            if ($('body').hasClass('modal-open')) {
                $('.modal.fade').modal('hide');
            }
        }
    });
    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scroll-top').fadeIn();
        } else {
            $('.scroll-top').fadeOut();
        }
    });
    //Click event to scroll to top
    $('.scroll-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });
});
function openMenu() {
    $('.main-menu').slideDown("slow ");
    $('body').css('overflow-y', 'hidden');
}
