<?php
/**
 * Inspirar Admin Class.
 *
 * @author  CrestaProject
 * @package Inspirar
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Inspirar_Lite_Admin' ) ) :

/**
 * Inspirar_Lite_Admin Class.
 */
class Inspirar_Lite_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );
		global $inspirar_adminpage;
		$inspirar_adminpage = add_theme_page( esc_html__( 'About', 'inspirar' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'inspirar' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'inspirar-welcome', array( $this, 'welcome_screen' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_admin_scripts() {
		global $inspirar_adminpage;
		$screen = get_current_screen();
		if ( $screen->id != $inspirar_adminpage ) {
			return;
		}
		wp_enqueue_style( 'inspirar-welcome', get_template_directory_uri() . '/inc/admin/welcome.css', array(), '1.0' );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'inspirar-message', get_template_directory_uri() . '/inc/admin/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'inspirar_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'inspirar_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['inspirar-hide-notice'] ) && isset( $_GET['_inspirar_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_key($_GET['_inspirar_notice_nonce'] ), 'inspirar_hide_notices_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'inspirar' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'inspirar' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash($_GET['inspirar-hide-notice'] ));
			update_option( 'inspirar_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		$theme = wp_get_theme( get_template() );
		?>
		<div id="message" class="updated inspirar-message">
			<h1><?php esc_html_e( 'Welcome to ', 'inspirar' ); ?><?php echo esc_html($theme->get( 'Name' )) ." ". esc_html($theme->get( 'Version' )); ?></h1>
			<a class="inspirar-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'inspirar-hide-notice', 'welcome' ) ), 'inspirar_hide_notices_nonce', '_inspirar_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'inspirar' ); ?></a>
			<p>
			<?php
			/* translators: 1: start option panel link, 2: end option panel link */
			printf( esc_html__( 'Thank you for choosing Inspirar! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'inspirar' ), '<a href="' . esc_url( admin_url( 'themes.php?page=inspirar-welcome' ) ) . '">', '</a>' );
			?>
			</p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=inspirar-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Inspirar', 'inspirar' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="inspirar-theme-info">
				
			<div class="welcome-description-wrap">
				<div class="about-text">
					<h1>
						<?php esc_html_e('About', 'inspirar'); ?>
						<?php echo esc_html($theme->get( 'Name' )) ." ". esc_html($theme->get( 'Version' )); ?>
					</h1>
					<?php echo esc_html($theme->display( 'Description' )); ?>
				</div>
				<div class="inspirar-screenshot">
					<a target="_blank" href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wpmanageninja.com/downloads/sciencex-multipurpose-researcher-professor-education-wordpress-theme/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
					</a>
				</div>
			</div>
            
			<div class="welcome-description-wrap-action">
                <p class="inspirar-actions inspirar-text-center">
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wpmanageninja.com/downloads/inspirar-pro-multipurpose-wordpress-theme-for-unlimited-website/' ) ); ?>" class="button button-secondary bg-success docs" target="_blank"><?php esc_html_e( 'Get Full Version', 'inspirar' ); ?></a>
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wordpress.org/themes/inspirar/reviews/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'inspirar' ); ?></a>
                </p>
                
				<p class="inspirar-actions">
					<span><?php esc_html_e( 'Inspirar Pro', 'inspirar' ); ?></span>
				</p>
			</div>

            <h2 class="nav-tab-wrapper">
                <a class="nav-tab <?php if ( empty( $_GET['tab'] ) && isset( $_GET['page'] ) && $_GET['page'] == 'inspirar-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'inspirar-welcome' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Corporate Agency', 'inspirar' ); ?>
                </a>
                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'lawyer' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'inspirar-welcome', 'tab' => 'lawyer' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Lawyer', 'inspirar' ); ?>
                </a>
                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'construction' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'inspirar-welcome', 'tab' => 'construction' ), 'themes.php' ) ) ); ?>">
		            <?php esc_html_e( 'Construction', 'inspirar' ); ?>
                </a>
                <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'marketer' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'inspirar-welcome', 'tab' => 'marketer' ), 'themes.php' ) ) ); ?>">
		            <?php esc_html_e( 'Marketer', 'inspirar' ); ?>
                </a>
                
            </h2>
            
		</div>

		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( wp_unslash($_GET['tab']) );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->corporate_about_screen();
	}

	
	


	/**
	 * Output the about screen.
	 */
	public function corporate_about_screen() {
		$theme = wp_get_theme( get_template() );
		?>

		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="inspirar-table-wrap">
                <div class="inspirar-row">
                    <div class="inspirar-col-8">
                        <div class="content">
                            <p><?php esc_html_e('Inspirai Agency is a responsive and multipurpose theme suitable for all kinds of agencies and digital marketing specialists, design studios and consulting businesses. Using Agency theme, you can easily create amazing websites for marketing agencies, human resources, recruitment and distribution and wholesale agencies, advertising companies and hosts of creative enterprises.', 'inspirar'); ?></p>
                        </div>
                    </div>
                    <div class="inspirar-col-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/inspirar-agency.jpg" alt="">
                    </div>
                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-12">
                        <div class="section-title">
                            <h3><?php esc_html_e('Key Features', 'inspirar'); ?></h3>
                        </div>
                    </div>
      
                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Responsive Design', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Translation Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Header Seetings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Settings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Banner & Breadcrumbs', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Upload Your Own Logo', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Manage sidebar position', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Custom Widgets', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Demo Content Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Background Image/Gradients/Overlay', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Powerful theme options', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Sticky Header', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Column Layout', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Copyright & Layout', 'inspirar'); ?></li>
                        </ul>
                    </div>
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Unlimited Color', 'inspirar'); ?></li>
                            <li><?php esc_html_e('One Click Demo Import', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Theme Features Core Plugin', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Drag and Drop Page Builder', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Documentation', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Google Fonts', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Inline Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('20+ Shortcodes/Addons', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mobile Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mailchimp', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Pages', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Contact Forms', 'inspirar'); ?></li>
                        </ul>
                    </div>
                </div>
                
           
			<div class="inspirar-theme-actions btn-wrapper inspirar-text-center">
				<a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://inspirar-agency.demo.wpmanageninja.com' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Live Preview', 'inspirar' ); ?></a>
				<a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wpmanageninja.com/downloads/inspirar-pro-multipurpose-wordpress-theme-for-unlimited-website/' ) ); ?>" class="button button-secondary bg-success" target="_blank"><?php esc_html_e( 'Get Full Version', 'inspirar' ); ?></a>
			</div>
		   </div>
            

		</div>
		<?php
	}

	public function lawyer_screen() {
		$theme = wp_get_theme( get_template() );
		?>

        <div class="wrap about-wrap">

			<?php $this->intro(); ?>
            <div class="inspirar-table-wrap">
                <div class="inspirar-row">
                    <div class="inspirar-col-8">
                        <div class="content">
                            <p><?php esc_html_e("Inspirai Lawyer is a Clean and Corporate Friendly Lawyer, Legal Office and Attorney WordPress theme, It'\s Fully Responsive with Powerful theme options, Drag and Drop Page Builder, WPML multilingual plugin support.", 'inspirar'); ?></p>
                        </div>
                    </div>
                    <div class="inspirar-col-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/inspirar-lawyer.jpg" alt="">
                    </div>
                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-12">
                        <div class="section-title">
                            <h3><?php esc_html_e('Key Features', 'inspirar'); ?></h3>
                        </div>
                    </div>

                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Responsive Design', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Translation Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Header Seetings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Settings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Banner & Breadcrumbs', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Upload Your Own Logo', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Manage sidebar position', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Custom Widgets', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Demo Content Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Background Image/Gradients/Overlay', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Powerful theme options', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Sticky Header', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Column Layout', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Copyright & Layout', 'inspirar'); ?></li>
                        </ul>
                    </div>
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Unlimited Color', 'inspirar'); ?></li>
                            <li><?php esc_html_e('One Click Demo Import', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Theme Features Core Plugin', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Drag and Drop Page Builder', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Documentation', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Google Fonts', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Inline Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('20+ Shortcodes/Addons', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mobile Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mailchimp', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Pages', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Contact Forms', 'inspirar'); ?></li>
                        </ul>
                    </div>
                </div>


                <div class="inspirar-theme-actions btn-wrapper inspirar-text-center">
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://inspirar-lawyer.demo.wpmanageninja.com' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Live Preview', 'inspirar' ); ?></a>
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wpmanageninja.com/downloads/inspirar-pro-multipurpose-wordpress-theme-for-unlimited-website/' ) ); ?>" class="button button-secondary bg-success" target="_blank"><?php esc_html_e( 'Get Full Version', 'inspirar' ); ?></a>
                </div>
            </div>


        </div>
		<?php
	}
	public function construction_screen() {
		$theme = wp_get_theme( get_template() );
		?>

        <div class="wrap about-wrap">

			<?php $this->intro(); ?>
            <div class="inspirar-table-wrap">
                <div class="inspirar-row">
                    <div class="inspirar-col-8">
                        <div class="content">
                            <p><?php esc_html_e('Inspirai is a very powerful Construction WordPress theme. All the latest features are using here which help you to make unique website from others. Inspirai is a business theme designed specifically for construction, building companies and those that offer building services. The theme comes pre-packed with a drag and drop page builder Elementor.', 'inspirar'); ?></p>
                        </div>
                    </div>
                    <div class="inspirar-col-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/inspirar-cons.jpg" alt="">
                    </div>
                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-12">
                        <div class="section-title">
                            <h3><?php esc_html_e('Key Features', 'inspirar'); ?></h3>
                        </div>
                    </div>

                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Responsive Design', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Translation Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Header Seetings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Settings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Banner & Breadcrumbs', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Upload Your Own Logo', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Manage sidebar position', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Custom Widgets', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Demo Content Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Background Image/Gradients/Overlay', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Powerful theme options', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Sticky Header', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Column Layout', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Copyright & Layout', 'inspirar'); ?></li>
                        </ul>
                    </div>
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Unlimited Color', 'inspirar'); ?></li>
                            <li><?php esc_html_e('One Click Demo Import', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Theme Features Core Plugin', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Drag and Drop Page Builder', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Documentation', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Google Fonts', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Inline Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('20+ Shortcodes/Addons', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mobile Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mailchimp', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Pages', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Contact Forms', 'inspirar'); ?></li>
                        </ul>
                    </div>
                </div>


                <div class="inspirar-theme-actions btn-wrapper inspirar-text-center">
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://inspirar-construction.demo.wpmanageninja.com' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Live Preview', 'inspirar' ); ?></a>
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wpmanageninja.com/downloads/inspirar-pro-multipurpose-wordpress-theme-for-unlimited-website/' ) ); ?>" class="button button-secondary bg-success" target="_blank"><?php esc_html_e( 'Get Full Version', 'inspirar' ); ?></a>
                </div>
            </div>


        </div>
		<?php
	}
	public function marketer_screen() {
		$theme = wp_get_theme( get_template() );
		?>

        <div class="wrap about-wrap">

			<?php $this->intro(); ?>
            <div class="inspirar-table-wrap">
                <div class="inspirar-row">
                    <div class="inspirar-col-8">
                        <div class="content">
                            <p><?php esc_html_e('Inspirai Marketer is a powerful Easy to Use, Highly Customzable SEO /Digital Agency / Multi-Purpose Theme , built with latest Bootstrap.This Theme is a highly suitable Theme for companies that offer SEO services as well as other internet marketing related services. It has purpose oriented design, responsive layout and special features like 2 different landing pages, blog layouts, galleries, services and pricing tables. Digital Media can also be used for multi-purposes.', 'inspirar'); ?></p>
                        </div>
                    </div>
                    <div class="inspirar-col-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/inspirar-marketer.jpg" alt="">
                    </div>
                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-12">
                        <div class="section-title">
                            <h3><?php esc_html_e('Key Features', 'inspirar'); ?></h3>
                        </div>
                    </div>

                </div>
                <div class="inspirar-row">
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Responsive Design', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Translation Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Header Seetings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Settings', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Banner & Breadcrumbs', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Upload Your Own Logo', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Manage sidebar position', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Custom Widgets', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Demo Content Ready', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Background Image/Gradients/Overlay', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Powerful theme options', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Sticky Header', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Column Layout', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Footer Copyright & Layout', 'inspirar'); ?></li>
                        </ul>
                    </div>
                    <div class="inspirar-col-6">
                        <ul>
                            <li><?php esc_html_e('Unlimited Color', 'inspirar'); ?></li>
                            <li><?php esc_html_e('One Click Demo Import', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Theme Features Core Plugin', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Drag and Drop Page Builder', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Documentation', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Google Fonts', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Inline Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('20+ Shortcodes/Addons', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mobile Editing', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Mailchimp', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Pages', 'inspirar'); ?></li>
                            <li><?php esc_html_e('Pre Made Contact Forms', 'inspirar'); ?></li>
                        </ul>
                    </div>
                </div>


                <div class="inspirar-theme-actions btn-wrapper inspirar-text-center">
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://inspirar-marketer.demo.wpmanageninja.com' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Live Preview', 'inspirar' ); ?></a>
                    <a href="<?php echo esc_url( apply_filters( 'inspirar_pro_theme_url', 'https://wpmanageninja.com/downloads/inspirar-pro-multipurpose-wordpress-theme-for-unlimited-website/' ) ); ?>" class="button button-secondary bg-success" target="_blank"><?php esc_html_e( 'Get Full Version', 'inspirar' ); ?></a>
                </div>
            </div>


        </div>
		<?php
	}
	


}

endif;

return new Inspirar_Lite_Admin();
