<?php
if (!defined('ABSPATH')) {
    exit;
}

class Smtrm_Pager implements Smtrm_Pager_Interface
{
    private static $post_type;
    private static $cat_id_num;
    private static $tag_id_num;
    private static $term_id_num;
    private static $get_filter;
    private static $taxonomy;
    private static $term_exists;
    private static $get_term;
    private static $oldest;
    private static $latest;
    private static $prevpost;
    private static $nextpost;

    // 投稿データのセット処理
    public function set_post_data() {
        if (is_single()) {
            self::$post_type = get_post_type();
            list(self::$get_filter, self::$taxonomy, self::$term_exists, self::$get_term) = Smtrm_Adjacent_Post::smtrm_param_check();
            $link = new Smtrm_Get_Link;

            if (self::$taxonomy == 'category') {
                self::$cat_id_num = self::$get_filter;
            } elseif (self::$taxonomy == 'post_tag') {
                self::$tag_id_num = self::$get_filter;
            } else {
                self::$term_id_num = self::$get_filter;
            }

            self::$oldest = $this->smtrm_get_post('ASC');
            self::$latest = $this->smtrm_get_post('DESC');
            self::$prevpost = get_adjacent_post(false, '', true);
            self::$nextpost = get_adjacent_post(false, '', false);
        }
    }

    function sameterm_pager()
    {
        if (is_single()) {
            $this->set_post_data();  // 投稿データのセット
            echo '<div class="same-term-pager-wrapper">';
            if (self::$prevpost || self::$nextpost) {
                echo '<nav class="same-term-pager cf">';
                if(self::$prevpost){
                    echo $this->display_oldest_post();
                }
                echo $this->display_prev_post();
                echo $this->display_next_post();
                if(self::$nextpost){
                    echo $this->display_latest_post();
                }
                echo '</nav>';
            }
            self::smtrm_pager_release_button();
            echo '</div>';
        }
    }

    // 最古の記事
    public function display_oldest_post() {
        if (self::$prevpost) {
            $default_oldest_text = __('<span class="pc-none">Read the oldest post</span><span class="sp-none">Oldest</span>', 'wp-sameterm-pager');
            $saved_setting = new Smtrm_Get_Setting;
            $link = new Smtrm_Get_Link;
            $oldest_post_text = $saved_setting->pager_oldest_text();
            if(!$oldest_post_text){
                $oldest_post_text = $default_oldest_text;
            }
            return '<a href="' . $link->get_link(self::$get_filter, self::$oldest[0]) . '" class="oldest-post same-term-nav-link">' .
                '<div class="double-left same-term-icon" aria-hidden="true"></div>' .
                '<span>' . wp_kses_post($oldest_post_text) . '</span>' .
                '</a>';
        }
        return '<div class="oldest-post"></div>';
    }

    // 前の記事
    public function display_prev_post() {
        if (self::$prevpost) {
            $link = new Smtrm_Get_Link;
            $thumbnail = has_post_thumbnail(self::$prevpost->ID) ?
                get_the_post_thumbnail(self::$prevpost->ID, 'post-thumbnail', array('class' => 'attachment-thumb240 size-thumb240')) :
                '<img width="120" height="68" alt="no-image" src="' . SMTRM_DIR_URL . 'images/no-image.png" class="no-image post-navi-no-image" />';

            return '<a href="' . $link->get_link(self::$get_filter, self::$prevpost->ID) . '" title="' . esc_attr(get_the_title(self::$prevpost->ID)) . '" class="prev-post same-term-nav-link">' .
                '<div class="arrow-left same-term-icon" aria-hidden="true"></div>' .
                '<figure class="prev-post-thumb">' . $thumbnail . '</figure>' .
                '<div class="prev-post-title"><span>' . get_the_title(self::$prevpost->ID) . '</span></div>' .
                '</a>';
        }
        return '<div class="prev-post"></div>';
    }

    // 次の記事
    public function display_next_post() {
        if (self::$nextpost) {
            $link = new Smtrm_Get_Link;
            $thumbnail = has_post_thumbnail(self::$nextpost->ID) ?
                get_the_post_thumbnail(self::$nextpost->ID, 'post-thumbnail', array('class' => 'attachment-thumb240 size-thumb240')) :
                '<img width="120" height="68" alt="no-image" src="' . SMTRM_DIR_URL . 'images/no-image.png" class="no-image post-navi-no-image" />';

            return '<a href="' . $link->get_link(self::$get_filter, self::$nextpost->ID) . '" title="' . esc_attr(get_the_title(self::$nextpost->ID)) . '" class="next-post same-term-nav-link">' .
                '<div class="arrow-right same-term-icon" aria-hidden="true"></div>' .
                '<figure class="next-post-thumb">' . $thumbnail . '</figure>' .
                '<div class="next-post-title"><span>' . get_the_title(self::$nextpost->ID) . '</span></div>' .
                '</a>';
        }
        return '<div class="next-post"></div>';
    }

