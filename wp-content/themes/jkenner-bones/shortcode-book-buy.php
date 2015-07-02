<?php 
add_shortcode('buybook', 'buy_book_block');
function buy_book_block( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'bookslug' => '',
        'bookid' => '',
        'display' => 'short',
    ), $atts );
    
    
ob_start();

	$booktitle = get_the_title($a['bookid']);
	if (function_exists('get_field')) {

	$outObjects = array();
	$sortOrder = 0;

		// EDITIONS
		if( have_rows('editions', $a['bookid']) ) {
			while( have_rows('editions', $a['bookid']) ): the_row();

			$outObject = new OutObject();

			$sortOrder++;
			$outObject->sortOrder = $sortOrder;

			$formats = get_sub_field('book_format');
			
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

			$outObject->edition_name = get_sub_field('edition_name');

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
			if( get_sub_field('featured' && get_sub_field('featured') == '1') ) {
				$outObject->featured = '1';
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



			endwhile; // have_rows editions
		} // have_rows editions

		// perform a usort with an inline compare function
			usort ($outObjects, function($a, $b)
			{
				// sort by parentFormat and then childFormat
			    //return strcmp($a->parentFormat . '|' . $a->childFormat, $b->parentFormat . '|' . $b->childFormat);
				
				// sort by a custom rule; parent then child ordered by parent
			    //return strcmp(parentFormatOrder($a->parentFormat) . '|' . $a->childFormat, parentFormatOrder($b->parentFormat) . '|' . $b->childFormat);
			    
			    // sort by custom rule ordering parents; children order by menu order
			    return strcmp(parentFormatOrder($a->parentFormat) . '|' . str_pad($a->sortOrder, 3, "0", STR_PAD_LEFT), parentFormatOrder($b->parentFormat) . '|' . str_pad($b->sortOrder, 3, "0", STR_PAD_LEFT));
				
			});

			$lastMediaType = '';
			foreach ($outObjects as $outObject) {
				
				// if parentFormat is changed, or first, show header
				if ($lastMediaType != $outObject->parentFormat)
				{
					$output .= '<h3>'.$outObject->parentFormat.'</h3>';
				}

				$output .= '<div class="cf buyblock">';
					if ($outObject->showimg) {
						$img = $outObject->showimg;
						$caption = 'true';
					} else {
						$img = $featuredImg;
						$caption = 'false';
					}

					$output .= '<div class="cover">';
					$output .= $img;
					if ($caption == 'true') {
						$output .= '<span class="cover-caption">This cover is for the ' . $outObject->edition_name . ' Edition.</span>';	
					}
					if ( $outObject->isbn_13 ) {
						$output .= '<span>ISBN-13: ' . $outObject->isbn_13 . '</span>';
					}
					if ( $outObject->isbn_10 ) {
						$output .= '<span>ISBN-10: ' . $outObject->isbn_10 . '</span>';
					}
					$output .= '</div>';
					
					$output .= '<h4>' . $outObject->childFormat . '</h4>';
					$output .= '<ul>';

						if ( $outObject->isbn_13 && $outObject->parentFormat == 'Print' ) {
							$output .= '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
							// Amazon
							$output .= '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' .  $outObject->isbn_13 . '&index=books&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
							// AMAZON UK
							$output .= '<li><a target="_blank" href="http://www.amazon.co.uk/gp/search?keywords=' .  $outObject->isbn_13 . '&index=books&linkCode=qs&tag=jk-website-20">Amazon UK</a></li>';
							// Barnes & Noble
							$output .= '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->isbn_13 . '">Barnes &amp; Noble</a></li>';
							// Indiebound
							$output .= '<li><a target="_blank" href="http://www.indiebound.org/book/' .  $outObject->isbn_13 . '">IndieBound</a></li>';
							// BAM
							$output .= '<li><a target="_blank" href="http://www.booksamillion.com/search?query=' . $outObject->isbn_13 . '">Books-A-Million</a></li>';
							// Random House
							$output .= '<li><a target="_blank" href="http://www.randomhouse.com/book/search/search.php?isbn=' . $outObject->isbn_13 . '">Random House</a></li>';						
						} 

						if ( $outObject->asin && $outObject->parentFormat == 'Digital' ) {
							$output .= '<span class="debug-id">ASIN: ' . $outObject->asin . '</span>';
							// Amazon Kindle
							$output .= '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
						}

						if ( $outObject->isbn_13 && $outObject->parentFormat == 'Digital' ) {
							$output .= '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
							// Kobo
							$output .= '<li><a target="_blank" href="http://store.kobobooks.com/en-US/search?Query=' . $outObject->isbn_13 . '">Kobo</a></li>';
							// iTunes
							$output .= '<li><a target="_blank" href="http://www.itunes.com/' . $outObject->isbn_13 . '">iTunes</a></li>';
							// Google Play
							$output .= '<li><a target="_blank" href="https://play.google.com/store/search?c=books&q=' . $outObject->isbn_13 . '">Google Play</a></li>';

						}

						if ( $outObject->bnid && $outObject->parentFormat == 'Digital' ) {
							$output .= '<span class="debug-id">BNID: ' . $outObject->bnid . '</span>';
							// Barnes & Noble
							$output .= '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->bnid . '">Barnes &amp; Noble</a></li>';
						}

						if ( $outObject->asin && $outObject->parentFormat == 'Audio' ) {
							$output .= '<span class="debug-id">ASIN: ' . $outObject->asin . '</span>';
							// Amazon Audio
							$output .= '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
						}

						if ( $outObject->isbn_13 && $outObject->parentFormat == 'Audio' ) {
							$output .= '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
							// Barnes & Noble
							$output .= '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->isbn_13 . '">Barnes &amp; Noble</a></li>';
						}

						if ( $outObject->asin_audible && $outObject->parentFormat == 'Audio' ) {
							$output .= '<span class="debug-id">ASIN Audible: ' . $outObject->asin_audible . '</span>';
							// Audible
							$output .= '<li><a target="_blank" href="http://www.audible.com/search/?advsearchKeywords=' . $outObject->asin_audible . '">Audible</a></li>';
						}

						// Additional Links
						foreach($outObject->outLinks as $outLink ) {
							$output .= '<li><a target="_blank" href="' . $outLink->link . '">' .  $outLink->label . '</a></li>';
						}

				$output .= '</ul></div>';

				$lastMediaType = $outObject->parentFormat;
			}
		}
	$clean = ob_get_clean();
	return $output . $clean; 
}

