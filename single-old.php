<?php
wp_enqueue_style('blog_styles', get_template_directory_uri() . '/custom-css/blog/blog-styles.min.css', [], null);
wp_enqueue_style('cta_styles', get_template_directory_uri() . '/custom-css/modules/cta/cta.css', ['blog_styles'], null);

get_header();

?>

<div class="wrapper">
    <div class="to-top">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" viewBox="0 0 80 80">
            <defs>
                <filter id="Эллипс_4" x="0" y="0" width="80" height="80" filterUnits="userSpaceOnUse">
                    <feOffset dy="3" input="SourceAlpha" />
                    <feGaussianBlur stdDeviation="3" result="blur" />
                    <feFlood flood-opacity="0.161" />
                    <feComposite operator="in" in2="blur" />
                    <feComposite in="SourceGraphic" />
                </filter>
            </defs>
            <g id="Компонент_2_1" data-name="Компонент 2 – 1" transform="translate(9 6)">
                <g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Эллипс_4)">
                    <circle id="Эллипс_4-2" data-name="Эллипс 4" cx="31" cy="31" r="31" transform="translate(9 6)" fill="#2e384d" />
                </g>
                <path id="Icon_feather-chevron-up" data-name="Icon feather-chevron-up" d="M27.025,22.513,18.013,13.5,9,22.513" transform="translate(13.388 13.023)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
            </g>
        </svg>

    </div>
    <main class="main">
        <section class="single-section">
            <div class="container">
                <div class="single-wrap">
                    <div class="sidebar">
                        <a href="/the-leave-ledger" class="back-home">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="26.911" viewBox="0 0 27 26.911">
                                    <g id="arrow-down-circle" transform="translate(27) rotate(90)">
                                        <path id="Контур_182128" data-name="Контур 182128" d="M28.948,24.515,26.23,27.188V19.48a.98.98,0,0,0-1.96,0v7.708l-2.718-2.673a1.008,1.008,0,0,0-1.426,1.426l4.411,4.366a1.012,1.012,0,0,0,.713.267,1.092,1.092,0,0,0,.713-.267l4.411-4.366a1.008,1.008,0,0,0-1.426-1.426Z" transform="translate(-11.794 -11.015)" fill="#6bb701" />
                                        <path id="Контур_182129" data-name="Контур 182129" d="M15.256,1.7A13.5,13.5,0,1,0,28.711,15.2,13.482,13.482,0,0,0,15.256,1.7Zm0,25a11.5,11.5,0,1,1,11.5-11.5A11.523,11.523,0,0,1,15.256,26.7Z" transform="translate(-1.8 -1.7)" fill="#6bb701" />
                                    </g>
                                </svg>
                            </span>
                            Back to blog home
                        </a>
                        <form action="" class="search-single">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.551" height="18.805" viewBox="0 0 20.551 18.805">
                                    <path id="search-alt_1_" data-name="search-alt (1)" d="M20.185,19.965l-5.455-4.428a8.059,8.059,0,0,0-.866-10.429A8.058,8.058,0,0,0,2.407,5.075a8.151,8.151,0,0,0,5.744,13.9,7.868,7.868,0,0,0,5.487-2.15l5.552,4.525a.656.656,0,0,0,.513.16.759.759,0,0,0,.674-.353A.823.823,0,0,0,20.185,19.965ZM8.119,17.237a6.309,6.309,0,0,1-4.525-1.893A6.442,6.442,0,0,1,1.7,10.819,6.309,6.309,0,0,1,3.594,6.294,6.5,6.5,0,0,1,8.119,4.4a6.309,6.309,0,0,1,4.525,1.893,6.5,6.5,0,0,1,1.893,4.525,6.309,6.309,0,0,1-1.893,4.525A6.255,6.255,0,0,1,8.119,17.237Z" transform="translate(0 -2.7)" fill="#616161" />
                                </svg>
                            </button>
                            <input type="text" placeholder="Search in this article">
                        </form>
                        <div class="single-nav">
                            <span class="js-open">
                                Table of contents
                            </span>
                            <ul class="single-nav-menu">
                                <?php if (have_rows('paragraph')) : ?>
                                    <?php while (have_rows('paragraph')) : the_row();
                                        $title = get_sub_field('title');
                                    ?>
                                        <li class="single-nav-item" data-pg="p-<?php echo get_row_index(); ?>"><?php echo esc_html($title); ?>
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="27" height="26.911" viewBox="0 0 27 26.911">
                                                    <g id="arrow-down-circle" transform="translate(0 26.911) rotate(-90)">
                                                        <path id="Контур_182128" data-name="Контур 182128" d="M28.948,24.515,26.23,27.188V19.48a.98.98,0,0,0-1.96,0v7.708l-2.718-2.673a1.008,1.008,0,0,0-1.426,1.426l4.411,4.366a1.012,1.012,0,0,0,.713.267,1.092,1.092,0,0,0,.713-.267l4.411-4.366a1.008,1.008,0,0,0-1.426-1.426Z" transform="translate(-11.794 -11.015)" fill="#6bb701" />
                                                        <path id="Контур_182129" data-name="Контур 182129" d="M15.256,1.7A13.5,13.5,0,1,0,28.711,15.2,13.482,13.482,0,0,0,15.256,1.7Zm0,25a11.5,11.5,0,1,1,11.5-11.5A11.523,11.523,0,0,1,15.256,26.7Z" transform="translate(-1.8 -1.7)" fill="#6bb701" />
                                                    </g>
                                                </svg></span>
                                        </li>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="newsletter desk">
                            <p>
                                Sign up now for smarter time-off management!
                            </p>
                            <?php echo do_shortcode('[contact-form-7 id="73073f1" title="Newsletter"]'); ?>
                        </div>
                    </div>
                    <div class="article">
                        <div class="article-head">
                            <h1><?php the_title(); ?></h1>
                            <?php
                            $thumbail = get_field('thumbail');
                            $time_read = get_field('time_read');
                            ?>
                            <div class="thumbail">
                                <img src="<?php echo esc_url($thumbail['url']); ?>" alt="<?php echo esc_attr($thumbail['alt']); ?>">
                            </div>
                            <div class="article-info">
                                <div class="row mb-10">
                                    <div class="flex">
                                        <?php foreach (get_the_category() as $category) { ?>
                                            <div class="tag">
                                                <?php echo $category->name; ?>
                                            </div>
                                        <?php   } ?>
                                    </div>
                                    <div class="share mob">
                                        <span>Share:</span>
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="update">Last updated: <?php the_modified_date('F j, Y'); ?> - <?php echo $time_read; ?> read</div>
                                    <div class="share desk">
                                        <span>Share:</span>
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (have_rows('paragraph')) : ?>
                            <?php while (have_rows('paragraph')) : the_row();
                                $title = get_sub_field('title');
                                $content = get_sub_field('content');
                            ?>
                                <div class="article-paragraph" id="p-<?php echo get_row_index(); ?>">
                                    <h5><?php echo esc_html($title); ?></h5>

                                    <?php echo $content; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                    <div class="newsletter mob">
                     <p>
                            Sign up now for smarter time-off management!
                        </p>
                        <?php echo do_shortcode('[contact-form-7 id="73073f1" title="Newsletter"]'); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if (function_exists('ea_acf_modules')) {
            ea_acf_modules();
        } ?>
    </main>

</div>

<?php
wp_enqueue_script('blog_js', get_template_directory_uri() . '/custom-js/blog/app.js', ['jquery'], '', true);

get_footer();