<?php 

/**
 * The Spotlight sidebar.
 *
 * @package elit
 */
?>

<?php 

/**
 * The sidebar containing the article widget area.
 *
 * @package elit
 */
?>

        <div class="article-wrapper">
          <div class='widgets--article__wrapper--full-width'>
          <?php if ( !dynamic_sidebar( 'article-sidebar' ) ); ?>
          </div>
        </div>
