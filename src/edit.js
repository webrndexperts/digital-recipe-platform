import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button, ToggleControl } from '@wordpress/components';
import '../editor.css';

export default function Edit({ attributes, setAttributes }) {
    const { testimonials, slidesPerView, delay, loop, autoplay, showArrows, showDots, breakpoints } = attributes;

    const addTestimonial = () => {
        const newTestimonials = [...testimonials, { text: '', author: '', imageUrl: '', imageId: null }];
        setAttributes({ testimonials: newTestimonials });
    };

    const setBreakpoint = (width, slides) => {
        const newBreakpoints = { ...breakpoints };
        if (slides) {
            newBreakpoints[width] = { slidesPerView: parseInt(slides, 10) };
        } else {
            delete newBreakpoints[width];
        }
        setAttributes({ breakpoints: newBreakpoints });
    };

    const removeTestimonial = (index) => {
        const newTestimonials = testimonials.filter((_, i) => i !== index);
        setAttributes({ testimonials: newTestimonials });
    };

    const updateTestimonial = (index, key, value) => {
        const newTestimonials = testimonials.map((testimonial, i) => {
            if (i === index) {
                return { ...testimonial, [key]: value };
            }
            return testimonial;
        });
        setAttributes({ testimonials: newTestimonials });
    };

    const onSelectImage = (media, index) => {
        updateTestimonial(index, 'imageUrl', media.url);
        updateTestimonial(index, 'imageId', media.id);
    };

    return (
        <div {...useBlockProps()}>
            <InspectorControls>
                <PanelBody title={__('Slider Settings', 'testimonial-slider')}>
                    <TextControl
                        label={__('Slides Per View', 'testimonial-slider')}
                        type="number"
                        value={slidesPerView}
                        onChange={(val) => setAttributes({ slidesPerView: parseInt(val, 10) })}
                        min="1"
                    />
                    <TextControl
                        label={__('Delay', 'testimonial-slider')}
                        type="number"
                        value={delay}
                        onChange={(val) => setAttributes({ delay: parseInt(val, 10) })}
                        min="1"
                    />
                    <ToggleControl
                        label={__('Loop', 'testimonial-slider')}
                        checked={loop}
                        onChange={(val) => setAttributes({ loop: val })}
                    />
                    <ToggleControl
                        label={__('Autoplay', 'testimonial-slider')}
                        checked={autoplay}
                        onChange={(val) => setAttributes({ autoplay: val })}
                    />
                    <ToggleControl
                        label={__('Show Arrows', 'testimonial-slider')}
                        checked={showArrows}
                        onChange={(val) => setAttributes({ showArrows: val })}
                    />
                    <ToggleControl
                        label={__('Show Dots', 'testimonial-slider')}
                        checked={showDots}
                        onChange={(val) => setAttributes({ showDots: val })}
                    />
                </PanelBody>
                <PanelBody title={__('Responsive Settings', 'testimonial-slider')} initialOpen={false}>
                    <p>{__('Leave blank to use the default Slides Per View.', 'testimonial-slider')}</p>
                    <TextControl
                        label={__('Desktop (1024px)', 'testimonial-slider')}
                        type="number"
                        value={breakpoints?.[1024]?.slidesPerView || ''}
                        onChange={(val) => setBreakpoint(1024, val)}
                        min="1"
                    />
                    <TextControl
                        label={__('Tablet (768px)', 'testimonial-slider')}
                        type="number"
                        value={breakpoints?.[768]?.slidesPerView || ''}
                        onChange={(val) => setBreakpoint(768, val)}
                        min="1"
                    />
                    <TextControl
                        label={__('Mobile (320px)', 'testimonial-slider')}
                        type="number"
                        value={breakpoints?.[320]?.slidesPerView || ''}
                        onChange={(val) => setBreakpoint(320, val)}
                        min="1"
                    />
                </PanelBody>
            </InspectorControls>

            {testimonials.map((testimonial, index) => (
                <div key={index} className="testimonial-editor-item">
                    <MediaUploadCheck>
                        <MediaUpload
                            onSelect={(media) => onSelectImage(media, index)}
                            allowedTypes={['image']}
                            value={testimonial.imageId}
                            render={({ open }) => (
                                <Button onClick={open} isSecondary>
                                    {!testimonial.imageId ? __('Upload Image', 'testimonial-slider') : __('Replace Image', 'testimonial-slider')}
                                </Button>
                            )}
                        />
                    </MediaUploadCheck>
                    {testimonial.imageUrl && (
                        <img src={testimonial.imageUrl} alt="" className="testimonial-image-preview" />
                    )}
                    <TextareaControl
                        label={`${__('Testimonial', 'testimonial-slider')} ${index + 1}`}
                        value={testimonial.text}
                        onChange={(val) => updateTestimonial(index, 'text', val)}
                    />
                    <TextControl
                        label={__('Author', 'testimonial-slider')}
                        value={testimonial.author}
                        onChange={(val) => updateTestimonial(index, 'author', val)}
                    />
                    <Button isDestructive onClick={() => removeTestimonial(index)}>
                        {__('Remove', 'testimonial-slider')}
                    </Button>
                </div>
            ))}

            <Button isPrimary onClick={addTestimonial}>
                {__('Add Testimonial', 'testimonial-slider')}
            </Button>
        </div>
    );
}