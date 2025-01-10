# WP Same Term Pager – WordPress Term-Based Navigation Plugin
WP Same Term Pager is a WordPress plugin that allows you to navigate posts within the same category, tag, or custom taxonomy seamlessly.

## Download Latest Version
For non-developers, please download the file named wp-sameterm-pager-{version}.zip, where {version} represents the specific version number.
[Download from GitHub](https://github.com/sorano-emaki/wp-sameterm-pager/releases/latest)
For developers, please clone the develop branch of the GitHub repository to use it.

## What is the Same Term Pager Plugin?
This plugin displays pagination for post pages filtered by the same term (such as category, tag, or custom taxonomy item).

Even if a post is registered under multiple terms, it enables navigation to previous and next posts based on post date while maintaining the same term filter.

The previous and next post links include an icon indicating direction, a thumbnail of the featured image (or a "No Image" thumbnail if no featured image is set), and the post title, all displayed in a single line. This visually clear navigation allows users to move between posts easily.

Using the "oldest" link, you can navigate to the post with the earliest publication date, while the "latest" link lets you move to the most recent post, both filtered by the same term.

The term filter (smtrm_filter) is activated based on the type of archive page the user navigates from, such as a category, tag, or custom taxonomy archive page. It does not activate when moving from the front page, date-based archive, author archive, search results page, or external websites.

The filter can be removed at any time using the "Release" button.

When the filter is removed, users can navigate to previous and next posts by post date or move to the oldest or latest post among all posts.

### What Does "Term" Mean in WordPress?
Terms are items that categorize posts (taxonomy) in WordPress.

For example, WordPress includes two default taxonomies: categories and tags. Each individual item within these taxonomies (such as each category or tag) is called a term.

### What is a Pager?
A pager refers to a post pagination feature. In this plugin, "pager" is used synonymously with "pagination."

To help visitors easily find the articles they want, pagers often appear on post pages, providing navigation links to move to the previous or next post.

On archive pages, pagers usually appear as "Previous," "Next," and numbered page links.

The Same Term Pager plugin offers a pager specifically designed for post pages, including a filter feature that limits navigation to posts within the same term.


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
English is the default language used in the plugin.

The Japanese environment can be used as-is since the translation files have already been prepared.

If you would like to help us with multilingualization, please contact the developer, and we will handle the part of the operation procedure below if you help us only with translation by Poedit or other means.

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
