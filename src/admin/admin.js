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
import PageNavigation from './navigation';  // 共通ナビゲーションのインポート

const Admin = () => {
    const [showPagerTop, setShowPagerTop] = useState(true);
    const [showPagerBtm, setShowPagerBtm] = useState(true);
    
    // ローディング状態の管理
    const [isLoading, setIsLoading] = useState(true); // 初期表示はローディング中

    // ローディング状態、メッセージ状態の追加
    const [isSaving, setIsSaving] = useState(false);
    const [statusMessage, setStatusMessage] = useState(null);
    const [hasChanges, setHasChanges] = useState(false);    // 変更があったかどうかのフラグ
    
    
    // 画面遷移時に保存確認ダイアログを追加
    useEffect(() => {
        const handleBeforeUnload = (event) => {
            if (hasChanges) {
                event.preventDefault();
                event.returnValue = ''; // これを設定することで、確認ダイアログが表示される
            }
        };

        window.addEventListener('beforeunload', handleBeforeUnload);

        // クリーンアップ
        return () => {
            window.removeEventListener('beforeunload', handleBeforeUnload);
        };
    }, [hasChanges]);

    // 初期設定を取得する処理    
    useEffect(() => {
        setIsLoading(true);
        apiFetch({ path: '/wp/v2/settings' })
            .then(response => {
                setShowPagerTop(Boolean(response.smtrm_pager_top));
                setShowPagerBtm(Boolean(response.smtrm_pager_bottom));
            })
            .catch(error => {
                setStatusMessage({ type: 'error', text: '設定の取得に失敗しました。' });
            })
            .finally(() => {
                // ローディング終了
                setIsLoading(false);
            });
    }, []);

    const onClick = async () => {
    
        // 保存確認ダイアログ
        if (!window.confirm('本当に設定を保存しますか？')) {
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
            const errorMessage = error.message || '不明なエラーが発生しました。';
            setStatusMessage({ type: 'error', text: `保存に失敗しました: ${errorMessage}` });
        } finally {
            setIsSaving(false);
        }
    };

    // ローディング中であればSpinnerを表示
    if (isLoading) {
        return (
            <div className="smtrm-admin-loading">
                <Spinner className="custom-spinner" /> {/* ローディングインジケーター */}
                <p>設定を読み込んでいます...</p>
            </div>
        );
    }

    return (
        <div className="smtrm-admin-wrapper">
            <div className="admin-content">
                <h1>Same Term Pager 設定</h1>
                {/* 保存成功/失敗メッセージの表示 */}
                {statusMessage && (
                    <Notice
                        status={statusMessage.type}
                        onRemove={() => setStatusMessage(null)}
                    >
                        {statusMessage.text}
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
                        />
                        <ToggleControl
                            label="投稿下に表示する"
                            checked={showPagerBtm}
                            onChange={() => {
                                setShowPagerBtm(!showPagerBtm);
                                setHasChanges(true);  // 変更があったことを通知
                            }}
                        />
                    </div>
                </div>
                <Button
                    isPrimary
                    onClick={onClick}
                    disabled={isSaving}
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
