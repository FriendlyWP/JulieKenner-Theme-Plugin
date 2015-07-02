<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							} ?>

						<div id="main" class="main-content cf" role="main">

							<?php if ( is_tax() ) { ?>
							    	<?php 
							    	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

							    	$title = $term->name; ?>
							    		<h1 class="page-title">
							    	    		<?php echo $title; ?>
							        	</h1>
							    <?php } elseif ( is_post_type_archive() ) { ?>
							    	<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
							    <?php } ?>
							    
							<?php if (is_category() && category_description()) { ?>
			                   	<div class="cat-desc"><?php echo category_description(); ?></div>
			                <?php } ?>

			                <?php if (is_tax() && ($term->description !== '')) { ?>
			                   	<div class="cat-desc"><?php echo $term->description; ?></div>
		                    <?php } ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<?php 

								//if (have_posts()) {

								$series_terms = get_terms('series');

								foreach($series_terms as $series_term) {
									    wp_reset_query();
										$args = array(
									    	
									    	'post_type' => 'book',
									    	'orderby'    => 'meta_value_num',
							                'order' => 'ASC',
							                'meta_key' => 'number_in_series',
							                'posts_per_page' => -1,
							                'no_found_rows' => true,
								            'tax_query' => array(
												'relation' => 'AND',
												array(
									                'taxonomy' => 'series',
									                'field' => 'slug',
									                'terms' => $series_term->slug,
									            ),
												array(
									                'taxonomy' => 'genre',
									                'field' => 'slug',
									                'terms' => $term->slug,
									            ),
											),
									        
									     );

							     $series_loop = new WP_Query($args);
							     if($series_loop->have_posts()) {
							        
							        //echo '<div class="serieslist cf">';
							        echo '<h3><a href="' . get_term_link($series_term->slug, 'series') . '">'.$series_term->name.'</a></h3>';
									echo '<div class="serieslist cf">';
										        /*if ( term_description($series_term->term_id, 'series')) {
										        	echo term_description($series_term->term_id, 'series');
										        }*/
							        while($series_loop->have_posts()) : 
							        $series_loop->the_post();
							        	?>	
							        		<?php echo do_shortcode('[showbook id="' . get_the_id() . '" class="in-list smallimg" display="quick" links="false" showcaption="true" showorder="true" linkto="book"][/showbook]'); 

							        		//echo do_shortcode('[showbook id="' . get_the_id() . '" class="in-list smallimg" display="quick" links="false" showorder="true" linkto="book"]<strong><a href="' . get_permalink() . '">' . get_the_title() . '</a></strong>[/showbook]');
							        		?>
										
							            <?php
							        endwhile;
							        echo '</div>';
							     }
							 }
//}
								?>

							</article>

							

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
