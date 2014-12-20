<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
					<?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							} ?>

					<div id="main" class="main-content cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<?php 
								// if this book has a 'parent' it is an order page, show content-order.php
								if ( $post->post_parent !== 0 ) {
									echo get_template_part('content', 'order');
								} // otherwise ths is the main book page, show content-single-book.php
								else { 
									echo get_template_part('content', 'single-book');
									echo '<a href="' . get_permalink() . 'order/">See all ordering options for this title</a>';
								?>
							<?php }  ?>

								
							</article>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div><!-- #main -->

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
