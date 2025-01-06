<?php

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Smtrm_Widget')) {
    class Smtrm_Widget extends WP_Widget
    {
        private $pager;

        /**
         * Constructor for the WP Same Term Pager widget.
         *
         * Initializes the widget with its ID, name, and description.
         *
         * @since 0.10.0
         *
         * @param Smtrm_Pager_Interface $pager An instance of a pager implementing the Smtrm_Pager_Interface.
         */
        public function __construct(Smtrm_Pager_Interface $pager)
        {
            parent::__construct(
                'sameterm_pager_widget',
                __('WP Same Term Pager', 'wp-sameterm-pager'),
                array('description' => __('Display a pager on posts that can be filtered by category, tags or taxonomy.', 'wp-sameterm-pager'))
            );
            $this->pager = $pager;
        }

        /**
         * Outputs the content of the widget.
         *
         * Displays the pager on posts that can be filtered by category, tags, or taxonomy.
         * Handles any exceptions that occur while rendering the pager and logs them.
         *
         * @since 0.10.0
         *
         * @param array $args An array of widget display arguments including 'before_title', 'after_title',
         *                    'before_widget', and 'after_widget' provided by [register_sidebar].
         * @param array $instance An array of settings for the widget instance.
         *
         * @return void
         */
        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            try {
                echo $this->pager->get_pager_area();
            } catch (\Exception $e) {
                error_log('Pager error: ' . $e->getMessage());
                echo esc_html(__('An error occurred while displaying the pager.', 'wp-sameterm-pager'));
            }

            echo $args['after_widget'];
        }

        /**
         * Outputs the settings update form.
         *
         * This function is called in the admin panel to display the widget's settings form.
         *
         * @since 0.10.0
         *
         * @param array $instance An array of the current settings for the widget.
         *
         * @return void
         */
        public function form($instance)
        {
        }

        /**
         * Handles updating the widget's settings.
         *
         * Processes the widget's settings update when they are saved.
         *
         * @since 0.10.0
         *
         * @param array $new_instance An array of the new settings for the widget.
         * @param array $old_instance An array of the previous settings for the widget.
         *
         * @return array Updated settings to save.
         */
        public function update($new_instance, $old_instance)
        {
            return array();
        }
    }

    function register_smtrm_widget()
    {
        $pager = new Smtrm_Pager();
        register_widget(new Smtrm_Widget($pager));
    }
    add_action('widgets_init', 'register_smtrm_widget');
}
