<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php
        $pager = new Smtrm_Pager();
        try {
            echo $pager->get_pager_area();
        } catch (\Exception $e) {
            error_log('Pager error: ' . $e->getMessage());
            echo 'An error occurred while displaying the pager.';
        }
    ?>
</div>