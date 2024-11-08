<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php
	// global $smtrm_pager;
	// $pager = $smtrm_pager;
	// // ウィジェットの内容出力
	// if ( isset( $pager ) && method_exists( $pager, 'get_pager_area' ) ) {
	// 	echo  $pager->get_pager_area();
	// } else {
	// 	echo 'Pager is not available';
	// }
	$pager = new Smtrm_Pager();
	try {
		echo $pager->get_pager_area();
	} catch (\Exception $e) {
		error_log('Pager error: ' . $e->getMessage());
		echo 'An error occurred while displaying the pager.';
	}
	?>
</div>
