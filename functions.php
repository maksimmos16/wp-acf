<?php

/**
 * promo-front functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package promo-front
 */

if (!defined('_S_VERSION')) {
// Replace the version number of the theme on each release.
define('_S_VERSION', '1.0.0');
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function promo_front_setup()
{
/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
* If you're building a theme based on promo-front, use a find and replace
* to change 'promo-front' to the name of your theme in all the template files.
*/
load_theme_textdomain('promo-front', get_template_directory() . '/languages');

// Add default posts and comments RSS feed links to head.
add_theme_support('automatic-feed-links');

/*
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded <title> tag in the document head, and expect WordPress to
* provide it for us.
*/
add_theme_support('title-tag');

/*
* Enable support for Post Thumbnails on posts and pages.
*
* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
*/
add_theme_support('post-thumbnails');

// This theme uses wp_nav_menu() in one location.
register_nav_menus(
array(
'menu-1' => esc_html__('Primary', 'promo-front'),
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
'style',
'script',
)
);

// Set up the WordPress core custom background feature.
add_theme_support(
'custom-background',
apply_filters(
'promo_front_custom_background_args',
array(
	'default-color' => 'ffffff',
	'default-image' => '',
)
)
);

// Add theme support for selective refresh for widgets.
add_theme_support('customize-selective-refresh-widgets');

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
add_theme_support(
'custom-logo',
array(
'height'      => 250,
'width'       => 250,
'flex-width'  => true,
'flex-height' => true,
)
);
}
add_action('after_setup_theme', 'promo_front_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function promo_front_content_width()
{
$GLOBALS['content_width'] = apply_filters('promo_front_content_width', 640);
}
add_action('after_setup_theme', 'promo_front_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function promo_front_widgets_init()
{
register_sidebar(
array(
'name'          => esc_html__('Sidebar', 'promo-front'),
'id'            => 'sidebar-1',
'description'   => esc_html__('Add widgets here.', 'promo-front'),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget'  => '</section>',
'before_title'  => '<h2 class="widget-title">',
'after_title'   => '</h2>',
)
);
}
add_action('widgets_init', 'promo_front_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function promo_front_scripts()
{
wp_enqueue_style('promo-front-style', get_stylesheet_uri(), array(), _S_VERSION);
wp_style_add_data('promo-front-style', 'rtl', 'replace');

// wp_enqueue_script( 'promo-front-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

if (is_singular() && comments_open() && get_option('thread_comments')) {
wp_enqueue_script('comment-reply');
}
}
add_action('wp_enqueue_scripts', 'promo_front_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
require get_template_directory() . '/inc/jetpack.php';
}


function deregister_default_jquery()
{
if (!is_admin()) {
// Отключаем стандартное подключение jQuery
wp_deregister_script('jquery');
}
}

// Вызываем функцию при загрузке скриптов
add_action('wp_enqueue_scripts', 'deregister_default_jquery');



function custom_theme_scripts()
{
wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.0.min.js', array(), '3.7.0', false);

wp_enqueue_script('app-script', get_template_directory_uri() . '/js/app.min.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'custom_theme_scripts');



if (function_exists('acf_add_options_page')) {

acf_add_options_page(array(
'page_title'    => 'Theme General Settings',
'menu_title'    => 'Theme Settings',
'menu_slug'     => 'theme-general-settings',
'capability'    => 'edit_posts',
'redirect'      => false
));
}

/* widgets for footer */
function custom_footer_widgets_init()
{
register_sidebar(array(
'name' => __('Footer Widget 1', 'theme_name'),
'id' => 'footer_widget_1',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
));

register_sidebar(array(
'name' => __('Footer Widget 2', 'theme_name'),
'id' => 'footer_widget_2',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
));

register_sidebar(array(
'name' => __('Footer Widget 3', 'theme_name'),
'id' => 'footer_widget_3',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
));

register_sidebar(array(
'name' => __('Footer Copyright', 'theme_name'),
'id' => 'footer_widget_copyright',
));

// register_sidebar(array(
// 	'name' => __('Blog post share desktop', 'theme_name'),
// 	'id' => 'blog_post_share',
// ));

// register_sidebar(array(
// 	'name' => __('Blog post share mobile', 'theme_name'),
// 	'id' => 'blog_post_share_mobile',
// ));
}

add_action('widgets_init', 'custom_footer_widgets_init');



// add_filter( 'wpcf7_load_js', '__return_false' );
// add_filter( 'wpcf7_load_css', '__return_false' );

// modules 


/* homepage modules */
if (!function_exists('ea_acf_hero')) {
function ea_acf_hero()
{
// Check if ACF is active
if (function_exists('get_field')) {
// Get the current post/page ID
$post_id = get_the_ID();

$hero_fields = get_field('hero_section', $post_id);

if ($hero_fields) {
	$hero_title = $hero_fields['hero_title'];
	$hero_title = str_replace(array('<p>', '</p>'), '', $hero_title);

	$hero_text = $hero_fields['hero_text'];
	$hero_button = $hero_fields['hero_button'];;

	if ($hero_button) :
		$hero_button_link_url = $hero_button['url'];
		$hero_button_link_title = $hero_button['title'];
	endif;

	$background_image = $hero_fields['hero_background_image'];

	if (!empty($hero_title)) { ?>

	<section class="mt-[50px] relative xl:mt-[40px]">
	<div class="hidden xl:block absolute bg-contain bg-no-repeat bottom-0 left-0 right-0 top-0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/main-hero-bg.svg'); background-position: center;"></div>
	<div class="flex justify-center gap-5 px-[16px] xl:container xl:justify-between">
		<div class="text-center max-w-[700px] xl:mt-[100px] xl:text-left">
		<h1 class="mb-[50px] xl:mb-[20px]"><?php echo $hero_title; ?></h1>
		<p class="text-[18px] text-troove-black-900 leading-[1.2] lg:text-[20px] max-w-[640px]">
			<?php echo $hero_text; ?>
			</p>
			<a href="<?php echo ($hero_button_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[35px] xl:mt-[70px]">
				<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo esc_html($hero_button_link_title); ?></span>
				<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
			</a>
		</div>
		<div class="hidden xl:block max-w-[50%]"><img src="<?php echo esc_url($background_image); ?>" alt=""></div>
	</div>
	</section>

	<?php }
}
}
}
}


if (!function_exists('ea_acf_services')) {
function ea_acf_services()
{
if (function_exists('get_field')) {
// Get the current post/page ID
$post_id = get_the_ID();

$services_fields = get_field('service_section', $post_id);

if ($services_fields) {
	$service_title = $services_fields['service_title'];
	$allowed_tags = array(
		'br' => array(),
		'span' => array(),
	);
	$service_title = wp_kses($service_title, $allowed_tags);

	$service_text = $services_fields['service_text'];
	$custom_service_text_classes = 'mx-auto leading-[1.2] lg:text-[20px] max-w-[900px] mb-5 text-[18px] text-troove-black-900';
	$existing_opening_service_text_p = '<p>';
	$service_text = str_replace($existing_opening_service_text_p, '<p class="' . esc_attr($custom_service_text_classes) . '">', $service_text);

	$service_card_image_1 = $services_fields['service_card_image_1'];
	$service_card_text_1 = $services_fields['service_card_text_1'];
	if ($service_card_text_1) :
		$service_card_text_1_url = $service_card_text_1['url'];
		$service_card_text_1_title = $service_card_text_1['title'];
	endif;

	$service_card_image_2 = $services_fields['service_card_image_2'];
	$service_card_text_2 = $services_fields['service_card_text_2'];
	if ($service_card_text_2) :
		$service_card_text_2_url = $service_card_text_2['url'];
		$service_card_text_2_title = $service_card_text_2['title'];
	endif;


	$service_card_image_3 = $services_fields['service_card_image_3'];
	$service_card_text_3 = $services_fields['service_card_text_3'];
	if ($service_card_text_3) :
		$service_card_text_3_url = $service_card_text_3['url'];
		$service_card_text_3_title = $service_card_text_3['title'];
	endif;

	$service_card_image_4 = $services_fields['service_card_image_4'];
	$service_card_text_4 = $services_fields['service_card_text_4'];
	if ($service_card_text_4) :
		$service_card_text_4_url = $service_card_text_4['url'];
		$service_card_text_4_title = $service_card_text_4['title'];
	endif;

	$service_card_image_5 = $services_fields['service_card_image_5'];
	$service_card_text_5 = $services_fields['service_card_text_5'];
	if ($service_card_text_5) :
		$service_card_text_5_url = $service_card_text_5['url'];
		$service_card_text_5_title = $service_card_text_5['title'];
	endif;

	$service_button_link = $services_fields['service_button_link'];;
	if ($service_button_link) :
		$service_button_link_url = $service_button_link['url'];
		$hero_button_link_title = $service_button_link['title'];
	endif;

	if (!empty($service_title)) { ?>

		<section class="pb-[50px] pt-[70px] xl:py-[50px] xl:mt-[50px]">
			<div class="text-center px-[16px] xl:container">
				<h2 class="text-center h1 mb-[45px]"><?php echo $service_title; ?></h2>
				<?php echo $service_text; ?>

				<div class="mb-[50px] 2xl:gap-[165px] gap-[50px] grid grid-cols-1 lg:gap-[30px] lg:grid-cols-5 lg:mb-[90px] mt-[60px] sm:grid-cols-3 xl:gap-[70px]">
					<div>
						<div class="items-center justify-center flex h-[133px] mx-auto rounded-full w-[133px] xl:h-[187px] xl:w-[187px] bg-troove-purple-400">
							<img class="w-[60%] xl:w-auto" src="<?php echo esc_url($service_card_image_1); ?>" alt="">
						</div>
						<a class="hover:text-troove-purple-500" href="<?php echo esc_url($service_card_text_1_url); ?>">
							<h3 class="mt-[30px] hover:text-troove-purple-600"><?php echo $service_card_text_1_title; ?></h3>
						</a>
					</div>
					<div>
						<div class="items-center justify-center flex h-[133px] mx-auto rounded-full w-[133px] xl:h-[187px] xl:w-[187px] bg-troove-purple-500">
							<img class="w-[60%] xl:w-auto" src="<?php echo esc_url($service_card_image_2); ?>" alt="">
						</div>
						<a href="<?php echo esc_url($service_card_text_2_url); ?>">
							<h3 class="mt-[30px] hover:text-troove-purple-600"><?php echo $service_card_text_2_title; ?></h3>
						</a>
					</div>
					<div>
						<div class="items-center justify-center flex h-[133px] mx-auto rounded-full w-[133px] xl:h-[187px] xl:w-[187px] bg-troove-gradient-400">
							<img class="w-[60%] xl:w-auto" src="<?php echo esc_url($service_card_image_3); ?>" alt="">
						</div>
						<a href="<?php echo esc_url($service_card_text_3_url); ?>">
							<h3 class="mt-[30px] hover:text-troove-purple-600"><?php echo $service_card_text_3_title; ?></h3>
						</a>
					</div>
					<div>
						<div class="items-center justify-center flex h-[133px] mx-auto rounded-full w-[133px] xl:h-[187px] xl:w-[187px] bg-troove-yellow-400">
							<img class="w-[60%] xl:w-auto" src="<?php echo esc_url($service_card_image_4); ?>" alt="">
						</div>
						<a href="<?php echo esc_url($service_card_text_4_url); ?>">
							<h3 class="mt-[30px] hover:text-troove-purple-600"><?php echo $service_card_text_4_title; ?></h3>
						</a>
					</div>
					<div>
						<div class="items-center justify-center flex h-[133px] mx-auto rounded-full w-[133px] xl:h-[187px] xl:w-[187px] bg-troove-purple-600">
							<img class="w-[60%] xl:w-auto" src="<?php echo esc_url($service_card_image_5); ?>" alt="">
						</div>
						<a href="<?php echo esc_url($service_card_text_5_url); ?>">
							<h3 class="mt-[30px]"><?php echo $service_card_text_5_title; ?></h3>
						</a>
					</div>
				</div>

				<a href="<?php echo ($service_button_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
					<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo esc_html($hero_button_link_title); ?></span>
					<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover h-[10px] mt-[1px] w-[10px]" src="<?php echo get_template_directory_uri(); ?>/images/arrow-right-white.svg" alt="demo-icon">
				</a>

			</div>
		</section>

	<?php }
}
}
}
}


if (!function_exists('ea_acf_why_choose_us')) {
function ea_acf_why_choose_us()
{
if (function_exists('get_field')) {
// Get the current post/page ID
$post_id = get_the_ID();

$why_choose_us_section_fields = get_field('why_choose_us_section', $post_id);

if ($why_choose_us_section_fields) {
	$why_choose_us_title = $why_choose_us_section_fields['why_choose_us_title'];
	$allowed_tags = array(
		'br' => array(),
		'span' => array(),
	);
	$why_choose_us_title = wp_kses($why_choose_us_title, $allowed_tags);

	$why_choose_us_image_1 = $why_choose_us_section_fields['why_choose_us_image_1'];
	$why_choose_us_content_1 = $why_choose_us_section_fields['why_choose_us_content_1'];
	$why_choose_us_content_1 = str_replace('<h4>', '<h4 class="h2">', $why_choose_us_content_1);

	$why_choose_us_image_2 = $why_choose_us_section_fields['why_choose_us_image_2'];
	$why_choose_us_content_2 = $why_choose_us_section_fields['why_choose_us_content_2'];
	$why_choose_us_content_2 = str_replace('<h4>', '<h4 class="h2">', $why_choose_us_content_2);

	$why_choose_us_image_3 = $why_choose_us_section_fields['why_choose_us_image_3'];
	$why_choose_us_content_3 = $why_choose_us_section_fields['why_choose_us_content_3'];
	$why_choose_us_content_3 = str_replace('<h4>', '<h4 class="h2">', $why_choose_us_content_3);

	$why_choose_us_image_4 = $why_choose_us_section_fields['why_choose_us_image_4'];
	$why_choose_us_content_4 = $why_choose_us_section_fields['why_choose_us_content_4'];
	$why_choose_us_content_4 = str_replace('<h4>', '<h4 class="h2">', $why_choose_us_content_4);


	if (!empty($why_choose_us_section_fields)) { ?>

		<section class="bg-gradient-to-r from-troove-gradient-300 py-[60px] to-troove-purple-100 via-transparent">
			<div class="px-[20px] xl:container">
				<h2 class="text-center h1 mb-[45px]"><?php echo $why_choose_us_title; ?></h2>
				<div class="flex flex-col bm:gap-[20px] chooses gap-[50px]">
					<div class="choose-card">
						<div class="wrap-img"><img src="<?php echo esc_url($why_choose_us_image_1); ?>" alt=""></div>
						<div>
							<?php echo $why_choose_us_content_1; ?>
						</div>
					</div>
					<div class="choose-card">
						<div class="wrap-img"><img src="<?php echo esc_url($why_choose_us_image_2); ?>" alt=""></div>
						<div>
							<?php echo $why_choose_us_content_2; ?>
						</div>
					</div>
					<div class="choose-card">
						<div class="wrap-img"><img src="<?php echo esc_url($why_choose_us_image_3); ?>" alt=""></div>
						<div>
							<?php echo $why_choose_us_content_3; ?>
						</div>
					</div>
					<div class="choose-card">
						<div class="wrap-img"><img src="<?php echo esc_url($why_choose_us_image_4); ?>" alt=""></div>
						<div>
							<?php echo $why_choose_us_content_4; ?>
						</div>
					</div>
				</div>
		</section>

	<?php }
}
}
}
}


if (!function_exists('ea_acf_what_you_need')) {
function ea_acf_what_you_need()
{
if (function_exists('get_field')) {
// Get the current post/page ID
$post_id = get_the_ID();

$what_you_need_section_fields = get_field('what_you_need_section', $post_id);

if ($what_you_need_section_fields) {
	$what_you_need_title = $what_you_need_section_fields['what_you_need_title'];
	$what_you_need_title = str_replace(array('<p>', '</p>'), '', $what_you_need_title);

	$what_you_need_text = $what_you_need_section_fields['what_you_need_text'];

	$what_you_need_button_link = $what_you_need_section_fields['what_you_need_button_link'];;

	if ($what_you_need_button_link) :
		$what_you_need_button_link_url = $what_you_need_button_link['url'];
		$what_you_need_button_link_title = $what_you_need_button_link['title'];
	endif;

	if (!empty($what_you_need_section_fields)) { ?>

		<section class="bg-cover bg-no-repeat lg:bg-solution-bg lg:py-[75px] py-[65px] solutions">
			<div class="text-center xl:container px-[16px]">
				<h3 class="mx-auto h1"><?php echo $what_you_need_title; ?></h3>
				<div class="mx-auto max-w-[900px] lg:mb-[80px] lg:mt-[50px] mb-[50px] mt-[40px]">
					<?php echo $what_you_need_text; ?>
				</div>
				<a href="<?php echo ($what_you_need_button_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
					<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo esc_html($what_you_need_button_link_title); ?></span>
					<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
				</a>
			</div>
		</section>

	<?php }
}
}
}
}

if (!function_exists('ea_acf_testimonials')) {
function ea_acf_testimonials()
{
if (function_exists('get_field')) {
// Get the current post/page ID
$post_id = get_the_ID();

$testimonials_section_fields = get_field('testimonials_section', $post_id);

if ($testimonials_section_fields) {
	$testimonials_title = $testimonials_section_fields['testimonials_title'];
	$allowed_tags = array(
		'br' => array(),
		'span' => array(),
	);
	$testimonials_title = wp_kses($testimonials_title, $allowed_tags);

	$testimonials_link = $testimonials_section_fields['testimonials_link'];;

	if ($testimonials_link) :
		$testimonials_button_link_url = $testimonials_link['url'];
		$testimonials_button_link_title = $testimonials_link['title'];
	endif;

	$client_review_1_image = $testimonials_section_fields['client_review_1_image'];
	$client_review_1_title = $testimonials_section_fields['client_review_1_title'];
	$client_review_1_text = $testimonials_section_fields['client_review_1_text'];
	$client_review_1_text = str_replace(array('<br>'), '', $client_review_1_text);

	$client_review_2_image = $testimonials_section_fields['client_review_2_image'];
	$client_review_2_title = $testimonials_section_fields['client_review_2_title'];
	$client_review_2_text = $testimonials_section_fields['client_review_2_text'];
	$client_review_2_text = str_replace(array('<br>'), '', $client_review_2_text);

	$client_review_3_image = $testimonials_section_fields['client_review_3_image'];
	$client_review_3_title = $testimonials_section_fields['client_review_3_title'];
	$client_review_3_text = $testimonials_section_fields['client_review_3_text'];
	$client_review_3_text = str_replace(array('<br>'), '', $client_review_3_text);


	if (!empty($testimonials_section_fields)) { ?>
		<section class="pb-[50px] pt-[70px] bg-troove-white-300 lg:pb-[130px] lg:pt-[85px]">
			<div class="items-center flex flex-col 2xl:gap-[100px] bg-[top_right] bg-cover bg-no-repeat gap-[40px] lg:bg-globe-bg lg:flex-row px-[16px] xl:container">
				<div>
					<div class="text-center lg:text-left">
						<h3 class="text-troove-black-900 max-w-[650px] text-[30px] xl:text-[40px]">
							<?php echo $testimonials_title; ?>
						</h3>
						<a href="<?php echo esc_html($testimonials_button_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[35px]">
							<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo ($testimonials_button_link_title); ?></span>
							<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
						</a>
					</div>
					<div class="mt-[50px] lg:mt-[85px] testimonial-card without-border">
						<div class="wrap-img"><img src="<?php echo esc_url($client_review_1_image); ?>" alt=""></div>
						<div>
							<h4><?php echo $client_review_1_title; ?></h4>
							<p><?php echo wp_kses($client_review_1_text, array('span' => array())); ?></p>
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="testimonial-card with-border 2xl:ml-[40px] lg:mt-[70px]">
						<div class="wrap-img"><img src="<?php echo esc_url($client_review_2_image); ?>" alt=""></div>
						<div>
							<h4><?php echo $client_review_2_title; ?></h4>
							<p><?php echo wp_kses($client_review_2_text, array('span' => array())); ?></p>
						</div>
					</div>
					<div class="testimonial-card with-border lg:mt-[130px] mt-[40px]">
						<div class="wrap-img"><img src="<?php echo esc_url($client_review_3_image); ?>" alt=""></div>
						<div>
							<h4><?php echo $client_review_3_title; ?></h4>
							<p><?php echo wp_kses($client_review_3_text, array('span' => array())); ?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php }
}
}
}
}

if (!function_exists('ea_acf_testimonials_new')) {
	function ea_acf_testimonials_new()
	{
		if (function_exists('get_field')) {
		// Get the current post/page ID
		$post_id = get_the_ID();

		$testimonials_section_fields = get_field('testimonials_section', $post_id);

		if ($testimonials_section_fields) {
			$testimonials_title = $testimonials_section_fields['testimonials_title'];
			if (!empty($testimonials_title)) { ?>
				<section class="pb-[80px] bg-troove-pink-300 md:pb-[40px] pt-[65px]">
					<div class="mx-auto px-[16px] max-w-[1247px] pz-[16px]">
					<h3 class="text-center h2 leading-[1.2] max-w-[1150px] mb-[30px] md:mb-[60px] mx-auto">
						<?php echo $testimonials_title; ?>
					</h3>
					<div class="text-center md:hidden">
						<a href="" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
							<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]">Book a demo</span>
							<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri() ;?>/images/calender.svg" alt="demo-icon">
						</a>
					</div>
			<?php }
		}
	} ?>

	<?php if (have_rows('testimonial_block')) : ?>
		<?php while (have_rows('testimonial_block')) : the_row();
			$testimonial_block_item_image = get_sub_field('testimonial_block_image');
			$testimonial_block_item_text = get_sub_field('testimonial_block_text');
			$testimonial_block_item_author = get_sub_field('testimonial_block_author');
			$testimonial_block_item_role = get_sub_field('testimonial_block_role');
		?>
			<div class="bg-white md:mt-0 md:shadow-none mt-[40px] px-[35px] py-[35px] rounded-[34px] shadow-[15px_10px_10px_rgba(0,0,0,0.16)] sm:px-[65px]">
				<h4 class="hidden sm:block font-medium leading-[1.1] mb-[25px] md:font-proxima-nova md:text-[36px] text-[18px] text-center text-troove-black-900">
					<?php echo $testimonial_block_item_text; ?>
				</h4>
				<div class="items-center justify-center flex flex-col sm:flex-row gap-[25px]">
					<div class="max-w-[90px]">
						<div><img src="<?php echo esc_url($testimonial_block_item_image); ?>" alt=""></div>
					</div>
					<h4 class="text-center font-medium leading-[1.1] mb-[25px] md:font-proxima-nova md:text-[36px] text-[18px] text-troove-black-900 sm:hidden">
						<?php echo $testimonial_block_item_text; ?>
					</h4>
					<div class="text-center sm:text-left">
						<h6 class="text-[16px] leading-[1.87] sm:leading-2 sm:text-[15px]"><?php echo $testimonial_block_item_author; ?></h6>
						<div><?php echo $testimonial_block_item_role; ?></div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	</div>


	<?php if (have_rows('main_page_testimonials_client')) : ?>
		<div class="mt-[50px] px-[16px] sm:mt-[40px] xl:container xl:px-[16px] xs:px-[25px]">
			<div class="items-center justify-center flex flex-col sm:flex-row 2xl:gap-[50px] flex-wrap gap-x-[25px] gap-y-[45px] lg:flex-nowrap sm:gap-[25px] sm:gap-y-[35px] sm:items-stretch">
				<?php while (have_rows('main_page_testimonials_client')) : the_row();
				$main_page_testimonials_client_image = get_sub_field('testimonial_block_client_image');
				?>
				<div class="items-center justify-center flex lg:w-auto sm:w-[calc(100%/3-25px*3/2)] w-[calc(50%-25px/2)]">
					<img class="sm:w-[80%]" src="<?php echo esc_url($main_page_testimonials_client_image); ?>" alt="">
				</div>

				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>

</section>
<?php }
} ?>



<?php if (!function_exists('ea_acf_workflow')) {
	function ea_acf_workflow()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$workflow_section_fields = get_field('workflow_section', $post_id);

			if ($workflow_section_fields) {
				$webflow_title = $workflow_section_fields['webflow_title'];
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$webflow_title = wp_kses($webflow_title, $allowed_tags);

				$workflow_text = $workflow_section_fields['workflow_text'];
				$webflow_title = str_replace(array('<p>', '</p>'), '', $webflow_title);

				$workflow_image = $workflow_section_fields['workflow_image'];
				$workflow_mobile_image = $workflow_section_fields['workflow_mobile_image'];


				$workflow_link = $workflow_section_fields['workflow_link'];

				if ($workflow_link) :
					$workflow_button_link_url = $workflow_link['url'];
					$workflow_button_link_title = $workflow_link['title'];
				endif;

				if (!empty($workflow_section_fields)) { ?>
					<section class="lg:py-[80px] py-[50px]">
						<div class="text-center xl:container px-[20px]">
							<h3 class="h1"><?php echo $webflow_title; ?></h3>
							<div class="mx-auto max-w-[900px] mt-[50px]">
								<p class="text-troove-black-900 leading-[1.2] lg:text-[20px] text-[18px]">
									<?php echo $workflow_text; ?>
								</p>
							</div>
						</div>
						<div class="mb-[50px] lg:mb-[70px] lg:mt-[100px] mt-[70px]">
							<img class="w-full object-cover min-h-[400px] sm:hidden" src="<?php echo esc_url($workflow_mobile_image); ?>" alt="">
							<img class="hidden w-full sm:block" src="<?php echo esc_url($workflow_image); ?>" alt="">
						</div>
						<div class="text-center xl:container px-[20px]">
							<a href="<?php echo esc_html($workflow_button_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
								<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo ($workflow_button_link_title); ?></span>
								<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
							</a>
						</div>
					</section>

				<?php }
			}
		}
	}
}




if (!function_exists('ea_acf_ready_to')) {
	function ea_acf_ready_to()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$ready_to_section_fields = get_field('ready_to_section', $post_id);

			if ($ready_to_section_fields) {
				$ready_to_title = $ready_to_section_fields['ready_to_title'];
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$ready_to_title = wp_kses($ready_to_title, $allowed_tags);
				$ready_to_text = $ready_to_section_fields['ready_to_text'];


				$ready_to_link = $ready_to_section_fields['ready_to_link'];

				if ($ready_to_link) :
					$ready_button_link_url = $ready_to_link['url'];
					$ready_button_link_title = $ready_to_link['title'];
				endif;

				if (!empty($ready_to_section_fields)) { ?>

					<section class="lg:pb-[120px] pb-[80px]">
						<div class="text-center xl:container px-[16px]">

							<div class="bg-cover bg-no-repeat bg-troove-pink-300 bg-troove-white-300 bg-workday-bg lg:py-[110px] lg:rounded-[81px] pb-[40px] pt-[50px] px-[20px] rounded-[30px]">
								<h3 class="mx-auto h1 max-w-[700px] mb-[20px]"><?php echo $ready_to_title; ?></h3>
								<p class="mx-auto leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900 max-w-[1040px]">
									<?php echo $ready_to_text; ?>
								</p>
								<a href="<?php echo ($ready_button_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[40px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo esc_html($ready_button_link_title); ?></span>
									<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}


/* Planner modules */
if (!function_exists('ea_acf_planner_hero_section')) {
	function ea_acf_planner_hero_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$planner_hero_section_fields = get_field('planner_hero_section', $post_id);

			if ($planner_hero_section_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$planner_hero_title = $planner_hero_section_fields['planner_hero_title'];
				$planner_hero_title = wp_kses($planner_hero_title, $allowed_tags);

				$planner_hero_text = $planner_hero_section_fields['planner_hero_text'];
				$planner_hero_link = $planner_hero_section_fields['planner_hero_link'];
				$planner_hero_image = $planner_hero_section_fields['planner_hero_image'];

				if ($planner_hero_link) :
					$planner_hero_link_url = $planner_hero_link['url'];
					$planner_hero_link_title = $planner_hero_link['title'];
				endif;

				if (!empty($planner_hero_section_fields)) { ?>

					<section class="relative mt-[50px] xl:mt-[40px]">
						<div class="hidden absolute bottom-0 left-0 right-0 top-0 bg-contain bg-no-repeat xl:block" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/other-hero-bg.svg); background-position: center;"></div>
						<div class="flex justify-center px-[16px] xl:container gap-5 xl:justify-between flex items-center">
							<div class="text-center max-w-[700px] xl:text-left">
								<h1 class="xl:mb-[20px] mb-[50px]"><?php echo $planner_hero_title; ?></h1>
								<?php echo $planner_hero_text; ?>
								<a href="<?php echo ($planner_hero_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[35px] xl:mt-[35px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo esc_html($planner_hero_link_title); ?></span>
									<img class="hidden lg:block object-cover w-[14px] lg:duration-200 lg:ease-in lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:opacity-100 lg:group-hover:transition lg:opacity-0 lg:transition" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
							<div class="hidden xl:block max-w-[50%]"><img src="<?php echo esc_url($planner_hero_image); ?>" alt=""></div>
						</div>
					</section>

				<?php }
			}
		}
	}
}


if (!function_exists('ea_acf_planner_to_do_section')) {
	function ea_acf_planner_to_do_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$planner_to_do_section_fields = get_field('planner_to_do_section', $post_id);

			if ($planner_to_do_section_fields) {

				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$planner_to_do_title = $planner_to_do_section_fields['planner_to_do_title'];
				$planner_to_do_title = wp_kses($planner_to_do_title, $allowed_tags);

				$planner_to_do_content = $planner_to_do_section_fields['planner_to_do_content'];
				$planner_to_do_image = $planner_to_do_section_fields['planner_to_do_image'];;
				$planner_to_do_image_mobile = $planner_to_do_section_fields['planner_to_do_image_mobile'];;


				if (!empty($planner_to_do_section_fields)) { ?>

					<section class="text-center lg:py-[100px] lg:text-left pt-[100px]">
						<div class="flex justify-center px-[16px] xl:container 2xl:gap-[100px] flex-col-reverse gap-[25px] lg:gap-[10px] xl:gap-[30px] flex-normal">
							<div class="xl:max-w-[50%] lg:max-w-[45%] relative flex items-center">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-1-mobile-bg.png" alt="" class="top-0 absolute bottom-0 left-0 right-0 -z-10 sm:hidden">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-1-bg.png" alt="bg-desktop" class="hidden sm:block -z-10 absolute bottom-0 left-0 right-0 top-0">

								<img src="<?php echo esc_url($planner_to_do_image_mobile); ?>" alt="" class="sm:hidden">
								<img src="<?php echo esc_url($planner_to_do_image); ?>" alt="" class="hidden sm:block">
							</div>
							<div class="xl:max-w-[50%] lg:max-w-[55%]">
								<h3 class="font-semibold h2"><?php echo $planner_to_do_title; ?></h3>
								<div class="mt-[30px] lg:max-w-[490px] planner-text">
									<?php echo $planner_to_do_content; ?>
								</div>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}



if (!function_exists('ea_acf_planner_my_list_section')) {
	function ea_acf_planner_my_list_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$planner_my_list_section_fields = get_field('planner_my_list_section', $post_id);

			if ($planner_my_list_section_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$planner_my_list_title = $planner_my_list_section_fields['planner_my_list_title'];
				$planner_my_list_title = wp_kses($planner_my_list_title, $allowed_tags);

				$planner_my_list_content = $planner_my_list_section_fields['planner_my_list_content'];
				$planner_my_list_image = $planner_my_list_section_fields['planner_my_list_image'];;
				$planner_my_list_image_mobile = $planner_my_list_section_fields['planner_my_list_image_mobile'];;


				if (!empty($planner_my_list_section_fields)) { ?>

					<section class="text-center lg:py-[100px] lg:text-left pt-[100px]">
						<div class="flex justify-center px-[16px] xl:container 2xl:gap-[100px] flex-col-reverse gap-[25px] lg:gap-[10px] xl:gap-[30px] flex-reverce">
							<div class="xl:max-w-[50%] lg:max-w-[45%] relative flex items-center">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-2-mobile-bg.png" alt="" class="top-0 absolute bottom-0 left-0 right-0 -z-10 sm:hidden">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-2-bg.png" alt="bg-desktop" class="hidden sm:block -z-10 absolute bottom-0 left-0 right-0 top-0">

								<img src="<?php echo esc_url($planner_my_list_image_mobile); ?>" alt="" class="sm:hidden">
								<img src="<?php echo esc_url($planner_my_list_image); ?>" alt="" class="hidden sm:block">
							</div>
							<div class="xl:max-w-[50%] lg:max-w-[55%]">
								<h3 class="font-semibold h2"><?php echo $planner_my_list_title; ?></h3>
								<div class="mt-[30px] lg:max-w-[490px] planner-text"><?php echo $planner_my_list_content; ?></div>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}



if (!function_exists('ea_acf_planner_meeting_management_section')) {
	function ea_acf_planner_meeting_management_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$planner_meeting_management_section_fields = get_field('planner_meeting_management_section', $post_id);

			if ($planner_meeting_management_section_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$planner_meeting_management_title = $planner_meeting_management_section_fields['planner_meeting_management_title'];
				$planner_meeting_management_title = wp_kses($planner_meeting_management_title, $allowed_tags);

				$planner_meeting_management_content = $planner_meeting_management_section_fields['planner_meeting_management_content'];
				$planner_meeting_management_image = $planner_meeting_management_section_fields['planner_meeting_management_image'];;
				$planner_meeting_management_image_mobile = $planner_meeting_management_section_fields['planner_meeting_management_image_mobile'];;


				if (!empty($planner_meeting_management_section_fields)) { ?>

					<section class="text-center lg:py-[100px] lg:text-left pt-[100px]">
						<div class="flex justify-center px-[16px] xl:container 2xl:gap-[100px] flex-col-reverse gap-[25px] lg:gap-[10px] xl:gap-[30px] flex-normal">
							<div class="xl:max-w-[50%] lg:max-w-[45%] relative flex items-center">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-3-bg.png" alt="" class="top-0 absolute bottom-0 left-0 right-0 -z-10 sm:hidden">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-3-bg.png" alt="bg-desktop" class="hidden sm:block -z-10 absolute bottom-0 left-0 right-0 top-0">

								<img src="<?php echo esc_url($planner_meeting_management_image); ?>" alt="" class="sm:hidden">
								<img src="<?php echo esc_url($planner_meeting_management_image_mobile); ?>" alt="" class="hidden sm:block">
							</div>
							<div class="xl:max-w-[50%] lg:max-w-[55%]">
								<h3 class="font-semibold h2"><?php echo $planner_meeting_management_title; ?></h3>
								<div class="mt-[30px] lg:max-w-[490px] planner-text">
									<?php echo $planner_meeting_management_content; ?>
								</div>
							</div>
						</div>
					</section>


				<?php }
			}
		}
	}
}



if (!function_exists('ea_acf_planner_inbox_section')) {
	function ea_acf_planner_inbox_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$planner_inbox_section_fields = get_field('planner_inbox_section', $post_id);

			if ($planner_inbox_section_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$planner_inbox_title = $planner_inbox_section_fields['planner_inbox_title'];
				$planner_inbox_title = wp_kses($planner_inbox_title, $allowed_tags);

				$planner_inbox_content = $planner_inbox_section_fields['planner_inbox_content'];
				$planner_inbox_image = $planner_inbox_section_fields['planner_inbox_image'];;
				$planner_inbox_mobile = $planner_inbox_section_fields['planner_inbox_mobile'];;


				if (!empty($planner_inbox_section_fields)) { ?>

					<section class="text-center lg:py-[100px] lg:text-left pt-[100px]">
						<div class="flex justify-center px-[16px] xl:container 2xl:gap-[100px] flex-col-reverse gap-[25px] lg:gap-[10px] xl:gap-[30px] flex-reverce">
							<div class="xl:max-w-[50%] lg:max-w-[45%] relative flex items-center">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-4-mobile-bg.png" alt="" class="top-0 absolute bottom-0 left-0 right-0 -z-10 sm:hidden">
								<img src="<?php echo get_template_directory_uri(); ?>/images/planner-4-bg.png" alt="bg-desktop" class="hidden sm:block -z-10 absolute bottom-0 left-0 right-0 top-0">

								<img src="<?php echo esc_url($planner_inbox_mobile); ?>" alt="" class="sm:hidden">
								<img src="<?php echo esc_url($planner_inbox_image); ?>" alt="" class="hidden sm:block">
							</div>
							<div class="xl:max-w-[50%] lg:max-w-[55%]">
								<h3 class="font-semibold h2"><?php echo $planner_inbox_title; ?></h3>
								<div class="mt-[30px] lg:max-w-[490px] planner-text">
									<?php echo $planner_inbox_content; ?>
								</div>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}



if (!function_exists('ea_acf_planner_call_to_action')) {
	function ea_acf_planner_call_to_action()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$planner_call_to_action_fields = get_field('planner_call_to_action', $post_id);

			if ($planner_call_to_action_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$planner_call_to_action_title = $planner_call_to_action_fields['planner_call_to_action_title'];
				$planner_call_to_action_title = wp_kses($planner_call_to_action_title, $allowed_tags);

				$planner_call_to_action_content = $planner_call_to_action_fields['planner_call_to_action_content'];
				$planner_call_to_action_content = str_replace('<p>', '<p class="leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900">', $planner_call_to_action_content);

				$planner_call_to_action_link = $planner_call_to_action_fields['planner_call_to_action_link'];;

				if ($planner_call_to_action_link) :
					$planner_call_to_action_link_url = $planner_call_to_action_link['url'];
					$planner_call_to_action_link_title = $planner_call_to_action_link['title'];
				endif;

				if (!empty($planner_call_to_action_fields)) { ?>

					<section class="lg:pb-[120px] pb-[80px]">
						<div class="text-center px-[16px] xl:container">
							<div class="bg-cover bg-no-repeat bg-troove-pink-300 bg-troove-white-300 bg-workday-bg lg:py-[110px] lg:rounded-[81px] pb-[40px] pt-[50px] px-[20px] rounded-[30px]">

								<h3 class="h1 mb-[20px]"><?php echo $planner_call_to_action_title; ?></h3>
								<?php echo $planner_call_to_action_content; ?>

								<a href="<?php echo ($planner_call_to_action_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[40px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $planner_call_to_action_link_title; ?></span>
									<img class="hidden lg:block object-cover w-[14px] lg:duration-200 lg:ease-in lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:opacity-100 lg:group-hover:transition lg:opacity-0 lg:transition" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}

/* BLog module */

if (!function_exists('ea_acf_blog_module')) {
	function ea_acf_blog_module()
	{
		if (function_exists('get_field')) {
			$blog_and_article_module_fields = get_field('blog_and_article_module');

			if ($blog_and_article_module_fields) {
				$blog_module_title = $blog_and_article_module_fields['blog_module_title'];
				$allowed_blog_module_title_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$blog_module_title = wp_kses($blog_module_title, $allowed_blog_module_title_tags);

				$blog_module_text = $blog_and_article_module_fields['blog_module_text'];;
				$blog_module_link = $blog_and_article_module_fields['blog_module_link'];

				if ($blog_module_link) :
					$blog_module_link_url = $blog_module_link['url'];
					$blog_module_link_title = $blog_module_link['title'];
				endif;

				if (!empty($blog_and_article_module_fields)) { ?>
					<section class="lg:pb-[120px] pb-[80px]">
						<div class="text-center px-[16px] xl:container">
							<div class="bg-troove-pink-300 bg-cover bg-no-repeat bg-troove-white-300 bg-workday-bg lg:py-[110px] lg:rounded-[81px] pb-[40px] pt-[50px] px-[20px] rounded-[30px]">
								<h3 class="h1 mb-[20px]"><?php echo $blog_module_title; ?></h3>
								<p class="leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900"><?php echo $blog_module_text; ?></p>
								<a href="<?php echo ($blog_module_link_url); ?>" class="items-center gap-[5px] group justify-center lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition btn btn-primary btn-primary-hover inline-flex mt-[40px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $blog_module_link_title; ?></span>
									<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}



if (!function_exists('ea_acf_blog_posts_module')) {
	function ea_acf_blog_posts_module()
	{
		if (function_exists('get_field')) {
			$blog_and_article_module_fields = get_field('blog_and_article_module', 8);
			//var_dump($blog_and_article_module_fields);
			if ($blog_and_article_module_fields) {
				$blog_module_title = $blog_and_article_module_fields['blog_module_title'];
				$allowed_blog_module_title_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$blog_module_title = wp_kses($blog_module_title, $allowed_blog_module_title_tags);

				$blog_module_text = $blog_and_article_module_fields['blog_module_text'];;
				$blog_module_link = $blog_and_article_module_fields['blog_module_link'];

				if ($blog_module_link) :
					$blog_module_link_url = $blog_module_link['url'];
					$blog_module_link_title = $blog_module_link['title'];
				endif;

				if (!empty($blog_and_article_module_fields)) { ?>
					<section class="lg:pb-[120px] pb-[80px]">
						<div class="text-center px-[16px] xl:container">
							<div class="bg-troove-pink-300 bg-cover bg-no-repeat bg-troove-white-300 bg-workday-bg lg:py-[110px] lg:rounded-[81px] pb-[40px] pt-[50px] px-[20px] rounded-[30px]">
								<h3 class="h1 mb-[20px]"><?php echo $blog_module_title; ?></h3>
								<p class="leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900"><?php echo $blog_module_text; ?></p>
								<a href="<?php echo ($blog_module_link_url); ?>" class="items-center gap-[5px] group justify-center lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition btn btn-primary btn-primary-hover inline-flex mt-[40px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $blog_module_link_title; ?></span>
									<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
						</div>
					</section>

				<?php }
			}
		}
	}
}



/* Features Blocks */

if (!function_exists('ea_acf_features_cta_blocks')) {
	function ea_acf_features_cta_blocks()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$ea_acf_features_cta_fields = get_field('features_cta', $post_id);

			if ($ea_acf_features_cta_fields) {
				$features_cta_title = $ea_acf_features_cta_fields['features_cta_text'];
				$allowed_tags = array(
					'span' => array(),
					'br' => array(),
				);
				$features_cta_title = wp_kses($features_cta_title, $allowed_tags);

				$features_cta_text = $ea_acf_features_cta_fields['features_text'];
				$features_cta_text = str_replace('<p>', '<p class="mx-auto font-title lg:text-[20px] max-w-[810px] text-[18px]">', $features_cta_text);

				$features_cta_link = $ea_acf_features_cta_fields['features_cta_link'];

				if ($features_cta_link) :
					$features_cta_link_url = $features_cta_link['url'];
					$features_cta_link_title = $features_cta_link['title'];
				endif;

				if (!empty($ea_acf_features_cta_fields)) { ?>
					<section class="text-center bg-[center_center] bg-contain bg-no-repeat py-[60px] xl:bg-hero-bg">
						<div class="xl:container px-[25px]">
							<h2 class="mx-auto h1 max-w-[1200px] mb-[50px]"><?php echo $features_cta_title; ?></h2>
							<p class="mx-auto font-title lg:text-[20px] max-w-[810px] text-[18px]">
								<?php echo $features_cta_text; ?>
							</p>
							<a href="<?php echo $features_cta_link_url; ?>" class="items-center justify-center btn inline-flex btn-primary btn-primary-hover gap-[5px] group lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition mt-[50px]">
								<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $features_cta_link_title; ?></span>
								<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
							</a>
						</div>
					</section>
				<?php }
			}
		}
	}
}


if (!function_exists('ea_acf_features_info')) {
	function ea_acf_features_info()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$ea_acf_features_info_fields = get_field('features_info', $post_id);

			if ($ea_acf_features_info_fields) {
				$features_info_title = $ea_acf_features_info_fields['features_info_title'];
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$features_info_title = wp_kses($features_info_title, $allowed_tags);

				$features_info_text = $ea_acf_features_info_fields['features_info_text'];
				$features_info_link = $ea_acf_features_info_fields['features_info_link'];
				$features_info_image = $ea_acf_features_info_fields['features_info_image'];
				$features_mobile_info_image = $ea_acf_features_info_fields['features_mobile_info_image'];

				if ($features_info_link) :
					$features_info_link_url = $features_info_link['url'];
					$features_info_link_title = $features_info_link['title'];
				endif;

				if (!empty($ea_acf_features_info_fields)) { ?>

					<section class="py-[50px] lg:py-[80px] potential">
						<div class="xl:container text-center px-[20px]">
							<h3 class="h1"><?php echo $features_info_title; ?></h3>
							<div class="mx-auto font-medium max-w-[900px] mt-[50px]">
								<?php echo $features_info_text; ?>
							</div>
						</div>
						<div class="xl:container text-center px-[20px] mt-[50px]">
							<a href="<?php echo $features_info_link_url; ?>" class="items-center justify-center btn inline-flex btn-primary btn-primary-hover gap-[5px] group lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition">
								<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $features_info_link_title; ?></span>
								<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
							</a>
						</div>
						<div class="mb-[50px] lg:mb-[70px] lg:mt-[100px] mt-[70px]">
							<img class="object-cover w-full min-h-[400px] sm:hidden" src="<?php echo $features_mobile_info_image; ?>" alt="">
							<img class="w-full hidden sm:block" src="<?php echo $features_info_image; ?>" alt="">
						</div>
					</section>
		<?php }
			}
		}
	}
}


if (!function_exists('ea_acf_features_tabs_blocks_tabs')) {
	function ea_acf_features_tabs_blocks_tabs()
	{ ?>

		<section class="py-[30px] xl:py-[40px]">
			<div class="xl:container px-[25px] 2xl:px-0 md:px-[30px]">
				<div class="flex justify-center flex-wrap gap-[20px] tabs-nav">
					<?php if (have_rows('features_tab')) : $tabCount = 1; ?>
						<?php while (have_rows('features_tab')) : the_row();
							$features_tab_title = get_sub_field('features_tab_title');
							$features_title = get_sub_field('features_title');

							$features_content = get_sub_field('features_content');
							$allowed_content = array(
								'span'     => array(),
								'strong'      => array(),
								'p' => array(),
							);
							$features_content = wp_kses($features_content, $allowed_content);
							$features_tab_image = get_sub_field('featured_tab_image');

							$features_tab_link = get_sub_field('features_tab_link');
							if ($features_tab_link) :
								$features_tab_link_url = $features_tab_link['url'];
								$features_tab_link_title = $features_tab_link['title'];
							endif;

							$features_tab_link = '#tab-' . $tabCount;
						?>


							<a href="<?php echo $features_tab_link; ?>" class="<?php echo ($tabCount === 1) ? 'active' : ''; ?> items-center flex-col btn btn-secondary btn-secondary-hover inline-flex justify-center min-h-[58px] tab-link"><?php echo $features_tab_title; ?></a>

							<?php $tabCount++; ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>


		<section class="bg-tabs-gradient pb-[70px] pt-[60px]">
			<div class="xl:container px-[25px] 2xl:px-0 md:px-[30px] tabs-content">
				<?php if (have_rows('features_tab')) : $mytabCount = 1; ?>
					<?php while (have_rows('features_tab')) : the_row();
						$features_tab_title = get_sub_field('features_tab_title');
						$features_title = get_sub_field('features_title');

						$features_content = get_sub_field('features_content');
						$allowed_content = array(
							'span'     => array(),
							'strong'      => array(),
							'p' => array(),
						);
						$features_content = wp_kses($features_content, $allowed_content);
						$features_tab_image = get_sub_field('featured_tab_image');

						$features_tab_link = get_sub_field('features_tab_link');
						if ($features_tab_link) :
							$features_tab_link_url = $features_tab_link['url'];
							$features_tab_link_title = $features_tab_link['title'];
						endif;

						$features_tab_link = 'tab-' . $mytabCount;
					?>
						<div class="tab <?php echo ($mytabCount === 1) ? 'active' : ''; ?>" id="<?php echo $features_tab_link; ?>">
							<div class="flex flex-col items-center bm:justify-between gap-[60px] xl:flex-row xl:ga-[30px] xl:gap-[10px] xl:items-start">
								<div class="flex grow-1 max-w-[640px] shrink-0 w-full">
									<img class="object-cover rounded-[34px]" src="<?php echo $features_tab_image; ?>" alt="">
								</div>
								<div class="flex flex-col bg-white border border-solid border-troove-white lg:px-[50px] lg:py-[60px] max-w-[775px] md:px-[40px] md:py-[50px] px-[36px] py-[44px] rounded-[34px] shadow-tab-content">
									<div class="h2"><?php echo $features_title; ?></div>
									<?php echo $features_content; ?>
									<a href="<?php echo $features_tab_link_url; ?>"><?php echo $features_tab_link_title; ?></a>
								</div>
							</div>
						</div>
						<?php $mytabCount++; ?>
					<?php endwhile; ?>
				<?php endif; ?>

			</div>
		</section>
<?php }
} ?>


<?php if (!function_exists('ea_acf_features_faq')) {
	function ea_acf_features_faq()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$features_faq_info_fields = get_field('features_faq_info', $post_id);

			if ($features_faq_info_fields) {
				$features_faq_title_main = $features_faq_info_fields['features_faq_title_main'];
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$features_faq_title_main = wp_kses($features_faq_title_main, $allowed_tags);

				$features_faq_link = $features_faq_info_fields['features_faq_link'];

				if ($features_faq_link) :
					$features_info_link_url = $features_faq_link['url'];
					$features_info_link_title = $features_faq_link['title'];
				endif;
			}
		} ?>

		<section class="py-[50px] bg-troove-purple-150 lg:py-[100px]">
			<div class="xl:container px-[16px] xl:px-[16px] xs:px-[25px] 2xl:gap-[150px] gap-[50px] xl:flex">
				<div class="xl:max-w-[350px]">
					<h3 class="text-center 2xl:leading-[1.52] 2xl:text-[60px] leading-[1.33] lg:text-[42px] pb-[50px] text-[24px] xl:pb-0 xl:text-left"><?php echo $features_faq_title_main; ?></h3>
				</div>
				<div class="flex flex-col accordion-wrap gap-[20px] one w-full">
					<?php if (have_rows('features_faq')) : ?>
						<?php while (have_rows('features_faq')) : the_row();
							$features_faq_title = get_sub_field('features_faq_title');
							$features_faq_text = get_sub_field('features_faq_text');
							$allowed_tags = array(
								'br' => array(),
								'p' => array(),
								'h6' => array(),
								'strong' => array(),
							);

							$features_faq_text = wp_kses($features_faq_text, $allowed_tags);
						?>
							<div class="block__item">
								<div class="block__title">
									<?php echo $features_faq_title; ?>
								</div>
								<div class="block__text">
									<?php echo $features_faq_text; ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="xl:container px-[16px] xl:px-[16px] xs:px-[25px] text-center">
				<a href="<?php echo $features_info_link_url; ?>" class="items-center justify-center btn inline-flex btn-primary btn-primary-hover gap-[5px] group lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition mt-[35px] xl:mt-[70px]">
					<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $features_info_link_title; ?></span>
					<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
				</a>
			</div>
		</section>

		<?php }
}


/* Pricing page */
if (!function_exists('ea_acf_pricing_info')) {
	function ea_acf_pricing_info()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$pricing_info_section_fields = get_field('pricing_info_section', $post_id);

			if ($pricing_info_section_fields) {
				$pricing_info_title = $pricing_info_section_fields['pricing_info_title'];
				$allowed_pricing_info_title_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$pricing_info_title = wp_kses($pricing_info_title, $allowed_pricing_info_title_tags);

				$pricing_info_text = $pricing_info_section_fields['pricing_info_text'];
				$pricing_info_text = str_replace('<p>', '<p class="font-title font-medium leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900">', $pricing_info_text);

				if (!empty($pricing_info_section_fields)) { ?>

					<div class="text-center">
						<h2 class="h1 lg:pb-[40px] pb-[30px]"><?php echo $pricing_info_title; ?></h2>
						<p class="font-title font-medium leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900">
							<?php echo $pricing_info_text; ?>
						</p>
					</div>

		<?php }
			}
		} ?>


		<?php }
}


if (!function_exists('ea_acf_pricing_small_client')) {
	function ea_acf_pricing_small_client()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$small_business_card_fields = get_field('small_business_card', $post_id);

			if ($small_business_card_fields) {
				$client_small_business_card_client = $small_business_card_fields['clientsmall_business_card_client'];
				$small_business_count_employees = $small_business_card_fields['small_business_count_employees'];
				$small_business_price_cost = $small_business_card_fields['small_business_price_cost'];
				$small_business_period = $small_business_card_fields['small_business_period'];
				$small_business_price_annually = $small_business_card_fields['small_business_price_annually'];
				$small_business_period = $small_business_card_fields['small_business_period'];
				$small_business_discount = $small_business_card_fields['small_business_discount'];

				$small_business_link = $small_business_card_fields['small_business_link'];
				if ($small_business_link) :
					$small_business_link_url = $small_business_link['url'];
					$small_business_link_title = $small_business_link['title'];
				endif;

				$small_business_user_seats = $small_business_card_fields['small_business_user_seats'];
				$allowed_small_business_user_seats_tags = array(
					'strong' => array(),
				);
				$small_business_user_seats = wp_kses($small_business_user_seats, $allowed_small_business_user_seats_tags);

				$small_business_description =  $small_business_card_fields['small_business_description'];
				$allowed_small_business_description_tags = array(
					'h6' => array(),
					'ul' => array(),
					'li' => array(),
				);
				$small_business_description = wp_kses($small_business_description, $allowed_small_business_description_tags);


				if (!empty($small_business_card_fields)) { ?>
					<div class="price-card small-business">
						<div class="font-title mb-[25px] min-h-[360px]">
							<div class="claent"><?php echo $client_small_business_card_client; ?></div>
							<div class="count-employees"><?php echo $small_business_count_employees; ?></div>
							<div class="price-cost"><?php echo $small_business_price_cost; ?></div>
							<div class="period"><?php echo $small_business_period; ?></div>
							<div class="price-annually"><?php echo $small_business_price_annually; ?></div>
							<div class="period"><?php echo $small_business_period; ?></div>
							<p class="discount"><?php echo $small_business_discount; ?></p>
						</div>

						<a href="<?php echo $small_business_link_url; ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
							<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $small_business_link_title; ?></span>
							<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
						</a>

						<div class="font-title font-medium 2xl:text-[20px] mt-[30px] text-16px text-troove-gray-500">
							<p class="seats"><?php echo $small_business_user_seats; ?></p>
							<?php echo $small_business_description; ?>
						</div>
					</div>
		<?php }
			}
		} ?>


		<?php }
}



if (!function_exists('ea_acf_pricing_midsize_client')) {
	function ea_acf_pricing_midsize_client()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$midsize_business_card_fields = get_field('midsize_business_card', $post_id);

			if ($midsize_business_card_fields) {
				$client_midsize_business_card_client = $midsize_business_card_fields['midsize_business_client_title'];
				$midsize_business_count_employees = $midsize_business_card_fields['midsize_business_count_employees'];
				$midsize_business_price_cost = $midsize_business_card_fields['midsize_business_price_cost'];
				$midsize_business_period = $midsize_business_card_fields['midsize_business_period'];
				$midsize_business_price_annually = $midsize_business_card_fields['midsize_business_price_annually'];
				$midsize_business_period = $midsize_business_card_fields['midsize_business_period'];
				$midsize_business_discount = $midsize_business_card_fields['midsize_business_discount'];

				$midsize_business_link = $midsize_business_card_fields['midsize_business_link'];
				if ($midsize_business_link) :
					$midsize_business_link_url = $midsize_business_link['url'];
					$midsize_business_link_title = $midsize_business_link['title'];
				endif;

				$midsize_business_user_seats = $midsize_business_card_fields['midsize_business_user_seats'];
				$allowed_midsize_business_user_seats_tags = array(
					'strong' => array(),
				);
				$midsize_business_user_seats = wp_kses($midsize_business_user_seats, $allowed_midsize_business_user_seats_tags);

				$midsize_business_description =  $midsize_business_card_fields['midsize_business_description'];
				$allowed_midsize_business_description_tags = array(
					'h6' => array(),
					'ul' => array(),
					'li' => array(),
				);
				$midsize_business_description = wp_kses($midsize_business_description, $allowed_midsize_business_description_tags);


				if (!empty($midsize_business_card_fields)) { ?>
					<div class="price-card midsize-business">
						<div class="font-title mb-[25px] min-h-[360px]">
							<div class="claent"><?php echo $client_midsize_business_card_client; ?></div>
							<div class="count-employees"><?php echo $midsize_business_count_employees; ?></div>
							<div class="price-cost"><?php echo $midsize_business_price_cost; ?></div>
							<div class="period"><?php echo $midsize_business_period; ?></div>
							<div class="price-annually"><?php echo $midsize_business_price_annually; ?></div>
							<div class="period"><?php echo $midsize_business_period; ?></div>
							<p class="discount"><?php echo $midsize_business_discount; ?></p>
						</div>

						<a href="<?php echo $midsize_business_link_url; ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
							<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $midsize_business_link_title; ?></span>
							<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
						</a>

						<div class="font-title font-medium 2xl:text-[20px] mt-[30px] text-16px text-troove-gray-500">
							<p class="seats"><?php echo $midsize_business_user_seats; ?></p>
							<?php echo $midsize_business_description; ?>
						</div>
					</div>
		<?php }
			}
		} ?>


		<?php }
}


