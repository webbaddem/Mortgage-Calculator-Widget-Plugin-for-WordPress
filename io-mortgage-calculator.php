<?php
/*
Plugin Name: Mortgage Calculator Widget
Plugin URI: http://digitalmichael.net
Description: A simple mortgage calculator widget
Version: 1.0.0
Author: Michael Harris
Author URI: http://digitalmichael.net
*/

/*-----------------------------------------------------------------------------------*/
/* Include CSS */
/*-----------------------------------------------------------------------------------*/
 
function io_mortgage_calc_css() {		
	wp_register_style( 'io_mortgage_calc', plugins_url( './assets/style.css', __FILE__ ), false, '1.0' );
	wp_enqueue_style( 'io_mortgage_calc' );
}
add_action( 'wp_print_styles', 'io_mortgage_calc_css' );

/*-----------------------------------------------------------------------------------*/
/* Include JS */
/*-----------------------------------------------------------------------------------*/

function io_mortgage_calc_scripts() {
	wp_register_script( 'calc', plugins_url( './assets/calc.js', __FILE__ ), array('jquery'), '1.0', true );
	wp_enqueue_script( 'calc' );
}
add_action( 'wp_enqueue_scripts', 'io_mortgage_calc_scripts' );

/*-----------------------------------------------------------------------------------*/
/* Register Widget */
/*-----------------------------------------------------------------------------------*/

class io_MortgageCalculator extends WP_Widget {

	function io_MortgageCalculator() {
	   $widget_ops = array('description' => 'Display a mortgage calculator.' );
	   parent::WP_Widget(false, __('IO Mortgage Calculator', 'otacon'),$widget_ops);      
	}

	function widget($args, $instance) {  
		
		extract( $args );
		
		$title = $instance['title'];
		
	?>
		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . $title . $after_title; }
			global $io_options;
		?>
        
            <form id="loanCalc">
                <fieldset>
                  <input type="text" name="mcPrice" id="mcPrice" class="text-input" value="<?php _e('Sale price ($)', 'otacon'); ?>" onfocus="if(this.value=='<?php _e('Sale price ($)', 'otacon'); ?>')this.value = '';" onblur="if(this.value=='')this.value = '<?php _e('Sale price ($)', 'otacon'); ?>';" />
                  <input type="text" name="mcRate" id="mcRate" class="text-input" value="<?php _e('Interest Rate (%)', 'otacon'); ?>" onfocus="if(this.value=='<?php _e('Interest Rate (%)', 'otacon'); ?>')this.value = '';" onblur="if(this.value=='')this.value = '<?php _e('Interest Rate (%)', 'otacon'); ?>';" />
                  <input type="text" name="mcTerm" id="mcTerm" class="text-input" value="<?php _e('Term (years)', 'otacon'); ?>" onfocus="if(this.value=='<?php _e('Term (years)', 'otacon'); ?>')this.value = '';" onblur="if(this.value=='')this.value = '<?php _e('Term (years)', 'otacon'); ?>';" />
                  <input type="text" name="mcDown" id="mcDown" class="text-input" value="<?php _e('Down payment ($)', 'otacon'); ?>" onfocus="if(this.value=='<?php _e('Down payment ($)', 'otacon'); ?>')this.value = '';" onblur="if(this.value=='')this.value = '<?php _e('Down payment ($)', 'otacon'); ?>';" />
                  
                  <input class="btn marB10" type="submit" id="mortgageCalc" value="<?php _e('Calculate', 'otacon'); ?>" onclick="return false">
                  <input class="btn reset" type="button" value="Reset" onClick="this.form.reset()" />
                  <input type="text" name="mcPayment" id="mcPayment" class="text-input" value="<?php _e('Your Monthly Payment', 'otacon'); ?>" />
                </fieldset>
            </form>
		
		<?php echo $after_widget; ?>   
    <?php
   }

   function update($new_instance, $old_instance) {                
	   return $new_instance;
   }

   function form($instance) {
   
			$title = esc_attr($instance['title']);

		?>
		<p>
		   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','otacon'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<?php
	}
} 

add_action( 'widgets_init', create_function( '', 'register_widget("io_MortgageCalculator");' ) );

?>
