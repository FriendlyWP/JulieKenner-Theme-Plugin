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

								if (have_posts()) {
									echo do_shortcode('[faqs cat="' . $term->slug . '"]');
								
								}
								?>

							</article>

							

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