if (!function_exists('ea_acf_pricing_enterprise_client')) {
	function ea_acf_pricing_enterprise_client()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$enterprise_business_card_fields = get_field('enterprise_business_card', $post_id);

			if ($enterprise_business_card_fields) {
				$client_enterprise_business_card_client = $enterprise_business_card_fields['enterprise_business_client_title'];
				$enterprise_business_count_employees = $enterprise_business_card_fields['enterprise_business_count_employees'];
				$enterprise_business_price_cost = $enterprise_business_card_fields['enterprise_business_price_cost'];
				$enterprise_business_period = $enterprise_business_card_fields['enterprise_business_period'];
				$enterprise_business_price_annually = $enterprise_business_card_fields['enterprise_business_price_annually'];
				$enterprise_business_period = $enterprise_business_card_fields['enterprise_business_period'];
				$enterprise_business_discount = $enterprise_business_card_fields['enterprise_business_discount'];

				$enterprise_business_link = $enterprise_business_card_fields['enterprise_business_link'];
				if ($enterprise_business_link) :
					$enterprise_business_link_url = $enterprise_business_link['url'];
					$enterprise_business_link_title = $enterprise_business_link['title'];
				endif;

				$enterprise_business_user_seats = $enterprise_business_card_fields['enterprise_business_user_seats'];
				$allowed_enterprise_business_user_seats_tags = array(
					'strong' => array(),
				);
				$enterprise_business_user_seats = wp_kses($enterprise_business_user_seats, $allowed_enterprise_business_user_seats_tags);

				$enterprise_business_description =  $enterprise_business_card_fields['enterprise_business_description'];
				$allowed_enterprise_business_description_tags = array(
					'h6' => array(),
					'ul' => array(),
					'li' => array(),
				);
				$enterprise_business_description = wp_kses($enterprise_business_description, $allowed_enterprise_business_description_tags);


				if (!empty($enterprise_business_card_fields)) { ?>
					<div class="price-card enterprise">
						<div class="font-title mb-[25px] min-h-[360px]">
							<div class="claent"><?php echo $client_enterprise_business_card_client; ?></div>
							<div class="count-employees"><?php echo $enterprise_business_count_employees; ?></div>
							<div class="price-cost"><?php echo $enterprise_business_price_cost; ?></div>
							<div class="period"><?php echo $enterprise_business_period; ?></div>
							<div class="price-annually"><?php echo $enterprise_business_price_annually; ?></div>
							<div class="period"><?php echo $enterprise_business_period; ?></div>
							<p class="discount"><?php echo $enterprise_business_discount; ?></p>
						</div>

						<a href="<?php echo $enterprise_business_link_url; ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex">
							<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $enterprise_business_link_title; ?></span>
							<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
						</a>

						<div class="font-title font-medium 2xl:text-[20px] mt-[30px] text-16px text-troove-gray-500">
							<p class="seats"><?php echo $enterprise_business_user_seats; ?></p>
							<?php echo $enterprise_business_description; ?>
						</div>
					</div>
		<?php }
			}
		} ?>


	<?php }
}



