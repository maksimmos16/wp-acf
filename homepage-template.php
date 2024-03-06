<?php
/*
Template Name: Homepage Template
*/
get_header();
?>

<main class="page">
  <div data-observ=""></div>

  <?php ea_acf_hero(); ?>

  <?php ea_acf_services(); ?>

  <?php ea_acf_why_choose_us(); ?>

  <?php ea_acf_what_you_need(); ?>

  <?php ea_acf_testimonials_new() ;?>

  <?php ea_acf_workflow(); ?>

  <?php ea_acf_ready_to(); ?>

  <button class="hidden bottom-5 btn btn-scroll-up btn-scroll-up-hover fixed lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] md:bottom-10 md:right-10 right-5" id="js-top">
    <img src="<?php echo get_template_directory_uri(); ?>/images/back-to-top.svg" alt="">
  </button>
</main>

<?php get_footer(); ?>