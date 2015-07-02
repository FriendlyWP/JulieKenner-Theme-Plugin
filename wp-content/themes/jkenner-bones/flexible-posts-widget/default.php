<?php
/**
 * Flexible Posts Widget: Default widget template
 * 
 * @since 3.4.0
 *
 * This template was added to overcome some often-requested changes
 * to the old default template (widget.php).
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( ! empty( $title ) )
	echo $before_title . $title . $after_title;

if ( $flexible_posts->have_posts() ):
?>
	<ul class="dpe-flexible-posts">
	<?php while ( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<?php
					if ( $thumbnail == true ) {
						
						// If the post has a feature image, show it
						if ( has_post_thumbnail() ) {
							echo '<a class="imglink" href="' . get_permalink() . '">';
							the_post_thumbnail( $thumbsize );
							echo '</a>';
							echo '<a class="title" href="' . get_permalink() . '">';
								echo get_the_title();
							echo '</a>';
						// Else if the post has a mime type that starts with "image/" then show the image directly.
						} elseif ( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) {
							echo '<a class="imglink" href="' . get_permalink() . '">';
								echo wp_get_attachment_image( $post->ID, $thumbsize );
							echo '</a>';
							echo '<a class="title" href="' . get_permalink() . '">';
								echo get_the_title();
							echo '</a>';
						} else {
							echo '<a class="title full" href="' . get_permalink() . '">';
								echo get_the_title();
							echo '</a>';
						}
						
					} else {
						echo '<a class="title full" href="' . get_permalink() . '">';
							echo get_the_title();
						echo '</a>';
					}
				?>
		</li>
	<?php endwhile; ?>
	</ul><!-- .dpe-flexible-posts -->
<?php	
endif; // End have_posts()
	
echo $after_widget;
