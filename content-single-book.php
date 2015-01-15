<header class="article-header">

	<h1 class="page-title" itemprop="headline"><em><?php the_title(); ?></em></h1>

</header> <?php // end article header ?>

<section class="entry-content cf" itemprop="articleBody">
	<?php 

	$current_url = get_permalink();
	
	// SUB-TITLE, BLURB AND JUMPLINKS TO EXCERPT, REVIEWS ETC
	if (function_exists('get_field')) {
		echo '<div class="book-section">';
			// BOOK COVER & QUICK BUY LINKS
			echo do_shortcode('[showbook id="' . get_the_id() . '" class="fullimage alignleft"][/showbook]');

			// SUB TITLE
			if ( get_field('sub_title') ) {
				?>
				<h3><?php the_field('sub_title'); ?></h3>
				<?php
			}

			// BLURB
			if ( get_field('blurb') ) {
				?>
				<?php the_field('blurb'); ?>
				<?php
			}

			if ( get_field('book_trailer') || get_field('book_trailer') || get_field('book_trailer') || get_field('book_trailer') ) {
				echo '<div class="more-links">';

				if ( get_field('book_trailer') ) {
					echo '<a href="#book-trailer">Book Trailer</a>';
				}

				if ( get_field('more_about_this_story') ) {
					echo '<a href="#more-about">More About This Story</a>';
				}

				if ( get_field('excerpt') ) {
					echo '<a href="#story-excerpt">Read an Excerpt!</a>';
				}

				echo '</div>';
			} 			

			// COLLECTION
			if (function_exists('get_field') && (get_field('story_type') == 'Collection') && get_field('books_in_collection')) {
				$ids = get_field('books_in_collection', false, false);

				$collections = new WP_Query(array(
					'post_type'      	=> 'book',
					'post__in'		=> $ids,
					'post_status'		=> 'publish',
					'meta_key'			=> 'number_in_series',
					'orderby'        	=> 'meta_value_num',
				));

				 if ( $collections->have_posts() ) { 
				 	// JUMP LINKS TO BLURBS ETC
				 	echo '<h2>In this Collection</h2>';
				 	echo '<ul class="indent">';
		   			while ( $collections->have_posts() ) : $collections->the_post(); ?>
		   				<li><strong><?php the_title(); ?></strong><br /><a href="#<?php the_title_attribute(); ?>">Read the Blurb</a></li>
					<?php endwhile;
					echo '</ul>';?>

					<div class="cf blurbs">
					<?php 
					// BLURBS
					while ( $collections->have_posts() ) : $collections->the_post(); ?>
						<div class="blurb">
		   				<?php echo do_shortcode('[showbook id="' . get_the_id() . '" class="alignright smallimg" links="false"][/showbook]'); ?><h6 id="<?php the_title_attribute(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		   				<?php if ( get_field('blurb', $collections->ID) ) {
		   					the_field('blurb');
		   				} ?>
		   				<strong><a href="<?php echo $current_url; ?>order">Order Collection</a> &nbsp; |  &nbsp; <a href="<?php the_permalink(); ?>order">Order <em><?php the_title(); ?></em></a> &nbsp; | &nbsp; <a href="<?php the_permalink(); ?>">More Info &amp; Excerpt</a></strong>
		   				</div>
					<?php endwhile;
					?>
					</div>
				<?php }

				wp_reset_postdata();
			
			}

			

		echo '</div>';
	}

	

	// ABOUT THIS BOOK 
	if (function_exists('get_field')) {
		
		echo '<div class="about-story book-section">';
		echo '<h2>About this Story</h2>';
		// Primary Characters
		$primarys = get_field('primary_characters');
		if ( $primarys ) { ?>
			<span class="line-item">
				<span class="type">Primary Characters</span>
				<span class="item">
					<?php foreach( $primarys as $term ) { ?>
					<a class="comma-separated" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
					<?php } ?>
				</span>
			</span>

		<?php }

		// Secondary Characters
		$secondarys = get_field('secondary_characters');
		if ( $secondarys ) { ?>
			<span class="line-item">
				<span class="type">Secondary Characters</span>
				<span class="item">
					<?php foreach( $secondarys as $term ) { ?>
					<a class="comma-separated" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
					<?php } ?>
				</span>
			</span>
		<?php }

		// Series
		$series = get_the_terms(get_the_id(), 'series');
		if ( $series ) { ?>
			<span class="line-item">
				<span class="type">Series</span>
				<span class="item">
					<?php foreach( $series as $term ) { ?>
					<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
					<?php } ?>
				</span>
			</span>
		<?php }

		// Genre
		$genre = get_the_terms(get_the_id(), 'genre');
		if ( $genre ) { ?>
			<span class="line-item">
				<span class="type">Genre</span>
				<span class="item">
					<?php foreach( $genre as $term ) { ?>
					<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
					<?php } ?>
				</span>
			</span>
		<?php }
		echo '</div>';

		// BOOK TRAILER
		if (get_field('book_trailer')) {
			echo '<div id="book-trailer" class="book-section">';
				echo '<h2>Book Trailer</h2>';
				echo '<div class="video-container">';
					the_field('book_trailer');
				echo '</div>';
			echo '</div>';
		}

		// MORE ABOUT THIS STORY
		if (get_field('more_about_this_story')) {
			echo '<div id="more-about" class="book-section">';
				echo '<h2>More About This Story</h2>';
				echo '<div class="more-about">';
					the_field('more_about_this_story');
				echo '</div>';
			echo '</div>';
		}

		// EXCERPT
		if (get_field('excerpt')) {
			echo '<div id="story-excerpt" class="book-section">';
				echo '<h2>Excerpt</h2>';
				echo '<div class="story-excerpt">';
					$cover = do_shortcode('[showbook id="' . get_the_id() . '" links="false" class="alignleft smallimg"][/showbook]');
					$excerpt = get_field('excerpt');
					echo prefix_insert_covers($excerpt, $cover, 3000);
				echo '</div>';
			echo '</div>';
		}
	} // about this book
?>


</section>