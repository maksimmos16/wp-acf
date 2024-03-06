<?php
/*
Template Name: Planner Template
*/
get_header();
?>

<main class="page">
    <div data-observ></div>
    <div class="xl:container px-[16px] text-troove-gray-150 text-[20px] hidden xl:block font-title font-medium">
        <?php  $home_url = get_home_url();
        $current_page_title = get_the_title();
        ?>
        <a class="text-troove-gray-450 font-medium hover:text-troove-black-900" href="<?php echo esc_url($home_url) ;?>">Home</a> / <span class="text-troove-gray-150"><?php echo esc_html($current_page_title); ?></span>
    </div>

    <?php ea_acf_planner_hero_section(); ?>

    <?php ea_acf_planner_to_do_section(); ?>

    <?php ea_acf_planner_my_list_section(); ?>

    <?php ea_acf_planner_meeting_management_section(); ?>

    <?php ea_acf_planner_inbox_section(); ?>

    <?php ea_acf_planner_call_to_action(); ?>

    <button class="hidden bottom-5 btn btn-scroll-up btn-scroll-up-hover fixed lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] md:bottom-10 md:right-10 right-5" id="js-top">
        <img src="<?php echo get_template_directory_uri(); ?>/images/back-to-top.svg" alt="">
    </button>

</main>

<?php get_footer(); ?>