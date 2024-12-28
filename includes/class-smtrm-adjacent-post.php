<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Class Smtrm_Adjacent_Post
 *
 * This class handles post navigation within the same term.
 * It adds parameters to post links and filters posts based on the current term.
 *
 * @since 0.9.18
 */
if ( ! class_exists( 'Smtrm_Adjacent_Post' ) ) {
    class Smtrm_Adjacent_Post
    {
        public function __construct() {
            add_filter('get_next_post_where', array($this,'smtrm_post_where'), 10, 3);
            add_filter('get_next_post_join', array($this,'smtrm_post_join'), 10, 3);
            add_filter('get_previous_post_where', array($this,'smtrm_post_where'), 10, 3);
            add_filter('get_previous_post_join', array($this,'smtrm_post_join'), 10, 3);
            add_filter('previous_post_link', array($this,'smtrm_add_param_to_post_link'), 10, 3);
            add_filter('next_post_link', array($this,'smtrm_add_param_to_post_link'), 10, 3);
        }
        /**
         * Check and retrieve term-related parameters from the URL.
         *
         * This method extracts the `smtrm_filter` parameter from the URL and verifies if the term exists.
         * If the term exists, it retrieves the term information.
         *
         * @return array An array containing the term ID, taxonomy name, existence flag, and term object.
         * @since 0.9.18
         */
        public static function smtrm_param_check()
        {
            // タームの存在をチェックし、パラメータを返す
            /* Check for the term's existence and return parameters. */
            $get_filter = isset($_GET['smtrm_filter']) ? intval($_GET['smtrm_filter']) : 0;
            $taxonomy = '';
            $term_exists = 0;
            $get_term = 0;
            if ($get_filter) {
                $term_exists = term_exists($get_filter);
            }
            if (!empty($term_exists)) {
                $get_term = get_term($get_filter);
                $taxonomy = $get_term -> taxonomy;
            }
            return [$get_filter,$taxonomy,$term_exists,$get_term];
        }
        /**
         * Modify the SQL JOIN clause for retrieving posts within the same term.
         *
         * If a valid term is found, the query is modified to join `term_relationships` and `term_taxonomy` tables.
         *
         * @param string $join The existing SQL JOIN clause.
         * @param bool $in_same_term Whether to include posts in the same term.
         * @param array $excluded_terms An array of terms to exclude.
         * @return string The modified or original SQL JOIN clause.
         * @since 0.9.18
         */
        public function smtrm_post_join($join, $in_same_term, $excluded_terms)
        {
            list($get_filter, $taxonomy, $term_exists, $get_term) = self::smtrm_param_check();
            global $post, $wpdb;
            if (!empty($term_exists)) {
                //  タームが存在する場合だけ、term_relationshipsとterm_taxonomyをINNER JOIN
                /* Add INNER JOIN if the term exists. */
                return $join  .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
            }
            // その他はそのままreturn
            return $join;
        }
        /**
         * Modify the SQL WHERE clause for retrieving posts within the same term.
         *
         * If a valid term is found, the query is modified to filter posts based on the taxonomy and term ID.
         *
         * @param string $where The existing SQL WHERE clause.
         * @param bool $in_same_term Whether to include posts in the same term.
         * @param array $excluded_terms An array of terms to exclude.
         * @return string The modified or original SQL WHERE clause.
         * @since 0.9.18
         */
        public function smtrm_post_where($where, $in_same_term, $excluded_terms)
        {
            list($get_filter, $taxonomy, $term_exists, $get_term) = self::smtrm_param_check();
            global $post, $wpdb;
            if (!empty($term_exists)) {
                //  タームが存在する場合だけ、taxonomy名とterm_idで絞り込む
                /* Filter by taxonomy and term ID if the term exists. */
                $where .= $wpdb->prepare(' AND tt.taxonomy = %s', $taxonomy);
                $where .= $wpdb->prepare(' AND tt.term_id =  %d', intval($get_filter));
                return $where;
            }
            // その他はそのままreturn
            return $where;
        }
        /**
         * Add a custom parameter to post links.
         *
         * This method modifies the post link URL by appending the `smtrm_filter` parameter if a valid term exists.
         *
         * @param string $link_html The original HTML for the post link.
         * @param string $format The format of the link.
         * @param string $link The link display text. Default '%title'.
         * @return string The modified post link HTML.
         * @since 0.9.18
         */
        public function smtrm_add_param_to_post_link($link_html, $format, $link)
        {
            list($get_filter, $taxonomy, $term_exists, $get_term) = self::smtrm_param_check();
            if ($link_html) {
                if (!empty($term_exists)) {
                    preg_match('/href="([^"]+)"/', $link_html, $matches);
                    $original_url = $matches[1];

                    /* Add parameter to URL and generate a new link. */
                    // URLにクエリパラメータを追加
                    $new_url = add_query_arg(array(
                        // 追加するパラメータ
                        'smtrm_filter' =>  esc_attr($get_filter), 
                    ), $original_url);

                    // 新しいURLでリンクを再構築
                    $link_html = str_replace($original_url, $new_url, $link_html);
                    return $link_html;
                } else {
                    return $link_html;
                }
            }
        }
    }
    new Smtrm_Adjacent_Post;
}