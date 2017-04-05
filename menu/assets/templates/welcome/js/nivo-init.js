jQuery(window).load(function() {
  var slider = jQuery('#nivoSlider');
  slider.nivoSlider({
	effect:sliderOptions['effect'],
	slices:sliderOptions['slices'],
	boxCols:sliderOptions['boxCols'],
	boxRows:sliderOptions['boxRows'],
	animSpeed:sliderOptions['animSpeed'],
	pauseTime:sliderOptions['pauseTime'],
	startSlide:0,
	directionNav:sliderOptions['directionNav'],
	directionNavHide:sliderOptions['directionNavHide'],
	controlNav:sliderOptions['controlNav'],
	controlNavThumbs:false, 
	keyboardNav:sliderOptions['keyboardNav'],
	pauseOnHover:sliderOptions['pauseOnHover'],
	manualAdvance:sliderOptions['manualAdvance'],
	captionOpacity:sliderOptions['captionOpacity'],
	lastSlide: function(){
	  if(sliderOptions['stopAtEnd']){
		slider.data('nivoslider').stop();
	  }
	}
  });
});
