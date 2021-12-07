(function ($) {
    "use strict"

    // Fixed Nav
    var lastScrollTop = 0;
    $(window).on('scroll', function () {
        var wScroll = $(this).scrollTop();
        if (wScroll > $('#nav').height()) {
            if (wScroll < lastScrollTop) {
                $('#nav-fixed').removeClass('slide-up').addClass('slide-down');
            } else {
                $('#nav-fixed').removeClass('slide-down').addClass('slide-up');
            }
        }
        lastScrollTop = wScroll
    });

    // Search Nav
    $('.search-btn').on('click', function () {
        $('.search-form').addClass('active');
    });

    $('.search-close').on('click', function () {
        $('.search-form').removeClass('active');
    });

    // Aside Nav
    $(document).click(function (event) {
        if (!$(event.target).closest($('#nav-aside')).length) {
            if ($('#nav-aside').hasClass('active')) {
                $('#nav-aside').removeClass('active');
                $('#nav').removeClass('shadow-active');
            } else {
                if ($(event.target).closest('.aside-btn').length) {
                    $('#nav-aside').addClass('active');
                    $('#nav').addClass('shadow-active');
                }
            }
        }
    });

    $('.nav-aside-close').on('click', function () {
        $('#nav-aside').removeClass('active');
        $('#nav').removeClass('shadow-active');
    });

    // Sticky Shares
    var $shares = $('.sticky-container .sticky-shares'),
        $sharesHeight = $shares.height(),
        $sharesTop,
        $sharesCon = $('.sticky-container'),
        $sharesConTop,
        $sharesConleft,
        $sharesConHeight,
        $sharesConBottom,
        $offsetTop = 80;

    function setStickyPos() {
        if ($shares.length > 0) {
            $sharesTop = $shares.offset().top
            $sharesConTop = $sharesCon.offset().top;
            $sharesConleft = $sharesCon.offset().left;
            $sharesConHeight = $sharesCon.height();
            $sharesConBottom = $sharesConHeight + $sharesConTop;
        }
    }

    function stickyShares(wScroll) {
        if ($shares.length > 0) {
            if ($sharesConBottom - $sharesHeight - $offsetTop < wScroll) {
                $shares.css({position: 'absolute', top: $sharesConHeight - $sharesHeight, left: 0});
            } else if ($sharesTop < wScroll + $offsetTop) {
                $shares.css({position: 'fixed', top: $offsetTop, left: $sharesConleft});
            } else {
                $shares.css({position: 'absolute', top: 0, left: 0});
            }
        }
    }

    $(window).on('scroll', function () {
        stickyShares($(this).scrollTop());
    });

    $(window).resize(function () {
        setStickyPos();
        stickyShares($(this).scrollTop());
    });

    setStickyPos();


    // =========== Лайки ===========

    $('.add-like').submit(function (e) {
        e.preventDefault();
        let data = $(this)
        let action = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: `${action}`,
            data: data.serialize()
        }).done(function (message) {
            // console.log(message)
        });
        return false;
    })

    let likeIco = document.querySelectorAll('.like-btn i')
    likeIco.forEach(function (el) {
        let parent = el.parentNode
        if(el.classList.contains('fa-bookmark') || el.classList.contains('fa-heart')){
            parent.setAttribute('data-like', 1)
        }
    })

    $('.like-btn').click(function (e) {
        var counter = $(this).siblings('.like-count')
        var count = +counter.html()
        var ico = $(this).data('ico')

        if($(this).attr('data-like') == 0){
            $(this).attr('data-like', 1)
            $(this).html(`<i class="fa fa-${ico}" aria-hidden="true"></i>`)
            count++
            counter.html(count)
        }else if($(this).attr('data-like') == 1){
            $(this).attr('data-like', 0)
            $(this).html(`<i class="fa fa-${ico}-o" aria-hidden="true"></i>`)
            count--
            counter.html(count)
        }
    })

    // =========== Лайки ===========

    // =========== Комментарии ===========
    $('.reply').on('click', function(e){
        let id = $(this).attr('id')

        $('#parent_id').val(id)
    })

})(jQuery);
