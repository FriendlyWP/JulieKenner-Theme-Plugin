<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="main-content cf" role="main">

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">

								<h1><?php _e( 'Oh No!', 'bonestheme' ); ?></h1>

							</header>

							<section class="entry-content">

								<p><?php _e( 'The content you were looking for was not found. Maybe try looking again:', 'bonestheme' ); ?></p>

							</section>

							<section class="search">

									<p><?php get_search_form(); ?></p>

									<h1>Site Map</h1>

									<?php get_template_part('content','sitemap'); ?>

							</section>

							
						</article>

					</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