if (!function_exists('ea_acf_pricing_reviews_section')) {
	function ea_acf_pricing_reviews_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$pricing_client_review_title_section_fields = get_field('pricing_client_review_title_section', $post_id);

			if ($pricing_client_review_title_section_fields) {
				$pricing_client_review_title = $pricing_client_review_title_section_fields['pricing_client_review_title'];
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$pricing_client_review_title = wp_kses($pricing_client_review_title, $allowed_tags);
			}
		} ?>

		<section class="pb-[80px] bg-troove-pink-300 md:pb-[40px] pt-[65px]">
					<div class="mx-auto px-[16px] max-w-[1247px] pz-[16px]">
					<h3 class="text-center h2 leading-[1.2] max-w-[1150px] mb-[30px] md:mb-[60px] mx-auto">
						<?php echo $pricing_client_review_title; ?>
					</h3>
					<?php if (have_rows('clients_reviews_item')) : ?>
						<?php while (have_rows('clients_reviews_item')) : the_row();
								$clients_reviews_item_image = get_sub_field('clients_reviews_item_image');
								$clients_reviews_item_text = get_sub_field('clients_reviews_item_text');
								$clients_reviews_item_author = get_sub_field('clients_reviews_item_author');
								$client_review_item_role = get_sub_field('client_review_item_role');

							?>
							<div class="bg-white md:mt-0 md:shadow-none mt-[40px] px-[35px] py-[35px] rounded-[34px] shadow-[15px_10px_10px_rgba(0,0,0,0.16)] sm:px-[65px]">
							<h4 class="hidden sm:block font-medium leading-[1.1] mb-[25px] md:font-proxima-nova md:text-[36px] text-[18px] text-center text-troove-black-900">
							<?php echo $clients_reviews_item_text; ?>
												</h4>
							<div class="items-center justify-center flex flex-col sm:flex-row gap-[25px]">
								<div class="max-w-[90px]">
									<div><img src="<?php echo esc_url($clients_reviews_item_image); ?>" alt=""></div>
								</div>
								<h4 class="text-center font-medium leading-[1.1] mb-[25px] md:font-proxima-nova md:text-[36px] text-[18px] text-troove-black-900 sm:hidden">
								<?php echo $clients_reviews_item_text; ?>
								</h4>
								<div class="text-center sm:text-left">
									<h6 class="text-[16px] leading-[1.87] sm:leading-2 sm:text-[15px]"><?php echo $clients_reviews_item_author; ?></h6>
									<div><?php echo $client_review_item_role;?></div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
		</section>
	<?php }
}



