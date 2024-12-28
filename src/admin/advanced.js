// 追加設定画面 advanced.js
import './admin.scss';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { __ } from '@wordpress/i18n'; // Importing i18n for translations
import { 
    // render,
    useState,
    useEffect
} from '@wordpress/element';
import {
    TextControl,
    Button,
    Notice,
    Spinner
} from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';
import PageNavigation from './components/Navigation';  // 共通ナビゲーションのインポート
import { useSaveConfirmation } from './components/SaveConfirmation';
import { useApiCheck } from './components/ApiCheck';
import { validateSelectors } from './components/SelectorValidation';
import { 
    ErrorBoundary,
} from 'react-error-boundary';
import ErrorFallback from './components/ErrorFallback';

const AdvancedSettings = () => {
    const [useLinkClass, setUseLinkClass] = useState(smtrmPagerAdmin?.archive);
    // Loading state and message state
    // ローディング状態、メッセージ状態の追加
    const [isSaving, setIsSaving] = useState(false);
    const [statusMessage, setStatusMessage] = useState(null);
    // Flag to check if there are changes
    // 変更があったかどうかのフラグ
    const [hasChanges, setHasChanges] = useState(false);    
    const confirmSave = useSaveConfirmation(hasChanges);
    const isApiError = useApiCheck();
    const onClick = async () => {
        if (useLinkClass && !validateSelectors(useLinkClass)) {
            setStatusMessage({
                type: 'error',
                
                text: __('There are invalid CSS selectors. Valid selectors include letters, numbers, IDs, classes, attribute selectors, and pseudo-classes.', 'wp-sameterm-pager'), //無効なCSSセレクタがあります。セレクタには英字、数字、ID、クラス、属性セレクタ、擬似クラスが使用可能です。
            });
            return;
        }

        if (!confirmSave()) {
            return;
        }
    
        setIsSaving(true);
        setStatusMessage(null);
    
        try {
            const response = await apiFetch({
                path: '/smtrm/v1/settings',
                method: 'POST',
                data: {
                    'smtrm_archive_post_link_param_css': useLinkClass,
                },
                headers: {
                    // Using nonce 
                    // nonceを使用
                    'X-WP-Nonce': smtrmPagerAdmin.nonce
                }
            });
            
            setStatusMessage({ type: 'success', text: __('Settings have been saved!', 'wp-sameterm-pager') }); // 設定が保存されました！
            // Reset the change flag
            // 変更フラグをリセット
            setHasChanges(false);  
        } catch (error) {
            let errorMessage = __('Failed to save settings.', 'wp-sameterm-pager'); // 設定の保存に失敗しました。
            // Show error object details for debugging
            // エラーオブジェクトの中身をデバッグ用に表示
            // Serialize the entire error object
            // エラーオブジェクト全体を文字列化
            const errorDetails = JSON.stringify(error, null, 2); 
            
            // エラーメッセージに詳細を追加
            // Append details to the error message
            errorMessage += ': ' + JSON.stringify(error.message);
            // Set error message
            // エラーメッセージをセット
            setStatusMessage({ type: 'error', text: errorMessage }); 
            // Output error log to console
            // コンソールにエラーログを出力
            console.error('API Save Error:', error);
            console.log(errorDetails);
        } finally {
            setIsSaving(false);
        }
    };

    return (
        <ErrorBoundary
            FallbackComponent={ErrorFallback} // エラーが発生した際のフォールバックコンポーネント
        >
        <div className="smtrm-admin-wrapper">
            <div className="admin-content">
                <h1>{__('Same Term Pager Plugin Advanced Settings Page', 'wp-sameterm-pager')}</h1> {/* Same Term Pagerプラグイン 詳細設定ページ */}
                {/* 保存成功/失敗メッセージの表示 */}
                {statusMessage && (
                    <Notice
                        status={statusMessage.type}
                        onRemove={() => setStatusMessage(null)}
                    >
                        {statusMessage.text}
                    </Notice>
                )}
                {/* Display error message if REST API is disabled */}
                {/* REST APIが無効な場合のエラーメッセージを設定画面の上部に表示 */}
                {isApiError && (
                    <Notice status="error" isDismissible={false}>
                        <p>{__('The REST API is disabled. Please enable the WordPress REST API.', 'wp-sameterm-pager')}</p> {/* REST APIが無効です。WordPress REST APIを有効にしてください。 */}
                        <a href="admin.php?page=wp_sameterm_pager&legacy=1">  {__('Use the Legacy Settings','wp-sameterm-pager') }</a>
                    </Notice>
                )}
                <h2>{__('Advanced Settings', 'wp-sameterm-pager')}</h2> {/* 詳細設定 */}
                <div className="setting-wrapper">
                    <div className="setting-box">
                        <h3>{__('Archive Page Setting', 'wp-sameterm-pager')}</h3> {/* アーカイブページ設定 */}
                        <TextControl
                            label={__('CSS selectors to use if the filter function is not working (multiple selectors can be separated by commas)', 'wp-sameterm-pager')}  // 絞り込み機能が動作しない場合に使用するCSSセレクタ (カンマ区切りで複数指定可能)
                            value={useLinkClass}
                            disabled={isSaving || isApiError}
                            onChange={(value) => {
                                setUseLinkClass(value);
                                setHasChanges(true);  // Notify that changes have been made  変更があったことを通知
                            }}
                            placeholder={__('e.g. .class1, .class2, .class3', 'wp-sameterm-pager')}  // 例: .class1, .class2, .class3
                        />
                    </div>
                </div>
                <Button
                    isPrimary
                    onClick={onClick}
                    disabled={isSaving || isApiError}
                    className="save-button"
                >
                    {isSaving ? (
                        <>
                            <Spinner /> {__('Saving…', 'wp-sameterm-pager')}  {/* 保存中… */}
                        </>
                    ) : (
                        __('Save', 'wp-sameterm-pager')  // 保存
                    )}
                </Button>
            </div>
            {/* 右カラム（ナビゲーション） */}
            <PageNavigation />
        </div>
        </ErrorBoundary>
    );
};

// エントリーポイントにレンダリング
// render(<AdvancedSettings />, document.getElementById('smtrm-pager-advanced'));
const root = createRoot(document.getElementById('smtrm-pager-advanced'));
root.render(<AdvancedSettings />);