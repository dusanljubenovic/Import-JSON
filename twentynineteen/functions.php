<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'events-list-css', get_template_directory_uri() . '/css/events-list.css', '', '1.0.0' );

	wp_enqueue_style( 'font-list-css','https://fonts.googleapis.com/css?family=Roboto&display=swap');
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/*******************************************************************************************************
 Additional part  - start
 *******************************************************************************************************/



add_action('init', 'create_post_type',0);
/* Create events post type */
if (!function_exists('create_post_type')) {
	function create_post_type() {
	
		
			register_post_type('events',
			array(
				'labels' 		=> array(
				'name' 				=> 'Events',
				'singular_name' 	=> 'event',
				'add_item'			=> 'New Event',
				'add_new_item' 		=> 'Add New Event',
				'edit_item' 		=> 'Edit Event'
				),
				'public'		=>	true,
				'show_in_menu'	=>	true, 
				'rewrite' 		=> 	array('slug' => 'events'),
				'menu_position' => 	4,
				 'public'             => true,
				 'publicly_queryable' => true,
				 'show_ui'            => true,
				 'show_in_menu'       => true,
				 'query_var'          => true,
				 'has_archive'	=>	true, 
				 'hierarchical'	=>	false,
				 'show_in_rest'       => true,
				'rest_base'          => 'events',
                'rest_controller_class' => 'WP_REST_Posts_Controller',
		        'supports'		=>	array('title', 'thumbnail', 'editor','tags')
			)
		);


		    /* Create  Tags */

			$labels = array(
				'name' => 'Event Tags', 
				'singular_name' => 'Event Tag', 
				'search_items' =>  'Search Event Tags',
				'all_items' => 'All Event Tags',
				'parent_item' => 'Parent Event Tag',
				'parent_item_colon' => 'Parent Event Tags:',
				'edit_item' => 'Edit Event Tags',
				'update_item' => 'Update Event Tags',
				'add_new_item' => 'Add New Event Tags',
				'new_item_name' => 'New Event Tags ',
				'menu_name' => 'Event Tags',
			);
		
			register_taxonomy('event_tag',array('events'), array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'event-tag' ),
			));   
    

    }
}

add_action("admin_init", "admin_init");
add_action('save_post', 'save_datas');

function admin_init(){
	add_meta_box("meta-time", "Time", "meta_options_time", "events", "normal", "high");
	add_meta_box("meta-active", "Active", "meta_options_active", "events", "normal", "high");
	add_meta_box("meta-organizer", "Organizer", "meta_options_organizer", "events", "normal", "high");
	add_meta_box("meta-email", "Email", "meta_options_email", "events", "normal", "high");
	add_meta_box("meta-address", "Address", "meta_options_address", "events", "normal", "high");
	add_meta_box("meta-latitude", "Latitude", "meta_options_latitude", "events", "normal", "high");
	add_meta_box("meta-longitude", "Longitude", "meta_options_longitude", "events", "normal", "high");
}
 
 
function meta_options_organizer(){
	global $post;
	$custom = get_post_custom($post->ID);
	$organizer = $custom["organizer"][0];
?>
<input name="organizer" value="<?php echo $organizer; ?>" />
<?php
}

function meta_options_email(){
	global $post;
	$custom = get_post_custom($post->ID);
	$email = $custom["email"][0];
?>
<input name="email" value="<?php echo $email; ?>" />
<?php
}

function meta_options_address(){
	global $post;
	$custom = get_post_custom($post->ID);
	$address = $custom["address"][0];
?>
<input name="address" value="<?php echo $address; ?>" />
<?php
}

function meta_options_latitude(){
	global $post;
	$custom = get_post_custom($post->ID);
	$latitude = $custom[latitude][0];
?>
<input name="latitude" value="<?php echo $latitude; ?>" />
<?php
}
function meta_options_longitude(){
	global $post;
	$custom = get_post_custom($post->ID);
	$longitude = $custom[longitude][0];
?>
<input name="longitude" value="<?php echo $longitude; ?>" />
<?php
}
function meta_options_active(){
	global $post;
	$custom = get_post_custom($post->ID);
	$active = $custom[active][0];

?>
<input type="checkbox" name="active[]" value="<?php echo $active; ?>" <?php if ($active): ?>checked<?php endif; ?>  > Is Active?<br>

<?php
}

function meta_options_time(){
	global $post;
	$custom = get_post_custom($post->ID);
	$time = $custom[time][0];

?>
<input name="time" value="<?php echo $time; ?>" />

<?php
}



function save_datas(){
global $post;

if ( isset($_POST["time"]) ) {
update_post_meta($post->ID, "time", $_POST["time"]);
}

if ( isset($_POST["organizer"]) ) {
update_post_meta($post->ID, "organizer", $_POST["organizer"]);
}


if ( isset($_POST["email"]) ) {
update_post_meta($post->ID, "email", $_POST["email"]);
}

if ( isset($_POST["address"]) ) {
update_post_meta($post->ID, "address", $_POST["address"]);
}

if ( isset($_POST["latitude"]) ) {
update_post_meta($post->ID, "latitude", $_POST["latitude"]);
}

if ( isset($_POST["longitude"]) ) {
update_post_meta($post->ID, "longitude", $_POST["longitude"]);
}

if ( isset($_POST["active"]) ) {
update_post_meta($post->ID, "active", $_POST["active"]);
}


}





