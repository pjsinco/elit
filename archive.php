<?php 
/**
 * The template for displaying archive pages.
 *
 * @package elit
 */

// TODO this is all temporary

get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary">
        <div class="row">
          <div class="elit-archive">

        <?php if( have_posts() ): ?>
            <div class="size-1-of-1">
              <div class="section-title--archive">
                <?php elit_the_archive_title( '', '' ); ?>
              </div>
            </div>

            <?php get_template_part('content', 'archive'); ?>
        <?php endif; ?>


          </div> <!-- .elit-archive -->
        </div> <!-- .row -->
      </section> <!-- #primary -->

<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="content__secondary">



<?php get_sidebar('archive'); ?>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
