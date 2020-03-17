<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<section class="comment-section">
    <div class="container">
        <div class="row">
<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'cortac' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'cortac'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => cortac_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'cortac' ),
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => cortac_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'cortac' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'cortac' ) . '</span>' . cortac_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'cortac' ); ?></p>
	<?php
	endif;
	$comments_args = array(
	        // change the title of send button 
	        'label_submit'=>'Send',
	        // change the title of the reply section
	        'title_reply'=>'Write a Reply or Comment',
	        // remove "Text or HTML to be displayed after the set of comment fields"
	        'comment_notes_after' => '',
	        // redefine your own textarea (the comment body)
	        'comment_field' => '<div class="col-md-12"><div class="form-group"><textarea id="comment" name="comment" aria-required="true" class="form-control" placeholder="*YOUR COMMENT"></textarea></div></div>',
	        'fields'=> array('author'=> '<div class="col-md-6"><input id="author" name="author" type="text" size="30" maxlength="245" aria-required="true" aria-required="true" class="form-control" placeholder="*YOUR NAME" /></div>','email' => '<div class="col-md-6"><input type="email" id="email" name="email" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required" class="form-control" placeholder="*EMAIL" /></div>'),
	        
	);

	comment_form($comments_args);
	?>

</div><!-- #comments -->
</div>
</div>
</section>