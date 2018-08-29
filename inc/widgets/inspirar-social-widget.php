<?php 
// Do not allow directly accessing this file.
if ( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

class Inspirar_Social_Widget extends WP_Widget{
   
	//setup the widget name, description , etc.
    public function __construct(){
    	$widget_ops = array(
    		'classname' => 'inspirar_social_widget',
    		'description' => esc_html__('Display Social list widget', 'inspirar')
    	);

    	parent::__construct('inspirar_social', esc_html__('Inspirar Social Links', 'inspirar'), $widget_ops);
    }

    //back-end display of widget
    public function form( $instance ){
    	$title = ( !empty( $instance['title'] ) ? $instance['title'] : '');
    	$google_link = ( !empty( $instance['google_link'] ) ? $instance['google_link'] : '');
        $facebook_link = ( !empty( $instance['facebook_link'] ) ? $instance['facebook_link'] : '');
        $twitter_link = ( !empty( $instance['twitter_link'] ) ? $instance['twitter_link'] : '');
        $linkedin_link = ( !empty( $instance['linkedin_link'] ) ? $instance['linkedin_link'] : '');
        $youtube_link = ( !empty( $instance['youtube_link'] ) ? $instance['youtube_link'] : '');
        $google_plus_link = ( !empty( $instance['google_plus_link'] ) ? $instance['google_plus_link'] : '');
        $instagram_link = ( !empty( $instance['instagram_link'] ) ? $instance['instagram_link'] : '');
        $pinterest_link = ( !empty( $instance['pinterest_link'] ) ? $instance['pinterest_link'] : '');
        $flickr_link = ( !empty( $instance['flickr_link'] ) ? $instance['flickr_link'] : '');
        $rss_link = ( !empty( $instance['rss_link'] ) ? $instance['rss_link'] : '');
        
?>
    	<p>
	        <label for="<?php echo esc_attr($this->get_field_id('title'));?>">
			    <?php echo esc_html('Title:', 'inspirar');?>
		    </label>
	        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') );?>" name="<?php echo esc_attr( $this->get_field_name('title') );?>" value="<?php echo esc_attr( $title );?>">
        </p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('google_link'));?>">
				<?php echo esc_html('Google Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('google_link') );?>" name="<?php echo esc_attr( $this->get_field_name('google_link') );?>" value="<?php echo esc_attr( $google_link );?>">
		</p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook_link'));?>">
	            <?php echo esc_html('Facebook Link', 'inspirar');?>
            </label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook_link') );?>" name="<?php echo esc_attr( $this->get_field_name('facebook_link') );?>" value="<?php echo esc_attr( $facebook_link );?>">
        </p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter_link'));?>">
				<?php echo esc_html('Twitter Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter_link') );?>" name="<?php echo esc_attr( $this->get_field_name('twitter_link') );?>" value="<?php echo esc_attr( $twitter_link );?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin_link'));?>">
				<?php echo esc_html('Linkedin Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('linkedin_link') );?>" name="<?php echo esc_attr( $this->get_field_name('linkedin_link') );?>" value="<?php echo esc_attr( $linkedin_link );?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube_link'));?>">
				<?php echo esc_html('Youtube Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('youtube_link') );?>" name="<?php echo esc_attr( $this->get_field_name('youtube_link') );?>" value="<?php echo esc_attr( $youtube_link );?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('google_plus_link'));?>">
				<?php echo esc_html('Google Plus Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('google_plus_link') );?>" name="<?php echo esc_attr( $this->get_field_name('google_plus_link') );?>" value="<?php echo esc_attr( $google_plus_link );?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram_link'));?>">
				<?php echo esc_html('Instagram Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram_link') );?>" name="<?php echo esc_attr( $this->get_field_name('instagram_link') );?>" value="<?php echo esc_attr( $instagram_link );?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest_link'));?>">
				<?php echo esc_html('Pinterest Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest_link') );?>" name="<?php echo esc_attr( $this->get_field_name('pinterest_link') );?>" value="<?php echo esc_attr( $pinterest_link );?>">
		</p>


		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_link'));?>">
				<?php echo esc_html('Flickr Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('flickr_link') );?>" name="<?php echo esc_attr( $this->get_field_name('flickr_link') );?>" value="<?php echo esc_attr( $flickr_link );?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('rss_link'));?>">
				<?php echo esc_html('Rss Link', 'inspirar');?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('rss_link') );?>" name="<?php echo esc_attr( $this->get_field_name('rss_link') );?>" value="<?php echo esc_attr( $rss_link );?>">
		</p>

