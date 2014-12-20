
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

                  <p class="byline vcard">
                    <?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
                  </p>

                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php
                    the_content();

                    if (function_exists('get_field')) {
                      // check if the repeater field has rows of data
                      if( have_rows('hump_day_items') ) {

                        // loop through the rows of data
                          while ( have_rows('hump_day_items') ) : the_row(); 
                          $amazon = get_sub_field('amazon_url'); 
                          $cover = get_sub_field('cover_image'); 
                          $author = get_sub_field('author_name'); 
                          $book = get_sub_field('book_title'); 
                          $website = get_sub_field('website_url'); 
                          $link_text = get_sub_field('link_text'); 
                          $info = get_sub_field('info'); 
                          $default_attr = array(
                            'class' => "imglink",
                            'alt'   => trim(strip_tags( $book )),
                          );
                          ?>

                            <div class="hump-item cf">

                            <?php if ($cover) { 
                                echo '<a target="_blank" class="cover" href="' . $amazon . '&tag=angrysuper-20">';
                                  echo wp_get_attachment_image( $cover, "cover-small", false, $default_attr);
                                echo '</a>';
                              }
                              echo '<div>';
                                echo '<h3><a target="_blank" href="' . $amazon . '&tag=angrysuper-20">' . $book . '</a></h3>';
                                echo '<p>' . $info . '</p>';
                                echo '<p>Learn more at ';
                                echo '<a target="_blank" href="' . $website . '">';
                                if ($link_text) {
                                  echo $link_text;
                                } else {
                                  echo $website;
                                }
                                echo '</a></p>';
                                 echo '<a target="_blank" class="button" href="' . $amazon . '&tag=angrysuper-20">Buy Now</a>';
                              echo '</div>';
                            ?>
                            </div>

                          <?php endwhile;
                      }

                    }
                  ?>
                </section> <?php // end article section ?>

                <footer class="article-footer">

                  <?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <?php // end article footer ?>

                <?php comments_template(); ?>

              </article> <?php // end article ?>