<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package promo-front
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PH3CJHZX');</script>
<!-- End Google Tag Manager -->
	<meta name="google-site-verification" content="VUum8qBycp5EZac9E8VEAIBDd4a9POa6QVcDnabf9-I" />
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="wrapper">
		<div class="inner-wrapper">
		<header class="top-0 bg-troove-purple-400 js-header lg:py-10 md:bg-white py-[30px] sticky w-full z-[100] header-bg-purple">
			<div class="flex items-center justify-between gap-3 mx-auto px-[16px] xl:container">
				<a href="<?php echo esc_url(get_site_url()); ?>" class="block w-full lg:max-w-[190px] max-w-[140px]">
					<?php
					// Desctop Logo Image (h_logo)
					$h_logo = get_field('h_logo', 'options');
					if (!empty($h_logo)) {
						$image_url = wp_get_attachment_url($h_logo);
					?>
						<img class="w-full h-full object-cover hidden lg:block" src="<?php echo esc_url($image_url); ?>" alt="Logo 1">
					<?php } else {
						echo 'No image found for Logo 1.';
					}
					?>

					<?php
					// Mobile Logo Image (h_logo_m)
					$h_logo_m = get_field('h_logo_m', 'options');
					if (!empty($h_logo_m)) {
						$image_url_m = wp_get_attachment_url($h_logo_m);
					?>
						<img class="block object-cover h-full lg:hidden w-full" src="<?php echo esc_url($image_url_m); ?>" alt="Logo 2">
					<?php } else {
						echo 'No image found for Logo 2.';
					}
					?>
				</a>



				<?php
					$header_link_1 = get_field('header_link_1', 'options');
					$header_link_2 = get_field('header_link_2', 'options');
					$header_button_link_1 = get_field('header_button_link_1', 'options');
					$header_button_link_2 = get_field('header_button_link_2', 'options');
				?>
				<div class="gap-5 items-center hidden lg:gap-[70px] lg:flex">
					<nav class="header__menu">
					<ul class="menu__list">
						<?php
						if (!empty($header_link_1)) {
						?>
							<li class="menu__item"><a href="<?php echo esc_url($header_link_1); ?>"><?php echo esc_html__('Features', 'promo-front'); ?></a></li>
						<?php
						}

						if (!empty($header_link_2)) {
						?>
							<li class="menu__item"><a href="<?php echo esc_url($header_link_2); ?>"><?php echo esc_html__('Pricing', 'promo-front'); ?></a></li>
						<?php
						}
						?>
					</ul>
					</nav>

					<div class="flex items-center gap-5">
					<?php if (!empty($header_button_link_1)) { ?>
							<a href="<?php echo esc_url($header_button_link_1); ?>" class="flex items-center gap-[5px] group justify-center lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition px-9 py-3 rounded-[22px] border border-solid border-troove-gray-400">
								<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:translate-x-[5px] lg:group-hover:translate-x-[-2px] text-troove-gray-400">Sign in</span>
								<img class="hidden lg:block lg:duration-200 lg:ease-in lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:opacity-100 lg:group-hover:transition lg:opacity-0 lg:transition lg:group-hover:translate-x-[8px] h-[9px] object-contain w-[11px]" src="<?php echo get_template_directory_uri(); ?>/images/arrow-right-black.svg" alt="arrow-right">
							</a>
						<?php } ?>
						<?php if (!empty($header_button_link_2)) { ?>
							<a href="<?php echo esc_url($header_button_link_2); ?>"  class="flex items-center gap-[5px] group justify-center lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition px-9 py-3 rounded-[22px] bg-troove-purple-200">
							<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] text-[16px] lg:translate-x-[5px] text-white lg:group-hover:translate-x-[-2px]">Book a demo</span>
							<img class="hidden lg:block object-cover w-[14px] lg:duration-200 lg:ease-in lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:opacity-100 lg:group-hover:transition lg:opacity-0 lg:transition h-3 lg:group-hover:translate-x-[8px]" src="<?php echo get_template_directory_uri(); ?>/images/calender.svg" alt="calender">

							<?php } ?>
						</a>
					</div>
				</div>

				<button class="header__burger icon-menu">
					<span></span>
				</button>
				<div class="header__burder-menu">
					<ul>
					<?php
						// Check and add the first button
						if (!empty($header_link_1)) {
						?>
							<li class="menu__item text-center"><a href="<?php echo esc_url($header_link_1); ?>"><?php echo esc_html__('Features', 'promo-front'); ?></a></li>
						<?php
						}

						// Check and add the second button
						if (!empty($header_link_2)) {
						?>
							<li class="menu__item text-center"><a href="<?php echo esc_url($header_link_2); ?>"><?php echo esc_html__('Pricing', 'promo-front'); ?></a></li>
						<?php
						}
						?>
					</ul>
					<div class="flex flex-col gap-5">
						<?php if (!empty($header_button_link_1)) { ?>
							<a href="<?php echo esc_url($header_button_link_1); ?>" class="flex items-center gap-[5px] group justify-center lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition px-9 py-3 rounded-[22px] border border-solid border-troove-gray-400">
								<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] lg:group-hover:translate-x-[-5px] text-[16px] text-troove-gray-400">Sign in</span>
								<img class="block object-cover h-[10px] w-[10px]" src="<?php echo get_template_directory_uri(); ?>/images/arrow-right-black.svg" alt="arrow-right">
							</a>
						<?php } ?>
						<?php if (!empty($header_button_link_2)) { ?>
							<a href="<?php echo esc_url($header_button_link_2); ?>" class="flex items-center gap-[5px] group justify-center lg:duration-200 lg:ease-in lg:gap-[0px] lg:hover:duration-200 lg:hover:ease-in lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] lg:hover:transition lg:transition px-9 py-3 rounded-[22px] bg-troove-purple-200">
								<span class="lg:duration-200 lg:ease-in lg:transition lg:group-hover:duration-200 lg:group-hover:ease-in lg:group-hover:transition font-bold leading-[100%] lg:group-hover:translate-x-[-5px] text-[16px] text-white">Book a demo</span>
								<img class="block object-cover h-[10px] w-[10px]" src="<?php echo get_template_directory_uri(); ?>/images/demo-icon.png" alt="demo-icon">
							</a>
						<?php } ?>
					</div>
				</div>

			</div>
		</header>