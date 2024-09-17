/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

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
	const imageDirectoryUrl = pluginDirectoryUrl + 'images/';
	return (
		<div { ...useBlockProps() }>
			<div class="same-term-pager-wrapper">
    <nav class="same-term-pager cf">
        <a href="#" class="oldest-post">
            <div class="double-left same-term-icon" aria-hidden="true"></div>最初<span class="pc-none">の記事から読む</span>
        </a>
        <a href="#" title="1つ前の投稿タイトル" class="prev-post cf">
            <div class="arrow-left same-term-icon" aria-hidden="true"></div>
            <figure class="prev-post-thumb"><img decoding="async" width="120" height="68" alt="no-image" src= {imageDirectoryUrl + "no-image.png"}  class="no-image post-navi-no-image" /></figure>
            <div class="prev-post-title">1つ前の投稿タイトル</div>
        </a>
        <a href="#" title="1つ後の投稿タイトル" class="next-post cf">
            <div class="arrow-right same-term-icon" aria-hidden="true"></div>
            <figure class="next-post-thumb"><img decoding="async" width="120" height="68" alt="no-image" src= {imageDirectoryUrl + "no-image.png"} class="no-image post-navi-no-image" /></figure>
            <div class="next-post-title">1つ後の投稿タイトル</div>
        </a>
        <a href="#" class="latest-post">最後<span class="pc-none">の記事を読む</span>
            <div class="double-right same-term-icon" aria-hidden="true"></div>
        </a>
    </nav>
    <div class="pager-filter">
        <div class="same-term-message">
            <div class="same-term-icon category-icon"></div>
            <div class="same-term-filter"><span>カテゴリー：</span><span>『カテゴリー名』</span><span>内の投稿を絞り込み表示中</span></div>
        </div>
    </div>
</div>
		</div>
	);
}
