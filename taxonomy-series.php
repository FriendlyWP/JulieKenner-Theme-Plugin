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
							    	var_dump($term);
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
								$args = array(
							    	'post_type' => 'book',
							    	'orderby'    => 'meta_value_num',
					                'order' => 'ASC',
					                'meta_key' => 'number_in_series',
					                'posts_per_page' => -1,
					                'post_status' => 'publish',
					                'no_found_rows' => true,
		 					        'tax_query' => array(
							            array(
							                'taxonomy' => 'series',
							                'field' => 'slug',
							                'terms' => $term->slug,
							            ),
							        ),
							     );

							     $series_loop = new WP_Query($args);
							     if($series_loop->have_posts()) {
							        
							        echo '<div class="serieslist cf">';
							        
							        while($series_loop->have_posts()) : 
							        $series_loop->the_post();
							        	?>	
							        		<?php echo do_shortcode('[showbook id="' . get_the_id() . '" class="in-list smallimg" display="quick" links="false" showorder="true" linkto="book"]<strong><a href="' . get_permalink() . '">' . get_the_title() . '</a></strong>[/showbook]'); ?>
										
							            <?php
							        endwhile;
							        echo '</div>';
							     }
								?>

							</article>

							

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
