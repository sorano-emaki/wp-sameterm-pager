<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php
	$pager = new Smtrm_Pager_Area();
	echo $pager->get_pager_area();
	?>
</div>
