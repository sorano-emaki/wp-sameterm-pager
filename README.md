# WP Same Term Pager – WordPress Term-Based Navigation Plugin
WP Same Term Pager is a WordPress plugin that allows you to navigate posts within the same category, tag, or custom taxonomy seamlessly.

## Download Latest Version
For non-developers, please download the file named wp-sameterm-pager-{version}.zip, where {version} represents the specific version number.
[Download from GitHub](https://github.com/sorano-emaki/wp-sameterm-pager/releases/latest)

For developers, please clone the develop branch of the GitHub repository to use it.

## Readme in Other Languages

- [日本語 (Japanese)](README-ja.md)

## What is the Same Term Pager Plugin?
This plugin displays pagination for post pages filtered by the same term (such as category, tag, or custom taxonomy item).

Even if a post is registered under multiple terms, it enables navigation to previous and next posts based on post date while maintaining the same term filter.

The previous and next post links include an icon indicating direction, a thumbnail of the featured image (or a "No Image" thumbnail if no featured image is set), and the post title, all displayed in a single line. This visually clear navigation allows users to move between posts easily.

Using the "oldest" link, you can navigate to the post with the earliest publication date, while the "latest" link lets you move to the most recent post, both filtered by the same term.

The term filter (smtrm_filter) is activated based on the type of archive page the user navigates from, such as a category, tag, or custom taxonomy archive page. It does not activate when moving from the front page, date-based archive, author archive, search results page, or external websites.

The filter can be removed at any time using the "Clear" button.

When the filter is removed, users can navigate to previous and next posts by post date or move to the oldest or latest post among all posts.

### What Does "Term" Mean in WordPress?
Terms are items that categorize posts (taxonomy) in WordPress.

For example, WordPress includes two default taxonomies: categories and tags. Each individual item within these taxonomies (such as each category or tag) is called a term.

### What is a Pager?
A pager refers to a post pagination feature. In this plugin, "pager" is used synonymously with "pagination."

To help visitors easily find the articles they want, pagers often appear on post pages, providing navigation links to move to the previous or next post.

On archive pages, pagers usually appear as "Previous," "Next," and numbered page links.

The Same Term Pager plugin offers a pager specifically designed for post pages, including a filter feature that limits navigation to posts within the same term.

## Developer Hooks

WP Same Term Pager provides filter hooks that allow developers to customize the plugin's behavior and appearance using PHP code.

These hooks are intended for users who are familiar with WordPress development.

### Available Filters

| Filter Hook | Description |
|---|---|
| `smtrm_get_post_args` | Customize the arguments passed to `get_posts()`. |
| `smtrm_wrapper_classes` | Customize the CSS classes of the pagination wrapper. |
| `smtrm_title_allowed_html` | Customize the HTML tags allowed in post titles. |
| `smtrm_thumbnail_type` | Choose between CSS background images and `<img>` elements for thumbnails. |
| `smtrm_clear_button_label` | Customize the default label of the filter clear button. |

### Usage Examples

Add the following code to your theme's `functions.php` file or a custom plugin.

**1. Customize Post Query Arguments**

Use `smtrm_get_post_args` to modify the arguments passed to `get_posts()`.

**Filter Posts by Modification Date**

This example limits pagination to posts modified on or after January 1, 2026.

```php
add_filter('smtrm_get_post_args', function ($args) {
    $args['date_query'] = array(
        array(
            'column'    => 'post_modified',
            'after'     => '2026-01-01',
            'inclusive' => true,
        ),
    );

    return $args;
});
```

**Note:**  This example adds a date condition to the post query. Use this filter when you need to narrow down the posts within an existing set of conditions. Applying restrictive conditions globally may exclude posts that would otherwise appear in the pagination.

**2. Add Custom CSS Classes**

```php
add_filter('smtrm_wrapper_classes', function ($classes) {
    $classes[] = 'my-custom-class';
    return $classes;
});
```

**3. Allow Additional HTML Tags in Post Titles**

By default, only the `<br>` tag is allowed in post titles.
In the following example, `<span>` and `<strong>` are also allowed.

```php
add_filter('smtrm_title_allowed_html', function ($tags) {
    $tags['span'] = array(
        'class' => true,
    );
    $tags['strong'] = array();
    return $tags;
});
```

**4. Change the Thumbnail Display Method**

The default thumbnail display method uses CSS background images. To use the previous `<img>` method instead:

```php
add_filter('smtrm_thumbnail_type', function ($type) {
    return 'img';
});
```

**5. Change the Default Clear Button Label**

```php
add_filter('smtrm_clear_button_label', function ($label) {
    return 'Clear Filter';
});
```

## System Requirements
- WordPress Version:5.2 or higher
- PHP Version:7.3 or higher

## Development Environment

### Tools and Technologies
- **WordPress**: 5.2 and above (tested on versions 5.2 to 6.7.1)
- **PHP**: 7.3 and above
- **Database**: MySQL 5.7
- **Node.js**: 20.16.x
- **yarn**: 1.22.x

### Key Packages
- **@wordpress/scripts**: For build scripts and asset management
- **react** / **react-dom**: React-based admin panel

### Linters and Formatters
- **PHP-CS-Fixer**: Applied to all PHP files in the `includes` directory

### Other Tools
- **GitHub**: Version control and repository hosting
- **VSCode**: Primary code editor
- **WSL (Ubuntu)**: Used for command-line operations

### Translation

- **Translation Files**: `.pot`, `.mo`, `.po`, and JSON translation files are located in the `languages` directory.

The default language of this plugin is English.

For users in Japanese environments, translation files are already included, so you can use the plugin as-is.

If you would like to contribute to the plugin's localization, please contact the developer. You can assist by providing translations using tools like Poedit, and we will handle the operational steps outlined below on your behalf.

- **Tools Used**:
  - **WordPress CLI**:
    - Command to generate `.pot`:  
      `wp i18n make-pot . languages/wp-sameterm-pager.pot --exclude=src`
    - Command to generate JSON files from `.po`:  
      `wp i18n make-json ./languages/ --no-purge`
        - This generates the JSON files required for JavaScript-based translations, such as those used in React components.
- **Steps to Update Translations**:
  1. Ensure the WordPress CLI is installed and the `php-mbstring` extension is enabled.
  2. Run the `make-pot` command in the project root directory to generate or update the `.pot` file.
  3. Use a translation editor (e.g., Poedit or Loco Translate) to edit `.po` files and update `.mo` files.
  4. Run the `make-json` command to convert updated `.po` files into JSON files for use in JavaScript-based components.
- **Supported Languages**:
  - Japanese (`ja`)
- **Important Notes**:
  - The `--no-purge` flag ensures existing JSON files are not deleted, allowing incremental updates to be applied.
  - Ensure the generated JSON files are correctly loaded into your scripts via `wp_set_script_translations`.

# Disclaimer
This plugin is provided as a beta version, and its specifications are subject to change without prior notice. The developer shall not be held responsible for any damages or issues arising from the use of this plugin.

While efforts have been made to ensure the plugin’s functionality, it may still contain bugs or unintended behavior. Users are encouraged to test the plugin in a staging or development environment before deploying it in a production setting.

By using this plugin, you acknowledge and agree to these terms. If you encounter issues, please report them via the support page or GitHub repository.

# Author
Emaki Sorano

# Author URI
https://shokizerokara.com/

# License
GPLv2
