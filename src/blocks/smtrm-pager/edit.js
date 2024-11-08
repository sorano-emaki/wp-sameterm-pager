/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __, sprintf } from '@wordpress/i18n';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	const imageDirectoryUrl = smtrmCustomBlockData.pluginDirectoryUrl + 'images/';
    let oldestPostText = sprintf(
        '<span class="pc-none">%s</span><span class="sp-none">%s</span>',
        __('Read the oldest post', 'wp-sameterm-pager'),
        __('Oldest', 'wp-sameterm-pager')
    );
    let latestPostText = sprintf(
        '<span class="pc-none">%s</span><span class="sp-none">%s</span>',
        __('Read the latest post', 'wp-sameterm-pager'),
        __('Latest', 'wp-sameterm-pager')
    );
    if(smtrmCustomBlockData.userOldestText){
        oldestPostText = smtrmCustomBlockData.userOldestText;
    }
    if(smtrmCustomBlockData.userLatestText){
        latestPostText = smtrmCustomBlockData.userLatestText;
    }
    const containsHTML = (str) =>{
        const tagRegex = /<\/?[a-z][\s\S]*>/i; // シンプルなタグ検出用の正規表現
        return tagRegex.test(str);
    }
	return (
		<div { ...useBlockProps() }>
            <div className="same-term-pager-wrapper">
                <nav className="same-term-pager cf">
                    <a href="#" className="oldest-post same-term-nav-link">
                        <div className="double-left same-term-icon" aria-hidden="true"></div>
                        {containsHTML(oldestPostText) ? (
                            <span dangerouslySetInnerHTML={{ __html: oldestPostText }} />
                        ) : (
                            <span>{oldestPostText}</span>
                        )}
                    </a>
                    <a href="#" title={__('Previous post title', 'wp-sameterm-pager')} className="prev-post same-term-nav-link">
                        <div className="arrow-left same-term-icon" aria-hidden="true"></div>
                        <figure className="prev-post-thumb">
                            <img decoding="async" width="120" height="68" alt={__('No image', 'wp-sameterm-pager')} src={imageDirectoryUrl + "no-image.png"} className="no-image post-navi-no-image" />
                        </figure>
                        <div className="prev-post-title">{__('Previous post title', 'wp-sameterm-pager')}</div>
                    </a>
                    <a href="#" title={__('Next post title', 'wp-sameterm-pager')} className="next-post same-term-nav-link">
                        <div className="arrow-right same-term-icon" aria-hidden="true"></div>
                        <figure className="next-post-thumb">
                            <img decoding="async" width="120" height="68" alt={__('No image', 'wp-sameterm-pager')} src={imageDirectoryUrl + "no-image.png"} className="no-image post-navi-no-image" />
                        </figure>
                        <div className="next-post-title">{__('Next post title', 'wp-sameterm-pager')}</div>
                    </a>
                    <a href="#" className="latest-post same-term-nav-link">
                        {containsHTML(latestPostText) ? (
                            <span dangerouslySetInnerHTML={{ __html: latestPostText }} />
                        ) : (
                            <span>{latestPostText}</span>
                        )}
                        <div className="double-right same-term-icon" aria-hidden="true"></div>
                    </a>
                </nav>
                <div className="pager-filter cf">
                    <div className="same-term-message">
                        <div className="same-term-icon category-icon"></div>
                        <div className="same-term-filter">
                            <span>{__('Displaying posts filtered by Category: “Category Name”', 'wp-sameterm-pager')}</span>
                        </div>
                    </div>
                    <div>
                        <a href="#" className="release-button">
                            <span className="cancel-icon"></span>
                            <span>{__('Release', 'wp-sameterm-pager')}</span>
                        </a>
                    </div>
                </div>
            </div>
		</div>
	);
}

