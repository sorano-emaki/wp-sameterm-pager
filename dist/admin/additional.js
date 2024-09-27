/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/components/ApiCheck.js":
/*!******************************************!*\
  !*** ./src/admin/components/ApiCheck.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   useApiCheck: () => (/* binding */ useApiCheck)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1__);


const useApiCheck = () => {
  const [isApiError, setIsApiError] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_1___default()({
      path: '/wp/v2/settings'
    }).then(() => {
      setIsApiError(false);
    }).catch(() => {
      setIsApiError(true);
    });
  }, []);
  return isApiError;
};

/***/ }),

/***/ "./src/admin/components/Navigation.js":
/*!********************************************!*\
  !*** ./src/admin/components/Navigation.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


const PageNavigation = () => {
  const [currentPage, setCurrentPage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)('');
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    // 現在のページURLのクエリパラメータから現在のページを特定
    const params = new URLSearchParams(window.location.search);
    setCurrentPage(params.get('page'));
  }, []);
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    className: "admin-sidebar",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h3", {
      children: "\u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      className: "tab-navigation",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
        href: "admin.php?page=wp_sameterm_pager",
        className: currentPage === 'wp_sameterm_pager' ? 'active' : 'inactive',
        children: "\u4E00\u822C\u8A2D\u5B9A"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
        href: "admin.php?page=wp_sameterm_pager_additional",
        className: currentPage === 'wp_sameterm_pager_additional' ? 'active' : 'inactive',
        children: "\u8FFD\u52A0\u8A2D\u5B9A"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
        href: "admin.php?page=wp_sameterm_pager_help",
        className: currentPage === 'wp_sameterm_pager_help' ? 'active' : 'inactive',
        children: "\u30D8\u30EB\u30D7"
      })]
    })]
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PageNavigation);

/***/ }),

/***/ "./src/admin/components/SaveConfirmation.js":
/*!**************************************************!*\
  !*** ./src/admin/components/SaveConfirmation.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   useSaveConfirmation: () => (/* binding */ useSaveConfirmation)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const useSaveConfirmation = hasChanges => {
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    const handleBeforeUnload = event => {
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

/***/ }),

/***/ "./src/admin/components/SelectorValidation.js":
/*!****************************************************!*\
  !*** ./src/admin/components/SelectorValidation.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   validateSelectors: () => (/* binding */ validateSelectors)
/* harmony export */ });
const validateSelectors = selectors => {
  const selectorPattern = /^[a-zA-Z0-9_\-#.,: \[\]="']+$/;
  return selectors.split(',').every(selector => selectorPattern.test(selector.trim()));
};

/***/ }),

/***/ "react/jsx-runtime":
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["ReactJSXRuntime"];

/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./src/admin/additional.js ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_Navigation__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/Navigation */ "./src/admin/components/Navigation.js");
/* harmony import */ var _components_SaveConfirmation__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/SaveConfirmation */ "./src/admin/components/SaveConfirmation.js");
/* harmony import */ var _components_ApiCheck__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/ApiCheck */ "./src/admin/components/ApiCheck.js");
/* harmony import */ var _components_SelectorValidation__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/SelectorValidation */ "./src/admin/components/SelectorValidation.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__);



 // 共通ナビゲーションのインポート




