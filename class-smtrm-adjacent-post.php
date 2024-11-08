<?php
if(!defined('ABSPATH')) { exit; }
class Smtrm_Adjacent_Post{
    public static function smtrm_param_check(){
        $get_filter = isset($_GET['smtrm_filter']) ? intval($_GET['smtrm_filter']) : 0;
        $taxonomy = '';
        $term_exists = 0;
        $get_term = 0;
        if($get_filter){
            $term_exists = term_exists($get_filter);
        }
        if(!empty($term_exists) ){
            $get_term = get_term( $get_filter );
            $taxonomy = $get_term -> taxonomy;
            }
        return [$get_filter,$taxonomy,$term_exists,$get_term];
    }
    function smtrm_post_join($join,$in_same_term, $excluded_terms) {
        list($get_filter,$taxonomy,$term_exists,$get_term) = self::smtrm_param_check();
        global $post, $wpdb;
        if(!empty($term_exists) ){
            //  タームが存在する場合だけ、term_relationshipsとterm_taxonomyをINNER JOIN
            return $join  .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
        }
        return $join;  // その他はそのままreturn
    }
    function smtrm_post_where($where, $in_same_term, $excluded_terms) {
        list($get_filter,$taxonomy,$term_exists,$get_term) = self::smtrm_param_check();
        global $post, $wpdb;
        if(!empty($term_exists) ){
            //  タームが存在する場合だけ、taxonomy名とterm_idで絞り込む
            $where .= $wpdb->prepare(' AND tt.taxonomy = %s', $taxonomy );
            $where .= $wpdb->prepare(' AND tt.term_id =  %d',intval($get_filter) );
            return $where;
        }
        return $where; // その他はそのままreturn
    }
    function smtrm_add_param_to_post_link($link_html, $format, $link){
        list($get_filter,$taxonomy,$term_exists,$get_term) = self::smtrm_param_check();
        if($link_html){
            if(!empty($term_exists) ){
                preg_match('/href="([^"]+)"/', $link_html, $matches);
                $original_url = $matches[1];

                // URLにクエリパラメータを追加
                $new_url = add_query_arg(array(
                    'smtrm_filter' =>  esc_attr($get_filter),    // 追加するパラメータ
                ), $original_url);

                // 新しいURLでリンクを再構築
                $link_html = str_replace($original_url, $new_url, $link_html);
                return $link_html;
            }
            else{
                return $link_html;
            }
        }
    }
}
$smtrm_adj_post = new Smtrm_Adjacent_Post;
add_filter('get_next_post_where', array($smtrm_adj_post,'smtrm_post_where'), 10, 3);
add_filter('get_next_post_join', array($smtrm_adj_post,'smtrm_post_join'), 10, 3);
add_filter('get_previous_post_where', array($smtrm_adj_post,'smtrm_post_where'), 10, 3);
add_filter('get_previous_post_join',  array($smtrm_adj_post,'smtrm_post_join'), 10, 3);
add_filter('previous_post_link',  array($smtrm_adj_post,'smtrm_add_param_to_post_link'), 10, 3);
add_filter('next_post_link',  array($smtrm_adj_post,'smtrm_add_param_to_post_link'), 10, 3);