<?php
/**
 * Class DRP_Recipe_CPT
 *
 * Registers the "Recipe" Custom Post Type (CPT) for the Digital Recipe Platform plugin.
 */
class DRP_Recipe_CPT {
    /**
     * Register the "recipe" custom post type.
     *
     * This function sets up:
     *  - Labels (UI text shown in WP Admin for Recipe posts).
     *  - Public visibility (front-end accessible).
     *  - Menu icon (uses Dashicons carrot).
     *  - Supports (title, editor, thumbnail, excerpt).
     *  - Archive page (`/recipes`).
     *  - REST API support (for Gutenberg + API usage).
     *
     * @return void
     */
    public function register()
    {
        $labels = array(
            'name' => __( 'Recipes', 'digital-recipe-platform' ),
            'singular_name' => __( 'Recipe', 'digital-recipe-platform' ),
            'add_new_item' => __( 'Add New Recipe', 'digital-recipe-platform' ),
            'edit_item' => __( 'Edit Recipe', 'digital-recipe-platform' ),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-carrot',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'recipes' ),
            'show_in_rest' => true,
        );

        register_post_type( 'recipe', $args );
    }
}