if (!function_exists('ea_acf_client_pricing_images_section')) {
	function ea_acf_client_pricing_images_section()
	{ ?>
		<section class="py-[40px]">
			<div class="px-[16px] xl:container xl:px-[16px] xs:px-[25px]">
				<div class="flex justify-center 2xl:gap-[50px] flex-wrap gap-x-[25px] gap-y-[35px] lg:flex-nowrap sm:gap-[25px]">
					<?php if (have_rows('client_images_section')) : ?>
						<?php while (have_rows('client_images_section')) : the_row();
							$client_image_pricing_item = get_sub_field('client_image_pricing_item');
						?>
							<div class="flex items-center justify-center lg:w-auto sm:w-[calc(100%/3-25px*3/2)] w-[calc(50%-25px/2)]">
								<img class="sm:w-[80%]" src="<?php echo $client_image_pricing_item; ?>" alt="">
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php }
}


if (!function_exists('ea_acf_pricing_features_faq')) {
	function ea_acf_pricing_features_faq()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$pricing_faq_info_fields = get_field('pricing_faq_info', $post_id);

			if ($pricing_faq_info_fields) {
				$pricing_faq_title = $pricing_faq_info_fields['pricing_faq_title'];
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$pricing_faq_title = wp_kses($pricing_faq_title, $allowed_tags);

				$pricing_faq_link = $pricing_faq_info_fields['pricing_faq_link'];

				if ($pricing_faq_link) :
					$pricing_faq_link_url = $pricing_faq_link['url'];
					$pricing_faq_link_title = $pricing_faq_link['title'];
				endif;
			}
		} ?>

		<section class="py-[50px] bg-troove-purple-150 lg:py-[100px]">
			<div class="xl:container px-[16px] xl:px-[16px] xs:px-[25px] 2xl:gap-[150px] gap-[50px] xl:flex">
				<div class="xl:max-w-[350px]">
					<h3 class="text-center 2xl:leading-[1.52] 2xl:text-[60px] leading-[1.33] lg:text-[42px] pb-[50px] text-[24px] xl:pb-0 xl:text-left"><?php echo $pricing_faq_title; ?></h3>
				</div>
				<div class="flex flex-col accordion-wrap gap-[20px] one w-full">
					<?php if (have_rows('pricing_faq_items')) : ?>
						<?php while (have_rows('pricing_faq_items')) : the_row();
							$pricing_faq_title = get_sub_field('pricing_faq_title');
							$pricing_faq_text = get_sub_field('pricing_faq_text');
							$allowed_pricing_faq_text_tags = array(
								'br' => array(),
								'p' => array(),
								'h6' => array(),
								'strong' => array(),
							);

							$pricing_faq_text = wp_kses($pricing_faq_text, $allowed_pricing_faq_text_tags);
						?>
							<div class="block__item">
								<div class="block__title">
									<?php echo $pricing_faq_title; ?>
								</div>
								<div class="block__text">
									<?php echo $pricing_faq_text; ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="xl:container px-[16px] xl:px-[16px] xs:px-[25px] text-center">
				<a href="<?php echo $pricing_faq_link_url; ?>" class="items-center justify-center btn inline-flex btn-primary btn-primary-hover gap-[5px] group lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition mt-[35px] xl:mt-[70px]">
					<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $pricing_faq_link_title; ?></span>
					<img class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition hidden lg:block lg:group-hover:opacity-100 lg:opacity-0 object-cover w-[14px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
				</a>
			</div>
		</section>

		<?php }
}