<?php
    }
    //update widget
    public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
        $instance[ 'google_link' ] = ( !empty( $new_instance[ 'google_link' ] ) ? strip_tags( $new_instance[ 'google_link' ] ) : '' );
        $instance[ 'facebook_link' ] = ( !empty( $new_instance[ 'facebook_link' ] ) ? strip_tags( $new_instance[ 'facebook_link' ] ) : '' );
        $instance[ 'twitter_link' ] = ( !empty( $new_instance[ 'twitter_link' ] ) ? strip_tags( $new_instance[ 'twitter_link' ] ) : '' );
        $instance[ 'linkedin_link' ] = ( !empty( $new_instance[ 'linkedin_link' ] ) ? strip_tags( $new_instance[ 'linkedin_link' ] ) : '' );
        $instance[ 'youtube_link' ] = ( !empty( $new_instance[ 'youtube_link' ] ) ? strip_tags( $new_instance[ 'youtube_link' ] ) : '' );
        $instance[ 'google_plus_link' ] = ( !empty( $new_instance[ 'google_plus_link' ] ) ? strip_tags( $new_instance[ 'google_plus_link' ] ) : '' );
        $instance[ 'instagram_link' ] = ( !empty( $new_instance[ 'instagram_link' ] ) ? strip_tags( $new_instance[ 'instagram_link' ] ) : '' );
        $instance[ 'pinterest_link' ] = ( !empty( $new_instance[ 'pinterest_link' ] ) ? strip_tags( $new_instance[ 'pinterest_link' ] ) : '' );
        $instance[ 'flickr_link' ] = ( !empty( $new_instance[ 'flickr_link' ] ) ? strip_tags( $new_instance[ 'flickr_link' ] ) : '' );
        $instance[ 'rss_link' ] = ( !empty( $new_instance[ 'rss_link' ] ) ? strip_tags( $new_instance[ 'rss_link' ] ) : '' );
        
		return $instance;
	}

	//front-end display of widget 
    public function widget( $args, $instance){
	    $allowed_tags = array(
		    'div' => array(
			    'id' => array(),
			    'class' => array()
		    ),
		    'h4' => array(
			    'class' => array()
		    )
	    );
	    echo wp_kses($args['before_widget'], $allowed_tags);

	    if( !empty( $instance['title'] )){
		    echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
	    }

       echo '<div class="footer-social-links"><nav class="footer-social-nav">';
       
       if( $instance['facebook_link'] ){
          echo '<a href="'.esc_url($instance['facebook_link']).'" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>';
       }
       if( $instance['twitter_link'] ){
          echo '<a href="'.esc_url($instance['twitter_link']).'" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>';
       }
       if( $instance['google_link'] ){
          echo '<a href="'.esc_url($instance['google_link']).'" target="_blank" title="Google"><i class="fa fa-google"></i></a>';
       }
       if( $instance['linkedin_link'] ){
          echo '<a href="'.esc_url($instance['linkedin_link']).'" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a>';
       }
       if( $instance['youtube_link'] ){
          echo '<a href="'.esc_url($instance['youtube_link']).'" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a>';
       }
       if( $instance['instagram_link'] ){
          echo '<a href="'.esc_url($instance['instagram_link']).'" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>';
       }
       if( $instance['pinterest_link'] ){
          echo '<a href="'.esc_url($instance['pinterest_link']).'" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a>';
       }
       if( $instance['google_plus_link'] ){
          echo '<a href="'.esc_url($instance['google_plus_link']).'" target="_blank" title="Google Plus"><i class="fa fa-google-plus"></i></a>';
       }
       if( $instance['flickr_link'] ){
          echo '<a href="'.esc_url($instance['flickr_link']).'" target="_blank" title="Flickr"><i class="fa fa-flickr"></i></a>';
       }
       if( $instance['rss_link'] ){
          echo '<a href="'.esc_url($instance['rss_link']).'" target="_blank" title="Rss"><i class="fa fa-rss"></i></a>';
       }
       
       echo '</nav></div>';
	    echo wp_kses($args['after_widget'], $allowed_tags);
    }

}

function inspirar_register_social_widget(){
    register_widget('Inspirar_Social_Widget');
}
add_action('widgets_init', 'inspirar_register_social_widget');