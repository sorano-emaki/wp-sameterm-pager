jQuery(function($) {
    // URLを取得
    const url = new URL(window.location.href);
    const params = url.searchParams;
    params.delete('smtrm_filter');
    window.location.href = `${url.href}`;
    });