/* Typical page */
if (!function_exists('ea_acf_typical_page_hero_section')) {
	function ea_acf_typical_page_hero_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$typical_page_hero_section_field = get_field('typical_page_hero_section', $post_id);

			if ($typical_page_hero_section_field) {
				$allowed_typical_page_hero_section_title_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$typical_page_hero_section_title = $typical_page_hero_section_field['typical_page_hero_section_title'];
				$typical_page_hero_section_title = wp_kses($typical_page_hero_section_title, $allowed_typical_page_hero_section_title_tags);

				$typical_page_hero_section_text = $typical_page_hero_section_field['typical_page_hero_section_text'];
				$typical_page_hero_section_link = $typical_page_hero_section_field['typical_page_hero_section_link'];
				$typical_page_hero_section_image = $typical_page_hero_section_field['typical_page_hero_section_image'];

				if ($typical_page_hero_section_link) :
					$typical_page_hero_section_link_url = $typical_page_hero_section_link['url'];
					$typical_page_hero_section_link_title = $typical_page_hero_section_link['title'];
				endif;

				if (!empty($typical_page_hero_section_field)) { ?>

					<section class="relative mt-[50px] xl:mt-[40px]">
						<div class="hidden absolute bottom-0 left-0 right-0 top-0 bg-contain bg-no-repeat xl:block" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/other-hero-bg.svg); background-position: center;"></div>
						<div class="flex justify-center px-[16px] xl:container gap-5 xl:justify-between flex items-center">
							<div class="text-center max-w-[700px] xl:text-left">
								<h1 class="xl:mb-[20px] mb-[50px]"><?php echo $typical_page_hero_section_title; ?></h1>
								<?php echo $typical_page_hero_section_text; ?>
								<a href="<?php echo ($typical_page_hero_section_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[35px] xl:mt-[35px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo esc_html($typical_page_hero_section_link_title); ?></span>
									<img class="hidden lg:block object-cover w-[14px] lg:duration-200 lg:ease-in lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:opacity-100 lg:group-hover:transition lg:opacity-0 lg:transition" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
							<div class="hidden xl:block max-w-[50%]"><img src="<?php echo esc_url($typical_page_hero_section_image); ?>" alt=""></div>
						</div>
					</section>

		<?php }
			}
		}
	}
}

