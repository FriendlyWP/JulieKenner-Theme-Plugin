<?php 
/*
 * Template Name: Book List
 * Description: Displays all books sorted by genre and series.
 */

get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="main-content cf" role="main">

							<h1 class="page-title">
									<?php the_title(); ?>
							</h1>


							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<section class="entry-content cf">

									<?php the_content(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
