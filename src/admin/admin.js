// 設定画面用スタイル
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
import apiFetch from '@wordpress/api-fetch';
import PageNavigation from './components/Navigation';  // 共通ナビゲーションのインポート
import { useSaveConfirmation } from './components/SaveConfirmation';
import { useApiCheck } from './components/ApiCheck';

const Admin = () => {

    // ローディング状態、メッセージ状態の追加
    const [isSaving, setIsSaving] = useState(false);
    const [statusMessage, setStatusMessage] = useState(null);
    const [hasChanges, setHasChanges] = useState(false);    // 変更があったかどうかのフラグ
    const isApiError = useApiCheck();
    const confirmSave = useSaveConfirmation(hasChanges);
    const [showPagerTop, setShowPagerTop] = useState(Boolean(smtrmPagerAdmin?.top));
    const [showPagerBtm, setShowPagerBtm] = useState(Boolean(smtrmPagerAdmin?.bottom));

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
                    'smtrm_pager_bottom': showPagerBtm,                },
                headers: {
                    'X-WP-Nonce': smtrmPagerAdmin.nonce // nonceを使用
                }
            });
    
            setStatusMessage({ type: 'success', text: '設定が保存されました！' });
            setHasChanges(false);  // 変更フラグをリセット
        } catch (error) {
            let errorMessage = '設定の保存に失敗しました。';
            // エラーオブジェクトの中身をデバッグ用に表示
            const errorDetails = JSON.stringify(error, null, 2);  // エラーオブジェクト全体を文字列化
            errorMessage += ': '+ JSON.stringify(error.message);  // エラーメッセージに詳細を追加
            // エラーメッセージをセット
            setStatusMessage({ type: 'error', text: errorMessage });
            console.error('API Save Error:', error);  // コンソールにエラーログを出力
            console.log(errorDetails);
        } finally {
            setIsSaving(false);
        }
    };

    return (
        <div className="smtrm-admin-wrapper">
            <div className="admin-content">
                <h1>Same Term Pagerプラグイン 一般設定ページ</h1>
                {/* 保存成功/失敗メッセージの表示 */}
                {statusMessage && (
                    <Notice
                        status={statusMessage.type}
                        onRemove={() => setStatusMessage(null)}
                    >
                        {statusMessage.text}
                    </Notice>
                )}
                {/* REST APIが無効な場合のエラーメッセージを設定画面の上部に表示 */}
                {isApiError && (
                    <Notice status="error" isDismissible={false}>
                        <p>REST APIが無効です。WordPress REST APIを有効にしてください。</p>
                    </Notice>
                )}
                <h2>一般設定</h2>
                <div className="setting-wrapper">
                    <div className="setting-box">
                        <h3>投稿上下のページャー</h3>
                        <ToggleControl
                            label="投稿上に表示する"
                            checked={showPagerTop}
                            onChange={() => {
                                setShowPagerTop(!showPagerTop);
                                setHasChanges(true);  // 変更があったことを通知
                            }}
                            disabled={isSaving || isApiError}
                        />
                        <ToggleControl
                            label="投稿下に表示する"
                            checked={showPagerBtm}
                            onChange={() => {
                                setShowPagerBtm(!showPagerBtm);
                                setHasChanges(true);  // 変更があったことを通知
                            }}
                            disabled={isSaving || isApiError}
                        />
                    </div>
                </div>
                <Button
                    isPrimary
                    onClick={onClick}
                    disabled={isSaving || isApiError }
                >
                    {isSaving ? (
                        <>
                            <Spinner /> 保存中…
                        </>
                    ) : (
                        '保存'
                    )}
                </Button>
            </div>
            {/* 右カラム（ナビゲーション） */}
            <PageNavigation />
        </div>
    );
};

// AdminコンポーネントをルートDOMにレンダリング
render(
    <Admin />,
    document.getElementById('smtrm-pager-admin')
);
