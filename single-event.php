<?php
/**
 * The template for displaying a single event
 *
 * Please note that since 1.7, this template is not used by default. You can edit the 'event details'
 * by using the event-meta-event-single.php template.
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme. You can use this template as a guide.
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://wp-event-organiser.com/documentation/editing-the-templates/ for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="main-content cf" role="main">


						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<?php if ( function_exists('yoast_breadcrumb') ) {
										yoast_breadcrumb('<p id="breadcrumbs">','</p>');
									} ?>
								
								<header class="article-header">

									<!-- Display event title -->
									<h1 class="page-title"><?php the_title(); ?></h1>
								</header><!-- .entry-header -->

								

								<section class="entry-content clearfix" itemprop="articleBody">

									<!-- The content or the description of the event-->
									<?php the_content(); ?>

									<!-- Get event information, see template: event-meta-event-single.php -->
									<?php eo_get_template_part('event-meta','event-single'); ?>
								</section><!-- .entry-content -->

								<footer class="entry-meta">
								<?php
									//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
									/*$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ',''); 

									if ( '' != $categories_list ) {
										$utility_text = __( 'This event was posted in %1$s. Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
									} else {
										$utility_text = __( 'Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
									}
									printf($utility_text,
										$categories_list,
										esc_url( get_permalink() ),
										the_title_attribute( 'echo=0' ),
										get_the_author(),
										esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
									); */
								?>
								

								</footer><!-- .entry-meta -->

						</article> <!-- end article -->
					
						<?php endwhile; ?>			
					
						<?php else : ?>
					
							<article id="post-not-found" class="hentry clearfix">
					    		<header class="article-header">
					    			<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
					    		</header>
					    		<section class="entry-content">
					    			<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
					    		</section>
					    		<footer class="article-footer">
					    		    <p><?php _e("This is the error message in the single.php template.", "bonestheme"); ?></p>
					    		</footer>
							</article>
					
						<?php endif; ?>
			
					</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
