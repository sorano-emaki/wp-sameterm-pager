import { 
    render,
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

const AdditionalSettings = () => {
    const [useLinkClass, setUseLinkClass] = useState(smtrmPagerAdmin?.archive);
    
    // ローディング状態、メッセージ状態の追加
    const [isSaving, setIsSaving] = useState(false);
    const [statusMessage, setStatusMessage] = useState(null);
    const [hasChanges, setHasChanges] = useState(false);    // 変更があったかどうかのフラグ
    const confirmSave = useSaveConfirmation(hasChanges);
    const isApiError = useApiCheck();
    
    

    const onClick = async () => {

        if (useLinkClass && !validateSelectors(useLinkClass)) {
            setStatusMessage({
                type: 'error',
                text: '無効なCSSセレクタがあります。セレクタには英字、数字、ID、クラス、属性セレクタ、擬似クラスが使用可能です。',
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
                path: '/wp/v2/settings',
                method: 'POST',
                data: {
                    'smtrm_pager_entry_form': useLinkClass,
                },
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
                <h1>Same Term Pagerプラグイン 追加設定ページ</h1>
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
                <h2>追加設定</h2>
                <div className="setting-wrapper">
                    <div className="setting-box">
                        <h3>アーカイブページ設定</h3>
                        <TextControl
                            label="絞り込み機能が動作しない場合に使用するCSSセレクタ (カンマ区切りで複数指定可能)"
                            value={useLinkClass}
                            disabled={isSaving || isApiError}
                            onChange={(value) => {
                                setUseLinkClass(value);
                                setHasChanges(true);  // 変更があったことを通知
                            }}
                            placeholder="例: .class1, .class2, .class3"
                        />
                    </div>
                </div>
                <Button
                        isPrimary
                        onClick={onClick}
                        disabled={isSaving || isApiError}
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

// エントリーポイントにレンダリング
render(<AdditionalSettings />, document.getElementById('smtrm-pager-additional'));

