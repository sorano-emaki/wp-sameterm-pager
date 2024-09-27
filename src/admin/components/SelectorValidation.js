export const validateSelectors = (selectors) => {
    const selectorPattern = /^[a-zA-Z0-9_\-#.,: \[\]="']+$/;
    return selectors.split(',').every(selector => selectorPattern.test(selector.trim()));
};