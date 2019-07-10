<?php

/*====================================*\
	DEFINES
\*====================================*/

define('SKINS_DIR', 'skins');
define('SKINS_PATH', get_template_directory() . '/' . SKINS_DIR);

// Globals
$GLOBALS['pinthis_skin'] = get_option('pbpanel_site_skin');

/*====================================*\
	CONTENT WIDTH
\*====================================*/

if ( ! isset( $content_width ) ) {
	$content_width = 986;
}

/*====================================*\
	INIT
\*====================================*/

// Theme setup
function pinthis_setup() { 
	// Make PinThis available for translation.
	load_theme_textdomain('pinthis', get_template_directory() . '/languages');
	// This theme styles the visual editor with style-editor.css to match the theme style.
	add_editor_style('style-editor.css');
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');
	// This theme supports a variety of post formats.
	add_theme_support('post-formats', array('aside', 'image', 'quote', 'status', 'audio', 'video'));
	// This theme support post thumbnails.
	add_theme_support('post-thumbnails');
	// This theme supports custom background color and image
	add_theme_support('custom-background');
    // This theme supports title-tag
    add_theme_support('title-tag');
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu('pinthis-header-menu', __('Header Menu', 'pinthis'));
	// Custom Image Sizes
	add_image_size('pt-single', 720);
	add_image_size('pt-pinbox', 236);
	add_image_size('pt-thumb', 68, 68, true);
}
add_action('after_setup_theme', 'pinthis_setup');

// Add styles, scripts and fonts
function pinthis_add_styles() {
	// Register main stylesheet
	wp_register_style('pinthis-style', get_stylesheet_uri(), array(), '1.6.7', 'all');
	// Loads main stylesheet
	wp_enqueue_style('pinthis-style');
	
	if ($GLOBALS['pinthis_skin'] != 'default' && $GLOBALS['pinthis_skin'] != '') {
		// Register skin stylesheet
		wp_register_style('pinthis-style-' . $GLOBALS['pinthis_skin'], get_template_directory_uri() . '/' . SKINS_DIR . '/' . $GLOBALS['pinthis_skin'] . '/style-' . $GLOBALS['pinthis_skin'] . '.css', array(), '1.6.7', 'all');
		// Load skin stylesheet
		wp_enqueue_style('pinthis-style-' . $GLOBALS['pinthis_skin']);
	}
}
function pinthis_add_scripts() {
	// Register js files
	wp_register_script('pinthis-modernizr-script', get_template_directory_uri() . '/js/modernizr.min.js', array(), '2.8.3', true);
	wp_register_script('pinthis-spin-script', get_template_directory_uri() . '/js/spin.js', array(), '2.3.2', true);
	wp_register_script('pinthis-mousewheel-script', get_template_directory_uri() . '/js/jquery-mousewheel.js', array('jquery'), '3.1.12', true);
	wp_register_script('pinthis-masonry-script', get_template_directory_uri() . '/js/jquery-masonry.min.js', array('jquery'), '4.2.0', true);
	wp_register_script('pinthis-masonry-imagesload-script', get_template_directory_uri() . '/js/jquery-imagesloaded.js', array('jquery'), '4.1.2', true);
	wp_register_script('pinthis-selectbox-script', get_template_directory_uri() . '/js/jquery-selectbox.js', array('jquery'), '0.2', true);
	wp_register_script('pinthis-clearinginput-script', get_template_directory_uri() . '/js/jquery-clearinginput.js', array('jquery'), '1.0', true);
	wp_register_script('pinthis-atooltip-script', get_template_directory_uri() . '/js/jquery-atooltip.min.js', array('jquery'), '1.5', true);
	wp_register_script('pinthis-magnificpopup-script', get_template_directory_uri() . '/js/jquery-magnific-popup.js', array('jquery'), '1.1.0', true);
	wp_register_script('pinthis-spinjquery-script', get_template_directory_uri() . '/js/jquery-spin.min.js', array('jquery'), '1.0', true);
	wp_register_script('pinthis-jscrollpane-script', get_template_directory_uri() . '/js/jquery-jscrollpane.min.js', array('jquery'), '2.0.21', true);
	wp_register_script('pinthis-finger-script', get_template_directory_uri() . '/js/jquery-finger.min.js', array('jquery'), '0.1.0', true);
	wp_register_script('pinthis-flickerplate-script', get_template_directory_uri() . '/js/jquery-flickerplate.min.js', array('jquery'), '2.1.1', true);
	wp_register_script('pinthis-main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.6.7', true);
	// Localize js files
	$pinthis_phpjs_options = array(
		'arrows' => pinthis_string_boolean(get_option('pbpanel_slider_arrows')), 
		'arrows_constraint' => pinthis_string_boolean(get_option('pbpanel_slider_arrows_constraint')),
		'auto_flick' => pinthis_string_boolean(get_option('pbpanel_slider_slideshow')),
		'auto_flick_delay' => get_option('pbpanel_slider_slideshow_delay'),
		'block_text' => pinthis_string_boolean(get_option('pbpanel_slider_blocktext')),
		'dot_navigation' => pinthis_string_boolean(get_option('pbpanel_slider_dotnav')),
		'dot_alignment' => get_option('pbpanel_slider_dotnav_alignment'),
		'flick_position' => get_option('pbpanel_slider_slide_position'),
		'flick_position' => get_option('pbpanel_slider_slide_position'),
		'tr_username' => __('Username', 'pinthis'),
		'tr_password' => __('Password', 'pinthis'),
		'tr_search' => __('Search', 'pinthis')
	);
	wp_localize_script('pinthis-main-script', 'pinthis_phpjs_option', $pinthis_phpjs_options);	
	// Loads js files
	wp_enqueue_script('pinthis-modernizr-script');
	wp_enqueue_script('pinthis-spin-script');
	wp_enqueue_script('pinthis-mousewheel-script');
	wp_enqueue_script('pinthis-masonry-script');
	wp_enqueue_script('pinthis-masonry-imagesload-script');
	wp_enqueue_script('pinthis-selectbox-script');
	wp_enqueue_script('pinthis-clearinginput-script');
	wp_enqueue_script('pinthis-atooltip-script');
	wp_enqueue_script('pinthis-magnificpopup-script');
	wp_enqueue_script('pinthis-spinjquery-script');
	wp_enqueue_script('pinthis-jscrollpane-script');
	wp_enqueue_script('pinthis-finger-script');
	wp_enqueue_script('pinthis-flickerplate-script');
	wp_enqueue_script('pinthis-main-script');
}
function pinthis_add_fonts() {
	// Import Google Fonts
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('pinthis-ubuntu-font', "$protocol://fonts.googleapis.com/css?family=Ubuntu:400,400italic&subset=latin,cyrillic");
    wp_enqueue_style('pinthis-roboto-font', "$protocol://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900&subset=latin,cyrillic");
}
add_action('wp_enqueue_scripts', 'pinthis_add_styles');
add_action('wp_enqueue_scripts', 'pinthis_add_scripts');
add_action('wp_enqueue_scripts', 'pinthis_add_fonts');

