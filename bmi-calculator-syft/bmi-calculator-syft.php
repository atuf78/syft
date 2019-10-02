<?php
/*
Plugin Name: BMI Calculator
Plugin URI: https://syftapp.com
description: BMI Calculator
Version: 1.0
Author: Muhammad Atif
*/
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'bmi-grids', plugin_dir_url( __FILE__ ) . 'css/grids.css' );
	wp_enqueue_style( 'bmi-lightbox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
	wp_enqueue_style( 'bmi-style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
	wp_enqueue_style( 'bmi-jqueryui', 'https://code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css' );
	wp_enqueue_style( 'bmi-range-slider', plugin_dir_url( __FILE__ ) . 'css/range-slider.css' );
	wp_enqueue_script( 'bmi-bmi', plugin_dir_url( __FILE__ ) . 'js/bmiN.js?b1', array ( 'jquery' ));
	wp_enqueue_script( 'bmi-progressBar', plugin_dir_url( __FILE__ ) . 'js/progressBar.js', array ( 'jquery' ));
	wp_enqueue_script( 'bmi-jqueryui', 'https://code.jquery.com/ui/1.11.1/jquery-ui.js', array ( 'jquery' ));
	wp_enqueue_script( 'bmi-range-slider', plugin_dir_url( __FILE__ ) . 'js/range-slider.js', array ( 'jquery' ));
	wp_enqueue_script( 'bmi-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.js', array ( 'jquery' ));
	wp_enqueue_script( 'bmi-lightbox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array ( 'jquery' ), [], true);
} );
add_shortcode( 'bmi_calculator', function($atts){
	$atts = shortcode_atts( array(
		'popup' => false
	), $atts );
	include 'bmi-calculator-content.php';
	return $Content;
} );
add_action( 'wp_footer', function(){
	?>
	<script type="text/javascript">
		
		var bar = new ProgressBar.SemiCircle(container, {
		  strokeWidth: 6,
		  color: '#FFEA82',
		  trailColor: '#eee',
		  trailWidth: 1,
		  easing: 'easeInOut',
		  duration: 1400,
		  svgStyle: null,
		  text: {
		    value: '',
		    alignToBottom: false
		  },
		  from: {color: '#5748f9'},
		  to: {color: '#FF0000'},
		  // Set default step function for all animate calls
		  step: (state, bar) => {
		    bar.path.setAttribute('stroke', state.color);
		    var value = Math.round(bar.value() * 100);
		    if (value === 0) {
		      bar.setText('<span>BMI</span><br>0<div>kg/m<sup><small>2</small></sup></div>');
		    } else {
		    	value = value / 2;
		      bar.setText('<span>BMI</span><br>' + value + '<div>kg/m<sup><small>2</small></sup></div>');
		    }

		    bar.text.style.color = state.color;
		  }
		});
		bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
		bar.text.style.fontSize = '2rem';

		bar.animate(0);
		(function($){
			var doubleLabels = [
			    "<i>Inactive</i><span>Less than 30 minutes a week</span>", 
			    "<i>Moderately active</i><span>Between 30 and 60 minutes a week</span>", 
			    "<i>Active</i><span>Between 60 and 150 minutes a week</span>"
			];
			var slider = $("#double-label-slider")
		    .slider({
		        max: 3,
		        min: 1,
		        value: 1,
		        animate: 400,
		        change: function(event, ui) { 
			        //alert(ui.value); 
			        var width = ((ui.value - 1) * 50) + "%";
			        //$('.selected-pipe-area').css('width', ((ui.value - 1) * 50) + "%");
			        $('.selected-pipe-area').animate({width: width },400);
			    } 
		    })
		    .slider("pips", {
		        rest: "label",
		        labels: doubleLabels
		    });
		    $('#wu > a').on('click', function(event) {
		    	event.preventDefault();
		    	var __this = $(this);
		    	$(this).closest('span').find('a').removeClass('active');
		    	$(this).addClass('active');
		    	$('select[name="w_u"]').val($(this).attr('data-v'));
		    	//$('#w_v').fadeOut(400).fadeIn(400).find('input').val('').attr('placeholder', $(this).attr('data-v'));
		    	$('#w_v').fadeOut(400, function(){
		    		$('#w_v').fadeIn(400).find('input').val('').attr('placeholder', $(__this).attr('data-v'));
		    	})
		    });
		    $('#hu > a').on('click', function(event) {
		    	event.preventDefault();
		    	$(this).closest('span').find('a').removeClass('active');
		    	$(this).addClass('active');
		    	$('select[name="h_u"]').val($(this).attr('data-v'))
		    	if($(this).attr('data-v') == 'ft')
		    		$('#hincm').fadeOut('400', function(){
		    			$('#hfi').fadeIn('400');
		    		});
		    	else
		    		$('#hfi').fadeOut('400', function(){
		    			$('#hincm').fadeIn('400');
		    		});
		    });
		    $('#back').on('click', function(event) {
		    	event.preventDefault();
		    	bar.animate(0);
		    	jQuery('.bmi-form, .bmi-result').slideToggle(400);
		    });
		    $('#resetnClose').on('click', function(event) {
		    	event.preventDefault();
		    	bar.animate(0);
		    	slider.slider("value", 1);
		    	$(this).closest('form').trigger('reset');
		    	jQuery('.bmi-form, .bmi-result').slideToggle(400);
		    });
		    $('#reset').on('click', function(event) {
		    	event.preventDefault();
		    	bar.animate(0);
		    	slider.slider("value", 1);
		    	$(this).closest('form').trigger('reset');
		    });
		    $('input[name="interp"]').on('change', function(event) {
		    	event.preventDefault();
		    	$('#interp').text($(this).val());
		    	jQuery('.bmi-form').slideUp(400);
				jQuery('.bmi-result').slideDown(400);
		    });
		    $('input[name="bmi"]').on('change', function(event) {
		    	event.preventDefault();
		    	//$('#interp').text($(this).val());
		    	bar.animate($(this).val() / 50);
		    });
		})(jQuery);
	</script>
	<?php
}, 10, 1 );