const AdditionalSettings = () => {
  const [useLinkClass, setUseLinkClass] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(smtrmPagerAdmin?.archive);

  // ローディング状態の管理
  // const [isLoading, setIsLoading] = useState(false); 
  // ローディング状態、メッセージ状態の追加
  const [isSaving, setIsSaving] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [statusMessage, setStatusMessage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(null);
  const [hasChanges, setHasChanges] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false); // 変更があったかどうかのフラグ
  // const [isApiError, setIsApiError] = useState(false); // REST APIエラーフラグ
  const confirmSave = (0,_components_SaveConfirmation__WEBPACK_IMPORTED_MODULE_4__.useSaveConfirmation)(hasChanges);
  const isApiError = (0,_components_ApiCheck__WEBPACK_IMPORTED_MODULE_5__.useApiCheck)();

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
    if (useLinkClass && !(0,_components_SelectorValidation__WEBPACK_IMPORTED_MODULE_6__.validateSelectors)(useLinkClass)) {
      setStatusMessage({
        type: 'error',
        text: '無効なCSSセレクタがあります。セレクタには英字、数字、ID、クラス、属性セレクタ、擬似クラスが使用可能です。'
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
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
        path: '/wp/v2/settings',
        method: 'POST',
        data: {
          'smtrm_pager_entry_form': useLinkClass
        },
        headers: {
          'X-WP-Nonce': smtrmPagerAdmin.nonce // nonceを使用
        }
      });
      setStatusMessage({
        type: 'success',
        text: '設定が保存されました！'
      });
      setHasChanges(false); // 変更フラグをリセット
    } catch (error) {
      // const errorMessage = error.message || '不明なエラーが発生しました。';
      // setStatusMessage({ type: 'error', text: `保存に失敗しました: ${errorMessage}` });
      let errorMessage = '設定の保存に失敗しました。';
      // エラーオブジェクトの中身をデバッグ用に表示
      const errorDetails = JSON.stringify(error, null, 2); // エラーオブジェクト全体を文字列化
      errorMessage += ': ' + JSON.stringify(error.message); // エラーメッセージに詳細を追加
      // エラーメッセージをセット
      setStatusMessage({
        type: 'error',
        text: errorMessage
      });
      console.error('API Save Error:', error); // コンソールにエラーログを出力
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

  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
    className: "smtrm-admin-wrapper",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
      className: "admin-content",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("h1", {
        children: "Same Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3 \u8FFD\u52A0\u8A2D\u5B9A\u30DA\u30FC\u30B8"
      }), statusMessage && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Notice, {
        status: statusMessage.type,
        onRemove: () => setStatusMessage(null),
        children: statusMessage.text
      }), isApiError && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Notice, {
        status: "error",
        isDismissible: false,
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("p", {
          children: "REST API\u304C\u7121\u52B9\u3067\u3059\u3002WordPress REST API\u3092\u6709\u52B9\u306B\u3057\u3066\u304F\u3060\u3055\u3044\u3002"
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("h2", {
        children: "\u8FFD\u52A0\u8A2D\u5B9A"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
        className: "setting-wrapper",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
          className: "setting-box",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("h3", {
            children: "\u30A2\u30FC\u30AB\u30A4\u30D6\u30DA\u30FC\u30B8\u8A2D\u5B9A"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.TextControl, {
            label: "\u7D5E\u308A\u8FBC\u307F\u6A5F\u80FD\u304C\u52D5\u4F5C\u3057\u306A\u3044\u5834\u5408\u306B\u4F7F\u7528\u3059\u308BCSS\u30BB\u30EC\u30AF\u30BF (\u30AB\u30F3\u30DE\u533A\u5207\u308A\u3067\u8907\u6570\u6307\u5B9A\u53EF\u80FD)",
            value: useLinkClass,
            disabled: isSaving || isApiError,
            onChange: value => {
              setUseLinkClass(value);
              setHasChanges(true); // 変更があったことを通知
            },
            placeholder: "\u4F8B: .class1, .class2, .class3"
          })]
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, {
        isPrimary: true,
        onClick: onClick,
        disabled: isSaving || isApiError,
        children: isSaving ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.Fragment, {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Spinner, {}), " \u4FDD\u5B58\u4E2D\u2026"]
        }) : '保存'
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_components_Navigation__WEBPACK_IMPORTED_MODULE_3__["default"], {})]
  });
};

// エントリーポイントにレンダリング
(0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.render)(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(AdditionalSettings, {}), document.getElementById('smtrm-pager-additional'));
/******/ })()
;
//# sourceMappingURL=additional.js.map