// Comments reply
function pinthis_comments_reply() {
	if (is_singular() && comments_open() && get_option( 'thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('comment_form_before', 'pinthis_comments_reply');

/*====================================*\
	ENABLE LINK MANAGER
\*====================================*/

add_filter('pre_option_link_manager_enabled', '__return_true');

/*====================================*\
	SIDEBAR
\*====================================*/
function pinthis_sidebar() {
	register_sidebar(array(
		'id'          => 'page-sidebar',
		'name'          => __('Sidebar', 'pinthis'),
		'before_widget' => '<div class="contentbox">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title-1 border-color-2">',
		'after_title' => '</h4>'
	));
}
add_action('widgets_init', 'pinthis_sidebar');

/*====================================*\
	FOOTER WIDGET AREA
\*====================================*/
function pinthis_footer_widgets() {
	register_sidebar(array(
		'id'          => 'footer-widgets',
		'name'          => __('Footer', 'pinthis'),
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-2">',
		'after_title' => '</h3>'
	));
}
add_action('widgets_init', 'pinthis_footer_widgets');

/*====================================*\
	GET SKIN SRC
\*====================================*/

function pinthis_get_skin_src() {
	if ($GLOBALS['pinthis_skin'] != 'default' && $GLOBALS['pinthis_skin'] != '') {
		return get_template_directory_uri() . '/' . SKINS_DIR . '/' . $GLOBALS['pinthis_skin'];		
	} else {
		return get_template_directory_uri();	
	}
}

/*====================================*\
	GET FIRST POST IMAGE
\*====================================*/

function pinthis_get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	if (isset($matches[1][0])) {
		$first_img = $matches[1][0];
	}
	return $first_img;
}

/*====================================*\
	STRING TO BOOLEAN
\*====================================*/

function pinthis_string_boolean($string){
	return (strtoupper(trim($string)) === strtoupper("true")) ? true : false;
}

/*====================================*\
	EXCERPT
\*====================================*/

// Control excerpt length using custom function
function pinthis_excerpt($limit = 255) {
    echo wp_trim_words(get_the_excerpt(), $limit);
}

// Set excerpt length using filters 
function pinthis_excerpt_length($length) {
	return 255;
}
add_filter('excerpt_length', 'pinthis_excerpt_length', 999);

/*====================================*\
	WRAP HEADER SUB-MENU
\*====================================*/

class pinthis_submenu_wrap extends Walker_Nav_Menu {
   function start_lvl(&$output, $depth = 0, $args = array()) {
       $indent = str_repeat("\t", $depth);
       $output .= "\n$indent<div class=\"dropdown\"><div class=\"dropdown-wrapper arrow-up-left\"><ul class=\"sub-menu\">\n";
   }
   function end_lvl(&$output, $depth = 0, $args = array()) {
       $indent = str_repeat("\t", $depth);
       $output .= "$indent</ul></div></div>\n";
   }
} 

/*====================================*\
	POPULAR POSTS
\*====================================*/

function pinthis_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function pinthis_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*====================================*\
	ADD LINK TO EXTERNAL WEBSITE
\*====================================*/

// Register the metabox
function pinthis_add_external_link_box() {
	add_meta_box('pinthis_external_link_box', __('Add Link To External Website', 'pbpanel'), 'pinthis_show_external_link_box', 'post', 'side', 'default');
}
add_action('add_meta_boxes', 'pinthis_add_external_link_box');

// Output the metabox
function pinthis_show_external_link_box($object) {
	wp_nonce_field(basename( __FILE__ ), 'external_link_nonce'); ?>
	<p>
		<label for="external_link_title"><?php echo __('Link Title', 'pbpanel'); ?>:<br></label>
		<input type="text" id="external_link_title" name="external_link_title" value="<?php echo esc_attr(get_post_meta($object->ID, 'external_link_title', true)); ?>">
	</p>
	<p>
		<label for="external_link"><?php echo __('Link URL', 'pbpanel'); ?>:<br></label>
		<input type="text" id="external_link" name="external_link" value="<?php echo esc_attr(get_post_meta($object->ID, 'external_link', true)); ?>">
	</p>
    <?php
}

// Save the metabox values
function pinthis_save_external_link_box($post_id) {
	// Verify the nonce. If insn't there, stop the script
	if (!isset($_POST['external_link_nonce']) || !wp_verify_nonce($_POST['external_link_nonce'], basename( __FILE__ ))) return;

	// Stop the script if the user does not have edit permissions
	if (!current_user_can('edit_post')) return;

	// Data
	foreach ($_POST as $key => $value) {
		$exist_value = get_post_meta($post_id, $key, true);
		if ($value && $exist_value == '') {
			add_post_meta($post_id, $key, $value, true);
		} 
		elseif ($value && $value != $exist_value) {
			update_post_meta($post_id, $key, $value, $exist_value);
		} 
		elseif ($value == '' && $exist_value) {
			delete_post_meta($post_id, $key, $exist_value);
		}
	}	
} 
add_action('save_post', 'pinthis_save_external_link_box', 10, 2);

/*====================================*\
	ADD HTTP SCHEME
\*====================================*/

function pinthis_addScheme($url, $scheme = 'http://') {
    if (parse_url($url, PHP_URL_SCHEME) === null) {
        return $scheme . $url;
    }
    return $url;
}

/*====================================*\
	SET POST PER PAGE
\*====================================*/

function pinthis_posts_per_page($query) {
	$user_posts_per_page = get_option('posts_per_page');
    if ($user_posts_per_page < 10) {
		update_option('posts_per_page', 10);		
	}
}
add_action('pre_get_posts', 'pinthis_posts_per_page');

/*====================================*\
	NEXT AND PREVIOUS POST LINKS CLASS
\*====================================*/

function pinthis_next_posts_link_attributes(){
	return 'class="next"';
}
add_filter('next_posts_link_attributes', 'pinthis_next_posts_link_attributes');

function pinthis_prev_posts_link_attributes(){
	return 'class="prev"';
}
add_filter('previous_posts_link_attributes', 'pinthis_prev_posts_link_attributes');

/*====================================*\
	COMMENTS TEMPLATE
\*====================================*/

$pinthis_show_avatars = get_option('show_avatars');

function pinthis_comments($comment, $args, $depth) { ?>

<li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix'); ?> <?php if ($GLOBALS['pinthis_show_avatars'] != 1)  { ?> data-icon="false" <?php } ?>>
	<?php if (strlen(get_avatar($comment, 40)) > 0) { ?>
	<p class="icon"><?php echo get_avatar($comment, 40); ?></p>
	<?php } ?>
	<p class="date"><?php echo __('Posted:', 'pinthis'); ?>
		<?php comment_date(); comment_time(' H:i'); ?>
	</p>
	<h4 class="author">
		<?php comment_author_link(); ?>
		<?php if ($comment -> comment_approved == '0'): ?>
		<span class="color-2">&nbsp; <?php echo __('pending', 'pinthis'); ?></span>
		<?php endif; ?>
	</h4>
	<div class="comment-text"><?php echo $comment->comment_content; ?></div>
	<div class="comment-reply">
		<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'pinthis' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
<?php }

/*====================================*\
	COMMENTS FORM AVATAR
\*====================================*/

function pinthis_post_comment_form_avatar() { ?>
	<?php if ($GLOBALS['pinthis_show_avatars'] == 1)  { ?>
	<p class="icon">
	<?php 
		$current_user = wp_get_current_user();
		if (($current_user instanceof WP_User)) {
			echo get_avatar($current_user->user_email, 40);
		}
	?>
	</p>
	<?php } ?>
<?php }
add_action('comment_form_top', 'pinthis_post_comment_form_avatar');

/*====================================*\
	WIDGET - THUMBNAILER
\*====================================*/

function pinthis_register_thumbnailer_widget() {
	register_widget('thumbnailer_widget');
}
add_action('widgets_init', 'pinthis_register_thumbnailer_widget');

class thumbnailer_widget extends WP_Widget {
	function thumbnailer_widget() {
		$widget_ops = array('classname' => 'thumbnailer', 'description' => __('Recent Posts with thumbnails', 'thumbnailer'));
		$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'thumbnailer-widget');
		parent::__construct( 'thumbnailer-widget', __('Thumbnailer', 'thumbnailer'), $widget_ops, $control_ops);
	}
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$number_of_posts = $instance['number_of_posts'];
		echo $before_widget;
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		if ($number_of_posts) {
		?>
		<div class="widgetwrapper">
			<?php $args = array('numberposts' => $number_of_posts, 'order' => 'DESC'); $posts = wp_get_recent_posts($args); ?>
			<?php if ($posts) { ?>	
				<ul class="recentposts clearfix">	
					<?php foreach ($posts as $post) { ?>
					<li>
						<a class="tooltip" href="<?php echo get_permalink($post['ID']); ?>" title="<?php echo esc_attr($post['post_title']); ?>">
							<?php if (has_post_thumbnail($post['ID'])) { ?>
								<?php 
									$img = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), 'pt-thumb');
								?>
									<?php if ($img[0] != '') { ?>
									<img src="<?php echo $img[0]; ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" alt="<?php the_title(); ?>">
									<?php } else {
										the_post_thumbnail('thumbnail');	
									} ?>
							<?php } else { ?>
								<img src="<?php echo pinthis_get_skin_src(); ?>/images/no-image-small.png" width="68" height="68" alt="<?php the_title(); ?>">
							<?php } ?>
						</a>
					</li>	
					<?php } ?>
				</ul>	
			<?php } else { ?>
				<p class="notification"><?php echo __('No recent posts.', 'pinthis'); ?></p>
			<?php } ?>
		</div>
		<?php	
		}
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_of_posts'] = strip_tags($new_instance['number_of_posts']);
		return $instance;
	}
	function form($instance) {
		$defaults = array('title' => 'Thumbnailer', 'number_of_posts' => 9);
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'thumbnailer'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of posts (thumbnails) to show:', 'thumbnailer'); ?></label>
			<input type="text" size="3" value="<?php echo $instance['number_of_posts']; ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" id="<?php echo $this->get_field_id('number_of_posts'); ?>">
		</p>
		<?php
	}
}

