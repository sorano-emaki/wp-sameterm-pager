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
            <h3>Same Term Pager 設定</h3>
            <ul>
                <li>
                    <a
                        href="admin.php?page=wp_sameterm_pager"
                        className={currentPage === 'wp_sameterm_pager' ? 'active' : ''}
                    >
                        一般設定
                    </a>
                </li>
                <li>
                    <a
                        href="admin.php?page=wp_sameterm_pager_additional"
                        className={currentPage === 'wp_sameterm_pager_additional' ? 'active' : ''}
                    >
                        追加設定
                    </a>
                </li>
                <li>
                    <a
                        href="admin.php?page=wp_sameterm_pager_help"
                        className={currentPage === 'wp_sameterm_pager_help' ? 'active' : ''}
                    >
                        ヘルプ
                    </a>
                </li>
            </ul>
        </div>
    );
};

export default PageNavigation;