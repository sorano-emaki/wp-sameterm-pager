<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Pager{
    private static $post_type;
    private static $cat_id_num;
    private static $tag_id_num;
    private static $term_id_num;
    private static $get_filter;
    private static $taxonomy;
    private static $term_exists;
    private static $get_term;

    function sameterm_pager(){
    if(is_single()){
        self::$post_type = get_post_type();
        list(self::$get_filter,self::$taxonomy,self::$term_exists,self::$get_term) = SmtrmAdjacentPost::smtrm_param_check();
        $link = new Smtrm_Get_Link;
        $oldest = self::smtrm_get_post('ASC');
        // var_dump($oldest);
        $latest = self::smtrm_get_post('DESC');
        // var_dump($latest);
        $prevpost = get_adjacent_post(false, '', true );
        $nextpost = get_adjacent_post(false, '', false);
    ?>

        <div class="same-term-pager-wrapper">
        <?php if( $prevpost || $nextpost ){ //前の記事、次の記事いずれか存在しているとき ?>
            <nav class="same-term-pager cf">
            <?php
            if ( $prevpost ) {
                ?>
            <a href="<?php echo $link->get_link(self::$get_filter,$oldest[0]); ?>" class="oldest-post">
            <div class="double-left same-term-icon" aria-hidden="true"></div>最初<span class="pc-none">の記事から読む</span>
            </a>
            <?php 
            }else {
            echo '<div class="oldest-post"></div>';
            } ?>
            <?php
            if ( $prevpost ) { //前の記事が存在しているとき
                echo '<a href="' . $link->get_link(self::$get_filter,$prevpost->ID) . '" title="' . esc_attr(get_the_title($prevpost->ID)) . '" class="prev-post cf">
                    <div class="arrow-left same-term-icon" aria-hidden="true"></div>
                    <figure class="prev-post-thumb">';
                    if(has_post_thumbnail($prevpost->ID)){
                    echo get_the_post_thumbnail( $prevpost->ID, 'post-thumbnail', array( 'class'=>'attachment-thumb240 size-thumb240' ) );
                    }
                    else{
                        echo '<img width="120" height="68" alt="no-image" src="'.SMTRM_PLUGIN_URL.'images/no-image.png" class="no-image post-navi-no-image" />';
                        }
                    echo '</figure>
                    <div class="prev-post-title">' . get_the_title($prevpost->ID) . '</div></a>';
            } else { //前の記事が存在しないとき
                echo '<div class="prev-post"></div>';
            }
            if ( $nextpost ) { //次の記事が存在しているとき
                echo '<a href="' . $link->get_link(self::$get_filter,$nextpost->ID) . '" title="'. esc_attr(get_the_title($nextpost->ID)) . '" class="next-post cf">
                    <div class="arrow-right same-term-icon" aria-hidden="true"></div>
                    <figure class="next-post-thumb">';
                    if(has_post_thumbnail($nextpost->ID)){
                        echo get_the_post_thumbnail( $nextpost->ID, 'post-thumbnail', array( 'class'=>'attachment-thumb240 size-thumb240' ) );
                        }
                        else{
                            echo '<img width="120" height="68" alt="no-image" src="'.SMTRM_PLUGIN_URL.'images/no-image.png" class="no-image post-navi-no-image" />';
                        }
                        echo '</figure>
                        <div class="next-post-title">'. get_the_title($nextpost->ID) . '</div></a>';
            } else { //次の記事が存在しないとき
                echo '<div class="next-post"></div>';
            }
            ?>
            <?php
                if ( $nextpost ) {
                ?>
                <a href="<?php echo $link->get_link(self::$get_filter,$latest[0]); ?>" class="latest-post">
                最後<span class="pc-none">の記事を読む</span><div class="double-right same-term-icon" aria-hidden="true"></div>
                </a>
                <?php
                } else {
                echo '<div class="latest-post"></div>';
                } ?>
            </nav><!-- /.same-term-pager -->
            <?php 
            }
            self::smtrm_pager_release_button();?>
        </div><!-- /.same-term-pager-wrapper -->
        <?php
    }
  }
  public static function smtrm_pager_release_button(){
    if(is_single()){
        list(self::$get_filter,self::$taxonomy,self::$term_exists,self::$get_term) = SmtrmAdjacentPost::smtrm_param_check();
        if(!empty(self::$term_exists) ){
            $term_name = self::$get_term -> name;
            $get_taxonomy = get_taxonomy(self::$taxonomy);
            $taxonomy_name = $get_taxonomy->label;
            $icon_class = 'category-icon';
            if(self::$taxonomy == 'post_tag' || !is_taxonomy_hierarchical( self::$taxonomy )){
                $icon_class = 'tag-icon';
            }
            $url = get_the_permalink();
            $release_bt =<<<"EOT"
            <div class="pager-filter">
                <div class="same-term-message">
                    <div class="same-term-icon ${icon_class}"></div>
                    <div class="same-term-filter"><span>${taxonomy_name}：</span><span>『${term_name}』</span><span>内の投稿を絞り込み表示中</span></div>
                </div>
                <div>
                    <a href="${url}" class="release-button">
                        <span class="cancel-icon"></span><span>解除</span>
                    </a>
                </div>
            </div>
            EOT;
            ?>

            <?php
            if(self::$taxonomy == 'category'){
                self::$cat_id_num = self::$get_filter;
            }
            elseif(self::$taxonomy == 'post_tag'){
                self::$tag_id_num = self::$get_filter;
            }
            else{
                self::$term_id_num = self::$get_filter;
            }
            echo $release_bt;
        }
    }
  }
  private static function smtrm_get_post($order){
    $args = array(
        'post_type'        => self::$post_type,
        'posts_per_page'   => 1, // 読み込みしたい記事数
        'category'         => self::$cat_id_num, // 読み込みしたいカテゴリID（複数の場合は '1,2'）
        'tag_id'           => self::$tag_id_num,
        'orderby'          => 'date', // 何順で記事を読み込むか（省略時は日付順）
        'order'            => $order, // 昇順(ASC)か降順か(DESC）
        'fields' => 'ids',            //IDだけ取得
    );
    if( self::$term_id_num ){
    $args['tax_query'] = [
        [
            'taxonomy' => self::$taxonomy,
            'field'    => 'id',
            'terms'    => self::$term_id_num,
        ]
    ];
    }
    return get_posts($args);
  }

  function get_pager_area(){
    $pager_contents = '';
    ob_start();
    echo $this->sameterm_pager();
    $pager_contents = ob_get_clean();
    return $pager_contents;
  }
  function get_pager_release_button(){
    $pager_contents = '';
    ob_start();
    echo $this->smtrm_pager_release_button();
    $pager_contents = ob_get_clean();
    return $pager_contents;
  }

  function add_pager_area($content){
    $saved_setting = new Smtrm_Get_Setting;
    if(!is_single()){
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
$smtrm_pager = new Smtrm_Pager();
add_shortcode('sameterm_pager', array( $smtrm_pager,'get_pager_area'));
add_shortcode('sameterm_release', array( $smtrm_pager,'get_pager_release_button'));
add_filter('the_content',array($smtrm_pager,'add_pager_area'));