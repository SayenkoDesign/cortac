<?php
/**
 * Template part for displaying video posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
	$content = apply_filters( 'the_content', get_the_content() );
	$video = false;

	// Only get video from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			echo cortac_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<div class="row"> 
	<header class="entry-header">
		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="background-title" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') no-repeat;background-size:cover">
			<div class="row column title-container"> 
				<div class="row column">
			<?php
				if ( is_single() ) {
					the_title( '<h2 class="entry-title">', '</h2>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
			?>	
				</div>
			</div>
			<div class="row column entry-meta">
				<?php
					if ( 'post' === get_post_type() ) :
						echo '<div class="row column entry-meta-date">';
							if ( is_single() ) :
								cortac_posted_on();
							else :
								echo cortac_time_link();
								cortac_edit_link();
							endif;
						echo '</div><!-- .entry-meta -->';
						echo '<div class="row column entry-meta-author">';
						$default = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y';
						$args = array('height' => 96,'width'=>96);
						echo get_avatar( get_the_author_meta('ID'), 96, $default, '', $args ); 
						echo '</div>';
					endif;
				?>
			</div>
		</div><!-- .post-thumbnail -->
		<div class="row column"> 
			<div class="row column entry-meta">
				<div class="row column entry-meta-byline"> 
					<?php echo $author = get_the_author(); ?> 
				</div>
			</div>
		</div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	</div>

	<div class="row entry-content">
		<?php if ( ! is_single() ) :

			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="entry-video">';
						echo $video_html;
					echo '</div>';
				}
			endif;

		endif;

		if ( is_single() || empty( $video ) ) :

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cortac' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'cortac' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		endif; ?>
	</div><!-- .entry-content -->
	<div class="entry-footer">
		<?php if ( is_single() ) : ?>
			<?php cortac_edit_link();//cortac_entry_footer(); ?>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->	