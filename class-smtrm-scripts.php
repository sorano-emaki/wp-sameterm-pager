<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Scripts{
    function pager_scripts() {
        $link_class = get_option('smtrm_pager_entry_form');
    ?>
    <?php if(is_category() || is_tag() || is_tax()) :?>
        <script>
        jQuery(function($) {
            $('<?php echo $link_class; ?>').click(function(){
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
        <?php if( isset($_GET ['filter']) && is_numeric($_GET ['filter'])): ?>
            <script>
            <?php
            $get_filter = $_GET ['filter']; 
            $get_term = get_term( $get_filter );
            $get_tax = null;
            if($get_term){
            $get_tax = $get_term -> taxonomy;
            }
            ?>
            <?php if(has_term($get_filter,$get_tax)) : ?>
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
        <?php elseif( isset($_GET ['filter']) && !is_numeric($_GET ['filter']) ) : ?>
        <script>        
            jQuery(function($) {
            // URLを取得
            const url = new URL(window.location.href);
            const params = url.searchParams;
            params.delete('filter');
            window.location.href = `${url.href}`;
            });
        </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php }
}
add_action( 'wp_head', array( new Smtrm_Scripts(),'pager_scripts'), 99 );