import { __ } from '@wordpress/i18n'; // WordPressの翻訳機能を使用
const GettingStarted = () => {
return (
    <div className="help-content">
        <h1>{ __('Same Term Pager Plugin Help Page', 'wp-sameterm-pager') }</h1>
        <section>
            <h2 id="section1">{ __('What is the Same Term Pager Plugin?', 'wp-sameterm-pager') }</h2>
            <p>
                {__(
                'This plugin displays pagination for post pages filtered by the same term (such as category, tag, or custom taxonomy item).',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'Even if a post is registered under multiple terms, it enables navigation to previous and next posts based on post date while maintaining the same term filter.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'The previous and next post links include an icon indicating direction, a thumbnail of the featured image (or a "No Image" thumbnail if no featured image is set), and the post title, all displayed in a single line. This visually clear navigation allows users to move between posts easily.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'Using the "oldest" link, you can navigate to the post with the earliest publication date, while the "latest" link lets you move to the most recent post, both filtered by the same term.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'The term filter (smtrm_filter) is activated based on the type of archive page the user navigates from, such as a category, tag, or custom taxonomy archive page. It does not activate when moving from the front page, date-based archive, author archive, search results page, or external websites.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'The filter can be removed at any time using the "Release" button.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'When the filter is removed, users can navigate to previous and next posts by post date or move to the oldest or latest post among all posts.',
                'wp-sameterm-pager'
                )}
            </p>
        </section>
        <section>
            <h2 id="section2">{ __('What Does "Term" Mean in WordPress?', 'wp-sameterm-pager') }</h2>
            <p>
                {__(
                'Terms are items that categorize posts (taxonomy) in WordPress.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'For example, WordPress includes two default taxonomies: categories and tags. Each individual item within these taxonomies (such as each category or tag) is called a term.',
                'wp-sameterm-pager'
                )}
            </p>
        </section>
        <section>
            <h2 id="section3">{ __('What is a Pager?', 'wp-sameterm-pager') }</h2>
            <p>
                {__(
                'A pager refers to a post pagination feature. In this plugin, "pager" is used synonymously with "pagination."',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'To help visitors easily find the articles they want, pagers often appear on post pages, providing navigation links to move to the previous or next post.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'On archive pages, pagers usually appear as "Previous," "Next," and numbered page links.',
                'wp-sameterm-pager'
                )}
            </p>
            <p>
                {__(
                'The Same Term Pager plugin offers a pager specifically designed for post pages, including a filter feature that limits navigation to posts within the same term.',
                'wp-sameterm-pager'
                )}
            </p>
        </section>
        <p>
                { __('Audience: This manual is intended for users who manage their site using the WordPress admin panel. Please refer to the developer\'s website for detailed usage instructions.', 'wp-sameterm-pager') }
        </p>
        </div>
    );
};

export default GettingStarted;