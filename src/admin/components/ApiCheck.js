//APIチェック用コンポーネント ApiCheck.js
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

export const useApiCheck = () => {
    const [isApiError, setIsApiError] = useState(false);

    useEffect(() => {
        apiFetch({ path: '/smtrm/v1/settings' })
            .then(() => {
                setIsApiError(false);
            })
            .catch(() => {
                setIsApiError(true);
            });
    }, []);

    return isApiError;
};