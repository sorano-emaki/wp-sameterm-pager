<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Widget_Area')) {
    class Smtrm_Widget_Area
    {
        public function __construct()
        {
            add_action('widgets_init', array($this, 'smtrm_register_widget'));
            $theme = get_template();
            if ($theme == 'cocoon-master' || $theme == 'cocoon-child') {
                add_action('cocoon_part_after__tmp/header-container', array($this, 'insert_before_post'));
                add_action('cocoon_part_before__tmp/footer-bottom', array($this, 'insert_after_post'));
            } else {
                add_action('get_footer', array($this, 'insert_after_post'));
            }
        }

        /**
         * Registers widget areas for the pager.
         *
         * This method registers two widget areas: 'Pager Top' and 'Pager Bottom'.
         * These areas are designed to be used in the widget section of the WordPress admin interface.
         * Each widget area has a unique ID and description for easy identification.
         *
         * @since 0.10.0
         *
         * @return void
         */
        public function smtrm_register_widget()
        {
            register_sidebar(array(
                'name' => 'Pager Top',
                'id' => 'smtrm-pager-top',
                'description' => 'Pager Top',
                'before_widget' => '<div id="%1$s" class="smtrm-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="smtrm-widget-title">',
                'after_title' => '</h3>',
            ));
            register_sidebar(array(
                'name' => 'Pager Bottom',
                'id' => 'smtrm-pager-bottom',
                'description' => 'Pager Bottom',
                'before_widget' => '<div id="%1$s" class="smtrm-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="smtrm-widget-title">',
                'after_title' => '</h3>',
            ));
        }

        /**
         * Retrieves the contents of a dynamic sidebar as a string.
         *
         * This method captures the output of the dynamic sidebar with the given index.
         * It uses output buffering to store and return the sidebar's contents as a string.
         *
         * @since 0.10.0
         *
         * @param int|string $index The index or ID of the sidebar to retrieve. Default is 1.
         * @return string The contents of the sidebar.
         */
        public function get_dynamic_sidebar($index = 1)
        {
            $sidebar_contents = '';
            ob_start();
            dynamic_sidebar($index);
            $sidebar_contents = ob_get_clean();
            return $sidebar_contents;
        }

        /**
         * Inserts the top pager widget area before the post content.
         *
         * This method is designed to insert the contents of the 'Pager Top' widget area
         * above the post content when viewing a single post.
         *
         * @since 0.10.0
         *
         * @return void
         */
        public function insert_before_post()
        {
            if (is_single()) {
                $snippets = $this->get_dynamic_sidebar('smtrm-pager-top');
                if (!empty($snippets)) {
                    echo $snippets;
                }
            } else {
                return;
            }
        }

        /**
         * Inserts the bottom pager widget area after the post content.
         *
         * This method is designed to insert the contents of the 'Pager Bottom' widget area
         * below the post content when viewing a single post.
         *
         * @since 0.10.0
         *
         * @return void
         */
        public function insert_after_post()
        {
            if (is_single()) {
                $snippets = $this->get_dynamic_sidebar('smtrm-pager-bottom');
                if (!empty($snippets)) {
                    echo $snippets;
                }
            } else {
                return;
            }
        }
    }
    new Smtrm_Widget_Area();
}
