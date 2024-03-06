<?php
get_header();
?>

<main class="page">
    <div data-observ></div>
    <section class="pb-20 pt-[35px]">
        <div class="w-full mx-auto 2xl:px-0 px-[35px] xl:container">
            <div class="2xl:gap-[135px] lg:flex lg:gap-14 lg:justify-between xl:gap-20">
                <aside class="w-full mx-auto 2xl:max-w-[405px] article-sidebar lg:flex-shrink-0 lg:m-0 lg:max-w-[320px] max-w-[500px] mb-8">
                    <a href="<?php echo esc_url(home_url('/')); ?>/blog/" class="flex items-center 2xl:mb-20 2xl:text-xl font-title gap-4 lg:mb-10 mb-4">
                        <div class="2xl:h-[27px] 2xl:w-[27px] h-[22px] w-[22px]">
                            <img class="w-full h-full" src="<?php echo get_template_directory_uri(); ?>/images/arrow-left-circle.svg" alt="arrow">
                        </div>
                        Back to blog home
                    </a>
                    <div class="lg:sticky lg:top-[120px]">

                        <form class="2xl:mb-[35px] js-search-single lg:mb-5">
                            <label for="search" class="font-medium mb-2 sr-only text-sm">Search</label>
                            <div class="relative">
                                <div class="flex items-center absolute inset-y-0 pl-5 pointer-events-none start-0">
                                    <div class="w-[14px] 2xl:h-5 2xl:w-5 h-[14px]">
                                        <img class="w-full h-full" src="<?php echo get_template_directory_uri(); ?>/images/search-icon.svg" alt="search">
                                    </div>
                                </div>
                                <input type="text" id="search" class="w-full block border 2xl:pl-[60px] 2xl:text-[20px] border-troove-purple-500 dark:placeholder-[#616161] leading-[1.25] lg:pl-12 lg:py-[18px] lg:text-[16px] pl-12 pr-3 py-2 rounded-[20px] text-[14px]" placeholder="Search in this article">
                            </div>
                        </form>
                        <nav class="hidden lg:block 2xl:mb-[135px] lg:mb-20 navigation">
                            <p>Table of contents</p>

                            <ul>
                                <?php if (have_rows('paragraph')) : ?>
                                    <?php while (have_rows('paragraph')) : the_row();
                                        $title = get_sub_field('title');
                                    ?>
                                        <li>
                                            <a href="#paragraph-<?php echo get_row_index(); ?>"><?php echo esc_html($title); ?></a>
                                            <div class="arrow">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right-circle.svg" alt="arrow">
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>

                        </nav>
                        <div class="hidden lg:block bg-troove-pink-300 max-w-[405px] mx-auto pb-[21px] pt-6 px-[18px] rounded-[20px]">
                            <p class="text-center font-semibold font-title mb-3 px-5 text-xl">Sign up now for smarter time-off management!</p>
                            <!-- <form>
                                <div class="relative">
                                    <input type="email" class="w-full block border bg-white pl-[25px] placeholder:text-troove-gray-300 pr-32 py-[14px] rounded-[28px] text-[15px]" placeholder="Your email" required="">
                                    <button type="submit" class="text-white text-[14px] -translate-y-1/2 absolute bg-troove-purple-200 font-semibold hover:bg-troove-purple-400 px-7 py-[10px] right-[5px] rounded-[22px] top-1/2">Subscribe</button>
                                </div>
                            </form> -->
                            
                                <div class="relative">
                                    <?php echo do_shortcode('[contact-form-7 id="390bc81" title="Contact form 1"]'); ?>
                                </div>
                        </div>
                    </div>
                </aside>
                <article class="article">
                    <?php
                    $thumbail = get_field('thumbail');
                    $time_read = get_field('time_read');
                    $post_title = get_the_title();
                    ?>
                    <h1 class="text-center lg:mb-4 lg:text-left mb-8"><?php echo $post_title; ?></h1>
                    <div class="flex flex-col article-info gap-3 lg:flex-col-reverse mb-[38px]">
                        <div class="article-img overflow-hidden rounded-2xl">
                            <img class="w-full h-full object-cover" src="<?php echo esc_url($thumbail['url']); ?>" alt="<?php echo esc_attr($thumbail['alt']); ?>">
                        </div>
                        <div class="article-data">
                            <div class="flex flex-items-center lg:mb-[10px] mb-3">

                                <?php foreach (get_the_category() as $category) { ?>
                                    <p class="article-tags text-white 2xl:text-[15px] bg-troove-purple-400 category font-medium font-title leading-[1.5] lg:px-[10px] lg:text-[13px] px-2 py-1 rounded-[5px] text-[11px] w-max">
                                        <?php echo $category->name; ?>
                                    </p>
                                <?php   } ?>

                               

                            </div>
                            <div class="socials mobile">
                                    <p class="md:pb-0 sm:pb-0 xs:pb-0">Share:</p>
                                    <div class="flex items-center gap-2">
                                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/share/x-logo-black.svg" alt="x"></a>
                                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/share/linkedin-logo-black.svg" alt="linkedin"></a>
                                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/share/facebook-logo-black.svg" alt="facebook"></a>
                                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/share/link-icon.svg" alt="link-icon"></a>
                                    </div>
                                </div>
                            <div class="flex items-center justify-between">
                                <div class="2xl:text-[16px] [&>*]:text-troove-gray-300 font-title leading-[1.5] lg:text-[14px] text-[12px] text-troove-gray-300 updated">
                                    Last updated: <span class="date"><?php the_modified_date('F j, Y'); ?></span>
                                    <?php if ($time_read) : ?>
                                        - <span class="read-time"><?php echo $time_read; ?>min read</span>
                                    <?php endif; ?>
                                </div>

                                <div class="socials desktop">
                                    <p class="md:pb-0 lg:pb-0">Share:</p>
                                    <div class="flex items-center gap-[10px]">
                                        <a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                                            <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/images/share/x-logo-black.svg" alt="x">
                                        </a>
                                        <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                                            <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/images/share/linkedin-logo-black.svg" alt="linkedin">
                                        </a>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                                            <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/images/share/facebook-logo-black.svg" alt="facebook">
                                        </a>
                                        <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank">
                                            <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/images/share/link-icon.svg" alt="link-icon">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="article-content">

                        <?php if (have_rows('paragraph')) : ?>
                            <?php while (have_rows('paragraph')) : the_row();
                                $title = get_sub_field('title');
                                $content = get_sub_field('content');
                            ?>
                                <h2 class="nav-item" id="paragraph-<?php echo get_row_index(); ?>">
                                    <?php echo esc_html($title); ?>
                                </h2>
                                <?php echo $content; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                </article>
                <div class="rounded-[20px] bg-troove-pink-300 max-w-[405px] mx-auto pb-[21px] pt-6 px-[18px] lg:hidden">
                    <p class="text-center font-semibold font-title mb-3 px-5 text-xl">Sign up now for smarter time-off management!</p>
                        <div class="relative">
                            <?php echo do_shortcode('[contact-form-7 id="390bc81" title="Contact form 1"]'); ?>
                        </div>
                </div>
            </div>
        </div>
    </section>



    <?php ea_acf_blog_posts_module();  ?>

    <button class="bottom-5 btn btn-scroll-up btn-scroll-up-hover fixed lg:hover:shadow-[0px_3px_6px_rgba(0,0,0,0.4)] md:bottom-10 md:right-10 right-5" id="js-top">
        <img src="<?php echo get_template_directory_uri(); ?>/images/back-to-top.svg" alt="">
    </button>
</main>

<?php
get_footer();
