<?php
/**
 * The template for displaying search forms in sfu_theme
 *
 * @package sfu_theme
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="row collapse">
		<div class="small-8 columns">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'smart'); ?>">
		</div>
		<div class="small-4 columns">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'smart'); ?>" class="prefix button">
		</div>
	</div>
</form>