if (!function_exists('ea_acf_typical_page_content_section')) {
	function ea_acf_typical_page_content_section()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();
		} ?>


		<?php if (have_rows('typical_page_content')) :
			$counter = 0;
		?>

			<?php while (have_rows('typical_page_content')) : the_row();
				$page_slug = get_post_field('post_name', get_post()); // Get the current page slug
				$counter++;
				$typical_page_content_title = get_sub_field('typical_page_content_title');
				$allowed_typical_page_content_title_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$typical_page_content_title = wp_kses($typical_page_content_title, $allowed_typical_page_content_title_tags);
				$typical_page_content_text = get_sub_field('typical_page_content_text');
				$typical_page_mobile_image = get_sub_field('typical_page_mobile_image');
				$typical_page_desktop_image = get_sub_field('typical_page_desktop_image');

				$mobile_img_url = get_template_directory_uri() . "/images/{$page_slug}/{$page_slug}-{$counter}-mobile-bg.png";
				$desktop_img_url = get_template_directory_uri() . "/images/{$page_slug}/{$page_slug}-{$counter}-bg.png";

				$theme_directory = get_template_directory();
				$mobile_img_path = $theme_directory . "/images/{$page_slug}/{$page_slug}-{$counter}-mobile-bg.png";
				$desktop_img_path = $theme_directory . "/images/{$page_slug}/{$page_slug}-{$counter}-bg.png";
				$mobile_img_exists = file_exists($mobile_img_path);
				$desktop_img_exists = file_exists($desktop_img_path);
			?>

				<section class="text-center lg:py-[100px] lg:text-left pt-[100px]">
					<div class="flex justify-center px-[16px] xl:container 2xl:gap-[100px] items-center flex-col-reverse gap-[25px] lg:gap-[10px] xl:gap-[30px]  <?php echo $counter % 2 === 0 ? 'flex-reverce' : 'flex-normal'; ?>">
						<div class="xl:max-w-[50%] lg:max-w-[45%] relative ">
							<?php if ($mobile_img_exists) : ?>
								<img src="<?php echo esc_url($mobile_img_url); ?>" alt="" class="top-0 absolute bottom-0 left-0 right-0 -z-10 sm:hidden">
							<?php endif; ?>
							<?php if ($desktop_img_exists) : ?>
								<img src="<?php echo esc_url($desktop_img_url); ?>" alt="bg-desktop" class="hidden sm:block -z-10 absolute bottom-0 left-0 right-0 top-0">
							<?php endif; ?>

							<img src="<?php echo esc_url($typical_page_mobile_image); ?>" alt="" class="sm:hidden">
							<img src="<?php echo esc_url($typical_page_desktop_image); ?>" alt="" class="hidden sm:block">
						</div>
						<div class="xl:max-w-[50%] lg:max-w-[55%]">
							<h3 class="font-semibold h2"><?php echo $typical_page_content_title; ?></h3>
							<div class="mt-[30px] lg:max-w-[490px] planner-text">
								<?php echo $typical_page_content_text; ?>
							</div>
						</div>
					</div>
				</section>

			<?php endwhile; ?>
		<?php endif; ?>
		<?php }
}

