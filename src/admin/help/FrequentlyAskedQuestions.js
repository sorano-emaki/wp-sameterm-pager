import { __ } from '@wordpress/i18n';  // WordPressの翻訳機能を使用

const FrequentlyAskedQuestions = () => {
    return (
        <div className='faq-section'>
            <h1>{ __('Same Term Pager Plugin Help Page', 'wp-sameterm-pager') }</h1>
            <h2 id="section1">{ __('FAQ', 'wp-sameterm-pager') }</h2>
            <ul className="faq-list">
                <li>
                    <div className="question"><strong className="q-label">{ __('Q:', 'wp-sameterm-pager') }</strong> { __('Where can I check widget settings?', 'wp-sameterm-pager') }</div>
                    <div className="answer"><strong className="a-label">{ __('A:', 'wp-sameterm-pager') }</strong> { __('You can configure the settings from the “Appearance” → “Widgets” menu.', 'wp-sameterm-pager') }</div>
                </li>
                <li>
                    <div className="question"><strong className="q-label">{ __('Q:', 'wp-sameterm-pager') }</strong> { __('I don’t know how to customize a block theme.', 'wp-sameterm-pager') }</div>
                    <div className="answer"><strong className="a-label">{ __('A:', 'wp-sameterm-pager') }</strong> { __('Detailed instructions for using the editor are not supported. Please check the WordPress official site editor support page for more information.', 'wp-sameterm-pager') }</div>
                </li>
                <li>
                    <div className="question"><strong className="q-label">{ __('Q:', 'wp-sameterm-pager') }</strong> { __('Can I customize shortcode options?', 'wp-sameterm-pager') }</div>
                    <div className="answer"><strong className="a-label">{ __('A:', 'wp-sameterm-pager') }</strong> { __('There are currently no options for shortcodes. If you have requests, please contact the developer for consideration.', 'wp-sameterm-pager') }</div>
                </li>
                <li>
                    <div className="question"><strong className="q-label">{ __('Q:', 'wp-sameterm-pager') }</strong> { __('I see the error message "REST API is disabled. Please enable WordPress REST API." What should I do?', 'wp-sameterm-pager') }</div>
                    <div className="answer"><strong className="a-label">{ __('A:', 'wp-sameterm-pager') }</strong> { __('Same Term Pager uses the REST API in the admin panel. Please enable REST API for the admin panel only or allow Same Term Pager to use the REST API.', 'wp-sameterm-pager') }</div>
                </li>
            </ul>
        </div>

    );
};

export default FrequentlyAskedQuestions;
