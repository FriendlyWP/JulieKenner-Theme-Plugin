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
							    

			                <?php if (is_tax() && ($term->description !== '')) { ?>
			                   	<p class="cat-desc"><?php echo $term->description; ?></p>
		                    <?php } ?>

							<?php 

							$primaryloop = 0;
							$secondaryloop = 0;
							$outObjects = array();

							if (have_posts()) { while (have_posts()) : the_post(); 
								$outObject = new OutObject();
								$outObject->book_title = get_the_title();
								$outObject->book_link = get_permalink();
								$outObject->book_id = get_the_ID();
								
								if (function_exists('get_field') )  {

								$termID = $term->term_id;
								$primary_characters_array = get_field('primary_characters');
								$secondary_characters_array = get_field('secondary_characters');

								if ($primary_characters_array) {
									$primary = charactercheck($primary_characters_array, 'term_id', $termID);	
								}
								if ($secondary_characters_array) {
									$secondary = charactercheck($secondary_characters_array, 'term_id', $termID);
								}
								
								// characterLevel IS SET AS A PUBLIC PROPERTY IN THE outObject class in CPTS PLUGIN  
								if ($primary == 1) {
									$outObject->characterLevel = 1;
								} else {
									$outObject->characterLevel = 2;
								}
								
							}	
							
							$outObjects[] = $outObject;

							endwhile;

							usort ($outObjects, function($a, $b) {
								// characterLevel IS SET AS A PUBLIC PROPERTY IN THE outObject class in CPTS PLUGIN 
								return ($a->characterLevel > $b->characterLevel);
							});

							$lastCharacterLevel = '';
							foreach ($outObjects as $outObject) {

								// if parentFormat is changed, or first, show header
								if ($lastCharacterLevel != $outObject->characterLevel) {
									if ($outObject->characterLevel == 1) {
										echo '<h3>Stories with '. $title .' as a primary character</h3>';	
									}

									if ($outObject->characterLevel == 2) {
										echo '<h3>Stories with '. $title .' as a secondary character</h3>';	
									}

								} 
								echo do_shortcode('[showbook id="' . $outObject->book_id . '" class="in-list smallimg" display="quick" title="false" links="false" showcaption="true" showorder="true" linkto="book"][/showbook]');
								
								$lastCharacterLevel = $outObject->characterLevel;
							}


					} else { ?>

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

							<?php } ?>

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