/*====================================*\
	WIDGET - GOOGLE ADSENSE
\*====================================*/

function pinthis_register_googleadsense_widget() {
	register_widget('googleadsense_widget');
}
add_action('widgets_init', 'pinthis_register_googleadsense_widget');

class googleadsense_widget extends WP_Widget {
	function googleadsense_widget() {
		$widget_ops = array('classname' => 'googleadsense', 'description' => __('Google Adsense banner', 'thumbnailer'));
		$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'googleadsense-widget');
		parent::__construct( 'googleadsense-widget', __('Google Adsense', 'googleadsense'), $widget_ops, $control_ops);
	}
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$google_code = $instance['google_code'];
		echo $before_widget;
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		if ($google_code) {
		?>
		<div class="banner banner-position-4">
			<?php echo $google_code; ?>	
		</div>
		<?php	
		}
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['google_code'] = $new_instance['google_code'];
		return $instance;
	}
	function form($instance) {
		$defaults = array('title' => 'Google Adsense', 'google_code' => '');
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'googleadsense'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('google_code'); ?>"><?php _e('Put your google adsense code here. Recommended banner sizes: 200x200px, 180x150px, 160x600px, 120x600px, 120x240px', 'googleadsense'); ?></label>
			<textarea name="<?php echo $this->get_field_name('google_code'); ?>" id="<?php echo $this->get_field_id('google_code'); ?>" cols="20" rows="16" class="widefat"><?php echo $instance['google_code']; ?></textarea>
		</p>
		<?php
	}
}

