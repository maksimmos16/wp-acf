<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package promo-front
 */

 get_header();
 ?>
 
 <main class="page">
	 <div data-observ></div>
 
	<div class="page-not-exist-wrapper">
		<h1><span>Page not found</span></h1>
		<h3>go to <a href="<?php echo home_url(); ?>">Trovve home</a></h3>
	</div>

	 <button class="hidden bottom-5 btn btn-scroll-up btn-scroll-up-hover fixed lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] md:bottom-10 md:right-10 right-5" id="js-top">
		 <img src="<?php echo get_template_directory_uri(); ?>/images/back-to-top.svg" alt="">
	 </button>
 
 </main>
 
 <?php get_footer(); ?>