<header class="article-header">

	<h1 class="page-title" itemprop="headline"><em><?php the_title(); ?></em></h1>

</header> <?php // end article header ?>

<section class="entry-content cf" itemprop="articleBody"><?php 

	if (function_exists('get_field')) {

		// BOOK INFO

		if (get_field('number_in_series')) {
			echo '<h3>';
			echo 'Number in Series: ';
			the_field('number_in_series');
			echo '</h3>';
		}

		if (get_field('story_type')) {
			echo '<h3>';
			echo 'Story Type: ';
			the_field('story_type');
			echo '</h3>';
		}


		if (get_field('book_trailer')) {
			echo '<h3>';
			echo 'Book Trailer: ';
			echo '</h3>';
			the_field('book_trailer');
			
		}

		if (get_field('blurb')) {
			echo '<h3>';
			echo 'Blurb:</h3>';
			the_field('blurb');
			//echo '</h3>';
		}

		if (get_field('more_about_this_story')) {
			echo '<h3>';
			echo 'More About This Story:</h3>';
			the_field('more_about_this_story');
			//echo '</h3>';
		}
		$formatarray = array();
		$parentarray = array();
		$formatsdisplay = array();
		// EDITIONS
		if( have_rows('editions') ) {
			while( have_rows('editions') ): the_row();
			$formats = get_sub_field('book_format');
			
			//$formatarray[] = $formats;
									//print_r(array_pop($formatarray));
			if ($formats) {
				//$format_group = array();
				foreach($formats as $format) {
					$formatid = $format->term_id;
					$parentid = $format->parent;
					//$format = array();

					$formatsdisplay .= array("format_id" => $formatid, "parent_id" => $parentid);
					//$formatarray[] .= $formatsdisplay;
					//$parentarray[] .= $parentid;
				}	
				
			}

			array_push($formatarray, $formatsdisplay);
			
			if (function_exists('stripthis')) {
				$isbn_13 = stripthis(get_sub_field('isbn_13'));
				$isbn_10 = stripthis(get_sub_field('isbn_10'));
				$asin = stripthis(get_sub_field('asin'));
			}
			$edition_name = get_sub_field('edition_name');
			$image = get_sub_field('cover_image'); 
			$size = 'thumbnail';
			$img_attr = array(
				//'src'	=> $image,
				'class'	=> "attachment-$size",
				'alt'   => "none",
			);
			$showimg = wp_get_attachment_image($image,$size,false,$img_attr);

				if( get_sub_field('featured' && get_sub_field('featured') == '1') ) {

					echo $showimg;
					
				} 
			//$formats = get_sub_field('book_format');
			//var_dump($formats);

			/* if ($formats) { ?>
				<ul class="buy-links">
				<?php 
				$prevformatid = null;
				foreach($formats as $format) {
					$formatid = $format->term_id;
					
					 if (  ($format->parent != 0) ) {
						 echo '<h3>' . $format->name . '</h3>';	
						echo $isbn_13; 
						$formats[$format->parent]->child = $format;
					} else {
						$parent = $format;
					}
					$prevformatid = $formatid;
				}
				echo '</ul>';
			} */



			// BUY LINKS


			endwhile; // have_rows editions
		} // have_rows editions
		var_dump($formatarray);
		var_dump($parentarray);
		var_dump($formatsdisplay);
	}
	?>
</section>