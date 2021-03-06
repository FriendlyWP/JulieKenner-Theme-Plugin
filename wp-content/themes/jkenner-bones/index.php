<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							} ?>

						<div id="main" class="main-content cf" role="main">

							<header class="article-header">

									<h1 class="page-title" itemprop="headline">jk's blog</h1>

								</header> <?php // end article header ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">
									<a href="<?php the_permalink() ?>" class="alignleft" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cover-small' ); ?></a>
									<h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									

								</header>

								<section class="entry-content cf">

									<?php the_excerpt(); ?>
								</section>

								<footer class="article-footer cf">
								<!-- 	<p class="footer-comment-count">
										<?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), _n( '<span>%</span> Comments', '<span>%</span> Comments', get_comments_number(), 'bonestheme' ) );?>
									</p>
									<p class="byline vcard">
										<?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
									</p>

                 	<?php printf( __( '<p class="footer-category">Filed under: %1$s</p>', 'bonestheme' ), get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
 -->

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
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>


<?php get_footer(); ?>
