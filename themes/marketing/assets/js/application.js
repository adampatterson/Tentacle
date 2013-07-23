var App = function () {

    function handleBootstrap() {
        jQuery('.carousel').carousel({
            interval: 15000,
            pause: 'hover'
        });
        jQuery('.tooltips').tooltip();
        jQuery('.popovers').popover();
    }

    function handleMisc() {
        jQuery('.top').click(function () {
            jQuery('html,body').animate({
                scrollTop: jQuery('body').offset().top
            }, 'slow');
        }); //move to top navigator
    }

    function handleSearch() {
        jQuery('.search').click(function () {
            if(jQuery('.search-btn').hasClass('icon-search')){
                jQuery('.search-open').fadeIn(500);
                jQuery('.search-btn').removeClass('icon-search');
                jQuery('.search-btn').addClass('icon-remove');
            } else {
                jQuery('.search-open').fadeOut(500);
                jQuery('.search-btn').addClass('icon-search');
                jQuery('.search-btn').removeClass('icon-remove');
            }
        });
    }

    function handleSwitcher() {
        var panel = $('.style-switcher');

        $('.style-switcher-btn').click(function () {
            $('.style-switcher').show();
        });

        $('.theme-close').click(function () {
            $('.style-switcher').hide();
        });

        $('li', panel).click(function () {
            var color = $(this).attr("data-style");
            var data_header = $(this).attr("data-header");
            setColor(color, data_header);
            $('.unstyled li', panel).removeClass("theme-active");
            $(this).addClass("theme-active");
        });

        var setColor = function (color, data_header) {
            $('#style_color').attr("href", "assets/css/themes/" + color + ".css");
            if(data_header == 'light'){
                $('#style_color-header-1').attr("href", "assets/css/themes/headers/header1-" + color + ".css");
                $('#logo-header').attr("src", "assets/img/logo1-" + color + ".png");
                $('#logo-footer').attr("src", "assets/img/logo2-" + color + ".png");
            } else if(data_header == 'dark'){
                $('#style_color-header-2').attr("href", "assets/css/themes/headers/header2-" + color + ".css");
                $('#logo-header').attr("src", "assets/img/logo2-" + color + ".png");
                $('#logo-footer').attr("src", "assets/img/logo2-" + color + ".png");
            }
        }
    }

    function handleCode() {
        prettyPrint();
    }

    return {
        init: function () {
            handleBootstrap();
            handleMisc();
            handleSearch();
            handleSwitcher();
            handleCode();
        }

    };
}();

$(document).ready(function(){

    lte8 = false;

    // Rotating quotes for homepage footer
    var $quotes = $('section.quotes li'),
        $quotescontainer = $('section.quotes'),
        $quotetext = $('section.quotes .quote-text p'),
        $quotearrow = $('<div class="replace quote-arrow"></div>'),
        $quote,
        $quotescontainer,
        currentquote = 0,
        quoteplay = true,
        quoteinterval = 100,
        quotenavoffset = 162; // because Chrome won't recognise the .position() correctly

    if( lte8 ){
        quoteinterval = 0;
    }

    var quotes = {
        init : function(){
            $quotes.each(function(index){
                $(this).click(function(){
                    quoteplay = false;
                    quotes.swapquote( index );
                });
            });
            $quotescontainer.append($quotearrow);
            quotes.swapquote(0);
        },
        navigate : function(index){
            setTimeout(function() {
                if(quoteplay === true){
                    if(currentquote+1 < $quotes.length){
                        currentquote++;
                        quotes.swapquote(currentquote);
                    } else {
                        currentquote = 0;
                        quotes.swapquote(0);
                    }
                }
            }, 4000);
        },
        swapquote : function(index){
            $quotetext.stop().animate({ opacity: 0 }, quoteinterval, function(){
                $quotes.removeClass('selected');
                $quotes.eq(index).addClass('selected');
                var $trigger = $quotes.eq(index).find('h3');
                var triggerpos = $trigger.position();
                $quotearrow.stop().animate({ left : triggerpos.left + quotenavoffset + ( $trigger.width() / 2 ) - ( $quotearrow.width() / 2 ) }, quoteinterval, 'easeOutExpo');
                $(this).html( $quotes.eq(index).find('p').html() ).animate({ opacity: 1 }, quoteinterval, function(){
                    if( lte8 ){
                        this.style.removeAttribute('filter');
                    }
                    if( quoteplay == true ){
                        quotes.navigate(index);
                    }
                });
            });
        }
    }
    quotes.init();



//    $(function(){
//        $("#slides").slidesjs({
//            width: 1200,
//            height: 520,
//            navigation: {
//                active: false,
//                effect: "fade"
//            },
//            pagination: {
//                active: false,
//                effect: "fade"
//            },
//            play: {
//                effect: "fade",
//                active: false,
//                auto: true,
//                interval: 8000,
//                swap: true,
//                pauseOnHover: true,
//                restartDelay: 8000
//            },
//            effect: {
//                fade: {
//                    speed: 900
//                }
//            }
//        });
//    });

});