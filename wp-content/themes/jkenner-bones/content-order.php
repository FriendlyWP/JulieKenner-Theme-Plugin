<?php
/* Used on child pages (order pages) for the 'Book' custom post type. Displayed via the single-book.php templateto show all possible book ordering information. */
?>
<header class="article-header">

	<h1 class="page-title" itemprop="headline"><?php echo get_the_title( $post->ID ) . ' <em>' . get_the_title( $post->post_parent ) . '</em>'; ?></h1>

</header> <?php // end article header ?>

<section class="entry-content cf" itemprop="articleBody">
<?php 

$booktitle = get_the_title($post->post_parent);
$booklink = get_permalink($post->post_parent);
$series = get_the_terms($post->post_parent, 'series');
$number_in_series = get_field('number_in_series', $post->post_parent);
echo '<div class="book-deets">';
if ( $series ) { 
	foreach( $series as $term ) { 
		if ($number_in_series) {
			echo '<h6>Story # ' . $number_in_series . ' in the <a class="permalink after" href="' . get_term_link( $term ) . '">' .  $term->name . ' series.</a></h6>';	
		} else {
			echo '<h6>Part of the <a class="permalink after" href="' . get_term_link( $term ) . '">' .  $term->name . ' series.</a></h6>';	
		}
	}
}
echo '<h6>Summary, excerpt and more about <a class="permalink after" href="' . $booklink . '"><em>' .  $booktitle . '</em> here.</a></h6>';
echo '</div>'; //book-deets

