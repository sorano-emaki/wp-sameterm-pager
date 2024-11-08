//CSSセレクタ入力チェック用コンポーネント SelectorValidation.js
import DOMPurify from 'dompurify';

export const validateSelectors = (selectors) => {
    const selectorPattern = /^[a-zA-Z0-9_\-#.,: \[\]="\'^$*|~>+%\/]+$/;

    // サニタイズ処理を行う
    const sanitizedSelectors = selectors.split(',').map(selector => DOMPurify.sanitize(selector.trim()));

    // 正規表現チェックを行う
    return sanitizedSelectors.every(selector => selectorPattern.test(selector));
};