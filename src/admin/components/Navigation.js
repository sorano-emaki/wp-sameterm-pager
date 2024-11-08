// Navigation component
// ナビゲーション用コンポーネント
import { __ } from '@wordpress/i18n';  // WordPressの翻訳機能を使用
import { useState, useEffect } from '@wordpress/element';

const PageNavigation = () => {
    const [currentPage, setCurrentPage] = useState('');

    useEffect(() => {
        // Identify the current page from the URL query parameters
        // 現在のページURLのクエリパラメータから現在のページを特定
        const params = new URLSearchParams(window.location.search);
        setCurrentPage(params.get('page'));
    }, []);

    return (
        <div className="admin-sidebar">
            <h3>{ __('Settings Menu', 'wp-sameterm-pager') }</h3> {/* 設定メニュー */}
            <div className="smtrm-tab-navigation">
                <a
                    href="admin.php?page=wp_sameterm_pager"
                    className={currentPage === 'wp_sameterm_pager' ? 'active' : 'inactive'}
                >
                    { __('General Settings', 'wp-sameterm-pager') } {/* 一般設定 */}
                </a>
                <a
                    href="admin.php?page=wp_sameterm_pager_advanced"
                    className={currentPage === 'wp_sameterm_pager_advanced' ? 'active' : 'inactive'}
                >
                     {__('Advanced Settings', 'wp-sameterm-pager') } {/* 詳細設定 */}
                </a>
                <a
                    href="admin.php?page=wp_sameterm_pager_help"
                    className={currentPage === 'wp_sameterm_pager_help' ? 'active' : 'inactive'}
                >
                    { __('Help', 'wp-sameterm-pager') } {/* ヘルプ */}
                </a>
            </div>
        </div>
    );
};

export default PageNavigation;
