<?php
if(!defined('ABSPATH')) { exit; } 
class smtrm_pager{
    function sameterm_pager(){
    if(is_single()){
        $post_type = get_post_type();
        $cat_id_num = '';
        $tag_id_num = '';
        $term_id_num = '';
        $taxonomy = 'category';
        $release_bt = '';
        $get_filter = 0;
        $link = new smtrm_getlink;
        if(isset($_GET ['filter']) && is_numeric($_GET ['filter'])){
        $get_filter = (int)$_GET ['filter'];
        // echo 'filter'.$get_filter;
        $term_exists = term_exists($get_filter);
        // var_dump($term_exists);
        }

        if(!empty($term_exists) ){
        $get_term = get_term( $get_filter );
        $taxonomy = $get_term -> taxonomy;
        $term_name = $get_term -> name;
        $get_taxonomy = get_taxonomy($taxonomy);
        $taxonomy_name = $get_taxonomy->label;
        $fa_icon = 'fa-folder';
        if($taxonomy == 'post_tag' || !is_taxonomy_hierarchical( $taxonomy )){
            $fa_icon = 'fa-tag';
        }
        $url = get_the_permalink();
        $release_bt =<<<"EOT"
        <small>
            <span class="fas ${fa_icon}"></span>
            ${taxonomy_name}：『${term_name}』内の投稿を絞り込み表示中
        </small>
        <a href="${url}" class="cat-link">
            <span class="fas fa-times iconfont cat-icon tax-icon tag-icon"></span>解除
        </a>
        EOT;
        ?>

        <?php
        if($taxonomy == 'category'){
            $cat_id_num = $get_filter;
        }
        elseif($taxonomy == 'post_tag'){
            $tag_id_num = $get_filter;
        }
        else{
            $term_id_num = $get_filter;
        }
        }
        $args = array(
        'post_type'        => $post_type,
        'posts_per_page'   => -1, // 読み込みしたい記事数（全件取得時は-1）
        'category'         => $cat_id_num, // 読み込みしたいカテゴリID（複数の場合は '1,2'）
        'tag_id'           => $tag_id_num,
        'orderby'          => 'date', // 何順で記事を読み込むか（省略時は日付順）
        'order'            => 'ASC', // 昇順(ASC)か降順か(DESC）
        'fields' => 'ids',            //IDだけ取得
        );
        if( $term_id_num ){
        $args['tax_query'] = [
            [
                'taxonomy' => $taxonomy,
                'field'    => 'id',
                'terms'    => $term_id_num,
            ]
        ];
        }
        //前の投稿と次の投稿
        $prevpost = null;
        $nextpost = null;
        //最初の投稿と最後の投稿
        $oldest = null;
        $recent = null;
        //条件で絞り込まれた投稿のIDのみを配列で取得
        $post_id_list = get_posts($args);
        //配列の総数を取得
        $pos_count = count($post_id_list);
        // var_dump($post_id_list);
        //現在表示中の投稿IDを取得
        $current_id = get_the_id();
        //配列の中から現在の投稿のIDを捜す（検索結果は配列の添え字）
        $pos = array_search($current_id, $post_id_list, true);
        // var_dump($pos);
        //一つ前の配列の添え字
        $prev_pos = $pos - 1;
        // var_dump($prev_pos);
        //一つ後の配列の添え字
        $next_pos = $pos + 1;
        // var_dump($next_pos);
        //配列の添え字（0スタート）がマイナスになる場合は前の投稿がないのでnull
        if($prev_pos < 0) {$prev_pos = null;}
        //配列の添え字が配列の総数より多い場合は次の投稿がないのでnull
        if($next_pos >= $pos_count){$next_pos = null;}
        //配列の添え字が0の場合があるので値があるかどうかをissetで判定
        if(isset($prev_pos)){
        // echo $post_id_list[$prev_pos];
        $prpos_id = $post_id_list[$prev_pos];
        $prevpost = get_post($prpos_id);
        $olpos_id = $post_id_list[0];
        $oldest = get_post($olpos_id);
        }
        if(isset($next_pos)){
        // echo $post_id_list[$next_pos];
        $nxpos_id = $post_id_list[$next_pos];
        $nextpost = get_post($nxpos_id);
        $pos_count = $pos_count - 1;
        $rcpos_id = $post_id_list[$pos_count];
        $recent = get_post($rcpos_id);
        }

        if( $prevpost || $nextpost ){ //前の記事、次の記事いずれか存在しているとき ?>
        <div id="same-term-pager" class="same-term-pager cf">
        <?php
        if( $oldest ) {
        if ( $prevpost ) {
            ?>
        <a href="<?php echo $link->getlink($get_filter,$oldest->ID); ?>" class="oldest-post a-wrap">
        <div class="fas fa-angle-double-left iconfont" aria-hidden="true"></div>最初<span class="pc_none">の記事から読む</span>
        </a>
        <?php 
        } 
        }else {
        echo '<div class="oldest-post"></div>';
        } ?>
        <?php
        if ( $prevpost ) { //前の記事が存在しているとき
            echo '<a href="' . $link->getlink($get_filter,$prevpost->ID) . '" title="' . esc_attr(get_the_title($prevpost->ID)) . '" class="prev-post a-wrap border-element cf">
                <div class="fa fa-chevron-left iconfont" aria-hidden="true"></div>
                <figure class="prev-post-thumb card-thumb">';
                // get_post_navi_thumbnail_tag( $prevpost->ID, $width, $height ).
                if(has_post_thumbnail($prevpost->ID)){
                echo get_the_post_thumbnail( $prevpost->ID, 'post-thumbnail', array( 'class'=>'attachment-thumb240 size-thumb240' ) );
                }
                else{
                    echo '<img width="120" height="68" alt="no-image" src="'.plugin_dir_url( __FILE__ ).'images/no-image.png" class="no-image post-navi-no-image">';
                    }
                echo '</figure>
                <div class="prev-post-title">' . get_the_title($prevpost->ID) . '</div></a>';
        } else { //前の記事が存在しないとき
            echo '<div class="prev-post"></div>';
        }
        if ( $nextpost ) { //次の記事が存在しているとき
            echo '<a href="' . $link->getlink($get_filter,$nextpost->ID) . '" title="'. esc_attr(get_the_title($nextpost->ID)) . '" class="next-post a-wrap cf">
                <div class="fa fa-chevron-right iconfont" aria-hidden="true"></div>
                <figure class="next-post-thumb card-thumb">';
                // get_post_navi_thumbnail_tag( $nextpost->ID, $width, $height ).
                if(has_post_thumbnail($nextpost->ID)){
                    echo get_the_post_thumbnail( $nextpost->ID, 'post-thumbnail', array( 'class'=>'attachment-thumb240 size-thumb240' ) );
                    }
                    else{
                        echo '<img width="120" height="68" alt="no-image" src="'.plugin_dir_url( __FILE__ ).'images/no-image.png" class="no-image post-navi-no-image">';
                    }
                    echo '</figure>
                    <div class="next-post-title">'. get_the_title($nextpost->ID) . '</div></a>';
        } else { //次の記事が存在しないとき
            echo '<div class="next-post"></div>';
        }
        ?>
        <?php
            if( $recent ) {
            if ( $nextpost ) {
            ?>
            <a href="<?php echo $link->getlink($get_filter,$recent->ID); ?>" class="latest-post a-wrap">
            最後<span class="pc_none">の記事を読む</span><div class="fas fa-angle-double-right iconfont" aria-hidden="true"></div>
            </a>
            <?php
            }
            } else {
            echo '<div class="latest-post"></div>';
            } ?>
        </div><!-- /.same-term-pager -->
        <?php } ?>
        <div class="pager_filter">
        <?php   
        if(isset($release_bt)){
        echo $release_bt;
        }?>
        </div>
        <?php
    }
  }
}
add_shortcode('sameterm_pager', array( new smtrm_pager(),'sameterm_pager'));