if (function_exists('get_field')) {

$outObjects = array();
$sortOrder = 0;

	// EDITIONS
	if( have_rows('editions', $post->post_parent) ) {
		while( have_rows('editions', $post->post_parent) ) { 
			the_row();

		$outObject = new OutObject();
		$shouldSort = 0;
		$sortOrder++;
		$outObject->sortOrder = $sortOrder;

		$formats = get_sub_field('book_format');
		$intl = get_sub_field('international_edition');
		$intl_countries = get_sub_field('publication_country');
		
		// ASSIGN FORMATS FOR THIS EDITION
		if ($formats) {
			//$format_group = array();
			foreach($formats as $format) {
				$formatname = $format->name;
				$parentid = $format->parent;

				if ($parentid == 0)
					$outObject->parentFormat = $formatname;
				// else it's a child format
				else
					$outObject->childFormat = $formatname;
			}	
		}

		// ASSIGN FORMATS FOR THIS EDITION
		if ($intl_countries) {
			var_dump($intl_countries);
			//$format_group = array();
			foreach($intl_countries as $intl_country) {
				$countryname = $intl_country->name;
				$outObject->$countryname = $countryname;
			}	
		}

		// Get ISBN Data for this Edition
		if (function_exists('stripthis')) {
			$outObject->isbn_13 = stripthis(get_sub_field('isbn_13'));
			$outObject->isbn_10 = stripthis(get_sub_field('isbn_10'));
			$outObject->asin = stripthis(get_sub_field('asin'));
			$outObject->asin_audible = stripthis(get_sub_field('asin_audible'));
			$outObject->bnid = stripthis(get_sub_field('bnid'));
		}

		$outObject->outLinks = array();

		// ADDL BUY LINKS
		if( have_rows('additional_buy_links') ) {

			while( have_rows('additional_buy_links') ): the_row();
				$outLink = new OutLink();
				$outLink->label = get_sub_field('label');
				$outLink->link = get_sub_field('link');
				$outObject->outLinks[] = $outLink;
			endwhile;
		}
		

		// Edition Name
		$outObject->edition_name = get_sub_field('edition_name');

		// Edition Image
		$image = get_sub_field('cover_image'); 
		$size = 'thumbnail';
		$img_attr = array(
			//'src'	=> $image,
			'class'	=> "coverimg",
			'alt'   => "$booktitle - $formatname Cover",
		);
		$outObject->showimg = wp_get_attachment_image($image,$size,false,$img_attr);

		// IF FEATURED EDITION, $outObject->featured = '1';
        if ( get_sub_field('featured') && get_sub_field('featured') == '1' && $shouldSort == 0 ) {
            $outObject->featured = '1';
            $shouldSort = 1;
            $featuredImg = $outObject->showimg;
        } else {
            $outObject->featured = '0';
        }

		// Publication Date
		$outObject->publication_date = get_sub_field('publication_date');

		// International Edition? true = '1'
		$outObject->international_edition = get_sub_field('international_edition');


		//$outObject->otherData = $outObject->parentFormat . ' / ' . $outObject->childFormat . ' / ' . $isbn_13;


		$outObjects[] = $outObject;



		} // have_rows editions
	} // have_rows editions

	// if there's a featured item, sort so featured item is first, otherwise sort leave as-is (sorted by edition order on book page)
	if ($shouldSort == 1) {
	// perform a usort with an inline compare function
		usort ($outObjects, function($a, $b) {
		    // sort by custom rule ordering parents; children order by menu order
		    return strcmp(parentFormatOrder($a->parentFormat) . '|' . str_pad($a->sortOrder, 3, "0", STR_PAD_LEFT), parentFormatOrder($b->parentFormat) . '|' . str_pad($b->sortOrder, 3, "0", STR_PAD_LEFT));
			
		});
	}

		$lastMediaType = '';
		foreach ($outObjects as $outObject) {
			
			// if parentFormat is changed, or first, show header
			if ($lastMediaType != $outObject->parentFormat)
			{
				echo '<h3>'.$outObject->parentFormat.'</h3>';
			}

			echo '<div class="cf buyblock order-page">';
			/* if ( $outObject->$countryname ) {
					echo $outObject->$countryname;
				}  */
				if ($outObject->showimg) {
					$img = $outObject->showimg;
					$caption = 'true';
				} else {
					$img = $featuredImg;
					$caption = 'false';
				}

				echo '<div class="cover">';
				echo $img;
 				
				if ($caption == 'true') {
					echo '<span class="cover-caption">This cover is for the ' . $outObject->edition_name . ' Edition.</span>';	
				}
				if ( $outObject->isbn_13 ) {
					echo '<span>ISBN-13: ' . $outObject->isbn_13 . '</span>';
				}
				if ( $outObject->isbn_10 ) {
					echo '<span>ISBN-10: ' . $outObject->isbn_10 . '</span>';
				}
				echo '</div>';
				
				echo '<h4>' . $outObject->childFormat . '</h4>';
				echo '<ul>';

					if ( $outObject->isbn_13 && $outObject->parentFormat == 'Print' ) {
						echo '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
						// Amazon
						echo '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' .  $outObject->isbn_13 . '&index=books&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
						// AMAZON UK
						echo '<li><a target="_blank" href="http://www.amazon.co.uk/gp/search?keywords=' .  $outObject->isbn_13 . '&index=books&linkCode=qs&tag=jk-website-20">Amazon UK</a></li>';
						// Barnes & Noble
						echo '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->isbn_13 . '">Barnes &amp; Noble</a></li>';
						// Indiebound
						echo '<li><a target="_blank" href="http://www.indiebound.org/book/' .  $outObject->isbn_13 . '">IndieBound</a></li>';
						// BAM
						echo '<li><a target="_blank" href="http://www.booksamillion.com/search?query=' . $outObject->isbn_13 . '">Books-A-Million</a></li>';
						// Random House
						echo '<li><a target="_blank" href="http://www.randomhouse.com/book/search/search.php?isbn=' . $outObject->isbn_13 . '">Random House</a></li>';						
					} 

					if ( $outObject->asin && $outObject->parentFormat == 'Digital' ) {
						echo '<span class="debug-id">ASIN: ' . $outObject->asin . '</span>';
						// Amazon Kindle
						echo '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
					}

					if ( $outObject->isbn_13 && $outObject->parentFormat == 'Digital' ) {
						echo '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
						// Kobo
						echo '<li><a target="_blank" href="http://store.kobobooks.com/en-US/search?Query=' . $outObject->isbn_13 . '">Kobo</a></li>';
						// iTunes
						echo '<li><a target="_blank" href="http://www.itunes.com/' . $outObject->isbn_13 . '">iTunes</a></li>';
						// Google Play
						echo '<li><a target="_blank" href="https://play.google.com/store/search?c=books&q=' . $outObject->isbn_13 . '">Google Play</a></li>';

					}

					if ( $outObject->bnid && $outObject->parentFormat == 'Digital' ) {
						echo '<span class="debug-id">BNID: ' . $outObject->bnid . '</span>';
						// Barnes & Noble
						echo '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->bnid . '">Barnes &amp; Noble</a></li>';
					}

					if ( $outObject->asin && $outObject->parentFormat == 'Audio' ) {
						echo '<span class="debug-id">ASIN: ' . $outObject->asin . '</span>';
						// Amazon Audio
						echo '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
					}

					if ( $outObject->isbn_13 && $outObject->parentFormat == 'Audio' ) {
						echo '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
						// Barnes & Noble
						echo '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->isbn_13 . '">Barnes &amp; Noble</a></li>';
					}

					if ( $outObject->asin_audible && $outObject->parentFormat == 'Audio' ) {
						echo '<span class="debug-id">ASIN Audible: ' . $outObject->asin_audible . '</span>';
						// Audible
						echo '<li><a target="_blank" href="http://www.audible.com/search/?advsearchKeywords=' . $outObject->asin_audible . '">Audible</a></li>';
					}

					// Additional Links
					foreach($outObject->outLinks as $outLink ) {
						echo '<li><a target="_blank" href="' . $outLink->link . '">' .  $outLink->label . '</a></li>';
					}

			echo '</ul></div>';

			$lastMediaType = $outObject->parentFormat;
		}
}
	?>
</section>