/*====================================*\
	SLIDER
\*====================================*/

// Register slider post type
function pinthis_slider() {
    $labels = array(
        'name'                => _x('PB Slides', 'Post Type General Name', 'pinthis'),
        'singular_name'       => _x('Slide', 'Post Type Singular Name', 'pinthis'),
        'menu_name'           => __('PB Slides', 'pinthis'),
        'parent_item_colon'   => __('Parent Slide:', 'pinthis'),
        'all_items'           => __('All Slides', 'pinthis'),
        'view_item'           => __('View Slide', 'pinthis'),
        'add_new_item'        => __('Add New Slide', 'pinthis'),
        'add_new'             => __('New Slide', 'pinthis'),
        'edit_item'           => __('Edit Slide', 'pinthis'),
        'update_item'         => __('Update Slide', 'pinthis'),
        'search_items'        => __('Search slides', 'pinthis'),
        'not_found'           => __('No slides found', 'pinthis'),
        'not_found_in_trash'  => __('No slides found in Trash', 'pinthis'),
    );
 
    $args = array(
        'label'               => __('pinthis_slider', 'pinthis'),
        'description'         => __('Slides', 'pinthis'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail', 'page-attributes'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 62,
        'menu_icon'           => get_template_directory_uri() . '/pbpanel/images/icon-slides.png',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
 
    register_post_type('pinthis_slider', $args);
}
 
// Hook into the init action
add_action('init', 'pinthis_slider', 0);

/*====================================*\
	SLIDER METABOX
\*====================================*/

// Register the metabox
function pinthis_add_slide_box() {
	add_meta_box('pinthis_slide_box', __('Slide Data', 'pbpanel'), 'pinthis_show_slide_box', 'pinthis_slider', 'normal', 'high');
}
add_action('add_meta_boxes', 'pinthis_add_slide_box');

// Output the metabox
function pinthis_show_slide_box($object) {
	wp_nonce_field(basename( __FILE__ ), 'pinthis_slide_box_nonce'); ?>
	<p>
		<label for="slide_title"><?php echo __('Title', 'pbpanel'); ?>:<br></label>
		<input type="text" class="large-text" name="slide_title" id="slide_title" value="<?php echo esc_attr(get_post_meta($object->ID, 'slide_title', true)); ?>">
    </p>
	<p>
		<label for="slide_text"><?php echo __('Description', 'pbpanel'); ?>:<br></label>
		<textarea class="large-text" name="slide_text" id="slide_text" cols="50" rows="10"><?php echo esc_attr(get_post_meta($object->ID, 'slide_text', true)); ?></textarea>
    </p>
	<p>
		<label for="slide_link"><?php echo __('Link', 'pbpanel'); ?>:<br></label>
		<input type="text" class="large-text" name="slide_link" id="slide_link" value="<?php echo esc_attr(get_post_meta($object->ID, 'slide_link', true)); ?>">
    </p>
    <?php
}

// Save the metabox values
function pinthis_save_slide_box($post_id) {
	// Verify the nonce. If insn't there, stop the script
	if (!isset($_POST['pinthis_slide_box_nonce']) || !wp_verify_nonce($_POST['pinthis_slide_box_nonce'], basename( __FILE__ ))) return;

	// Stop the script if the user does not have edit permissions
	if (!current_user_can('edit_post')) return;

	// Data
	foreach ($_POST as $key => $value) {
		$exist_value = get_post_meta($post_id, $key, true);
		if ($value && $exist_value == '') {
			add_post_meta($post_id, $key, $value, true);
		} 
		elseif ($value && $value != $exist_value) {
			update_post_meta($post_id, $key, $value, $exist_value);
		} 
		elseif ($value == '' && $exist_value) {
			delete_post_meta($post_id, $key, $exist_value);
		}
	}
}
add_action('save_post', 'pinthis_save_slide_box');

/*====================================*\
	GOOGLE ADSENSE META BOX
\*====================================*/

// Register the metabox
function pinthis_add_googleadsense_settings_box() {
	add_meta_box('pinthis_googleadsense_settings_box', __('Google Adsense', 'pbpanel'), 'pinthis_show_googleadsense_settings_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'pinthis_add_googleadsense_settings_box');

// Output the metabox
function pinthis_show_googleadsense_settings_box($object) {
	wp_nonce_field(basename( __FILE__ ), 'pinthis_googleadsense_settings_box_nonce'); ?>
	<p>
		<label for="googleadsense_code"><?php echo __('Put your google adsense code here. Recommended banner sizes: 200x200px, 180x150px', 'pbpanel'); ?>:<br></label>
		<textarea class="large-text" name="googleadsense_code" id="googleadsense_code" cols="50" rows="10"><?php echo esc_attr(get_post_meta($object->ID, 'googleadsense_code', true)); ?></textarea>
    </p>
    <?php
}

// Save the metabox values
function pinthis_save_googleadsense_settings_box($post_id) {
	// Verify the nonce. If insn't there, stop the script
	if (!isset($_POST['pinthis_googleadsense_settings_box_nonce']) || !wp_verify_nonce($_POST['pinthis_googleadsense_settings_box_nonce'], basename( __FILE__ ))) return;

	// Stop the script if the user does not have edit permissions
	if (!current_user_can('edit_post')) return;

	// Data
	foreach ($_POST as $key => $value) {
		$exist_value = get_post_meta($post_id, $key, true);
		if ($value && $exist_value == '') {
			add_post_meta($post_id, $key, $value, true);
		} 
		elseif ($value && $value != $exist_value) {
			update_post_meta($post_id, $key, $value, $exist_value);
		} 
		elseif ($value == '' && $exist_value) {
			delete_post_meta($post_id, $key, $exist_value);
		}
	}
}
add_action('save_post', 'pinthis_save_googleadsense_settings_box');

/*====================================*\
	QUOTE SETTINGS META BOX
\*====================================*/

// Register the metabox
function pinthis_add_quote_settings_box() {
	add_meta_box('pinthis_quote_settings_box', __('Quote Settings', 'pbpanel'), 'pinthis_show_quote_settings_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'pinthis_add_quote_settings_box');

// Output the metabox
function pinthis_show_quote_settings_box($object) {
	wp_nonce_field(basename( __FILE__ ), 'pinthis_quote_settings_box_nonce'); ?>
	<p>
		<label for="quote_text"><?php echo __('Quote Text', 'pbpanel'); ?>:<br></label>
		<textarea class="large-text" name="quote_text" id="quote_text" cols="50" rows="10"><?php echo esc_attr(get_post_meta($object->ID, 'quote_text', true)); ?></textarea>
    </p>
	<p>
		<label for="quote_author"><?php echo __('Quote Author', 'pbpanel'); ?>:<br></label>
		<input type="text" class="large-text" name="quote_author" id="quote_author" value="<?php echo esc_attr(get_post_meta($object->ID, 'quote_author', true)); ?>">
    </p>
    <?php
}

// Save the metabox values
function pinthis_save_quote_settings_box($post_id) {
	// Verify the nonce. If insn't there, stop the script
	if (!isset($_POST['pinthis_quote_settings_box_nonce']) || !wp_verify_nonce($_POST['pinthis_quote_settings_box_nonce'], basename( __FILE__ ))) return;

	// Stop the script if the user does not have edit permissions
	if (!current_user_can('edit_post')) return;

	// Data
	foreach ($_POST as $key => $value) {
		$exist_value = get_post_meta($post_id, $key, true);
		if ($value && $exist_value == '') {
			add_post_meta($post_id, $key, $value, true);
		} 
		elseif ($value && $value != $exist_value) {
			update_post_meta($post_id, $key, $value, $exist_value);
		} 
		elseif ($value == '' && $exist_value) {
			delete_post_meta($post_id, $key, $exist_value);
		}
	}
}
add_action('save_post', 'pinthis_save_quote_settings_box');

/*====================================*\
	AUDIO SETTINGS META BOX
\*====================================*/

// Register the metabox
function pinthis_add_audio_settings_box() {
	add_meta_box('pinthis_audio_settings_box', __('Audio Settings', 'pbpanel'), 'pinthis_show_audio_settings_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'pinthis_add_audio_settings_box');

// Output the metabox
function pinthis_show_audio_settings_box($object) {
	wp_nonce_field(basename( __FILE__ ), 'pinthis_audio_settings_box_nonce'); ?>
	<p>
		<label for="audio_url"><?php echo __('Audio URL', 'pbpanel'); ?>:<br></label>
		<input type="text" class="large-text event-src-field" name="audio_url" id="audio_url" value="<?php echo esc_attr(get_post_meta($object->ID, 'audio_url', true)); ?>" placeholder="<?php echo __('http://', 'pbpanel'); ?>">
    </p>
	<p class="howto"><?php echo __('Supported formats: MP3, M4A, OGG, WAV, WMA', 'pbpanel'); ?></p>
	<hr>
	<p><?php echo __('or', 'pbpanel'); ?> &nbsp; <input type="button" value="<?php echo __('Upload Audio', 'pbpanel'); ?>" class="button event-upload-button" data-rel="audio"></p>
    <?php
}

// Save the metabox values
function pinthis_save_audio_settings_box($post_id) {
	// Verify the nonce. If insn't there, stop the script
	if (!isset($_POST['pinthis_audio_settings_box_nonce']) || !wp_verify_nonce($_POST['pinthis_audio_settings_box_nonce'], basename( __FILE__ ))) return;

	// Stop the script if the user does not have edit permissions
	if (!current_user_can('edit_post')) return;

	// Data
	foreach ($_POST as $key => $value) {
		$exist_value = get_post_meta($post_id, $key, true);
		if ($value && $exist_value == '') {
			add_post_meta($post_id, $key, $value, true);
		} 
		elseif ($value && $value != $exist_value) {
			update_post_meta($post_id, $key, $value, $exist_value);
		} 
		elseif ($value == '' && $exist_value) {
			delete_post_meta($post_id, $key, $exist_value);
		}
	}
}
add_action('save_post', 'pinthis_save_audio_settings_box');

/*====================================*\
	VIDEO SETTINGS META BOX
\*====================================*/

// Register the metabox
function pinthis_add_video_settings_box() {
	add_meta_box('pinthis_video_settings_box', __('Video Settings', 'pbpanel'), 'pinthis_show_video_settings_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'pinthis_add_video_settings_box');

// Output the metabox
function pinthis_show_video_settings_box($object) {
	wp_nonce_field(basename( __FILE__ ), 'pinthis_video_settings_box_nonce'); ?>
	<p>
		<?php echo __('Aspect Ratio:', 'pbpanel'); ?> &nbsp; 
		<label for="video_aspect_ratio_16_9"><input type="radio" value="16:9" name="video_aspect_ratio" id="video_aspect_ratio_16_9" <?php if (get_post_meta($object->ID, 'video_aspect_ratio', true) == '16:9' || strlen(get_post_meta($object->ID, 'video_aspect_ratio', true)) == 0) { ?> checked="checked" <?php } ?>><span><?php echo __('16:9', 'pbpanel'); ?></span></label> &nbsp; 
		<label for="video_aspect_ratio_4_3"><input type="radio" value="4:3" name="video_aspect_ratio" id="video_aspect_ratio_4_3" <?php if (get_post_meta($object->ID, 'video_aspect_ratio', true) == '4:3') { ?> checked="checked" <?php } ?>><span><?php echo __('4:3', 'pbpanel'); ?></span></label> 
	</p>
	<hr>
	<p>
		<label for="video_url"><?php echo __('Video URL', 'pbpanel'); ?>:<br></label>
		<input type="text" class="large-text event-src-field" name="video_url" id="video_url" value="<?php echo esc_attr(get_post_meta($object->ID, 'video_url', true)); ?>" placeholder="<?php echo __('http://', 'pbpanel'); ?>">
    </p>
	<p class="howto"><?php echo __('Supported sites: Youtube, Vimeo', 'pbpanel'); ?></p>
	<p class="howto"><?php echo __('Supported formats: MP4, M4V, WEBM, OGV, WMV, FLV', 'pbpanel'); ?></p>
	<hr>
	<p><?php echo __('or', 'pbpanel'); ?> &nbsp; <input type="button" value="<?php echo __('Upload Video', 'pbpanel'); ?>" class="button event-upload-button" data-rel="video"></p>
    <?php
}

// Save the metabox values
function pinthis_save_video_settings_box($post_id) {
	// Verify the nonce. If insn't there, stop the script
	if (!isset($_POST['pinthis_video_settings_box_nonce']) || !wp_verify_nonce($_POST['pinthis_video_settings_box_nonce'], basename( __FILE__ ))) return;

	// Stop the script if the user does not have edit permissions
	if (!current_user_can('edit_post')) return;

	// Data
	foreach ($_POST as $key => $value) {
		$exist_value = get_post_meta($post_id, $key, true);
		if ($value && $exist_value == '') {
			add_post_meta($post_id, $key, $value, true);
		} 
		elseif ($value && $value != $exist_value) {
			update_post_meta($post_id, $key, $value, $exist_value);
		} 
		elseif ($value == '' && $exist_value) {
			delete_post_meta($post_id, $key, $exist_value);
		}
	}
}
add_action('save_post', 'pinthis_save_video_settings_box');

/*====================================*\
	FILTER VIDEO OUTPUT
\*====================================*/

add_filter('oembed_result', 'pinthis_oembed_result', 10, 3);

function pinthis_oembed_result($html, $url, $args) {
	// $args includes custom argument
	$newargs = $args;
	
	// get rid of discover=true argument
	array_pop($newargs);
	$parameters = http_build_query($newargs);
	 
	// Modify video parameters
	$html = str_replace('?feature=oembed', '?feature=oembed' . '&amp;' . $parameters, $html);
	
	return $html;
}

/*====================================*\
	WP ADMIN
\*====================================*/

function pinthis_wpadmin_add_styles() {
	// Register stylesheets
	wp_register_style('pinthis-wpadmin-style', get_template_directory_uri() . '/style-wpadmin.css', array(), '1.6.7', 'all');
	// Loads stylesheets
	wp_enqueue_style('pinthis-wpadmin-style');
}
function pinthis_wpadmin_add_scripts() {
	// Register js files
	wp_register_script('pinthis-wpadmin-main-script', get_template_directory_uri() . '/js/main-wpadmin.js', array('jquery'), '1.6.7', true);
	// Loads js files
	wp_enqueue_script('pinthis-wpadmin-main-script');
}
add_action('admin_enqueue_scripts', 'pinthis_wpadmin_add_styles');
add_action('admin_enqueue_scripts', 'pinthis_wpadmin_add_scripts');

/*====================================*\
	PB PANEL
\*====================================*/

get_template_part('pbpanel/core');

function pbpanel_add_styles() {
	// Register our main stylesheet
	wp_register_style('pbpanel-style', get_template_directory_uri() . '/pbpanel/css/pbpanel.css', array(), '1.6.7', 'all');
	// Loads our main stylesheet
	wp_enqueue_style('pbpanel-style');
}
function pbpanel_add_scripts() {
	// Register js files
	wp_register_script('pbpanel-scripts', get_template_directory_uri() . '/pbpanel/js/pbpanel.js', array('jquery'), '1.6.7', true);
	// Loads js files
	wp_enqueue_script('pbpanel-scripts');
}
add_action('admin_enqueue_scripts', 'pbpanel_add_styles');
add_action('admin_enqueue_scripts', 'pbpanel_add_scripts');

function pbpanel_init(){
	pbpanel_options('add_option');
}
function pbpanel_menu() {
	add_menu_page(__('PB Panel', 'pinthis'), __('PB Panel', 'pinthis'), 'manage_options', 'pbpanel-main', 'pbpanel_render_main', get_template_directory_uri() . '/pbpanel/images/icon-logo.png', 61);
	add_submenu_page('pbpanel-main', __('Main', 'pinthis'), __('Main', 'pinthis'), 'manage_options', 'pbpanel-main', 'pbpanel_render_main');
	add_submenu_page('pbpanel-main', __('Branding', 'pinthis'), __('Branding', 'pinthis'), 'manage_options', 'pbpanel-branding', 'pbpanel_render_branding');
	add_submenu_page('pbpanel-main', __('Slider', 'pinthis'), __('Slider', 'pinthis'), 'manage_options', 'pbpanel-slider', 'pbpanel_render_slider');
	add_submenu_page('pbpanel-main', __('SEO', 'pinthis'), __('SEO', 'pinthis'), 'manage_options', 'pbpanel-seo', 'pbpanel_render_seo');
	add_submenu_page('pbpanel-main', __('Social Networks', 'pinthis'), __('Social Networks', 'pinthis'), 'manage_options', 'pbpanel-socialnetworks', 'pbpanel_render_socialnetworks');
	add_submenu_page('pbpanel-main', __('Google Adsense', 'pinthis'), __('Google Adsense', 'pinthis'), 'manage_options', 'pbpanel-googleads', 'pbpanel_render_googleads');
	add_submenu_page('pbpanel-main', __('Reset', 'pinthis'), __('Reset', 'pinthis'), 'manage_options', 'pbpanel-reset', 'pbpanel_render_reset');
}
function pbpanel_render_main() {
	get_template_part('pbpanel/page-main');	
}
function pbpanel_render_branding() {
	get_template_part('pbpanel/page-branding');	
}
function pbpanel_render_slider() {
	get_template_part('pbpanel/page-slider');	
}
function pbpanel_render_seo() {
	get_template_part('pbpanel/page-seo');	
}
function pbpanel_render_socialnetworks() {
	get_template_part('pbpanel/page-socialnetworks');	
}
function pbpanel_render_googleads() {
	get_template_part('pbpanel/page-googleads');	
}
function pbpanel_render_reset() {
	get_template_part('pbpanel/page-reset');	
}
add_action('admin_init', 'pbpanel_init');
add_action('admin_menu', 'pbpanel_menu');

/*====================================*\
	BUG FIXES
\*====================================*/

function pinthis_remove_category_list_rel($output) {
    // Remove rel attribute from the category list
    return str_replace('rel="category"', '', $output);
}
 
add_filter('wp_list_categories', 'pinthis_remove_category_list_rel');
add_filter('the_category', 'pinthis_remove_category_list_rel');

?>