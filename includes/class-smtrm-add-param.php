<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Class Smtrm_Add_Param
 *
 * This class handles adding parameters to permalinks when certain taxonomy conditions are met.
 *
 * @since 0.9.18
 */
if ( ! class_exists( 'Smtrm_Add_Param' ) ) {
    class Smtrm_Add_Param
    {
        public function __construct() {
            add_filter('post_link', array($this, 'add_param_link'), 10, 2);
            add_filter('post_type_link', array($this, 'add_param_link'), 10, 2);
        }
        /**
         * Add a custom parameter to the permalink.
         *
         * This method checks if the current view is a category, tag, or custom taxonomy archive.
         * If so, it appends the queried object's ID as a parameter to the permalink.
         *
         * @since 0.9.18
         * @param string $permalink The original permalink.
         * @return string $new_permalink The modified permalink with the added parameter.
         */
        public function add_param_link($permalink)
        {
            if (is_category() || is_tag() || is_tax()) {
                if (!is_admin() && is_main_query() && in_the_loop()) {
                    //パラメータを取得
                    /* This part handles adding the parameter to the permalink if conditions are met. */
                    $parameter = get_queried_object_id();
                    $new_permalink = add_query_arg('smtrm_filter', $parameter, $permalink);
                    return $new_permalink;
                }
            }
            return $permalink;
        }
    }
    new Smtrm_Add_Param();
}