add_action( 'rest_api_init', 'add_custom_fields' );

function add_custom_fields() {

register_rest_field(
'events', 
'timestamp', //New Field Name in JSON RESPONSEs
array(
    'get_callback'    => 'get_post_meta_for_api_time', // custom function name 
    'update_callback' => null,
    'schema'          => null,
     )
);

register_rest_field(
	'events', 
	'organizer', //New Field Name in JSON RESPONSEs
	array(
		'get_callback'    => 'get_post_meta_for_api_organizer', // custom function name 
		'update_callback' => null,
		'schema'          => null,
		 )
	);


register_rest_field(
		'events', 
		'active', //New Field Name in JSON RESPONSEs
		array(
			'get_callback'    => 'get_post_meta_for_api_is_active', // custom function name 
			'update_callback' => null,
			'schema'          => null,
			 )
);


register_rest_field(
	'events', 
	'email', //New Field Name in JSON RESPONSEs
	array(
		'get_callback'    => 'get_post_meta_for_api_email', // custom function name 
		'update_callback' => null,
		'schema'          => null,
		 )
);

register_rest_field(
	'events', 
	'address', //New Field Name in JSON RESPONSEs
	array(
		'get_callback'    => 'get_post_meta_for_api_address', // custom function name 
		'update_callback' => null,
		'schema'          => null,
		 )
);

register_rest_field(
	'events', 
	'latitude', //New Field Name in JSON RESPONSEs
	array(
		'get_callback'    => 'get_post_meta_for_api_latitude', // custom function name 
		'update_callback' => null,
		'schema'          => null,
		 )
);

register_rest_field(
	'events', 
	'longitude', //New Field Name in JSON RESPONSEs
	array(
		'get_callback'    => 'get_post_meta_for_api_longitude', // custom function name 
		'update_callback' => null,
		'schema'          => null,
		 )
);

register_rest_field(
	'events', 
	'tags', //New Field Name in JSON RESPONSEs
	array(
		'get_callback'    => 'get_post_meta_for_api_tags', // custom function name 
		'update_callback' => null,
		'schema'          => null,
		 )
);


}

function get_post_meta_for_api_time( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];
	
	return get_post_meta( $post_id , 'time', false )[0];

}

function get_post_meta_for_api_organizer( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];
	
	return get_post_meta( $post_id , 'organizer', false )[0];

}

function get_post_meta_for_api_is_active( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];

	if(get_post_meta( $post_id , 'active', false )[0][0]=="1" ) {
		return "true";
	}else{
		return "false";
	}

}


function get_post_meta_for_api_email( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];
	
	return get_post_meta( $post_id , 'email', false )[0];

}

function get_post_meta_for_api_address( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];
	
	return get_post_meta( $post_id , 'address', false )[0];

}

function get_post_meta_for_api_latitude( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];
	
	return get_post_meta( $post_id , 'latitude', false )[0];

}

function get_post_meta_for_api_longitude( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];
	
	return get_post_meta( $post_id , 'longitude', false )[0];

}

function get_post_meta_for_api_tags( $object ) {
    //get the id of the post object array
	$post_id = $object['id'];

	return wp_get_object_terms($post_id,'event_tag');
	
}



add_action( 'rest_api_init', 'wp_rest_filter_add_filters' );
 /**
  * Add the necessary filter to each post type
  **/
function wp_rest_filter_add_filters() {
    foreach ( get_post_types( array( 'show_in_rest' => true ), 'objects' ) as $post_type ) {
        add_filter( 'rest_' . $post_type->name . '_query', 'wp_rest_filter_add_filter_param', 10, 2 );
    }
}
/**
 * Add the filter parameter
 *
 * @param  array           $args    The query arguments.
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function wp_rest_filter_add_filter_param( $args, $request ) {
    // Bail out if no filter parameter is set.
    if ( empty( $request['filter'] ) || ! is_array( $request['filter'] ) ) {
        return $args;
    }
    $filter = $request['filter'];
    if ( isset( $filter['posts_per_page'] ) && ( (int) $filter['posts_per_page'] >= 1 && (int) $filter['posts_per_page'] <= 100 ) ) {
        $args['posts_per_page'] = $filter['posts_per_page'];
    }
    global $wp;
    $vars = apply_filters( 'rest_query_vars', $wp->public_query_vars );
    function allow_meta_query( $valid_vars )
    {
        $valid_vars = array_merge( $valid_vars, array( 'meta_query', 'meta_key', 'meta_value', 'meta_compare' ) );
        return $valid_vars;
    }
    $vars = allow_meta_query( $vars );

    foreach ( $vars as $var ) {
        if ( isset( $filter[ $var ] ) ) {
            $args[ $var ] = $filter[ $var ];
        }
    }
    return $args;
}

/*******************************************************************************************************
 Additional part  - end
 *******************************************************************************************************/