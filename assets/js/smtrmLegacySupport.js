function isES6Supported() {
    try {
        // ES6の構文を含むコードを試す
        new Function('var x = 1; var y = 2; (x, y) => x + y');
        return true; // エラーが発生しなければES6対応
    } catch (e) {
        return false; // エラーが発生すればES6非対応
    }
}

if (!isES6Supported()) {
    var messageContainer = document.createElement('div');
    messageContainer.style.backgroundColor = '#f8d7da';
    messageContainer.style.color = '#721c24';
    messageContainer.style.border = '1px solid #f5c6cb';
    messageContainer.style.padding = '15px';
    messageContainer.style.margin = '20px 0';
    messageContainer.style.borderRadius = '5px';

    // 翻訳用のテキストをJavaScript側で使用
    var unsupportedMessage = smtrmTranslations.unsupportedBrowserMessage || 'Your browser does not support modern features required for this page.';
    var legacyLinkText = smtrmTranslations.legacyPageLinkText || 'Please use the Legacy Settings Page instead.';

    messageContainer.innerHTML = 
        '<p>' + unsupportedMessage + ' ' +
        '<a href="admin.php?page=wp_sameterm_pager&legacy=1" style="color: #0056b3; text-decoration: underline;">' + legacyLinkText + '</a></p>';

    var wpbodyElement = document.getElementById('wpbody');
    if (wpbodyElement) {
        wpbodyElement.insertBefore(messageContainer, wpbodyElement.firstChild);
    }
    else{
        document.body.insertBefore(messageContainer, document.body.firstChild);
    }
}
