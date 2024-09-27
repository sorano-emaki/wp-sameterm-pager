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
    
    // ローディング状態の管理
    // const [isLoading, setIsLoading] = useState(false); 
    // ローディング状態、メッセージ状態の追加
    const [isSaving, setIsSaving] = useState(false);
    const [statusMessage, setStatusMessage] = useState(null);
    const [hasChanges, setHasChanges] = useState(false);    // 変更があったかどうかのフラグ
    // const [isApiError, setIsApiError] = useState(false); // REST APIエラーフラグ
    const confirmSave = useSaveConfirmation(hasChanges);
    const isApiError = useApiCheck();
    
    
    // 画面遷移時に保存確認ダイアログを追加
    // useEffect(() => {
    //     const handleBeforeUnload = (event) => {
    //         if (hasChanges) {
    //             event.preventDefault();
    //             event.returnValue = ''; // これを設定することで、確認ダイアログが表示される
    //         }
    //     };

    //     window.addEventListener('beforeunload', handleBeforeUnload);

    //     // クリーンアップ
    //     return () => {
    //         window.removeEventListener('beforeunload', handleBeforeUnload);
    //     };
    // }, [hasChanges]);

    // 初期設定を取得する処理    
    // useEffect(() => {
    //     setIsLoading(true);
    //     apiFetch({ path: '/wp/v2/settings' })
    //         .then(response => {
    //             setUseLinkClass(response.smtrm_pager_entry_form);
    //         })
    //         .catch(error => {
    //             setStatusMessage({ type: 'error', text: '設定の取得に失敗しました。' });
    //         })
    //         .finally(() => {
    //             // ローディング終了
    //             setIsLoading(false);
    //         });
    // }, []);
    // REST APIが動作しているか確認する処理
    // useEffect(() => {
    //     // setIsLoading(true);

    //     apiFetch({ path: '/wp/v2/settings' })
    //         .then(response => {
    //             // 正常にAPIリクエストが成功した場合、設定値を取得
    //             setIsApiError(false);  // エラーフラグをオフ
    //         })
    //         .catch((error) => {
    //             // APIリクエストが失敗した場合
    //             console.error('API Fetch Error:', error);
    //             setIsApiError(true);  // エラーフラグをオン
    //         })
    //         .finally(() => {
    //             setIsLoading(false);  // ローディング終了
    //         });
    // }, []);
    const onClick = async () => {
        // if(useLinkClass){
        //     // CSSセレクタ全般のバリデーション
        //     const selectorPattern = /^[a-zA-Z0-9_\-#.,: \[\]="']+$/;
        
        //     // カンマ区切りでセレクタを分割
        //     const selectors = useLinkClass.split(',');
        
        //     // 各セレクタを検証
        //     for (let selector of selectors) {
        //         selector = selector.trim(); // セレクタの前後のスペースを削除
        //         if (!selectorPattern.test(selector)) {
        //             setStatusMessage({
        //                 type: 'error',
        //                 text: '無効なCSSセレクタがあります。セレクタには英字、数字、ID、クラス、属性セレクタ、擬似クラスが使用可能です。',
        //             });
        //             return;
        //         }
        //     }
        // }
        if (useLinkClass && !validateSelectors(useLinkClass)) {
            setStatusMessage({
                type: 'error',
                text: '無効なCSSセレクタがあります。セレクタには英字、数字、ID、クラス、属性セレクタ、擬似クラスが使用可能です。',
            });
            return;
        }
    
        // 保存確認ダイアログ
        // if (!window.confirm('本当に設定を保存しますか？')) {
        //     return;
        // }
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
            // const errorMessage = error.message || '不明なエラーが発生しました。';
            // setStatusMessage({ type: 'error', text: `保存に失敗しました: ${errorMessage}` });
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

    // ローディング中であればSpinnerを表示
    // if (isLoading) {
    //     return (
    //         <div className="smtrm-admin-loading">
    //             <Spinner className="custom-spinner" /> {/* ローディングインジケーター */}
    //             <p>設定を読み込んでいます...</p>
    //         </div>
    //     );
    // }

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