    // 最新の記事
    public function display_latest_post() {
        if (self::$nextpost) {
            $default_latest_text = __('<span class="pc-none">Read the latest post</span><span class="sp-none">Latest</span>', 'wp-sameterm-pager');
            $saved_setting = new Smtrm_Get_Setting;
            $link = new Smtrm_Get_Link;
            $latest_post_text = $saved_setting->pager_latest_text();
            if(!$latest_post_text){
                $latest_post_text = $default_latest_text;
            }
            return '<a href="' . $link->get_link(self::$get_filter, self::$latest[0]) . '" class="latest-post same-term-nav-link">' .
                '<span>' . wp_kses_post($latest_post_text) . '</span>' .
                '<div class="double-right same-term-icon" aria-hidden="true"></div>' .
                '</a>';
        }
        return '<div class="latest-post"></div>';
    }

    // ショートコードを使った個別表示
    public function get_pager_part($part){
        $this->set_post_data();
        $parts = [
            'oldest' => $this->display_oldest_post(),
            'prev' => $this->display_prev_post(),
            'next' => $this->display_next_post(),
            'latest' => $this->display_latest_post(),
        ];
        return isset($parts[$part]) ? '<div class="same-term-part cf">' . $parts[$part] . '</div>' : '';
    }

    public static function smtrm_pager_release_button()
    {
        if (is_single()) {
            list(self::$get_filter, self::$taxonomy, self::$term_exists, self::$get_term) = Smtrm_Adjacent_Post::smtrm_param_check();
            if (!empty(self::$term_exists)) {
                $term_name = self::$get_term->name;
                $taxonomy_name = get_taxonomy(self::$taxonomy)->labels->singular_name;
                $icon_class = (self::$taxonomy == 'post_tag' || !is_taxonomy_hierarchical(self::$taxonomy)) ? 'tag-icon' : 'category-icon';
                $url = get_the_permalink();
                $release_message = sprintf(
                    // Translators: 1: Taxonomy name (e.g., Category), 2: Term name (e.g., Technology)
                    __('Displaying posts filtered by %1$s: “%2$s”', 'wp-sameterm-pager'),
                    esc_html($taxonomy_name),
                    esc_html($term_name)
                );
                $release_button = __('Release', 'wp-sameterm-pager');
                
                echo <<<HTML
                <div class="pager-filter cf">
                    <div class="same-term-message">
                        <div class="same-term-icon {$icon_class}"></div>
                        <div class="same-term-filter">{$release_message}</div>
                    </div>
                    <div>
                        <a href="{$url}" class="release-button">
                            <span class="cancel-icon"></span><span>{$release_button}</span>
                        </a>
                    </div>
                </div>
                HTML;
            }
        }
    }

    private static function smtrm_get_post($order)
    {
        $args = array(
            'post_type'      => self::$post_type,
            'posts_per_page' => 1,
            'category'       => self::$cat_id_num,
            'tag_id'         => self::$tag_id_num,
            'orderby'        => 'date',
            'order'          => $order,
            'fields'         => 'ids',
        );
        if (self::$term_id_num) {
            $args['tax_query'] = [
                [
                    'taxonomy' => self::$taxonomy,
                    'field'    => 'id',
                    'terms'    => self::$term_id_num,
                ],
            ];
        }
        return get_posts($args);
    }

    public function get_pager_area()
    {
        ob_start();
        $this->sameterm_pager();
        return ob_get_clean();
    }

    public function get_pager_release_button()
    {
        ob_start();
        $this->smtrm_pager_release_button();
        return ob_get_clean();
    }

    public function add_pager_area($content)
    {
        $saved_setting = new Smtrm_Get_Setting;
        if (!is_single()) {
            return $content;
        }
        $new_content = '';
        if ($saved_setting->pager_top()) {
            $new_content .= $this->get_pager_area();
        }
        $new_content .= $content;
        if ($saved_setting->pager_bottom()) {
            $new_content .= $this->get_pager_area();
        }
        return $new_content;
    }
}

// ショートコードの追加
$smtrm_pager = new Smtrm_Pager();
add_shortcode('sameterm_pager', array($smtrm_pager, 'get_pager_area'));
add_shortcode('sameterm_release', array($smtrm_pager, 'get_pager_release_button'));

add_shortcode('sameterm_oldest', function() use ($smtrm_pager) {
    return $smtrm_pager->get_pager_part('oldest');
});
add_shortcode('sameterm_prev', function() use ($smtrm_pager) {
    return $smtrm_pager->get_pager_part('prev');
});
add_shortcode('sameterm_next', function() use ($smtrm_pager) {
    return $smtrm_pager->get_pager_part('next');
});
add_shortcode('sameterm_latest', function() use ($smtrm_pager) {
    return $smtrm_pager->get_pager_part('latest');
});

// コンテンツフィルター
add_filter('the_content', array($smtrm_pager, 'add_pager_area'));