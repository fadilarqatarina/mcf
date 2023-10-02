<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form. 
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

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) { ?>
		<h2 class="comments-title">
			<span>
				<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {				
					esc_html_e( 'One Comment', 'minfolio' );
				} else {
					printf(					
						_nx(
							'%1$s Comment',
							'%1$s Comments',
							$comments_number,		
							'comments title',	
							'minfolio'
						),
						number_format_i18n( $comments_number )					
					);
				}
				?>
			</span>	
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  =>  esc_html__( 'Reply', 'minfolio' ),
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . esc_html__( 'Previous', 'minfolio' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'minfolio' ) . '</span><i class="fa fa-arrow-right"></i>',
		) );

	} // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'minfolio' ); ?></p>
	<?php
	}
	
	$req      = get_option( 'require_name_email' );
	$html_req = ( $req ? " required='required'" : '' );
	
	$fields   =  array(
		'author'  => '<p class="comment-form-author">' .
					 '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' placeholder="' . esc_attr__( 'Name', 'minfolio' ) . ( $req ? '*' : '' ) . '" /></p>',
		'email'   => '<p class="comment-form-email">' .
					 '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' placeholder="' . esc_attr__( 'Email', 'minfolio' ) . ( $req ? '*' : '' ) . '" /></p>',
		'url'     => '<p class="comment-form-url">' .
					 '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" placeholder="' . esc_attr__( 'Website', 'minfolio' ) . '" /></p>',
	);
	
	$comments_args = array(
		'fields'               => $fields,
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title"><span>',
		'title_reply_after'    => '</span></h3>',      
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . esc_attr__( 'Comment*', 'minfolio' ) . '" ></textarea></p>',
    );

	comment_form( $comments_args );
	
	?>

</div><!-- #comments -->
