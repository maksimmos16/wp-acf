<?php
/*
Template Name: Pricing Template
*/
get_header();
?>

<main class="page">
    <div data-observ=""></div>
    <div class="xl:container px-[16px] text-troove-gray-150 text-[20px] hidden xl:block font-title font-medium">
        <?php  $home_url = get_home_url();
        $current_page_title = get_the_title();
        ?>
        <a class="text-troove-gray-450 font-medium" href="<?php echo esc_url($home_url) ;?>">Home</a> / <span class="text-troove-gray-150"><?php echo esc_html($current_page_title); ?></span>
    </div>

    <section class="bg-contain bg-no-repeat lg:bg-hero-bg lg:py-[90px] py-[60px]">
        <div class="px-[16px] xl:container xl:px-[16px] xs:px-[25px]">

            <?php echo ea_acf_pricing_info(); ?>

            <div class="grid 2xl:gap-[30px] gap-[15px] lg:mt-[60px] md:grid-cols-2 mt-[40px] xl:grid-cols-3">
                <?php echo ea_acf_pricing_small_client(); ?>

                <?php echo ea_acf_pricing_midsize_client(); ?>

                <?php echo ea_acf_pricing_enterprise_client(); ?>
            </div>

        </div>
    </section>

    <?php echo ea_acf_pricing_reviews_section(); ?>

    <?php echo ea_acf_client_pricing_images_section(); ?>

    <?php echo ea_acf_pricing_features_faq(); ?>

    <button class="bottom-5 btn btn-scroll-up btn-scroll-up-hover fixed lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] md:bottom-10 md:right-10 right-5 hidden" id="js-top">
        <img src="<?php echo get_template_directory_uri();?>/images/back-to-top.svg" alt="">
    </button>

</main>

<?php get_footer(); ?>