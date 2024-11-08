//保存確認コンポーネント SaveConfirmation.js
import { __ } from '@wordpress/i18n';  // WordPressの翻訳機能を使用
import { 
    useEffect
} from '@wordpress/element';
export const useSaveConfirmation = (hasChanges) => {
    useEffect(() => {
        const handleBeforeUnload = (event) => {
            if (hasChanges) {
                event.preventDefault();
                event.returnValue = ''; // 確認ダイアログを表示
            }
        };
        
        window.addEventListener('beforeunload', handleBeforeUnload);
        return () => {
            window.removeEventListener('beforeunload', handleBeforeUnload);
        };
    }, [hasChanges]);

    const confirmSave = () => {
        return window.confirm( __('Do you really want to save the settings?', 'wp-sameterm-pager'));
    };
    return confirmSave;
};
