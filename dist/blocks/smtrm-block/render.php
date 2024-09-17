<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php
	global $smtrm_pager;
	$pager = $smtrm_pager;
	// ウィジェットの内容出力
	if ( isset( $pager ) && method_exists( $pager, 'get_pager_area' ) ) {
		echo  $pager->get_pager_area();
	} else {
		echo 'Pager is not available';
	}
	?>
</div>