if (!function_exists('ea_acf_typical_page_call_to_action')) {
	function ea_acf_typical_page_call_to_action()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$typical_page_call_to_action_fields = get_field('typical_page_call_to_action', $post_id);

			if ($typical_page_call_to_action_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$typical_page_call_to_action_title = $typical_page_call_to_action_fields['typical_page_call_to_action_title'];
				$typical_page_call_to_action_title = wp_kses($typical_page_call_to_action_title, $allowed_tags);

				$typical_page_call_to_action_content = $typical_page_call_to_action_fields['typical_page_call_to_action_content'];
				$typical_page_call_to_action_content = str_replace('<p>', '<p class="leading-[1.2] lg:text-[20px] text-[18px] text-troove-black-900">', $typical_page_call_to_action_content);

				$call_to_action_link = $typical_page_call_to_action_fields['call_to_action_link'];;

				if ($call_to_action_link) :
					$call_to_action_link_url = $call_to_action_link['url'];
					$call_to_action_link_title = $call_to_action_link['title'];
				endif;

				if (!empty($typical_page_call_to_action_fields)) { ?>

					<section class="lg:pb-[120px] pb-[80px] typical-page-cta">
						<div class="text-center px-[16px] xl:container">
							<div class="bg-cover bg-no-repeat bg-troove-pink-300 bg-troove-white-300 bg-workday-bg lg:py-[110px] lg:rounded-[81px] pb-[40px] pt-[50px] px-[20px] rounded-[30px]">

								<h3 class="h1 mb-[20px]"><?php echo $typical_page_call_to_action_title; ?></h3>
								<?php echo $typical_page_call_to_action_content; ?>

								<a href="<?php echo ($call_to_action_link_url); ?>" class="lg:duration-200 lg:ease-in lg:transition gap-[5px] group items-center justify-center lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition btn btn-primary btn-primary-hover inline-flex mt-[40px]">
									<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:group-hover:translate-x-[-5px] text-white lg:translate-x-[5px]"><?php echo $call_to_action_link_title; ?></span>
									<img class="hidden lg:block object-cover w-[14px] lg:duration-200 lg:ease-in lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:opacity-100 lg:group-hover:transition lg:opacity-0 lg:transition" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="demo-icon">
								</a>
							</div>
						</div>
					</section>

<?php }
			}
		}
	}
}
			
