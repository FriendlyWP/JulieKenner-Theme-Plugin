<?php

if (function_exists('get_field')) {

    $outObjects = array();
    $output = '';
    $shouldSort = 0;

    // NUMBER IN SERIES
    


    // GET ALL EDITIONS OF THIS BOOK
    if( have_rows('editions', $bookid) ) {
        while( have_rows('editions', $bookid) ): the_row();

        $outObject = new OutObject();

        // set variables from shortcode
        $outObject->display = $display;
        $outObject->class = $class;
        $outObject->showlinks = $links;
        $outObject->showorder = $showorder;
        $outObject->linkto = $linkto;
        $outObject->showcaption = $showcaption;

        // Edition Name
        $outObject->edition_name = get_sub_field('edition_name');
        
        // Publication Date
        $outObject->publication_date = get_sub_field('publication_date');

        // ASSIGN FORMATS FOR EACH EDITION
        $formats = get_sub_field('book_format');
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

        // Get ISBN Data for each Edition
        if (function_exists('stripthis')) {
            $outObject->isbn_13 = stripthis(get_sub_field('isbn_13'));
            $outObject->isbn_10 = stripthis(get_sub_field('isbn_10'));
            $outObject->asin = stripthis(get_sub_field('asin'));
            $outObject->asin_audible = stripthis(get_sub_field('asin_audible'));
            $outObject->bnid = stripthis(get_sub_field('bnid'));
        }

        
        // ADDL BUY LINKS
        $outObject->outLinks = array();
        if( have_rows('additional_buy_links') ) {
            while( have_rows('additional_buy_links') ): the_row();
                $outLink = new OutLink();
                $outLink->label = get_sub_field('label');
                $outLink->link = get_sub_field('link');
                $outObject->outLinks[] = $outLink;
            endwhile;
        }
    
        $outObject->content = $content;

        // Edition Image
        $image = get_sub_field('cover_image'); 
        $size = 'thumbnail';
        $img_attr = array(
            //'src' => $image,
            'class' => "coverimg",
            'alt'   => "$booktitle - $formatname Cover",
        );
        $outObject->showimg = wp_get_attachment_image($image,$size,false,$img_attr);

         // IF FEATURED EDITION, $outObject->featured = '1';
        if ( get_sub_field('featured') && get_sub_field('featured') == '1' && $shouldSort == 0 ) {
            $outObject->featured = '1';
            $featuredImg = $outObject->showimg;
            $shouldSort = 1;
        } else {
            $outObject->featured = '0';
        }

        $outObjects[] = $outObject;

        endwhile; // have_rows editions

    } // have_rows editions

    /********************************************************/
    /* SORTING DATA BASED ON FULL OR QUICK VIEW OF EDITIONS */
    /********************************************************/
    // if there's a featured item, sort so featured item is first, otherwise sort leave as-is (sorted by edition order on book page)
    if ($outObject->display == 'quick') {
        if ($shouldSort == 1) {
            usort ($outObjects, function($a, $b)    {
                return($a->featured < $b->featured);
            });    
        }
    } elseif ( $outObject->display == 'full' ) {
        usort ($outObjects, function($a, $b)    {
            // sort by custom rule ordering parents; children order by menu order
            return strcmp(parentFormatOrder($a->parentFormat) . '|' . str_pad($a->sortOrder, 3, "0", STR_PAD_LEFT), parentFormatOrder($b->parentFormat) . '|' . str_pad($b->sortOrder, 3, "0", STR_PAD_LEFT));
        });

    }
    
    /********************************************************/
    /* DISPLAY DATA BASED ON QUICK VIEW OF EDITIONS */
    /********************************************************/
    if ($outObject->display == 'quick') {
        // only show first item (see sort above)
        //if ( $outObjects[0] ) {
                
            $outObject = $outObjects[0];
            if ($outObject->showlinks == 'false') {
                $addclass = 'fullimage';
            } else {
                $addclass = '';
            }
            $output .= '<div class="shortcode cf buyblock ' . $outObject->class . ' ' . $addclass . '">';
                
                $img = $outObject->showimg;                

                $output .= '<div class="cover">';
                    if ($outObject->linkto == 'order') {
                        $output .= '<a href="' . $booklink . 'order">' . $img . '</a>';
                    } elseif ($outObject->linkto == 'book') {
                        $output .= '<a href="' . $booklink . '">' . $img . '</a>';
                    }

                    if ($outObject->showcaption == 'true') {
                       // if ($content !== '') {
                            $output .= '<span class="cover-caption"><a href="' . $booklink . '">' . $booktitle . '</a></span>';    
                       // }
                        if ($outObject->showorder == 'true' && $number_in_series !== '' ) {
                            $output .= '<span class="book-number">Story #' .  $number_in_series . '</span>';
                        }
                    }
                    
                $output .= '</div>'; // cover
                
                
       // } // if outObject[0]

        if ($outObject->content) {
            $output .= '<span class="shortcode-content">' . $outObject->content . '</span>';
        }
        
        if ($outObject->showlinks == 'true') { 
            $firstPrint = 0;
            $firstDigital = 0;  
            $output .= '<span class="short">';
            //$output .= '<h6 class="quick-buy">Order Now</h6>';

            foreach ($outObjects as $outObject) {
            
                // DIGITAL
                if ( $outObject->parentFormat == 'Digital' && $firstDigital == 0 ) {
                    $firstDigital = 1;
                    $output .= '<span class="digital">';
                    if ( $outObject->asin ) {
                        // Kindle
                        $output .= '<a class="amazon-kindle" target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20"><img src="' . get_stylesheet_directory_uri() . '/library/images/buttons/amazon-kindle.png" alt="Amazon - Kindle"></a>';
                    }
                    if ( $outObject->bnid ) {
                         // Nook
                        $output .= '<a class="bn-nook" target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->bnid . '"><img src="' . get_stylesheet_directory_uri() . '/library/images/buttons/bn-nook.png" alt="Barnes & Noble - Nook"></a>';
                    }
                    if ( $outObject->isbn_13 ) {
                         // iTunes
                        $output .= '<a class="ibooks" target="_blank" href="http://www.itunes.com/' . $outObject->isbn_13 . '"><img src="' . get_stylesheet_directory_uri() . '/library/images/buttons/ibooks.png" alt="iBooks"></a>';
                    }
                    $output .= '</span>'; //digital
                    
                }
                // PRINT
                if ( $outObject->isbn_13 && $outObject->parentFormat == 'Print'  && $firstPrint == 0) {
                    $firstPrint = 1;
                    $output .= '<span class="print">';
                    // Amazon Print
                    $output .= '<a class="amazon-print" target="_blank" href="http://www.amazon.com/gp/search?keywords=' .  $outObject->isbn_13 . '&index=books&linkCode=qs&tag=jk-website-20"><img src="' . get_stylesheet_directory_uri() . '/library/images/buttons/amazon-print.png" alt="Amazon - Print"></a>';
                    // B&N Print
                     $output .= '<a class="bn-print" target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->isbn_13 . '"><img src="' . get_stylesheet_directory_uri() . '/library/images/buttons/bn-print.png" alt="Barnes & Noble - Print"></a>';
                    // BAM Print
                    $output .= '<a class="bam" target="_blank" href="http://www.booksamillion.com/search?query=' . $outObject->isbn_13 . '"><img src="' . get_stylesheet_directory_uri() . '/library/images/buttons/bam.png" alt="Amazon Kindle"></a>';
                    $output .= '</span>'; // print
                }

            } // foreach

            $output .= '</span>';// short
             $output .= '<a class="order-options button" href="' . $booklink . 'order">View all ordering options</a>';
            
        } // showlinks
       $output .= '</div>'; //shortcode
    // end quick view
    /********************************************************/
    /* DISPLAY DATA BASED ON FULL VIEW OF EDITIONS */
    /********************************************************/
    } elseif ($outObject->display == 'full') {
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
                        //$output .= '<span class="debug-id">ASIN: ' . $outObject->asin . '</span>';
                        // Amazon Kindle
                        $output .= '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
                    }

                    if ( $outObject->isbn_13 && $outObject->parentFormat == 'Digital' ) {
                       // $output .= '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
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
                       // $output .= '<span class="debug-id">ASIN: ' . $outObject->asin . '</span>';
                        // Amazon Audio
                        $output .= '<li><a target="_blank" href="http://www.amazon.com/gp/search?keywords=' . $outObject->asin . '&linkCode=qs&tag=jk-website-20">Amazon</a></li>';
                    }

                    if ( $outObject->isbn_13 && $outObject->parentFormat == 'Audio' ) {
                       // $output .= '<span class="debug-id">ISBN-13: ' . $outObject->isbn_13 . '</span>';
                        // Barnes & Noble
                        $output .= '<li><a target="_blank" href="http://www.barnesandnoble.com/s/?store=allproducts&keyword=' .  $outObject->isbn_13 . '">Barnes &amp; Noble</a></li>';
                    }

                    if ( $outObject->asin_audible && $outObject->parentFormat == 'Audio' ) {
                      //  $output .= '<span class="debug-id">ASIN Audible: ' . $outObject->asin_audible . '</span>';
                        // Audible
                        $output .= '<li><a target="_blank" href="http://www.audible.com/search/?advsearchKeywords=' . $outObject->asin_audible . '">Audible</a></li>';
                    }

                    // Additional Links
                    foreach($outObject->outLinks as $outLink ) {
                        $output .= '<li><a target="_blank" href="' . $outLink->link . '">' .  $outLink->label . '</a></li>';
                    }

            $output .= '</ul>';
            $output .= '</div>';

            $lastMediaType = $outObject->parentFormat;
        }
    }


} // if function exists get_field