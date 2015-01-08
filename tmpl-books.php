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

						<?php
							$genre_terms = get_terms('genre');

							foreach($genre_terms as $genre_term) {
							    wp_reset_query();
							    $args = array(
							    	'post_type' => 'book',
							    	'posts_per_page' => -1,
							    	'fields' => 'ids',
							        'tax_query' => array(
							            array(
							                'taxonomy' => 'genre',
							                'field' => 'slug',
							                'terms' => $genre_term->slug,
							            ),
							        ),
							     );

							     $genre_loop = new WP_Query($args);

							     if($genre_loop->have_posts()) {

							     	// This is an alternate way to get just ids of the genre_term query. 
							     	// I switched to using fields => ids in the args instead as I didn't need the extra post data. 
							     	// see http://codex.wordpress.org/Function_Reference/wp_list_pluck
							     	// $genre_post_ids = wp_list_pluck( $genre_loop->posts, 'ID' );

							        echo '<h2>'.$genre_term->name.'</h2>';

							        $series_terms = get_terms('series');

									foreach($series_terms as $series_term) {
										    wp_reset_query();
										    $args = array(
										    	//'post__in' => $genre_post_ids,
										    	'post__in' => $genre_loop->posts,
										    	'post_type' => 'book',
										    	'orderby'    => 'meta_value_num',
								                'order' => 'ASC',
								                'meta_key' => 'number_in_series',
								                'posts_per_page' => -1,
								                'no_found_rows' => true,
					 					        'tax_query' => array(
										            array(
										                'taxonomy' => 'series',
										                'field' => 'slug',
										                'terms' => $series_term->slug,
										            ),
										        ),
										     );

										     $series_loop = new WP_Query($args);
										     if($series_loop->have_posts()) {
										        echo '<h3>'.$series_term->name.'</h3>';

										        while($series_loop->have_posts()) : $series_loop->the_post();
										        	?>
										        	<div>
														<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													</div>
										            <?php
										        endwhile;
										     }
										}
									}
								}
							
						?>

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
