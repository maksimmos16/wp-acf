<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package promo-front
 */

?>


</div>

<?php
if (function_exists('get_field')) {
  $footer_logo_url = get_field('footer_logo', 'option');
}
?>

<?php if (have_rows('footer', 'options')) : ?>
  <?php while (have_rows('footer', 'options')) : the_row();
    if (have_rows('footer_social_links')) :
      while (have_rows('footer_copyright')) : the_row();
        $footer_copyright = get_sub_field('footer_copyright');
  ?>
      <?php endwhile; ?>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>



<footer class="footer">
  <div class="footer__container">
    <div class="flex items-center flex-col justify-between md:flex-row md:items-stretch">
      <div class="flex items-center flex-col col-1 md:block">
        <a href="<?php echo esc_url(home_url()) ?>">
          <?php
          $footer_logo_image = get_field('footer_logo_image', 'options');
            if (!empty($footer_logo_image)) {
              $footer_logo_image_url = wp_get_attachment_url($footer_logo_image);
            ?>
            <img class="h-[37px] max-w-[168px]" src="<?php echo esc_url($footer_logo_image_url); ?>" alt="footer logo">
          <?php } ?>
        </a>
        <div class="flex gap-[29px] icons mb-[50px] mb:mb-0 md:mt-[50px] mt-[30px]">
          <?php if (have_rows('footer', 'options')) : ?>
              <?php while (have_rows('footer', 'options')) : the_row();
                if (have_rows('footer_social_links')) :
                  while (have_rows('footer_social_links')) : the_row();
                    $social_icon = get_sub_field('social_icon');
                    $social_link = get_sub_field('social_link'); ?>
                    <a href="<?php echo ($social_link); ?>"><img src="<?php echo ($social_icon); ?>" alt="" class="h-[30px] w-[30px]"></a>
                  <?php endwhile; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
        </div>
      </div>

      <div class="flex flex-col md:flex-row col-2 gap-[45px] lg:gap-[156px] md:gap-[75px]">
        <div class="footer-menu">
          <?php dynamic_sidebar('footer_widget_1'); ?>
        </div>
        <div class="footer-menu">
          <?php dynamic_sidebar('footer_widget_2'); ?>
        </div>
        <div class="footer-menu">
          <?php dynamic_sidebar('footer_widget_3'); ?>
        </div>
      </div>
    </div>
    <?php
    dynamic_sidebar('footer_widget_copyright');
    ?>
  </div>
</footer>

<?php wp_footer(); ?>
</div>
</body>

</html>