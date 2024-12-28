jQuery(function($) {
    $(for_add_smtrm_param.link_class).click(function(){
        //リンク先を取得
        const target_url = new URL($(this).attr("href"));
        //パラメータを取得
        var str = for_add_smtrm_param.queried_object_id;
        target_url.searchParams.set('smtrm_filter',str);
        $(this).attr('href', target_url.href);
    })
});