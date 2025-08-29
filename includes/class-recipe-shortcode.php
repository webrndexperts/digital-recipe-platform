<?php
class DRP_Recipe_Shortcode {
    public function register() {
        add_shortcode( 'recipe_search', [ $this, 'render_shortcode' ] );

        // AJAX hooks
        add_action( 'wp_ajax_drp_recipe_search', [ $this, 'ajax_search' ] );
        add_action( 'wp_ajax_nopriv_drp_recipe_search', [ $this, 'ajax_search' ] );
    }

    public function render_shortcode( $atts ) {
        ob_start(); ?>
        
        <div id="drp-recipe-search">
            <input type="text" id="drp-search-input" placeholder="Search recipes..." />
            <div id="drp-loader" style="display:none;">🔄 Loading...</div>
            <div id="drp-results" aria-live="polite">
                <?php $this->render_recipes(); ?>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }

    private function render_recipes( $search = '' ) {
        $args = [
            'post_type'      => 'recipe',
            'posts_per_page' => 6,
            's'              => $search,
        ];

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<ul class="drp-recipe-list">';
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<li class="drp-recipe-item">';
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'thumbnail' );
                }
                echo '<h4><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No recipes found.</p>';
        }
        wp_reset_postdata();
    }

    public function ajax_search() {
        // Nonce verification
        if ( ! isset($_POST['_ajax_nonce']) || ! wp_verify_nonce($_POST['_ajax_nonce'], 'drp_recipe_nonce') ) {
            wp_send_json_error( [ 'message' => 'Invalid request' ] );
        }

        $search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';
        ob_start();
        $this->render_recipes( $search );
        $html = ob_get_clean();

        wp_send_json_success( [ 'html' => $html ] );
    }
}
