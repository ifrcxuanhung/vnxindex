VideoJS.setupAllWhenReady();

// jQuery.noConflict();

jQuery(document).ready(function($) {
  jQuery(function(){
    jQuery('ul.sf-menu').superfish({ 
      speed: 'fast', 
      delay: 0, 
      animation: {
        height:'show'
      }
    });
  });
  
  jQuery('.footer-content .widget').setAllToMaxHeight();
  
  jQuery('.contact-form label').labelOver('over');
  
  jQuery('#commentform label').labelOver('over');
   
  jQuery("input[type=text]").focus(function () {
    if (this.value == this.defaultValue) {
      this.value = "";
    }
  });
  jQuery("input[type=text]").blur(function () {
    if (this.value == "") {
      this.value = this.defaultValue;
    }
  });
  if (jQuery('.tab_list').length > 0 ) {
    jQuery('.tab_list').sTabs();
  }
  
  jQuery(".accordion").each(function(){
    var $initialIndex = jQuery(this).attr('data-initialIndex');
    if($initialIndex==undefined){
      $initialIndex = 0;
    }
    jQuery(this).tabs("div.pane", {
      tabs: '.tab', 
      effect: 'slide',
      initialIndex: $initialIndex
    });
  });
    
  jQuery(".toggle-title").toggle(
    function(){
      jQuery(this).parent().addClass('active');
      jQuery(this).siblings('.toggle-content').slideDown("fast");
    },
    function(){
      jQuery(this).parent().removeClass('active');
      jQuery(this).siblings('.toggle-content').slideUp("fast");
    });
	
  jQuery("a[data-rel^='prettyPhoto'], .gallery .gallery-icon a").prettyPhoto();
  
  // Share Icons
  jQuery('.share_wrapper').hide();
	
  jQuery('.share').live('click', function(){
    jQuery('.share_wrapper', jQuery(this).parent()).slideToggle('fast');
    return false;
  });
  
  jQuery('.contact-form').submit(function(){				  
    var myform = jQuery(this);
    var validated = jQuery(this).validate({
      errorPlacement: function (error, element) {
        error.appendTo();
      }
    }).form();
    
    if (validated)
    {
      var $id = myform.find('input[name="contact_form_id"]').val();
      
      jQuery.post(this.action,{ 
        'name': jQuery('input[name="name_'+$id+'"]').val(),
        'email': jQuery('input[name="email_'+$id+'"]').val(),
        'message': jQuery('textarea[name="message_'+$id+'"]').val(),
        'contactto' : jQuery('input[name="contact_to_'+$id+'"]').val().replace("*", "@")
      },
      function(data){
        myform.fadeOut('fast', function() {
          jQuery(this).siblings('.success').show();
        });
      }
      );
    }
    return false;
  });
    
});

/*
 *  sTabs - simple tabs jQuery plugin
 *  http://labs.smasty.net/jquery/stabs/
 *
 *  Copyright (c) 2010 Martin Srank (http://smasty.net)
 *  Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php).
 *
 *  Built for jQuery library
 *  http://jquery.com
 *
 */
(function(jQuery) {
  jQuery.fn.sTabs = function(opts) {
  
    var options = jQuery.extend({}, jQuery.fn.sTabs.defaults, opts);
  
    return this.each(function() {
      jQuery(this).addClass('tabs');
      jQuery(this).find('a').each(function(){

        jQuery(jQuery(this).attr('href')).addClass('tab').hide();

        jQuery(this).bind(options.eventType, function(e){
          e.preventDefault();
          
          jQuery(this).addClass('active');
          
          options.animate ? jQuery(jQuery(this).attr('href')).fadeIn(options.duration) : jQuery(jQuery(this).attr('href')).show();
          
          jQuery(jQuery(this).parent().siblings().find('a')).each(function(){
            jQuery(this).removeClass('active');
            jQuery(jQuery(this).attr('href')).hide();
          });
        })
      });

      var first = jQuery(this).find('li:nth-child(' + options.startWith + ')').children('a');
      jQuery(first).addClass('active');
      jQuery(jQuery(first).attr('href')).show();
    });
  }
  jQuery.fn.sTabs.defaults = {
    animate: false, 
    duration: 300, 
    startWith: 1, 
    eventType: 'click'
  }
})(jQuery);

/* plugin for labels to be placed over input fields in contact page */
jQuery.fn.labelOver = function (overClass) {
  return this.each(function () {
    var label = jQuery(this);
    var f = label.attr('for');
    if (f) {
      var input = jQuery('#' + f);
      this.hide = function () {
        label.css({
          textIndent: -10000
        })
      }
      this.show = function () {
        if (input.val() == '') label.css({
          textIndent: 0
        })
      }
      // handlers
      input.focus(this.hide);
      input.blur(this.show);
      label.addClass(overClass).click(function () {
        input.focus()
      });
      if (input.val() != '') this.hide();
    }
  })
}

// plugin for equal heights in footer widgets
jQuery.fn.setAllToMaxHeight = function(){
  return this.height( Math.max.apply(this, jQuery.map( this , function(e){
    return jQuery(e).height()
  }) ) );
}
jQuery.fn.getMaxHeight = function(){
  return Math.max.apply(this, jQuery.map( this , function(e){
    return jQuery(e).height()
  }) );
}