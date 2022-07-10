<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php do_action('storefront_before_site'); ?>

    <div id="page" class="hfeed site">
        <?php do_action('storefront_before_header'); ?>

        <?php
        /**
         * Custom Top Bar Hook
         */
        do_action('top_header');
        ?>

        <header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">

            <?php
            /**
             * Functions hooked into storefront_header action
             *
             * @hooked storefront_header_container                 - 0
             * @hooked storefront_skip_links                       - 5
             * @hooked storefront_social_icons                     - 10
             * @hooked storefront_site_branding                    - 20
             * @hooked storefront_secondary_navigation             - 30
             * @hooked storefront_product_search                   - 40
             * @hooked storefront_header_container_close           - 41
             * @hooked storefront_primary_navigation_wrapper       - 42
             * @hooked storefront_primary_navigation               - 50
             * @hooked storefront_header_cart                      - 60
             * @hooked storefront_primary_navigation_wrapper_close - 68
             */
            do_action('storefront_header');
            ?>

        </header><!-- #masthead -->

        <div class="content-container parallax">
            <?php

            /**
             * Post Title
             */
            if (!is_front_page()) {
            ?>
                <div class="page-title-container parallax-layer">
                    <h1 class="page-title">
                        <?php
                        if (is_shop()) {
                            echo woocommerce_page_title();
                        } else if (is_product_category()) {
                            echo single_tag_title("", false);
                        } else if (is_product()) {
                            global $post;
                            $terms = get_the_terms($post->ID, 'product_cat');
                            foreach ($terms  as $term) {
                                $product_cat_id = $term->term_id;
                                $product_cat_name = $term->name;
                                break;
                            }
                            echo $product_cat_name;
                        } else {
                            echo get_the_title();
                        } ?>
                    </h1>
                </div>
            <?php
            }

            /**
             * Poster Section
             */
            if (is_front_page()) : do_action('poster_section');
            endif;

            /**
             * Functions hooked in to storefront_before_content
             *
             * @hooked storefront_header_widget_region - 10
             * @hooked woocommerce_breadcrumb - 10
             */
            do_action('storefront_before_content');
            ?>

            <div id="content" class="site-content" tabindex="-1">
                <div class="col-full">
                    <?php
                    do_action('storefront_content_top');
