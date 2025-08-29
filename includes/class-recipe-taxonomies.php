<?php
/**
 * Class DRP_Recipe_Taxonomies
 *
 * Registers custom taxonomies for the "Recipe" CPT.
 * Currently adds "Recipe Categories" as a hierarchical taxonomy.
 */
class DRP_Recipe_Taxonomies {
    /**
     * Register all custom taxonomies for the Recipe CPT.
     *
     * @return void
     */
    public function register()
    {
        // Recipe Category (hierarchical)
        register_taxonomy( 'recipe_category', 'recipe', array(
            'label' => __( 'Recipe Categories', 'digital-recipe-platform' ),
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => array( 'slug' => 'recipe-category' ),
        ));
    }
}
