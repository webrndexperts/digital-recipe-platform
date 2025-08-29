<?php
/**
 * Enqueue frontend assets for the DRP plugin.
 *
 * This function loads Swiper (CSS/JS) and the plugin's custom JS 
 * only when needed:
 *   - On singular pages (single posts, pages, or CPTs).
 *   - OR if the Gutenberg block `drp/recipe-slider` is present on the page.
 *
 * By conditionally loading assets, we optimize performance and 
 * avoid unnecessary asset bloat.
 *
 * @return void
 */
function drp_enqueue_assets() {
    if ( is_singular() || has_block( 'drp/recipe-slider' ) ) {
        wp_enqueue_style(
            'swiper-css',
            'https://unpkg.com/swiper/swiper-bundle.min.css',
            array(),
            '8.4.5'
        );

        wp_enqueue_script(
            'swiper-js',
            'https://unpkg.com/swiper/swiper-bundle.min.js',
            array(),
            '8.4.5',
            true
        );

        wp_enqueue_script(
            'drp-frontend',
            DRP_URL . 'build/frontend.js',
            array( 'swiper-js' ),
            DRP_VERSION,
            true
        );

        // Adding shortcode related scripts.
        wp_enqueue_script(
            'drp-recipe-search',
            DRP_URL . 'assets/js/recipe-search.js',
            [ 'jquery' ],
            DRP_VERSION,
            true
        );

        wp_localize_script( 'drp-recipe-search', 'drp_ajax', [
            'url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'drp_recipe_nonce' ),
        ] );


    }
}
