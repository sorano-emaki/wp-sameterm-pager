import { __ } from '@wordpress/i18n';  // WordPressの翻訳機能を使用
import { Button } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';

const PagerAdditionManual = () => {
    const [copiedText, setCopiedText] = useState(null);
    // ボタンの表示状態を管理するためのstateを作成
    const [isClipboardSupported, setIsClipboardSupported] = useState(true);

    useEffect(() => {
        // `navigator.clipboard`が利用可能かどうかをチェック
        if (!navigator.clipboard || !navigator.clipboard.writeText) {
            setIsClipboardSupported(false); // 利用できない場合は非表示に設定
        }
    }, []);
    const handleCopy = (text) => {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => {
                setCopiedText(text);
                setTimeout(() => setCopiedText(null), 2000); // 2秒後にメッセージをリセット
            }).catch((error) => {
                console.error("Copy failed", error);
            });
        }
        //  else {
        //     // Fallback: `execCommand` for unsupported environments
        //     const textArea = document.createElement("textarea");
        //     textArea.value = text;
        //     document.body.appendChild(textArea);
        //     textArea.select();
        //     try {
        //         document.execCommand("copy");
        //         setCopiedText(text);
        //         setTimeout(() => setCopiedText(null), 2000);
        //     } catch (error) {
        //         console.error("Fallback copy failed", error);
        //     }
        //     document.body.removeChild(textArea);
        // }
    };

    return (
        <div className="help-content">
            <h1>{ __('Same Term Pager Plugin Help Page', 'wp-sameterm-pager') }</h1>
            <h2>{ __('How to Add Pagers', 'wp-sameterm-pager') }</h2>
            <p>{ __('This page explains how to add a pager of the Same Term Pager plugin to any desired location. The following features are available:', 'wp-sameterm-pager') }</p>
            <ul>
                <li>{ __('Classic Widget for Classic Themes', 'wp-sameterm-pager') }</li>
                <li>{ __('Custom Block for Block Themes and Block Editors', 'wp-sameterm-pager') }</li>
                <li>{ __('Shortcode for Flexible Usage', 'wp-sameterm-pager') }</li>
            </ul>           
            <div className="smtrm-toc">
                <h2>{ __('Table of Contents', 'wp-sameterm-pager') }</h2>
                <ol>
                    <li><a href="#section1">{ __('How to Add Classic Widgets (For Classic Themes)', 'wp-sameterm-pager') }</a>
                        <ol>
                            <li><a href="#section1-1">{ __('Steps to Use the Pager Widget', 'wp-sameterm-pager') }</a></li>
                            <li><a href="#section1-2">{ __('Pager Widget Settings', 'wp-sameterm-pager') }</a></li>
                        </ol>
                    </li>
                    <li><a href="#section2">{ __('How to Add Custom Blocks (For Block Themes)', 'wp-sameterm-pager') }</a>
                        <ol>
                            <li><a href="#section2-1">{ __('Steps to Use the Pager Block in Block Themes', 'wp-sameterm-pager') }</a></li>
                            <li><a href="#section2-2">{ __('Pager Block Settings', 'wp-sameterm-pager') }</a></li>
                        </ol>
                    </li>
                    <li><a href="#section3">{ __('How to Add Shortcodes', 'wp-sameterm-pager') }</a>
                        <ol>
                            <li><a href="#section3-1">{ __('Steps to Use Shortcodes', 'wp-sameterm-pager') }</a></li>
                            <li><a href="#section3-2">{ __('Preview and Publish', 'wp-sameterm-pager') }</a></li>
                        </ol>
                    </li>
                    <li><a href="#section4">{ __('Troubleshooting', 'wp-sameterm-pager') }</a>
                        <ol>
                            <li><a href="#section4-1">{ __('When Blocks or Widgets Don’t Appear', 'wp-sameterm-pager') }</a></li>
                            <li><a href="#section4-2">{ __('When Shortcodes Don’t Work Correctly', 'wp-sameterm-pager') }</a></li>
                        </ol>
                    </li>
                    <li><a href="#section5">{ __('Support', 'wp-sameterm-pager') }</a></li>
                </ol>
            </div>

            <section>
                <h2 id="section1">{ __('How to Add Classic Widgets (For Classic Themes)', 'wp-sameterm-pager') }</h2>
                <h3 id="section1-1">{ __('Steps to Use the Pager Widget', 'wp-sameterm-pager') }</h3>
                <ol>
                    <li>{ __('Log in to the admin panel.', 'wp-sameterm-pager') }</li>
                    <li>{ __('From the menu, go to "Appearance" → "Widgets".', 'wp-sameterm-pager') }</li>
                    <li>{ __('Select the widget area you want to use from the list of widget areas displayed on the left.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Find "WP Same Term Pager" in "Available Widgets" on the right, and click to add it.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Enter the necessary settings for the widget and click the "Save" button.', 'wp-sameterm-pager') }</li>
                </ol>
                <h3 id="section1-2">{ __('Pager Widget Settings', 'wp-sameterm-pager') }</h3>
                <ul>
                    <li>{ __('You can change the display settings options within the widget settings screen.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Classic widgets do not have a preview feature.', 'wp-sameterm-pager') }</li>
                    <li>{ __('After saving, the changes will be reflected in real-time on the pages visible to all users, including visitors who are not logged in.', 'wp-sameterm-pager') }</li>
                </ul>
            </section>

            <section>
                <h2 id="section2">{ __('How to Add Custom Blocks (For Block Themes)', 'wp-sameterm-pager') }</h2>
                <h3 id="section2-1">{ __('Steps to Use the Pager Block in Block Themes', 'wp-sameterm-pager') }</h3>
                <ol>
                    <li>{ __('Go to "Appearance" → "Editor" to open the "Design Editor".', 'wp-sameterm-pager') }</li>
                    <li>{ __('Select the item where you want to add the block and open the editor.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Move the cursor to the position where you want to add the block in the editor, and click the "+" button (Toggle block inserter) at the top left to open the block addition panel.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Search for "Same Term Pager Block" or find it under "Category > Widgets".', 'wp-sameterm-pager') }</li>
                    <li>{ __('Add the block to the desired position.', 'wp-sameterm-pager') }</li>
                </ol>
                <h3 id="section2-2">{ __('Pager Block Settings', 'wp-sameterm-pager') }</h3>
                <ul>
                    <li>{ __('You can intuitively customize the display position in the editor.', 'wp-sameterm-pager') }</li>
                    <li>{ __('The settings are reflected in real-time in the preview.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Although the pager block can be added anywhere, if you expect repeated use throughout the site, it is recommended to add it as "Navigation" or "Pattern", and configure it as a "Template Part" when editing the "Template".', 'wp-sameterm-pager') }</li>
                    <li>{ __('In the preview display, the pager will appear on pages other than the post page (such as archive pages and fixed pages), but the pager will only be displayed on the post page (including custom posts).', 'wp-sameterm-pager') }</li>
                </ul>
            </section>

            <section>
                <h2 id="section3">{ __('How to Add Shortcodes', 'wp-sameterm-pager') }</h2>
                <h3 id="section3-1">{ __('Steps to Use Shortcodes', 'wp-sameterm-pager') }</h3>
                <ol>
                    <li>{ __('Open the "Post" editing screen.', 'wp-sameterm-pager') }</li>
                    {isClipboardSupported && (
                    <li>{ __('Enter the shortcode in the following format where you want to use it.You can copy the shortcode to the clipboard using the Copy button.', 'wp-sameterm-pager') }</li>
                    )}
                </ol>
                <div className="example">
                    <ul>
                        <li>
                            <span>{ __('To add the entire pager', 'wp-sameterm-pager') }</span>
                            <span className="line"></span>
                            <div className="copy-container">
                                <code>[sameterm_pager]</code>
                                {isClipboardSupported && (
                                <Button
                                    isPrimary
                                    onClick={() => handleCopy('[sameterm_pager]')}
                                    className="copy-button"
                                >
                                    {copiedText === '[sameterm_pager]' ? __('Copied!', 'wp-sameterm-pager') : __('Copy', 'wp-sameterm-pager')}
                                </Button>
                                )}
                            </div>
                        </li>
                        <li>
                            <span>{ __('To add the release button for the filtering function', 'wp-sameterm-pager') }</span>
                            <span className="line"></span>
                            <div className="copy-container">
                                <code>[sameterm_release]</code>
                                {isClipboardSupported && (
                                <Button
                                    isPrimary
                                    onClick={() => handleCopy('[sameterm_release]')}
                                    className="copy-button"
                                >
                                    {copiedText === '[sameterm_release]' ? __('Copied!', 'wp-sameterm-pager') : __('Copy', 'wp-sameterm-pager')}
                                </Button>
                                )}
                            </div>
                        </li>
                        <li>
                            <span>{ __('To add a “Read the Oldest post” pagination link', 'wp-sameterm-pager') }</span>
                            <span className="line"></span>
                            <div className="copy-container">
                                <code>[sameterm_oldest]</code>
                                {isClipboardSupported && (
                                <Button
                                    isPrimary
                                    onClick={() => handleCopy('[sameterm_oldest]')}
                                    className="copy-button"
                                >
                                    {copiedText === '[sameterm_oldest]' ? __('Copied!', 'wp-sameterm-pager') : __('Copy', 'wp-sameterm-pager')}
                                </Button>
                                )}
                            </div>
                        </li>
                        <li>
                            <span>{ __('To add a “Read the Prev post” pagination link', 'wp-sameterm-pager') }</span>
                            <span className="line"></span>
                            <div className="copy-container">
                                <code>[sameterm_prev]</code>
                                {isClipboardSupported && (
                                <Button
                                    isPrimary
                                    onClick={() => handleCopy('[sameterm_prev]')}
                                    className="copy-button"
                                >
                                    {copiedText === '[sameterm_prev]' ? __('Copied!', 'wp-sameterm-pager') : __('Copy', 'wp-sameterm-pager')}
                                </Button>
                                )}
                            </div>
                            
                        </li>
                        <li>
                            <span>{ __('To add a “Read the Next post” pagination link', 'wp-sameterm-pager') }</span>
                            <span className="line"></span>
                            <div className="copy-container">
                                <code>[sameterm_next]</code>
                                {isClipboardSupported && (
                                <Button
                                    isPrimary
                                    onClick={() => handleCopy('[sameterm_next]')}
                                    className="copy-button"
                                >
                                    {copiedText === '[sameterm_next]' ? __('Copied!', 'wp-sameterm-pager') : __('Copy', 'wp-sameterm-pager')}
                                </Button>
                                )}
                            </div>
                            
                        </li>
                        <li>
                            <span>{ __('To add a “Read the latest post” pagination link', 'wp-sameterm-pager') }</span>
                            <span className="line"></span>
                            <div className="copy-container">
                                <code>[sameterm_latest]</code>
                                {isClipboardSupported && (
                                <Button
                                    isPrimary
                                    onClick={() => handleCopy('[sameterm_latest]')}
                                    className="copy-button"
                                >
                                    {copiedText === '[sameterm_latest]' ? __('Copied!', 'wp-sameterm-pager') : __('Copy', 'wp-sameterm-pager')}
                                </Button>
                                )}
                            </div>
                        </li>
                    </ul>
                </div>
                <h3 id="section3-2">{ __('Preview and Publish', 'wp-sameterm-pager') }</h3>
                <ul>
                    <li>{ __('After entering the shortcode, you can use the preview feature in the post screen to see how it will actually be displayed. If there are no issues, click the "Publish" button or the "Update" button to publish it.', 'wp-sameterm-pager') }</li>
                    <li>{ __('Shortcodes can also be registered as "Text" widgets in widget areas. Note that text widgets do not have a preview display. When you click the "Save" button, the settings are immediately reflected on the site.', 'wp-sameterm-pager') }</li>
                    <li>{ __('In the widget area, you can also use Classic Widgets and Custom Blocks. These are easier to add than shortcodes, so consider using them.', 'wp-sameterm-pager') }</li>
                </ul>
            </section>

            <section>
                <h2 id="section4">{ __('Troubleshooting', 'wp-sameterm-pager') }</h2>
                <h3 id="section4-1">{ __('When Blocks or Widgets Don’t Appear', 'wp-sameterm-pager') }</h3>
                <ul>
                    <li>{ __('There may be a conflict with the theme or plugins you are using. Disable the theme or other plugins to check for conflicts.', 'wp-sameterm-pager') }</li>
                </ul>
                <h3 id="section4-2">{ __('When Shortcodes Don’t Work Correctly', 'wp-sameterm-pager') }</h3>
                <ul>
                    <li>{ __('Check for any spelling mistakes in the shortcode.', 'wp-sameterm-pager') }</li>
                </ul>
            </section>

            <section>
                <h2 id="section5">{ __('Support', 'wp-sameterm-pager') }</h2>
                <p>{ __('If you have further questions or encounter any problems, please contact the developer.', 'wp-sameterm-pager') }</p>
            </section>
        </div>
    );
};

export default PagerAdditionManual;
