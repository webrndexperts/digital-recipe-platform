<?php
$testimonials = $attributes['testimonials'] ?? [];
$slides_per_view = $attributes['slidesPerView'] ?? 1;
$show_arrows = $attributes['showArrows'] ?? true;
$show_dots = $attributes['showDots'] ?? true;
$breakpoints = $attributes['breakpoints'] ?? [];
$loop = $attributes['loop'] ?? true;
$autoplay = $attributes['autoplay'] ?? true;
$delay = $attributes['delay'] ?? 1000;

$wrapper_attributes = get_block_wrapper_attributes([
    'class'               => 'wp-block-my-plugin-testimonial-slider',
    'data-slidesperview'  => $slides_per_view,
    'data-loop'           => $loop ? 'true' : 'false',
    'data-autoplay'       => $autoplay ? 'true' : 'false',
    'data-breakpoints'    => esc_attr(json_encode($breakpoints)),
]);

?>

<div <?php echo $wrapper_attributes; ?>>
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($testimonials as $testimonial) : ?>
                <div class="swiper-slide">
                    <?php if (!empty($testimonial['imageUrl'])) : ?>
                        <img src="<?php echo esc_url($testimonial['imageUrl']); ?>" alt="<?php echo esc_attr($testimonial['author'] ?? ''); ?>" class="testimonial-image" />
                    <?php elseif (!empty($testimonial['imageId'])) : ?>
                        <?php echo wp_get_attachment_image( $testimonial['imageId'], 'full' ); ?>
                    <?php endif; ?>

                    <p class="testimonial-text"><?php echo esc_html($testimonial['text'] ?? ''); ?></p>
                    <p class="testimonial-author"><?php echo esc_html($testimonial['author'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($show_dots) : ?>
            <div class="swiper-pagination"></div>
        <?php endif; ?>
        <?php if ($show_arrows) : ?>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        <?php endif; ?>
    </div>
</div>