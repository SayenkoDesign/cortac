<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'cortac' ); ?>">
	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>
</nav>
