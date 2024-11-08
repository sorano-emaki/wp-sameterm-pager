import { __ } from '@wordpress/i18n'; // WordPressの翻訳機能を使用
import {
    ToggleControl,
} from '@wordpress/components';

const SettingMenu = () => {
    return (
        <div className="help-content">
            <h1>{ __('Same Term Pager Plugin Help Page', 'wp-sameterm-pager') }</h1>

            <div className="smtrm-toc">
                <h2>{ __('Table of Contents', 'wp-sameterm-pager') }</h2>
                <ol>
                    <li><a href="#section1">{ __('What is the Settings Menu?', 'wp-sameterm-pager') }</a></li>
                    <li>
                        <a href="#section2">{ __('How to Use General Settings', 'wp-sameterm-pager') }</a>
                        <ol>
                            <li><a href="#section2-1">{ __('Saving and Applying General Settings', 'wp-sameterm-pager') }</a></li>
                            <li>
                                <a href="#section2-2">{ __('Detailed Explanation of General Settings', 'wp-sameterm-pager') }</a>
                                <ol>
                                    <li><a href="#section2-2-1">{ __('Pager Above and Below Posts', 'wp-sameterm-pager') }</a></li>
                                    <li><a href="#section2-2-2">{ __('Custom Text for Pager', 'wp-sameterm-pager') }</a>
                                        <ol>
                                            <li><a href="#section2-2-2-1">{ __('How to Customize', 'wp-sameterm-pager') }</a></li>
                                            <li><a href="#section2-2-2-2">{ __('Using HTML Tags', 'wp-sameterm-pager') }</a></li>
                                            <li><a href="#section2-2-2-3">{ __('Special Note for the "pc-none" and "sp-none" Classes', 'wp-sameterm-pager') }</a></li>
                                            <li><a href="#section2-2-2-4">{ __('Responsive Layout', 'wp-sameterm-pager') }</a></li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <a href="#section3">{ __('How to Use Advanced Settings', 'wp-sameterm-pager') }</a>
                        <ol>
                            <li><a href="#section3-1">{ __('Saving and Applying Advanced Settings', 'wp-sameterm-pager') }</a></li>
                            <li>
                                <a href="#section3-2">{ __('Detailed Explanation of Advanced Settings', 'wp-sameterm-pager') }</a>
                                <ol>
                                    <li><a href="#section3-2-1">{ __('Archive Page Settings', 'wp-sameterm-pager') }</a></li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li><a href="#section4">{ __('Help Menu', 'wp-sameterm-pager') }</a></li>
                    <li><a href="#section5">{ __('Notes and Tips', 'wp-sameterm-pager') }</a></li>
                </ol>
            </div>

            <section>
                <h2 id="section1">{ __('What is the Settings Menu?', 'wp-sameterm-pager') }</h2>
                <p>
                    { __('The settings menu is a menu for selecting the settings page of the Same Term Pager plugin. The menu contents are only visible to users with administrative privileges, but it allows you to configure settings related to site behavior and display.', 'wp-sameterm-pager') }
                </p>
            </section>

            <section>
                <h2 id="section2">{ __('How to Use General Settings', 'wp-sameterm-pager') }</h2>
                <p>
                    { __('In "General Settings," you can configure basic settings that affect the entire site. The settings you configure here will be reflected in pages and features visible to all users, including visitors who are not logged in.', 'wp-sameterm-pager') }
                </p>

                <section>
                    <h3 id="section2-1">{ __('Saving and Applying General Settings', 'wp-sameterm-pager') }</h3>
                    <ol>
                        <li>{ __('Select "General Settings" from the settings menu.', 'wp-sameterm-pager') }</li>
                        <li>{ __('Change each item as needed.', 'wp-sameterm-pager') }</li>
                        <li>{ __('Click the "Save" button located at the bottom right of the screen.', 'wp-sameterm-pager') }</li>
                        <li>{ __('A confirmation dialog will appear. If you want to save, click "OK".', 'wp-sameterm-pager') }</li>
                        <li>{ __('Changes will be applied to the site.', 'wp-sameterm-pager') }</li>
                    </ol>
                    <p>
                        { __('Make sure to save your changes; they will not be applied unless saved. If there are changes to the settings, a confirmation dialog will appear when navigating away or reloading the page. Clicking "Leave this Page" will discard the changes. To save the changes, click "Cancel" to cancel the page navigation and start over from step 3.', 'wp-sameterm-pager') }
                    </p>
                </section>

                <section>
                    <h3 id="section2-2">{ __('Detailed Explanation of General Settings', 'wp-sameterm-pager') }</h3>

                    <section>
                        <h4 id="section2-2-1">{ __('Pager Above and Below Posts', 'wp-sameterm-pager') }</h4>
                        <ul>
                            <li>{ __('You can choose whether to display a pager (navigation for moving between pages) above and below post pages by toggling a button. The pager is displayed only on post pages (including custom posts) and not on other pages (static pages, archive pages, front pages, etc.).', 'wp-sameterm-pager') }</li>
                            <li>{ __('When the toggle button is enabled, a pager created by the Same Term Pager plugin will be displayed above and below the post content. Below are sample states of the toggle button for explanation purposes.', 'wp-sameterm-pager') }</li>
                            <div className="example">
                                <ToggleControl
                                    label={ __('Enabled State', 'wp-sameterm-pager') }
                                    checked
                                />
                                <ToggleControl
                                    label={ __('Disabled State', 'wp-sameterm-pager') }
                                />
                            </div>
                            <li>{ __('This setting is enabled from the time the Same Term Pager plugin is installed, so you can check the pager functionality immediately after installation. If you want to disable it, toggle the button to the disabled state and save.', 'wp-sameterm-pager') }</li>
                            <li>{ __('The filtering function is enabled when navigating from various archive pages (category, tag, custom taxonomy). When navigating from the site\'s top or other navigation links, it will not be filtered and posts will be retrieved based on post date.', 'wp-sameterm-pager') }</li>
                            <li>{ __('You can easily navigate to previous and next posts, as well as the oldest and latest posts, within the categories, tags, or custom taxonomies you have set.', 'wp-sameterm-pager') }</li>
                            <li>{ __('If you do not want to display the pager above and below posts and want to add it elsewhere, disable the "Pager Above and Below Posts" setting. For adding the pager to other locations, please refer to the "How to Add Pagers" instructions.', 'wp-sameterm-pager') }</li>
                        </ul>
                    </section>

                    <section>
                        <h4 id="section2-2-2">{__('Custom Text for Pager', 'wp-sameterm-pager')}</h4>
                        <p>
                            {__('You can customize the text displayed for the "Read the oldest post" and "Read the latest post" pagination links. This allows you to modify the labels for these pagination links to fit your needs.', 'wp-sameterm-pager')}
                        </p>

                        <section>
                            <h5 id="section2-2-2-1">{__('How to Customize', 'wp-sameterm-pager')}</h5>
                            <ol>
                                <li>{__('Navigate to the "General Settings" page.', 'wp-sameterm-pager')}</li>
                                <li>{__('In the "Custom Text for Pager" section, you will find two text fields:', 'wp-sameterm-pager')}</li>
                                <ul>
                                    <li>{__('Text for "Read the oldest post"', 'wp-sameterm-pager')}</li>
                                    <li>{__('Text for "Read the latest post"', 'wp-sameterm-pager')}</li>
                                </ul>
                                <li>{__('You can enter custom text in these fields. For example:', 'wp-sameterm-pager')}</li>
                                <ul>
                                    <li>{__('Latest' , 'wp-sameterm-pager')}</li>
                                    <li><code>{__('<span class="pc-none">Start from the </span>oldest post', 'wp-sameterm-pager')}</code></li>
                                    <li><code>{__('<span class="sp-none">New</span><span class="pc-none">Begin reading the latest post</span>', 'wp-sameterm-pager')}</code></li>
                                </ul>
                                <li>{__('The text entered will be applied to the corresponding pagination links.', 'wp-sameterm-pager')}</li>
                            </ol>
                        </section>

                        <section>
                            <h5 id="section2-2-2-2">{__('Using HTML Tags', 'wp-sameterm-pager')}</h5>
                            <p>
                                {__('You can use HTML tags like <span>, <b>, <i>, and others that are allowed by WordPress\' wp_kses_post() function. Unsupported tags will be automatically removed.', 'wp-sameterm-pager')}
                            </p>
                            <p>{__('Here are the allowed HTML tags:', 'wp-sameterm-pager')}</p>
                            <ul>
                                <li><code>{'<b>'}</code></li>
                                <li><code>{'<del>'}</code></li>
                                <li><code>{'<em>'}</code></li>
                                <li><code>{'<i>'}</code></li>
                                <li><code>{'<strike>'}</code></li>
                                <li><code>{'<strong>'}</code></li>
                                <li><code>{'<span>'}</code></li>
                                <li>{__('and more.', 'wp-sameterm-pager')}</li>
                            </ul>
                        </section>

                        <section>
                            <h5 id="section2-2-2-3">{__('Special Note for the "pc-none" and "sp-none" Classes', 'wp-sameterm-pager')}</h5>
                            <p>
                                {__('If you want to hide specific parts of the text in the PC view but display it in a mobile or sidebar layout, you can use the "pc-none" class. Text wrapped in this class will not be displayed when the pager is shown in a single-line layout on PC, but it will appear when the pager links stack vertically in narrow views, such as in mobile or sidebar displays.', 'wp-sameterm-pager')}
                            </p>
                            <p>
                                {__('Similarly, if you want to hide specific parts of the text in the mobile or sidebar layout but display them in the PC view, you can use the "sp-none" class. Text wrapped in this class will not be displayed when the pager is shown in a mobile or sidebar layout, but it will appear in the PC view when the pager links are displayed horizontally.', 'wp-sameterm-pager')}
                            </p>
                            <p>{__('For example:', 'wp-sameterm-pager')}</p>
                            <ul>
                                <li><code>{__('<span class="pc-none">Start from the </span>oldest post', 'wp-sameterm-pager')}</code></li>
                            </ul>
                            <p>
                                {__('In PC view with a single-line layout, only "oldest post" will be shown. In mobile view (600px or less), or in the sidebar, "Start from the oldest post" will be fully visible.', 'wp-sameterm-pager')}
                            </p>
                            <ul>
                                <li><code>{__('<span class="sp-none">New</span><span class="pc-none">Begin reading the latest post</span>', 'wp-sameterm-pager')}</code></li>
                            </ul>
                            <p>
                                {__('In the PC view with a single-line layout, only "New" will be shown. In mobile view (600px or less), or in the sidebar, only "Begin reading the latest post" will be visible.', 'wp-sameterm-pager')}
                            </p>
                        </section>

                        <section>
                            <h5 id="section2-2-2-4">{__('Responsive Layout', 'wp-sameterm-pager')}</h5>
                            <p>
                                {__('When the pagination is placed in areas narrower than 600px (like in mobile view or a sidebar), the pagination links will stack vertically for better readability. The "pc-none" and "sp-none" classes help manage what text is shown or hidden depending on the display width, allowing you to tailor the appearance of pagination links for both PC and mobile views.', 'wp-sameterm-pager')}
                            </p>
                        </section>
                    </section>
                </section>
            </section>

            <section>
                <h2 id="section3">{ __('How to Use Advanced Settings', 'wp-sameterm-pager') }</h2>
                <p>
                    { __('Advanced Settings include more advanced features compared to general settings. In most basic WordPress themes, it is assumed that the pager will function correctly with only general settings. However, depending on your theme or customizations, the pager filtering feature may not work.', 'wp-sameterm-pager') }
                    { __('By using Advanced Settings, you can enable the pager filtering feature if it does not work with general settings alone.', 'wp-sameterm-pager') }
                </p>

                <section>
                    <h3 id="section3-1">{ __('Saving and Applying Advanced Settings', 'wp-sameterm-pager') }</h3>
                    <ol>
                        <li>{ __('Select "Advanced Settings".', 'wp-sameterm-pager') }</li>
                        <li>{ __('Change each item as needed.', 'wp-sameterm-pager') }</li>
                        <li>{ __('Click the "Save" button located at the bottom right of the screen.', 'wp-sameterm-pager') }</li>
                        <li>{ __('A confirmation dialog will appear. If you want to save, click "OK".', 'wp-sameterm-pager') }</li>
                        <li>{ __('Changes will be applied to the site.', 'wp-sameterm-pager') }</li>
                    </ol>
                </section>

                <section>
                    <h3 id="section3-2">{ __('Detailed Explanation of Advanced Settings', 'wp-sameterm-pager') }</h3>

                    <section>
                        <h4 id="section3-2-1">{ __('Archive Page Settings', 'wp-sameterm-pager') }</h4>
                        <ul>
                            <li>{ __('If the pager filtering feature does not work after navigating from various archive pages (category, tag, custom taxonomy), JavaScript will add URL parameters to the post links. If it is already working, leave this field blank.', 'wp-sameterm-pager') }</li>
                            <li>{ __('In the input field, enter the class names used in the <a> tags of post links within the article list on the archive page, prefixed with a period (.).', 'wp-sameterm-pager') }</li>
                            <li>{ __('Class names can be specified multiple times, separated by commas.', 'wp-sameterm-pager') }</li>
                            <li>{ __('Other CSS selectors besides class names can also be specified.', 'wp-sameterm-pager') }</li>
                            <li>{ __('If you enter characters that cannot be used in CSS selectors, you will not be able to save the settings.', 'wp-sameterm-pager') }</li>
                        </ul>
                    </section>
                </section>
            </section>

            <section>
                <h2 id="section4">{ __('Help Menu', 'wp-sameterm-pager') }</h2>
                <p>
                    { __('The "Help" menu provides a simple guide for operating the settings, as well as support information. If you are unsure about something, refer to this page for useful information on how to operate the plugin or troubleshoot problems.', 'wp-sameterm-pager') }
                </p>
            </section>

            <section>
                <h2 id="section5">{ __('Notes and Tips', 'wp-sameterm-pager') }</h2>
                <ul>
                    <li><strong>{ __('Mobile Support:', 'wp-sameterm-pager') }</strong> { __('When the screen becomes narrow (e.g., on smartphone displays), the menu automatically adjusts to be displayed as horizontally arranged tabs.', 'wp-sameterm-pager') }</li>
                    <li><strong>{ __('Troubleshooting:', 'wp-sameterm-pager') }</strong> { __('If there are display issues on the site after changing settings, reverting the most recent changes often resolves the problem.', 'wp-sameterm-pager') }</li>
                </ul>
            </section>
        </div>
    );
};

export default SettingMenu;
