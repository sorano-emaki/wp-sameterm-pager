import './admin.scss';

import { 
    render,
    useState,
    useEffect
} from '@wordpress/element';
import {
    ToggleControl,
    TextControl,
    Button,
    Notice,
    Spinner
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';  // WordPressの国際化機能をインポート
import apiFetch from '@wordpress/api-fetch';
import PageNavigation from './components/Navigation';  // Common navigation import 共通ナビゲーションのインポート
import { useSaveConfirmation } from './components/SaveConfirmation';
import { useApiCheck } from './components/ApiCheck';

const Admin = () => {

    // Add loading state and message state
    // ローディング状態、メッセージ状態の追加
    const [isSaving, setIsSaving] = useState(false);
    const [statusMessage, setStatusMessage] = useState(null);
    const [hasChanges, setHasChanges] = useState(false);    // Flag to indicate if there are changes 変更があったかどうかのフラグ
    const isApiError = useApiCheck();
    const confirmSave = useSaveConfirmation(hasChanges);
    const [showPagerTop, setShowPagerTop] = useState(Boolean(smtrmPagerAdmin?.top));
    const [showPagerBtm, setShowPagerBtm] = useState(Boolean(smtrmPagerAdmin?.bottom));
    const [latestPostText, setLatestPostText] = useState(smtrmPagerAdmin?.latestText || '');
    const [oldestPostText, setOldestPostText] = useState(smtrmPagerAdmin?.oldestText || '');

    const onClick = async () => {

        if (!confirmSave()) {
            return;
        }

        setIsSaving(true);
        setStatusMessage(null);

        try {
            const response = await apiFetch({
                path: '/wp/v2/settings',
                method: 'POST',
                data: {
                    'smtrm_pager_top': showPagerTop,
                    'smtrm_pager_bottom': showPagerBtm,
                    'smtrm_latest_post_text': latestPostText,
                    'smtrm_oldest_post_text': oldestPostText,
                },
                headers: {
                    'X-WP-Nonce': smtrmPagerAdmin.nonce // Use nonce nonceを使用
                }
            });

            setStatusMessage({ type: 'success', text: __('Settings have been saved!', 'wp-sameterm-pager') });
            setHasChanges(false);  // Reset the change flag 変更フラグをリセット
        } catch (error) {
            let errorMessage = __('Failed to save settings.', 'wp-sameterm-pager');
            // Display the error object for debugging エラーオブジェクトの中身をデバッグ用に表示
            const errorDetails = JSON.stringify(error, null, 2);  // Convert the entire error object to a string エラーオブジェクト全体を文字列化
            errorMessage += ': '+ JSON.stringify(error.message);  // Append details to the error message エラーメッセージに詳細を追加
            // Set the error message エラーメッセージをセット
            setStatusMessage({ type: 'error', text: errorMessage });
            console.error('API Save Error:', error);  // Output the error log to the console コンソールにエラーログを出力
            console.log(errorDetails);
        } finally {
            setIsSaving(false);
        }
    };

    return (
        <div className="smtrm-admin-wrapper">
            <div className="admin-content">
                <h1>{ __('Same Term Pager Plugin General Settings Page', 'wp-sameterm-pager') }</h1>
                {/* Display success/failure message for saving 保存成功/失敗メッセージの表示 */}
                {statusMessage && (
                    <Notice
                        status={statusMessage.type}
                        onRemove={() => setStatusMessage(null)}
                    >
                        {statusMessage.text}
                    </Notice>
                )}
                {/* Display an error message at the top of the settings page if REST API is disabled REST APIが無効な場合のエラーメッセージを設定画面の上部に表示 */}
                {isApiError && (
                    <Notice status="error" isDismissible={false}>
                        <p>{ __('REST API is disabled. Please enable WordPress REST API.', 'wp-sameterm-pager') }</p>
                    </Notice>
                )}
                <h2>{ __('General Settings', 'wp-sameterm-pager') }</h2>
                <div className="setting-wrapper">
                    <div className="setting-box">
                        <h3>{ __('Pager Above and Below Posts', 'wp-sameterm-pager') }</h3>
                        <ToggleControl
                            label={ __('Display pager above the post', 'wp-sameterm-pager') }
                            checked={showPagerTop}
                            onChange={() => {
                                setShowPagerTop(!showPagerTop);
                                setHasChanges(true);  // Notify that changes have occurred 変更があったことを通知
                            }}
                            disabled={isSaving || isApiError}
                        />
                        <ToggleControl
                            label={ __('Display pager below the post', 'wp-sameterm-pager') }
                            checked={showPagerBtm}
                            onChange={() => {
                                setShowPagerBtm(!showPagerBtm);
                                setHasChanges(true);  // Notify that changes have occurred 変更があったことを通知
                            }}
                            disabled={isSaving || isApiError}
                        />
                    </div>
                    <div className="setting-box">
                        <h3>{ __('Custom Text for Pager', 'wp-sameterm-pager') }</h3>
                        <TextControl
                            label={ __('Text for "Read the oldest post"', 'wp-sameterm-pager') }
                            value={oldestPostText}
                            onChange={(value) => {
                                setOldestPostText(value);
                                setHasChanges(true);  // Notify that changes have occurred
                            }}
                        />
                        <TextControl
                            label={ __('Text for "Read the latest post"', 'wp-sameterm-pager') }
                            value={latestPostText}
                            onChange={(value) => {
                                setLatestPostText(value);
                                setHasChanges(true);  // Notify that changes have occurred
                            }}
                        />
                        <small>{ __('You can use HTML tags such as <span>.', 'wp-sameterm-pager') }</small>
                        <small>{ __('Unavailable HTML tags are automatically removed.', 'wp-sameterm-pager') }</small>
                    </div>
                </div>
                <Button
                    isPrimary
                    onClick={onClick}
                    disabled={isSaving || isApiError }
                    className="save-button"
                >
                    {isSaving ? (
                        <>
                            <Spinner /> { __('Saving...', 'wp-sameterm-pager') }
                        </>
                    ) : (
                        __('Save', 'wp-sameterm-pager')
                    )}
                </Button>
            </div>
            {/* Right column (Navigation) 右カラム（ナビゲーション） */}
            <PageNavigation />
        </div>
    );
};

// Render the Admin component to the root DOM AdminコンポーネントをルートDOMにレンダリング
render(
    <Admin />,
    document.getElementById('smtrm-pager-admin')
);
