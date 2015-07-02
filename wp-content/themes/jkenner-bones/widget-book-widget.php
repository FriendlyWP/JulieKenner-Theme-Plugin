<?php 
  if (have_rows('book_features', $acfw)) {
    $features = get_field('book_features', $acfw);
    $count = count($features);
    echo '<div class="widget-features count-' . $count . ' cf">';
        while ( have_rows('book_features', $acfw) ) { the_row();
            $blurb = get_sub_field('blurb', $acfw);
            
            $cta = get_sub_field('cta_text', $acfw);
            $feature_link = '';
            if ( get_sub_field('feature_link', $acfw) ) {
                $feature_link = get_sub_field('feature_link', $acfw);
            }
            if (get_sub_field('featured_book', $acfw)) {
                $books = get_sub_field('featured_book', $acfw); ?>
                <?php foreach( $books as $book ) { 
                    $img_attr = array(
                        'title' => trim( strip_tags(  $blurb ) ),
                    );
                    if ($feature_link == '') {
                        $feature_link = get_permalink( $book->ID );
                    }
                    ?>
                    <div class="widget-block">
                        <?php echo do_shortcode('[showbook title="' . get_the_title($book->ID) . '" class="" links="true" showtitle="true"]' . $blurb . '[/showbook]'); ?>
                    </div>
                <?php } //endforeach; ?>
            <?php
            } // endif get_sub_field featured_book

        } //endwhile have_rows book_features;
    echo '</div>';
  } //endif