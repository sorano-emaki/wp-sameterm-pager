import { useState, useEffect } from '@wordpress/element';
const PageNavigation = () => {
    const [currentPage, setCurrentPage] = useState('');

    useEffect(() => {
        // 現在のページURLのクエリパラメータから現在のページを特定
        const params = new URLSearchParams(window.location.search);
        setCurrentPage(params.get('page'));
    }, []);

    return (
        <div className="admin-sidebar">
            <h3>設定メニュー</h3>
            <div className="tab-navigation">
                <a
                    href="admin.php?page=wp_sameterm_pager"
                    className={currentPage === 'wp_sameterm_pager' ? 'active' : 'inactive'}
                >
                    一般設定
                </a>
                <a
                    href="admin.php?page=wp_sameterm_pager_additional"
                    className={currentPage === 'wp_sameterm_pager_additional' ? 'active' : 'inactive'}
                >
                    追加設定
                </a>
                <a
                    href="admin.php?page=wp_sameterm_pager_help"
                    className={currentPage === 'wp_sameterm_pager_help' ? 'active' : 'inactive'}
                >
                    ヘルプ
                </a>
            </div>
        </div>
    );
};

export default PageNavigation;