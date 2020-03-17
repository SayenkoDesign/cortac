$(document).ready(function () {
    $('.main-menu').css('min-height', $(window).height());
    $('.menu-icon').on('click', function () {
        $('.main-menu').fadeToggle("slow");
        $('body').toggleClass('overflow-hidden');
    });
    $('.menu-icon.close').on('click', function () {
        $('.main-menu').fadeOut("slow");
        $('body').css('overflow-y', 'auto');
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

        margin: 8,
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
                nav: true
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
});
function openMenu() {
    $('.main-menu').slideDown("slow ");
    $('body').css('overflow-y', 'hidden');
}