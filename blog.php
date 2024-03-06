<?php

/**
 *
 * Template Name: Blog Template
 *
 */

get_header();
?>


<main class="page">
    <div data-observ=""></div>

    <?php
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'numberposts'    => 0,
        'posts_per_page' => 9,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => get_query_var('paged') ? get_query_var('paged') : 1
    );
    $query = new WP_Query($args);
    ?>
    <?php if ($query->have_posts()) : ?>

        <section class="lg:pt-[44px] pb-20 pt-[60px]">
            <div class="w-full 2xl:px-0 mx-auto px-[35px] xl:container">

                <h1 class="text-center [*>br]:lg:hidden lg:mb-[53px] lg:text-left mb-9">
                    <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                $content = get_the_content();
                                $allowed_tags = '<span>';
                                $content = strip_tags($content, $allowed_tags);
                                echo  $content ;
                            }
                        }
                    ?>
                </h1>
                <p class="font-medium font-title leading-[1.56] lg:mb-10 lg:text-xl mb-5"><?php the_title(); ?></p>

                <div class="gap-9 grid lg:gap-x-[30px] lg:gap-y-[60px] lg:grid-cols-3 lg:mb-[74px] mb-7 md:grid-cols-2">
                    <?php while ($query->have_posts()) : $query->the_post();
                        $thumbail = get_field('thumbail');
                        $time_read = get_field('time_read');
                    ?>
                        <a href="<?php the_permalink(); ?>" class="blog-card">
                            <div class="blog-card-img">
                            <?php if ($thumbail && is_array($thumbail) && isset($thumbail['url']) ) : ?>
                                <img src="<?php echo esc_url($thumbail['url']); ?>" <?php if (isset($thumbail['alt'])) echo 'alt="' . esc_attr($thumbail['alt']) . '"'; ?>>
                            <?php endif; ?>
                            </div>
                            <div class="flex flex-items-center lg:mb-[10px] mb-3">
                                <?php foreach (get_the_category() as $category) { ?>
                                    <p class="article-tags category">
                                        <?php echo $category->name; ?>
                                    </p>
                                <?php   } ?>
                            </div>
                            <h4><?php the_title(); ?></h4>
                            <div class="blog-card-info">
                                <span class="date"><?php the_modified_date('F j, Y'); ?></span>
                                <?php if (isset($time_read) && !empty($time_read)) : ?>
                                    - <span class="read-time"><?php echo $time_read; ?> read</span>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>

                <div class="pagination">
                    <div class="pages">
                        <?php
                        echo paginate_links(array(
                            'total' => $query->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'prev_text' => __('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.006 512.006" xml:space="preserve">
                            <g>
                              <g>
                                <path d="M388.419,475.59L168.834,256.005L388.418,36.421c8.341-8.341,8.341-21.824,0-30.165s-21.824-8.341-30.165,0
                                  L123.586,240.923c-8.341,8.341-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251
                                  c5.461,0,10.923-2.091,15.083-6.251C396.76,497.414,396.76,483.931,388.419,475.59z"></path>
                              </g>
                            </g>
                          </svg>
                        '),
                            'next_text' => __('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                            <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001
                        c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213
                        C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606
                        C255,161.018,253.42,157.202,250.606,154.389z"></path>
                        </svg>
						  '),
                        ));
                        ?>
                    </div>
                </div>

            </div>
        </section>

        

    <?php
        wp_reset_postdata();
    endif;
    ?>
    <?php if (function_exists('ea_acf_blog_module')) {
        ea_acf_blog_module(); 
    } ?>

</main>

<?php
get_footer();
