
import React from 'react';
import { __ } from '@wordpress/i18n';


// エラーが発生した際のフォールバックUIを定義
function ErrorFallback({ error }) {
    return (
        <div className='components-notice is-error'>
            <div className='components-notice__content'>
                <h3>{ __('An error occurred while loading the page.', 'wp-sameterm-pager') }</h3>
                <p>{ error.message }</p>
                <p>{ __('Please use the legacy settings page instead.', 'wp-sameterm-pager') }</p>
                <a href="admin.php?page=wp_sameterm_pager&legacy=1" style={{ color: '#0073aa' }}>
                    { __('Go to the legacy settings page', 'wp-sameterm-pager') }
                </a>
            </div>
        </div>
    );
}
export default ErrorFallback;