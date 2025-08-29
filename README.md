# Digital Recipe Platform
---

## Description

Digital Recipe Platform is a modern WordPress plugin designed for food bloggers, chefs, and culinary enthusiasts. It enables you to create, manage, and display recipes using a custom post type, custom taxonomies, and a powerful shortcode. The plugin features a responsive slider for showcasing recipes and integrates seamlessly with the WordPress block editor (Gutenberg).

---

## Features

- **Custom Recipe Post Type**
- **Custom Taxonomies for Categorizing Recipes**
- **Shortcode for Displaying Recipes Anywhere**
- **Responsive Recipe Slider**
- **Gutenberg Block Support**
- **Easy Asset Management**

---

## Installation

1. Upload the plugin files to the `/wp-content/plugins/digital-recipe-platform` directory, or install the plugin through the WordPress plugins screen directly.

```sh
# Install dependencies
npm install

# Build assets (if using a build tool like webpack)
npm run build

# Watch for changes and rebuild automatically
npm run start
```

2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Recipes menu to add and manage your recipes.
4. Create a Gutenberg Block named **Recipe Slider** but for now its not linked with the custom post type and is adding images and text statically.
5. Can manage:
	- Slides Per View
	- Delay
	- Loop 
	- Autoplay
	- Show arrows
	- Show Dots
	- Responsive Screen.
		- Desktop (1024px)
		- Tablet (768px)
		- Mobile (320px)

---

## Usage

- Add new recipes via the WordPress admin dashboard.
- Use the `[drp_recipes]` shortcode to display recipes on any page or post.
- Customize recipe categories and tags using the built-in taxonomies.
- Enjoy the responsive slider and Gutenberg block integration for modern layouts.

---

## Frequently Asked Questions

**Q: Can I customize the recipe post type?**  
A: Yes, you can extend the plugin by editing the code or using hooks and filters.

**Q: Does it support Gutenberg blocks?**  
A: Yes, the plugin registers a block for use in the block editor.

---

### 1.0.0
- Initial release.

---

## License

This plugin is licensed under the GPLv2 or later.