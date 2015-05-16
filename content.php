<?php 
/**
 * @package elit
 */
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php // do we have a slideshow? if so, show it ?>
          <?php if ( get_post_meta( $post->ID, 'elit_featured_slideshow', true ) ): ?>
            <?php get_template_part( 'top_of_story', 'slideshow' ); ?>
          <?php // or if we have a featured image, show it ?>
          <?php elseif ( has_post_thumbnail() ): ?>
            <?php get_template_part( 'top_of_story', 'featured_image' ); ?>
          <?php endif; ?>


          <div class="story">
            <header class="story-header">
              <h5 class="story-header__kicker"><?php echo wptexturize( get_post_meta( $post->ID, 'elit_kicker', true ) ); ?></h5>
              <?php the_title('<h1 class="story-header__title">', '</h1>', true); ?>
              <h3 class="story-header__teaser"><?php echo wptexturize( get_the_excerpt() ); ?></h3>
              <div>
                <div class="story-meta">
                  <?php elit_byline(); ?>
                  <?php elit_posted_on(); ?>
                  <?php elit_comments_link(); ?>
                </div> <!-- story-meta -->
              </div>

              <?php 
                /**
                 * Set up social
                 *
                 */
                $meta = get_post_meta( $post->ID );
                $link = get_permalink();
                $title = get_the_title();
                $thumb_id = ( 
                  has_post_thumbnail() ? get_post_thumbnail_id() : 
                    $meta['elit_thumb'][0]
                );
                elit_social_links( $meta, $link, $title, $thumb_id, true ); ?>
            </header>

            <div class="story__body-text">
              <?php the_content(); ?>
            </div> <!-- story__body-text -->
            
            <footer class="story-footer"> 
              <?php elit_social_links( $meta, $link, $title, $thumb_id, false ); ?>
              <?php elit_story_footer(); ?>
            </footer>

          </div> <!-- .story -->
        </article>

