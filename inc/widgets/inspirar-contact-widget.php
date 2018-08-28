<?php 
// Do not allow directly accessing this file.
if( !defined('ABSPATH') ){
	exit('Direct script access denied.');
}

class Inspirar_Contact_Widget extends WP_Widget{
     
    //setup the widget name, description , etc.
    public function __construct(){

		$widget_ops = array(
			'calssname' => 'inspirar_contact_widget',
			'description' => esc_html__('Display Contact Widget', 'inspirar')
		);

		parent::__construct(
			'inspirar_contact_widget', 
			esc_html__('Inspirar Contact Widget', 'inspirar'), 
			$widget_ops
		);
    }

    //back-end display of widget
    public function form( $instance ){

    	$title = ( !empty( $instance['title'] ) ? $instance['title'] : 'Title' );
    	$address = ( !empty( $instance['address'] ) ? $instance['address'] : '' );
    	$tel = ( !empty( $instance['tel'] ) ? $instance['tel'] : '' );
    	$mobile = ( !empty( $instance['mobile'] ) ? $instance['mobile'] : '' );
    	$email = ( !empty( $instance['email'] ) ? $instance['email'] : '' );
        $show_btn = ( !empty( $instance['show_btn'] ) ? $instance['show_btn'] : '1' );
        $btn_text = ( !empty( $instance['btn_text'] ) ? $instance['btn_text'] : __('View All', 'inspirar') );
        $btn_link = ( !empty( $instance['btn_link'] ) ? $instance['btn_link'] : '#' );

?>
    	<p>
	        <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php echo esc_html__('Title:', 'inspirar');?></label>
	        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title'));?>" name="<?php echo esc_attr($this->get_field_name('title'));?>" value="<?php echo esc_attr( $title );?>">
        </p>

        <p>
	        <label for="<?php echo esc_attr($this->get_field_id('address'));?>">
			    <?php echo esc_html__('Address:', 'inspirar');?>
		    </label>
	        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('address') );?>" name="<?php echo esc_attr( $this->get_field_name('address') );?>" cols="10" rows="10"><?php echo esc_textarea( $address );?></textarea>
        </p>

        <p>
	        <label for="<?php echo esc_attr($this->get_field_id('tel'));?>"><?php echo esc_html__('Tel:', 'inspirar');?></label>
	        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tel'));?>" name="<?php echo esc_attr($this->get_field_name('tel'));?>" value="<?php echo esc_attr( $tel );?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('mobile'));?>"><?php echo esc_html__('Mobile:', 'inspirar');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('mobile'));?>" name="<?php echo esc_attr($this->get_field_name('mobile'));?>" value="<?php echo esc_attr( $mobile );?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email'));?>"><?php echo esc_html__('Email:', 'inspirar');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('email'));?>" name="<?php echo esc_attr($this->get_field_name('email'));?>" value="<?php echo esc_attr( $email );?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_text'));?>"><?php echo esc_html__('Button Text', 'inspirar');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_text'));?>" name="<?php echo esc_attr($this->get_field_name('btn_text'));?>" value="<?php echo esc_attr( $btn_text );?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link'));?>"><?php echo esc_html__('Button Link', 'inspirar');?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link'));?>" name="<?php echo esc_attr($this->get_field_name('btn_link'));?>" value="<?php echo esc_attr( $btn_link );?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_btn'));?>"><?php echo esc_html__('Show Button?', 'inspirar');?></label>
            <input <?php checked($show_btn, '1'); ?> type="checkbox" id="<?php echo esc_attr($this->get_field_id('show_btn'));?>" name="<?php echo esc_attr($this->get_field_name('show_btn'));?>" value="1">
        </p>

    <?php
    }


    //update widget
     public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
        $instance[ 'address' ] = ( !empty( $new_instance[ 'address' ] ) ? strip_tags( $new_instance[ 'address' ] ) : '' );
        $instance[ 'tel' ] = ( !empty( $new_instance[ 'tel' ] ) ? strip_tags( $new_instance[ 'tel' ] ) : '' );
        $instance[ 'mobile' ] = ( !empty( $new_instance[ 'mobile' ] ) ? strip_tags( $new_instance[ 'mobile' ] ) : '' );
        $instance[ 'email' ] = ( !empty( $new_instance[ 'email' ] ) ? strip_tags( $new_instance[ 'email' ] ) : '' );
        $instance[ 'show_btn' ] = ( !empty( $new_instance[ 'show_btn' ] ) ? strip_tags( $new_instance[ 'show_btn' ]) : '');
        $instance[ 'btn_text' ] = ( !empty( $new_instance[ 'btn_text' ] ) ? strip_tags( $new_instance[ 'btn_text' ]) : '');
        $instance[ 'btn_link' ] = ( !empty( $new_instance[ 'btn_link' ] ) ? strip_tags( $new_instance[ 'btn_link' ]) : '');
		
		return $instance;
		
	}

	//front-end display of widget 
    public function widget( $args, $instance){

	    $allowed_tags = array(
		    'div' => array(
			    'id' => array(),
			    'class' => array()
		    ),
		    'h3' => array(
			    'class' => array()
		    )
	    );

	    echo wp_kses($args['before_widget'], $allowed_tags);

	    if( !empty( $instance['title'] )){
		     echo wp_kses($args['before_title'], $allowed_tags) . esc_html(apply_filters('widget_title', $instance['title'], $instance, $this->id_base)) . wp_kses($args['after_title'], $allowed_tags);
	    }
        if( $instance['address'] ){
            echo '<p>' . esc_html($instance['address']) . '</p>';
        }
        echo '<ul>';

        if( $instance['tel'] ){
            echo '<li>'.esc_html__( 'Tel:', 'inspirar') . '<a href="tel:'.esc_url($instance['tel']).'">'.esc_html($instance['tel']).'</a></li>';
        }

        if( $instance['mobile'] ){
            echo '<li>'.esc_html__( 'Mobile:', 'inspirar') . '<a href="tel:'.esc_url($instance['mobile']).'">'.esc_html($instance['mobile']).'</a></li>';
        }

        if( $instance['email'] ){
            echo '<li>'.esc_html__( 'Email:', 'inspirar') . '<a href="mailto:'.esc_url($instance['email']).'">'.esc_html($instance['email']).'</a></li>';
        }

        echo '</ul>';
        if( $instance['show_btn'] && $instance['btn_text'] ) {
        echo '<a class="read-more" href="'.esc_url($instance['btn_link']).'">'.esc_html($instance['btn_text']).'</a>';
        }
    
	    echo wp_kses($args['after_widget'], $allowed_tags);
    
    }
}

function inspirar_register_contact_widget(){
    register_widget('Inspirar_Contact_Widget');
}
add_action('widgets_init', 'inspirar_register_contact_widget');