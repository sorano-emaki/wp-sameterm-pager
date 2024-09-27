/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

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

/***/ "react/jsx-runtime":
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["ReactJSXRuntime"];

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
/*!***************************!*\
  !*** ./src/admin/help.js ***!
  \***************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_Navigation__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/Navigation */ "./src/admin/components/Navigation.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__);



const HelpPage = () => {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
    className: "smtrm-admin-wrapper",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
      className: "admin-content",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h1", {
          children: "Same Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3 \u30D8\u30EB\u30D7\u30DA\u30FC\u30B8"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u3053\u306E\u30D8\u30EB\u30D7\u30DA\u30FC\u30B8\u3067\u306F\u3001Same Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3\u306E\u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC\u306B\u3064\u3044\u3066\u8AAC\u660E\u3057\u307E\u3059\u3002 \u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC\u3092\u4F7F\u7528\u3059\u308B\u3053\u3068\u3067\u3001Same Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3\u306E\u8A2D\u5B9A\u3092\u7C21\u5358\u306B\u30AB\u30B9\u30BF\u30DE\u30A4\u30BA\u3057\u3001 \u7279\u5B9A\u306E\u6A5F\u80FD\u3092\u6709\u52B9\u307E\u305F\u306F\u7121\u52B9\u306B\u3059\u308B\u3053\u3068\u304C\u3067\u304D\u307E\u3059\u3002\u307E\u305F\u3001\u8A73\u7D30\u8A2D\u5B9A\u3092\u4F7F\u3063\u3066\u8FFD\u52A0\u6A5F\u80FD\u306E\u8ABF\u6574\u3092\u884C\u3046\u3053\u3068\u304C\u3067\u304D\u307E\u3059\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u5BFE\u8C61\u8005\uFF1A\u3053\u306E\u30DE\u30CB\u30E5\u30A2\u30EB\u306F\u3001WordPress\u306E\u7BA1\u7406\u753B\u9762\u3092\u4F7F\u7528\u3057\u3066\u30B5\u30A4\u30C8\u3092\u7BA1\u7406\u3059\u308B\u30E6\u30FC\u30B6\u30FC\u3092\u5BFE\u8C61\u3068\u3057\u3066\u3044\u307E\u3059\u3002 \u8A73\u3057\u3044\u4F7F\u3044\u65B9\u3064\u3044\u3066\u306F\u88FD\u4F5C\u8005\u306E\u30B5\u30A4\u30C8\u3092\u3054\u53C2\u7167\u304F\u3060\u3055\u3044\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
          children: "\u76EE\u6B21"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ul", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: "#section1",
              children: "1. \u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC\u3068\u306F"
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("li", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: "#section2",
              children: "2. \u4E00\u822C\u8A2D\u5B9A\u306E\u4F7F\u3044\u65B9"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ul", {
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
                  href: "#section2-1",
                  children: "2.1 \u8A2D\u5B9A\u306E\u4FDD\u5B58\u3068\u53CD\u6620"
                })
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
                  href: "#section2-2",
                  children: "2.2 \u9805\u76EE\u3054\u3068\u306E\u8A73\u7D30\u8AAC\u660E"
                })
              })]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("li", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: "#section3",
              children: "3. \u8FFD\u52A0\u8A2D\u5B9A\u306E\u4F7F\u3044\u65B9"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("ul", {
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
                  href: "#section3-1",
                  children: "3.1 \u8FFD\u52A0\u8A2D\u5B9A\u306E\u4FDD\u5B58\u3068\u53CD\u6620"
                })
              })
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: "#section4",
              children: "4. \u30D8\u30EB\u30D7\u30E1\u30CB\u30E5\u30FC"
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: "#section5",
              children: "5. \u6CE8\u610F\u4E8B\u9805\u3068\u30D2\u30F3\u30C8"
            })
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
          id: "section1",
          children: "1. \u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC\u3068\u306F"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC\u306F\u3001Same Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3\u306E\u8A2D\u5B9A\u30DA\u30FC\u30B8\u3092\u9078\u629E\u3059\u308B\u305F\u3081\u306E\u30E1\u30CB\u30E5\u30FC\u3067\u3059\u3002\u30E1\u30CB\u30E5\u30FC\u306E\u5185\u5BB9\u306F\u7BA1\u7406\u8005\u6A29\u9650\u3092\u6301\u3064\u30E6\u30FC\u30B6\u30FC\u306B\u3057\u304B\u8868\u793A\u3055\u308C\u307E\u305B\u3093\u304C\u3001\u30B5\u30A4\u30C8\u306E\u52D5\u4F5C\u3084\u8868\u793A\u306B\u95A2\u308F\u308B\u8A2D\u5B9A\u3092\u884C\u3044\u307E\u3059\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
          id: "section2",
          children: "2. \u4E00\u822C\u8A2D\u5B9A\u306E\u4F7F\u3044\u65B9"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u300C\u4E00\u822C\u8A2D\u5B9A\u300D\u3067\u306F\u3001\u30B5\u30A4\u30C8\u5168\u4F53\u306B\u5F71\u97FF\u3092\u4E0E\u3048\u308B\u57FA\u672C\u7684\u306A\u8A2D\u5B9A\u3092\u884C\u3046\u3053\u3068\u304C\u3067\u304D\u307E\u3059\u3002\u3053\u3053\u3067\u8A2D\u5B9A\u3057\u305F\u5185\u5BB9\u306F\u3001\u30ED\u30B0\u30A4\u30F3\u3057\u3066\u3044\u306A\u3044\u8A2A\u554F\u8005\u3092\u542B\u3093\u3060\u3059\u3079\u3066\u306E\u30E6\u30FC\u30B6\u30FC\u306B\u8868\u793A\u3055\u308C\u308B\u30DA\u30FC\u30B8\u3084\u6A5F\u80FD\u306B\u53CD\u6620\u3055\u308C\u307E\u3059\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h3", {
          id: "section2-1",
          children: "2.1 \u8A2D\u5B9A\u306E\u4FDD\u5B58\u3068\u53CD\u6620"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ol", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u8A2D\u5B9A\u30E1\u30CB\u30E5\u30FC\u304B\u3089\u300C\u4E00\u822C\u8A2D\u5B9A\u300D\u3092\u9078\u629E\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u5404\u9805\u76EE\u3092\u5909\u66F4\u3057\u3001\u8ABF\u6574\u3092\u52A0\u3048\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u753B\u9762\u53F3\u4E0B\u306B\u8868\u793A\u3055\u308C\u308B\u300C\u4FDD\u5B58\u300D\u30DC\u30BF\u30F3\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u78BA\u8A8D\u30C0\u30A4\u30A2\u30ED\u30B0\u304C\u8868\u793A\u3055\u308C\u308B\u306E\u3067\u3001\u4FDD\u5B58\u3059\u308B\u5834\u5408\u306F\u300COK\u300D\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u5909\u66F4\u304C\u30B5\u30A4\u30C8\u306B\u53CD\u6620\u3055\u308C\u307E\u3059\u3002"
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u4FDD\u5B58\u3055\u308C\u306A\u3044\u3068\u5909\u66F4\u304C\u53CD\u6620\u3055\u308C\u307E\u305B\u3093\u306E\u3067\u3001\u5FD8\u308C\u305A\u306B\u4FDD\u5B58\u3059\u308B\u3088\u3046\u306B\u3057\u307E\u3057\u3087\u3046\u3002 \u8A2D\u5B9A\u306E\u5185\u5BB9\u306B\u5909\u66F4\u304C\u3042\u308B\u5834\u5408\u306F\u3001\u753B\u9762\u79FB\u52D5\u30FB\u30EA\u30ED\u30FC\u30C9\u6642\u306B\u78BA\u8A8D\u30C0\u30A4\u30A2\u30ED\u30B0\u304C\u8868\u793A\u3055\u308C\u307E\u3059\u304C\u3001\u300C\u3053\u306E\u30DA\u30FC\u30B8\u3092\u96E2\u308C\u308B\u300D\u3092\u30AF\u30EA\u30C3\u30AF\u3059\u308B\u3068\u5909\u66F4\u5185\u5BB9\u304C\u7834\u68C4\u3055\u308C\u307E\u3059\u3002\u5909\u66F4\u5185\u5BB9\u3092\u4FDD\u5B58\u3057\u305F\u3044\u5834\u5408\u306F\u300C\u30AD\u30E3\u30F3\u30BB\u30EB\u300D\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u3066\u753B\u9762\u79FB\u52D5\u3092\u30AD\u30E3\u30F3\u30BB\u30EB\u3057\u3001\u3082\u3046\u4E00\u5EA6\u624B\u98063\u304B\u3089\u3084\u308A\u76F4\u3057\u3066\u304F\u3060\u3055\u3044\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h3", {
          id: "section2-2",
          children: "2.2 \u9805\u76EE\u3054\u3068\u306E\u8A73\u7D30\u8AAC\u660E"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ul", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("li", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("strong", {
              children: "\u6295\u7A3F\u4E0A\u4E0B\u306E\u30DA\u30FC\u30B8\u30E3\u30FC"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("br", {}), "\u6295\u7A3F\u30DA\u30FC\u30B8\u306E\u4E0A\u4E0B\u306B\u30CA\u30D3\u30B2\u30FC\u30B7\u30E7\u30F3\u3092\u8868\u793A\u3059\u308B\u304B\u3092\u30DC\u30BF\u30F3\u306E\u5207\u308A\u66FF\u3048\u3067\u9078\u629E\u3067\u304D\u307E\u3059\u3002 \u30DA\u30FC\u30B8\u30E3\u30FC\u306F\u6295\u7A3F\u30DA\u30FC\u30B8\u306B\u306E\u307F\u8868\u793A\u3055\u308C\u3001\u305D\u306E\u4ED6\u306E\u30DA\u30FC\u30B8\uFF08\u56FA\u5B9A\u30DA\u30FC\u30B8\u30FB\u30A2\u30FC\u30AB\u30A4\u30D6\u30DA\u30FC\u30B8\u30FB\u30D5\u30ED\u30F3\u30C8\u30DA\u30FC\u30B8\uFF09\u3067\u306F\u8868\u793A\u3055\u308C\u307E\u305B\u3093\u3002"]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u30CA\u30D3\u30B2\u30FC\u30B7\u30E7\u30F3\u3092\u6709\u52B9\u306B\u3059\u308B\u3068\u3001\u6295\u7A3F\u672C\u6587\u306E\u4E0A\u4E0B\u306BSame Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3\u304C\u4F5C\u6210\u3057\u305F\u30DA\u30FC\u30B8\u30E3\u30FC\u304C\u8868\u793A\u3055\u308C\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u3053\u306E\u8A2D\u5B9A\u306FSame Term Pager\u30D7\u30E9\u30B0\u30A4\u30F3\u30A4\u30F3\u30B9\u30C8\u30FC\u30EB\u6642\u304B\u3089\u6709\u52B9\u306B\u306A\u3063\u3066\u3044\u308B\u306E\u3067\u3001\u30A4\u30F3\u30B9\u30C8\u30FC\u30EB\u5F8C\u3059\u3050\u306B\u30DA\u30FC\u30B8\u30E3\u30FC\u306E\u6A5F\u80FD\u3092\u78BA\u8A8D\u3067\u304D\u307E\u3059\u3002\u7121\u52B9\u306B\u3057\u305F\u3044\u5834\u5408\u306F\u30DC\u30BF\u30F3\u3092\u30AA\u30D5\u5074\u306B\u5207\u308A\u66FF\u3048\u3066\u4FDD\u5B58\u3057\u3066\u304F\u3060\u3055\u3044\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "WordPress\u306E\u30AB\u30C6\u30B4\u30EA\u30FC\u3084\u30BF\u30B0\u3084\u3001\u3054\u81EA\u8EAB\u3067\u8A2D\u5B9A\u3055\u308C\u305F\u30AB\u30B9\u30BF\u30E0\u30BF\u30AF\u30BD\u30CE\u30DF\u30FC\u306E\u30BF\u30FC\u30E0\u3067\u7D5E\u308A\u8FBC\u3093\u3060\u72B6\u614B\u3067\u3001\u7C21\u5358\u306B\u524D\u5F8C\u306E\u8A18\u4E8B\u3068\u6700\u521D\u3068\u6700\u5F8C\u306E\u8A18\u4E8B\u306B\u79FB\u52D5\u3067\u304D\u308B\u3088\u3046\u306B\u306A\u308A\u307E\u3059\u3002"
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
          id: "section3",
          children: "3. \u8FFD\u52A0\u8A2D\u5B9A\u306E\u4F7F\u3044\u65B9"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u8FFD\u52A0\u8A2D\u5B9A\u306B\u306F\u3001\u4E00\u822C\u8A2D\u5B9A\u3088\u308A\u4E00\u6B69\u8E0F\u307F\u8FBC\u3093\u3060\u5185\u5BB9\u306E\u6A5F\u80FD\u304C\u542B\u307E\u308C\u3066\u3044\u307E\u3059\u3002 \u57FA\u672C\u7684\u306AWordPress\u30C6\u30FC\u30DE\u306E\u5834\u5408\u3001\u4E00\u822C\u8A2D\u5B9A\u306E\u307F\u3067\u30DA\u30FC\u30B8\u30E3\u30FC\u304C\u6B63\u5E38\u306B\u52D5\u4F5C\u3059\u308B\u60F3\u5B9A\u3067\u3059\u304C\u3001 \u304A\u4F7F\u3044\u306E\u30C6\u30FC\u30DE\u3084\u30AB\u30B9\u30BF\u30DE\u30A4\u30BA\u5185\u5BB9\u306B\u3088\u3063\u3066\u30DA\u30FC\u30B8\u30E3\u30FC\u306E\u7D5E\u308A\u8FBC\u307F\u6A5F\u80FD\u304C\u52D5\u4F5C\u3057\u306A\u3044\u5834\u5408\u304C\u3042\u308A\u307E\u3059\u3002 \u8FFD\u52A0\u8A2D\u5B9A\u3092\u884C\u3046\u3053\u3068\u3067\u30DA\u30FC\u30B8\u30E3\u30FC\u306E\u7D5E\u308A\u8FBC\u307F\u6A5F\u80FD\u3092\u6709\u52B9\u306B\u3067\u304D\u308B\u5834\u5408\u304C\u3042\u308A\u307E\u3059\u306E\u3067\u4E00\u822C\u8A2D\u5B9A\u306E\u307F\u3067\u52D5\u4F5C\u3057\u306A\u3044\u5834\u5408\u306B\u3054\u4F7F\u7528\u304F\u3060\u3055\u3044\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h3", {
          id: "section3-1",
          children: "3.1 \u8FFD\u52A0\u8A2D\u5B9A\u306E\u4FDD\u5B58\u3068\u53CD\u6620"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ol", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u300C\u8FFD\u52A0\u8A2D\u5B9A\u300D\u3092\u9078\u629E\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u5404\u9805\u76EE\u3092\u8ABF\u6574\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u753B\u9762\u53F3\u4E0B\u306B\u8868\u793A\u3055\u308C\u308B\u300C\u4FDD\u5B58\u300D\u30DC\u30BF\u30F3\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u78BA\u8A8D\u30C0\u30A4\u30A2\u30ED\u30B0\u304C\u8868\u793A\u3055\u308C\u308B\u306E\u3067\u3001\u4FDD\u5B58\u3059\u308B\u5834\u5408\u306F\u300COK\u300D\u3092\u30AF\u30EA\u30C3\u30AF\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u5909\u66F4\u304C\u30B5\u30A4\u30C8\u306B\u53CD\u6620\u3055\u308C\u307E\u3059\u3002"
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h4", {
          children: "\u30A2\u30FC\u30AB\u30A4\u30D6\u30DA\u30FC\u30B8\u8A2D\u5B9A"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ul", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u30DA\u30FC\u30B8\u30E3\u30FC\u304C\u52D5\u4F5C\u3057\u306A\u3044\u5834\u5408\u3001JavaScript\u3067URL\u30D1\u30E9\u30E1\u30FC\u30BF\u3092\u4ED8\u4E0E\u3057\u307E\u3059\u3002\u52D5\u4F5C\u3057\u3066\u3044\u308B\u5834\u5408\u306F\u7A7A\u6B04\u306E\u307E\u307E\u3067\u304A\u4F7F\u3044\u304F\u3060\u3055\u3044\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u30A2\u30FC\u30AB\u30A4\u30D6\u30DA\u30FC\u30B8\u306B\u8868\u793A\u3055\u308C\u308B\u5404\u6295\u7A3F\u306E\u30EA\u30F3\u30AF\u306Ea\u30BF\u30B0\u306B\u4F7F\u7528\u3055\u308C\u3066\u3044\u308B\u30AF\u30E9\u30B9\u540D\u3092\u534A\u89D2\u30D4\u30EA\u30AA\u30C9\uFF08.\uFF09\u306B\u7D9A\u3051\u3066\u8A18\u8FF0\u3057\u307E\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u30AF\u30E9\u30B9\u540D\u306F\u534A\u89D2\u30B3\u30F3\u30DE\uFF08,\uFF09\u3092\u533A\u5207\u308A\u6587\u5B57\u306B\u3057\u3066\u8907\u6570\u6307\u5B9A\u53EF\u80FD\u3067\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "\u30AF\u30E9\u30B9\u540D\u4EE5\u5916\u306ECSS\u30BB\u30EC\u30AF\u30BF\u3082\u8A2D\u5B9A\u53EF\u80FD\u3067\u3059\u3002"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
            children: "CSS\u30BB\u30EC\u30AF\u30BF\u306B\u4F7F\u7528\u3067\u304D\u306A\u3044\u6587\u5B57\u3092\u5165\u529B\u3057\u305F\u5834\u5408\u306F\u4FDD\u5B58\u3059\u308B\u3053\u3068\u304C\u3067\u304D\u307E\u305B\u3093\u3002"
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
          id: "section4",
          children: "4. \u30D8\u30EB\u30D7\u30E1\u30CB\u30E5\u30FC"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          children: "\u300C\u30D8\u30EB\u30D7\u300D\u30E1\u30CB\u30E5\u30FC\u3067\u306F\u3001\u8A2D\u5B9A\u306E\u64CD\u4F5C\u306B\u95A2\u3059\u308B\u7C21\u5358\u306A\u30AC\u30A4\u30C9\u3084\u3001\u30B5\u30DD\u30FC\u30C8\u60C5\u5831\u3092\u78BA\u8A8D\u3067\u304D\u307E\u3059\u3002 \u56F0\u3063\u305F\u3068\u304D\u306B\u306F\u3053\u306E\u30DA\u30FC\u30B8\u3092\u53C2\u7167\u3059\u308B\u3053\u3068\u3067\u3001\u64CD\u4F5C\u65B9\u6CD5\u3084\u30C8\u30E9\u30D6\u30EB\u30B7\u30E5\u30FC\u30C6\u30A3\u30F3\u30B0\u306B\u5F79\u7ACB\u3064\u60C5\u5831\u3092\u5F97\u3089\u308C\u307E\u3059\u3002"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
          id: "section5",
          children: "5. \u6CE8\u610F\u4E8B\u9805\u3068\u30D2\u30F3\u30C8"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("ul", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("li", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("strong", {
              children: "\u30E2\u30D0\u30A4\u30EB\u5BFE\u5FDC\uFF1A"
            }), "\u753B\u9762\u304C\u72ED\u304F\u306A\u308B\uFF08\u4F8B\uFF1A\u30B9\u30DE\u30FC\u30C8\u30D5\u30A9\u30F3\u8868\u793A\uFF09\u5834\u5408\u3001\u30E1\u30CB\u30E5\u30FC\u304C\u4E0A\u90E8\u306B\u79FB\u52D5\u3057\u3001\u6A2A\u4E26\u3073\u306E\u30BF\u30D6\u5F62\u5F0F\u3067\u8868\u793A\u3055\u308C\u308B\u3088\u3046\u306B\u81EA\u52D5\u3067\u8ABF\u6574\u3055\u308C\u307E\u3059\u3002"]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("li", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("strong", {
              children: "\u30C8\u30E9\u30D6\u30EB\u6642\uFF1A"
            }), "\u8A2D\u5B9A\u3092\u5909\u66F4\u3057\u305F\u5F8C\u306B\u30B5\u30A4\u30C8\u306E\u8868\u793A\u306B\u554F\u984C\u304C\u751F\u3058\u305F\u5834\u5408\u3001\u76F4\u524D\u306B\u884C\u3063\u305F\u5909\u66F4\u3092\u5143\u306B\u623B\u3059\u3053\u3068\u3067\u89E3\u6C7A\u3059\u308B\u3053\u3068\u304C\u591A\u3044\u3067\u3059\u3002"]
          })]
        })]
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_components_Navigation__WEBPACK_IMPORTED_MODULE_1__["default"], {})]
  });
};

// エントリーポイントにレンダリング
(0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.render)(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(HelpPage, {}), document.getElementById('smtrm-pager-help'));
/******/ })()
;
//# sourceMappingURL=help.js.map