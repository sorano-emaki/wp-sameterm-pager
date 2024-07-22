<?php 
if(!defined('ABSPATH')) { exit; } 
function wp_sameterm_pager_scripts() {
?>
<?php if(is_category() || is_tag() || is_tax()) :?>
    <script>
    jQuery(function($) {
        $('a.entry-card-wrap').click(function(){
            //リンク先を取得
            var target_url = $(this).attr("href");
            //パラメータを取得
            <?php if(is_category()): ?>
                var str = 'filter=' + '<?php echo get_query_var('cat'); ?>';
            <?php elseif(is_tag()): ?>
                var str = 'filter=' + '<?php echo get_query_var('tag_id'); ?>';
            <?php elseif(is_tax()): ?>
                var str = 'filter=' + '<?php echo get_queried_object_id(); ?>';
            <?php endif; ?>
            // console.log(str);
            prm = decodeURIComponent(str);
            if (prm) {
            //target_urlに'？'を含む場合
                if (target_url.indexOf('?') != -1) {
                //追加パラメータの先頭文字列を'&'に置換
                $(this).attr('href', target_url + '&' + prm);
                } 
                else {
                $(this).attr('href', target_url + '?' + prm);
                }
            }
        })
    });
    </script>
<?php endif; ?>

<?php if(is_single()) :?>
    <?php if( isset($_GET ['filter'])): ?>
        <script>
        <?php
        $get_filter = $_GET ['filter']; 
        $get_term = get_term( $get_filter );
        $get_tax = $get_term -> taxonomy;
        ?>
        <?php if(has_term($get_filter,$get_tax)) : ?>
            jQuery(function($) {
                // URLのクエリ文字列を取得
                const queryString = window.location.search;
                // URLSearchParamsオブジェクトを作成してクエリ文字列を解析
                const params = new URLSearchParams(queryString);
                // 特定のパラメータの値を取得
                $("#same-term-pager a").each(function(){
                const paramValue = params.get('filter');
                let obj = jQuery(this);
                let link = obj.attr("href");
                obj.attr("href",link+"?filter="+paramValue)
                })
            });
        <?php else : ?>
            jQuery(function($) {
            // URLを取得
            const url = new URL(window.location.href);
            const params = url.searchParams;
            params.delete('filter');
            window.location.href = `${url.href}`;
            });
        <?php endif; ?>
        </script>
    <?php endif; ?>
<?php endif; ?>
<?php }
add_action( 'wp_head', 'wp_sameterm_pager_scripts', 99 );