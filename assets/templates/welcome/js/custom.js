/***************************************************
	 ADDITIONAL FUNCTIONS SCROLL TO TOP
***************************************************/
jQuery(document).ready(function(){
    
	// hide #back-top first
	jQuery("#back-top").hide();
	
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	$('.getSubData').click(function(){
        $('.getSubData').removeClass('ui-state-active');
        $(this).addClass('ui-state-active');
        return false;
    });
	
	$(function(){
    autoCenter()
        $(window).resize(function(){autoCenter()})//g?i hàm khi resize
        function autoCenter(){
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var widthPopup = $('.popup_research').width();
            var heightPopup = $('.popup_research').height();

			var leftPopup = (windowWidth - widthPopup)/2;
            var topPopup = (windowHeight - heightPopup)/2;
			$('.popup_research').css({"left":leftPopup});
            $('.popup_research').css({"top":topPopup});
        }
    });
    $('.btn_add_research').click(function(){
        $('.popup_research').fadeIn();
    });
    $('.close_popup').click(function(){
        $('.popup_research').fadeOut();
    });
    $(document).keyup(function(e) {
      if (e.keyCode == 27) {
        $('.popup_research').fadeOut();
      }
    });
    /*
    $(".popup_research").mCustomScrollbar({
    	advanced:{
    		updateOnContentResize: true
    	}
    });
    */
    
    $(function() {
        test()
        $(window).resize(function() {
            test()
        })//g?i hàm khi resize
        function test() {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var widthPopup = $('.popup').width();
            var heightPopup = $('.popup').height();
            var leftPopup = (windowWidth - widthPopup) / 2;
            var topPopup = (windowHeight - heightPopup) / 3;
            $('.popup').css({"left": leftPopup});
            $('.popup').css({"top": topPopup});
        }
    });
    

});


function showPopupMessage(content, tittle, close, link)
{
    tittle = (tittle != "") ? tittle : "Message";
    close = (close != "") ? close : "Close";
    $('.popup').html("<div class='popup-header ui-dialog-titlebar ui-widget-header'><p>"+tittle+"</p><span onclick=\"closePopup('"+link+"')\" class='ui-icon ui-icon-closethick popup-close'>"+close+"</span></div><div class='popup-content'>"+content+"</div>");
    $('.popup').show();
    $('.popup-background').show();
}

function closePopup(link)
{
    $('.popup').hide();
    $('.popup-background').hide();
    if(link != "")
    top.location.href = link;
}










