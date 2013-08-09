var App = function () {

    function handleCode() {
        window.prettyPrint && prettyPrint()
    }

    return {
        init: function () {
//            handleBootstrap();
//            handleSearch();
            handleCode();
        }

    };
}();

//$(document).ready(function(){
//
//    lte8 = false;
//
//    // Rotating quotes for homepage footer
//    var $quotes = $('section.quotes li'),
//        $quotescontainer = $('section.quotes'),
//        $quotetext = $('section.quotes .quote-text p'),
//        $quotearrow = $('<div class="replace quote-arrow"></div>'),
//        $quote,
//        $quotescontainer,
//        currentquote = 0,
//        quoteplay = true,
//        quoteinterval = 100,
//        quotenavoffset = 162; // because Chrome won't recognise the .position() correctly
//
//    if( lte8 ){
//        quoteinterval = 0;
//    }
//
//    var quotes = {
//        init : function(){
//            $quotes.each(function(index){
//                $(this).click(function(){
//                    quoteplay = false;
//                    quotes.swapquote( index );
//                });
//            });
//            $quotescontainer.append($quotearrow);
//            quotes.swapquote(0);
//        },
//        navigate : function(index){
//            setTimeout(function() {
//                if(quoteplay === true){
//                    if(currentquote+1 < $quotes.length){
//                        currentquote++;
//                        quotes.swapquote(currentquote);
//                    } else {
//                        currentquote = 0;
//                        quotes.swapquote(0);
//                    }
//                }
//            }, 4000);
//        },
//        swapquote : function(index){
//            $quotetext.stop().animate({ opacity: 0 }, quoteinterval, function(){
//                $quotes.removeClass('selected');
//                $quotes.eq(index).addClass('selected');
//                var $trigger = $quotes.eq(index).find('h3');
//                var triggerpos = $trigger.position();
//                $quotearrow.stop().animate({ left : triggerpos.left + quotenavoffset + ( $trigger.width() / 2 ) - ( $quotearrow.width() / 2 ) }, quoteinterval, 'easeOutExpo');
//                $(this).html( $quotes.eq(index).find('p').html() ).animate({ opacity: 1 }, quoteinterval, function(){
//                    if( lte8 ){
//                        this.style.removeAttribute('filter');
//                    }
//                    if( quoteplay == true ){
//                        quotes.navigate(index);
//                    }
//                });
//            });
//        }
//    }
//    quotes.init();
//
//
//
////    $(function(){
////        $("#slides").slidesjs({
////            width: 1200,
////            height: 520,
////            navigation: {
////                active: false,
////                effect: "fade"
////            },
////            pagination: {
////                active: false,
////                effect: "fade"
////            },
////            play: {
////                effect: "fade",
////                active: false,
////                auto: true,
////                interval: 8000,
////                swap: true,
////                pauseOnHover: true,
////                restartDelay: 8000
////            },
////            effect: {
////                fade: {
////                    speed: 900
////                }
////            }
////        });
////    });
//
//});