<?php
class DRP_Activator {

    /**
     * Run on plugin activation
     */
    public static function activate()
    {
        global $wpdb;

        $table_name      = $wpdb->prefix . 'drp_recipes_meta';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            recipe_id bigint(20) unsigned NOT NULL,
            prep_time int(11) DEFAULT 0,
            cook_time int(11) DEFAULT 0,
            servings int(11) DEFAULT 0,
            difficulty varchar(20) DEFAULT 'Easy',
            ingredients longtext NULL,
            instructions longtext NULL,
            gallery text NULL,
            nutrition text NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY recipe_id (recipe_id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
    }

    /**
     * Run on plugin uninstall (delete completely)
     */
    public static function uninstall()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'drp_recipes_meta';

        // Drop custom table
        $wpdb->query( "DROP TABLE IF EXISTS $table_name" );

        // Delete all recipes
        $recipes = get_posts( array(
            'post_type'   => 'recipe',
            'numberposts' => -1,
            'post_status' => 'any',
        ) );

        foreach ( $recipes as $recipe ) {
            wp_delete_post( $recipe->ID, true );
        }
    }
}