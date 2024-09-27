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
        return window.confirm('本当に設定を保存しますか？');
    };

    return confirmSave;
};