function add_svg_to_allowed_mimes($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_svg_to_allowed_mimes');


/* simple page */
if (!function_exists('ea_acf_simple_page_content')) {
	function ea_acf_simple_page_content()
	{
		if (function_exists('get_field')) {
			// Get the current post/page ID
			$post_id = get_the_ID();

			$typical_page_simple_page_fields = get_field('simple_page_fields', $post_id);

			if ($typical_page_simple_page_fields) {
				$allowed_tags = array(
					'br' => array(),
					'span' => array(),
				);
				$simple_page_title = $typical_page_simple_page_fields['simple_page_title'];
				$simple_page_title = wp_kses($simple_page_title, $allowed_tags);

				$simple_page_info = $typical_page_simple_page_fields['simple_page_info'];
				$simple_page_editor_content = $typical_page_simple_page_fields['simple_page_editor'];

				if (!empty($typical_page_simple_page_fields)) { ?>

				<section class="text-center bg-[center_center] bg-contain bg-no-repeat pb-[75px] pt-[60px] xl:bg-policy-bg">
					<div class="xl:container px-[25px]">
						<h2 class="mx-auto h1 max-w-[1200px] mb-[50px] mt-[30px]">
							<?php echo $simple_page_title; ?>
						</h2>
						<p class="mx-auto font-title lg:text-[20px] max-w-[905px] text-[18px]">
							<?php echo $simple_page_info;?>
						</p>
					</div>
				</section>
				<section class="lg:pb-[120px] lg:pt-[120px] pb-[80px] pt-[43px]">
					<div class="xl:container px-[16px]">
						<?php echo $simple_page_editor_content; ?>
					</div>
				</section>
<?php }
			}
		}
	}
}