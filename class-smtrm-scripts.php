<?php
if(!defined('ABSPATH')) { exit; } 
class Smtrm_Scripts{
    function pager_scripts() {
        $saved_setting = new Smtrm_Get_Setting;
        $link_class = $saved_setting->select_box_value();
        $radio_value = $saved_setting->radio_value();
        if($radio_value == 1){
            switch ($link_class){
                case 0:
                    $link_class = '';
                    break;
                case 1:
                    $link_class = 'a.entry-card-wrap';
                    break;
                case 2:
                    $link_class = 'li.wp-block-post a';
                    break;
                case 3:
                    $link_class = 'li.wp-block-post a';
                    break;
                case 4:
                    $link_class = 'li.wp-block-post a';
                    break;
                default :
                    $link_class = '';
                    break;
            }
        }
        else{
            $link_class = $saved_setting->entry_form_value();
        }
    ?>
    <?php if(is_category() || is_tag() || is_tax()) :?>
        <script>
        jQuery(function($) {
            $('<?php echo $link_class; ?>').click(function(){
                //リンク先を取得
                var target_url = $(this).attr("href");
                //パラメータを取得
                    var str = 'smtrm_filter=' + '<?php echo get_queried_object_id(); ?>';
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
        <?php if( isset($_GET ['smtrm_filter']) && is_numeric($_GET ['smtrm_filter'])): ?>
            <script>
            <?php
            $get_filter = $_GET ['smtrm_filter']; 
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
                params.delete('smtrm_filter');
                window.location.href = `${url.href}`;
                });
            <?php endif; ?>
            </script>
        <?php elseif( isset($_GET ['smtrm_filter']) && !is_numeric($_GET ['smtrm_filter']) ) : ?>
        <script>        
            jQuery(function($) {
            // URLを取得
            const url = new URL(window.location.href);
            const params = url.searchParams;
            params.delete('smtrm_filter');
            window.location.href = `${url.href}`;
            });
        </script>
        <?php endif; ?>
    <?php endif; ?>
    <?php }
}
add_action( 'wp_head', array( new Smtrm_Scripts(),'pager_scripts'), 99 );