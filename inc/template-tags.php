<?php
/**
 * Custom template tags!
 *
 * @package elit
 */

require_once elit_inc_path . '/classes/elit-suggested-posts.php'; 

/**
 * Generate our list of social links
 *
 * @param array $meta - post's meta data
 * @param string $link - post's permalink
 * @param string $title - post's title
 * @param string $thumb_id - post's thumbnail image id
 * @param boolean $shiftable - whether to add '--shiftable' class to tags
 */
function elit_social_links( $meta, $link, $title, $thumb_id, $shiftable = true, $small = false ) {
  $link = urlencode( $link );
  $title_decoded = 
    html_entity_decode( strip_tags( $title ), ENT_QUOTES, 'utf-8' );
  $url_encoded_title = urlencode( $title_decoded );
  $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-large', false );
  $shiftable_class = ( $shiftable ? 'social--shiftable' : 'social' );
  $social_class = ( $small ? 'social--small' : 'social' );
?>

<ul class="<?php if ( $shiftable ): echo $shiftable_class; endif; ?> <?php echo $social_class; ?>">
  <li class="social__icon">
    <a id="social-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" class="<?php echo $shiftable_class; ?>__link" >
      <span class="icon-facebook">
        <span class="text-replace">Facebook</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a id="social-twitter" href="https://twitter.com/intent/tweet?text=<?php echo $url_encoded_title; ?>&url=<?php echo $link; ?>&via=AOAforDOs" class="<?php echo $shiftable_class; ?>__link">
      <span class="icon-twitter">
        <span class="text-replace">Twitter</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link; ?>&title=<?php echo $title; ?>&source=<?php echo urlencode( home_url( $path = '/', $scheme = 'https' ) ); ?>&summary=<?php echo urlencode( get_the_excerpt() ); ?>" id="social-linkedin" class="<?php echo $shiftable_class; ?>__link">
      <span class="icon-linkedin">
        <span class="text-replace">LinkedIn</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a id="social-pinterest" class="<?php echo $shiftable_class; ?>__link" href="https://www.pinterest.com/pin/create/button/?url=<?php echo $link; ?>&media=<?php echo urlencode( $thumb_url[0] ); ?>&description=<?php echo $url_encoded_title; ?>" target="_blank">
      <span class="icon-pinterest">
        <span class="text-replace">Pinterest</span>
      </span>
    </a>
  </li>
  <li class="social__icon">
    <a href="mailto:?subject=<?php echo rawurlencode( 'From The DO: '. $title ); ?>&amp;body=<?php echo rawurlencode( $title ) . '%0A' . $link; ?>" title="Email this article" id="social-email" class="<?php echo $shiftable_class; ?>__link">
      <span class="icon-mail">
        <span class="text-replace">Email</span>
      </span>
    </a>
  </li>
</ul>
<?php }
/**
 * Prints the byline for a story.
 */
function elit_byline() {
?>
	<span class="story-meta__by">By</span>
	  <span class="story-meta__author"> 
      <a class="story-meta__link--author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
        <?php echo esc_html( get_the_author() ); ?>
      </a>
      <a class="story-meta__link" href="<?php echo author_can( get_the_ID(), 'publish_posts' ) ? elit_mailto('staff') : elit_mailto('contributor'); ?>"><span class="story-meta__author-email icon-mail"><span class="text-replace">Email</span></span></a>
    </span>
<?php 
}

/**
 * Prints the posted-on date; includes meta data about last-updated.
 *
 */
function elit_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('l, M. j, Y') ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date('l, M. j, Y') )
	);

	echo '<span class="story-meta__date">' . $time_string . '</span>';
}

/**
 * Prints the comments link. Intended to use at the top of a story.
 *
 */
function elit_comments_link() {
  if ( comments_open() ) {
?> 
    <span class="comment-link">
      <a href="#comments" class="comment-link__link">
        <?php 
          $num_comments = get_comments_number();
          $num_comments = ($num_comments == 0) ? '+' : $num_comments;
        ?>
        <span class="icon-comment comment-link__num" data-comments-num="<?php echo $num_comments; ?>"></span>
        <span class="comment-link__body">
        </span>
      </a>
    </span>
  <?php 
  }
}

/**
 * Prints the footer of a story
 *
 * @param boolean $with_social Optional. Include the social icons.
 */
function elit_story_footer( $post, $include_author = true ) {

  // #1 set up jump-to-comments
  elit_comments_jump();
  
  // #2 list our story tags
  elit_story_tags();

  // #3 output our about-the-author if we have the info
  if ( $include_author ) {
    elit_about_the_author();
  }

  // #4 print credit for the top-of-story-image
  elit_photo_credit_for_top_of_page();

  $suggested_posts = new ElitSuggestedPosts( $post );
  $suggested_posts->display();

  // #5 set up our post navigation
  elit_post_navigation();

}

/**
 * Display the leave-a-comment jump in story footer.
 *
 */
function elit_comments_jump() {

  if ( comments_open() ): ?>
  <div class="story-footer__jump-link">
    <a href="#comments">
      <span class="story-nav__emph"></span>
        <?php comments_number( 'Leave a comment ', '1 comment ', '% comments '); ?>
      <span class="icon-arrow-down-alt1"></span>
    </a>
  </div>
  <?php endif;

}

/**
 * Display the tags for a post.
 *
 */
function elit_story_tags() {

  $before = '<div class="story-footer__title">Topics</div>';
  $before .= '<ul class="topics"><li class="topics__topic">';
  $sep = '</li><li class="topics__topic">';
  $after = '</li><ul>';

  $tags_list = get_the_tag_list( $before, $sep, $after);

  if ( $tags_list ) {
    printf('<div class="story-nav">%1$s</div>', $tags_list);
  }

}

/**
 * Display information about the author.
 * Intended to use in a post footer.
 *
 */
function elit_about_the_author() {

  $bio = get_post_meta(get_the_ID(), 'elit_bio', true);
  // we only want to show emails for staff;
  // staff have at least 'Author' privileges
  if ( author_can( get_the_ID(), 'publish_posts' ) && empty( $bio ) ) {
    $author_bio  = get_the_author_meta( 'description' ); 
    $author_bio .= '<span class="story-footer__note">';
    $author_bio .= '<a href="' . elit_mailto('staff') . '"';
    $author_bio .= '?subject=' . strip_tags(get_the_title()) . '">';
    $author_bio .= '<span class="icon-mail"></span>&nbsp;Email '; 
    $author_bio .= get_the_author_meta( 'first_name' ) . '</a></span>';
  // here we catch less than 'Author' priveliges;
  // we don't want to show their email
  } elseif ( !author_can( get_the_ID(), 'publish_posts' ) && empty( $bio ) ) {
    $author_bio = get_the_author_meta( 'description' );
  } else {
    $author_bio = $bio;
  }

  if ( $author_bio ) {
    $about  = '<div class="story-footer__section">';
    $about .= '<div class="story-footer__title">About the author</div>';

    // get the id of the author's photo
    $author_photo_id = get_post_meta( get_the_id(), 'elit_author_photo_id', true );

    // if we have an author photo id ...
    if ( $author_photo_id ) {
      $author_photo_src = wp_get_attachment_url( $author_photo_id );

      // ... and it's valid
      if ( $author_photo_src ) {
        $author_photo_content = get_post( $author_photo_id );
        $width = wp_get_attachment_image_src( $author_photo_id );
        $about .= '<img class="story-footer__img--bio" ';
        $about .= 'src="' . wp_get_attachment_url( $author_photo_id ) . '" ';
        $about .= 'alt = "' . $author_photo_content->post_excerpt . '" '  ;
        $about .= ' width="' . $width[1] . '" />';
      }
    }
    
    $about .= '<div class="story-footer__body">';
    $about .= $author_bio;
    $about .= '</div></div>';

    echo $about;
  }

}

/**
 * Display the credit for the top-of-page image.
 * Intended to use in post footer.
 *
 */
function elit_photo_credit_for_top_of_page() {

  $credit = get_post_meta( get_the_id(), 'elit_standalone_credit', true );
  if ( $credit ) {

    $credit_line  = '<div id="photoCredit" class="story-footer__section">';
    $credit_line .= '<div class="story-footer__title">Credit</div>';
    $credit_line .= '<div class="story-footer__body">';
    $credit_line .= $credit;
    $credit_line .= '</div></div>';

    echo $credit_line;
  }

}

/**
 * Display the link for more stories in this category.
 * Intended to use in post footer.
 *
 */
function elit_more_in_category() {

  $story_nav  = '<div class="story-nav__more-in">More in ';
  $story_nav .= '<a href="%1$s" class="story-nav__emph">%2$s&nbsp;';
  $story_nav .= '<span class="icon-arrow-right"></span></a></div>';
  $story_nav = sprintf( $story_nav, 
    '#', // TODO temp value
    'Patient Care' // TODO temp value
  );

  echo $story_nav;

}

/**
 * Display the latest 2 or 3 posts in the post category.
 * Intended to use in post footer.
 *
 */
function elit_latest_related_posts( $post_type = 'post' ) {

  global $post;
  $current_page_id = $post->ID;
  
  $args = array(
    'post_type' => $post_type,
    'posts_per_page' => 3,
    'exclude' => $current_page_id,
  );

  $related_posts = get_posts( $args );

?>

<?php if ( $related_posts ):  ?>
  <h3 class="recommended__bigtitle">What to read next</h3>
  <div class="recommended">
    <h4 class="recommended__title">More Spotlights</h4>
    <?php foreach( $related_posts as $related ):

      $meta = get_post_meta( $related->ID );
      $thumb_id = ( 
        has_post_thumbnail( $related->ID ) ? get_post_thumbnail_id( $related->ID ) : $related['elit_thumb'][0]
      );
      $url = get_permalink( $related->ID ); 
    ?>

    <article>
      <figure>
        <a href="<?php echo $url; ?>" title="<?php $related->post_title ?>">
          <?php if ( $thumb_id ): ?>
          <?php $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-thumb' ); ?>
          <img src="<?php echo $thumb_url[0]; ?>" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>" class="image__img" width="96" height="64">
          <?php endif; ?>
        </a>
      </figure>
      <div class="recommended__body">
        <h5>
          <a href="<?php echo $url; ?>"><?php echo wptexturize( $related->post_title ); ?></a>
        </h5>
        <p><?php echo wptexturize( $related->post_excerpt ); ?></p>
      </div> <!-- .recommended__body -->
    </article>
    <?php endforeach; ?>
  </div> <!-- .recommended -->
<?php endif; ?>
<?php 
}

/**
 * Display the next and previous stories
 *
 */
function elit_post_navigation() {

  //$next_post = get_next_post(false, 'inside-the-aoa');
  $next_post = elit_get_adjacent_post('next', array( 'post', 'elit_spotlight' ) );

  if ( $next_post ) {
    $next  = '<li class="prev-next__item">';
    $next .= '<span class="prev-next__title">Next article</span>';
    $next .= '<a href="%2$s" class="prev-next__link">%3$s </a></li>';
    $next  = sprintf( $next,
      get_permalink( $next_post->ID ),
      get_permalink( $next_post->ID ),
      $next_post->post_title
    );
  } else {
    $next = '';
  }

  //$prev_post = get_previous_post(false, 'inside-the-aoa');
  $prev_post = elit_get_adjacent_post('prev', array( 'post', 'elit_spotlight' ) );

//echo '<pre>'; var_dump($prev_post); echo '</pre>'; die();
  if ( $prev_post ) {
    $prev  = '<li class="prev-next__item">';
    $prev .= '<span class="prev-next__title">Previous article</span>';
    $prev .= '<a href="%2$s" class="prev-next__link">%3$s </a></li>';
    $prev  = sprintf( $prev,
      get_permalink( $prev_post->ID ),
      get_permalink( $prev_post->ID ),
      $prev_post->post_title
    );
  } else {
    $prev = '';
  }

  if ( $prev || $next ) {
    // We don't want a bottom border on the component 
    // if comments are disabled
    $prev_next_class = 
      "prev-next" .  ( comments_open() ? "" : "--nobottomborder" );
    echo "<ul class='$prev_next_class'>";
    if ( $prev ) {
      echo $prev;
    } 
    if ( $next ) {
      echo $next;
    }
  echo '</ul>';
  }

}

/**
 * Show a list of recommended posts
 *
 */
function elit_recommended() {
  $recs = get_field( 'elit_recommended' );

  if ( $recs ):
    // Whether to "article" should be plural
    $label = 'Article' . (count($recs) > 1 ? 's' : '');
?>

  <h3 class="recommended__bigtitle">What to read next</h3>
  <div class="recommended">
    <h4 class="recommended__title">Related <?php echo $label; ?></h4>
    
  <?php foreach ( $recs as $rec ):
    $meta = get_post_meta( $rec->ID );
    $thumb_id = ( 
      has_post_thumbnail( $rec->ID ) ? get_post_thumbnail_id( $rec->ID ) : $meta['elit_thumb'][0]
    );
    $url = get_permalink( $rec->ID );
  ?>
    <article>
      <figure>
        <a href="<?php echo $url; ?>" title="<?php $rec->post_title ?>">
          <?php if ( $thumb_id ): ?>
          <?php $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-thumb' ); ?>
          <img src="<?php echo $thumb_url[0]; ?>" alt="<?php get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?>" class="image__img" width="96" height="64">
          <?php endif; ?>
        </a>
      </figure>
      <div class="recommended__body">
        <h5>
          <a href="<?php echo $url; ?>" title="<?php $rec->post_title; ?>"><?php echo wptexturize( $rec->post_title ); ?></a>
        </h5> 
        <p><?php echo wptexturize( $rec->post_excerpt ); ?></p>
      </div>
    </article>
  <?php endforeach; ?>

  </ul>
  <?php endif; 

}



/**
 * Show a list of posts that match a post's school taxonomy
 *
 */
function elit_school_posts( $post ) {

  function get_schools( $taxonomy )  {
    return $taxonomy->slug;
  }

  $term_slugs = array_map('get_schools', get_the_terms( $post->ID, 'elit_school' ));

  $args = array(
    'posts_per_page' => 2,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    'post_type' => 'post',
    'tax_query' => array(
      array(
        'taxonomy' => 'elit_school',
        'field' => 'slug',
        'terms' => $term_slugs,
        'operator' => 'IN',
      )
    )
  );

  $posts = get_posts( $args );

  if ( $posts ) {
    
  }
}

/**
 * Marks up each comment just the way we like.
 *
 * Used as a callback by wp_list_comments()
 * 
 * help http://themeshaper.com/2012/11/04/
 *    the-wordpress-theme-comments-template/
 */
function elit_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback':
    case 'trackback':
  ?>
    <li class="post pingback">
      <p>
        Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( '(Edit)' ); ?>

  <?php  
    
      break;
    default:
  ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment__body">
        <footer class="comment__meta">
          <div class="comment__author">
            <h3 class="comment__author-name"><?php echo $comment->comment_author; ?></h3>
            </h3>
          </div>
          <div class="comment__metadata">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
              <time datetime="<?php comment_time( 'c' ); ?>" pubdate>
                <?php printf( '%1$s at %2$s', get_comment_date( ' M. j, Y, ' ), get_comment_time() ); ?>   
              </time>
            </a>
            <?php edit_comment_link( '(Edit)', '<span class="comment__edit">', '</span>' ); ?>
          </div> <!-- comment__metadata -->
        </footer> <!-- comment__meta -->

        <div class="comment__content">
          <?php comment_text(); ?>
          <?php if ( $comment->comment_approved == '0' ): ?>
            <div class='comment__alert'>Your comment is awaiting moderation.<br><span>Please allow up to two business days for review.</span>
          <?php endif; ?>
        </div>

        <div class="comment__reply">
          <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
      </article>





  <?php 
  endswitch;
}


/**
 * Display the archive title
 *
 * Based strongly on the same function in the Underscores theme
 */
function elit_the_archive_title( $before = '', $after = '' ) {
  if ( is_category() ) {
    $title = sprintf( '%s', single_cat_title( '', false ) );
  } elseif ( is_tag() ) {
    $title = sprintf( 'Topic: %s', single_cat_title( '', false ) );
  } elseif ( is_author() ) {
    $title = sprintf( 'Articles by %s', get_the_author() );
  } elseif ( is_year() ) {
    $title = sprintf( 'Year: %s', get_the_date( 'Y' ) );
  } elseif ( is_month() ) {
    $title = sprintf( 'Month: %s', get_the_date( 'F Y' ) );
  } elseif ( is_day() ) {
    $title = sprintf( 'Day: %s', get_the_date( 'F j, Y' ) );
  } elseif ( is_post_type_archive() ) {
    if ( is_post_type_archive( 'elit_spotlight' ) ) {
      $title = sprintf( '%s', post_type_archive_title( '', false ) );
    } else {
      $title = sprintf( 'Archives: %s', post_type_archive_title( '', false ) );
    }
  } elseif ( is_tax( 'post_format' ) ) {
    if ( is_tax( 'post_format', 'post_format_video' ) ) {
      $title = 'Videos';
    }
  } elseif ( is_tax() ) {
    $tax = get_taxonomy( get_queried_object()->taxonomy );
    $title = sprintf( 
      '%1$s: %2$s', 
      $tax->labels->singular_name, 
      single_term_title( '', false ) );
  } else {
    $title = ( 'Archives' );
  }

  /**
   * Filter the archive title
   *
   * @param string $title Archive title to be displayed
   */
  $title = apply_filters( 'get_the_archive_title', $title );
  if ( ! empty( $title ) ) {
    echo $before . $title . $after;
  }
}

function elit_the_archive_description( $before = '', $after = '' ) {
  
}

//function get_shiftable_class( $shiftable = true ) {
//  if ( $shiftable ) {
//    return 'social--shiftable';
//  } else {
//    return 'social';
//  }
//}

/**
 * Generate a "mailto:" link
 *
 * @return a string ready to insert into an href attribute
 * @param string $recipient - 
 *   'staff' will use the author's email;
 *   any other value will use the admin's email
 * @author PJS
 */
function elit_mailto( $recipient ) {
  $link  = 'mailto:';
  $link .= $recipient == 'staff' ? get_the_author_meta( 'user_email' ) :
    get_option( 'admin_email' );
  $link .= '?subject=' . strip_tags( get_the_title() );
  
  return $link;
}

/**
 * Given a date, create a "[time] ago"-style string.
 * If date is today, will return time in hours or minutes or seconds.
 * If date is yesterday, returns "Yesterday".
 * Else, month and day are returned.
 *
 * @return string
 * @param string $date
 * @author PJS
 */
function elit_time_ago($date) {
    date_default_timezone_set("America/Chicago");
    $d = ((int)gmdate('U') - strtotime($date));
    $time_since = (time() - strtotime($date));
    $month = array("", "Jan.", "Feb.", "March", "April", "May", "June", "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec.");
    if ($d > 172800) {
      $d = 'Posted ' . $month[date("n", strtotime($date))] . ' ' . date("j", strtotime($date));
    } elseif ($d <= 172800 && $d > 86400) {
      $d = "Yesterday";
    } else if ($d > 7200) {
      $d = date("G", $time_since) . " hours ago";
    } else if ($d > 3600) {
      $d = date("G", $time_since) . " hour ago";
    } else if ($d > 120) {
//      $d = date("i", $time_since) . " minutes ago";
      // replaces '03' with '3'
      $d = str_replace('0', '', date("i", $time_since)) . " minutes ago";
    } else if ($d > 60) {
      $d = date("i", $time_since) . " minute ago";
    } else if ($d == 1) {
      $d = date("s", $time_since) . " second ago";
    } else {
      $d = date("s", $time_since) . " seconds ago";
    }
    return $d;
}

/**
 * Filter an array by its keys using a callback.
 *
 * Source: https://gist.github.com/h4cc/8e2e3d0f6a8cd9cacde8
 *
 * @param $arr      array    The array to filter
 * @param $callback function The filter callback, which will get 
 *                           the key as its first arg
 * @return array             The remaining key => value pairs from $array
 */
function array_filter_key( $arr, $callback ) {
  $matched_keys = array_filter( array_keys( $arr ), $callback );
  return array_intersect_key( $arr, array_flip( $matched_keys ) );
}


/**
 * A Series of helper functions to help us distinguish
 * between layouts.
 *
 */
function elit_story_body_class( $layout = 'two-col' ) {
  echo 'story__body-text' . ($layout == 'one-col' ? '--full-width' : '');
}

function elit_get_featured_image_size( $layout = 'two-col' ) {
  return ( $layout == 'two-col' ? 'elit-large' : 'elit-super' );
}

function elit_featured_image_class( $layout ) {
  echo 'image--' . ( $layout == 'two-col' ? 'primary' : 'super' );
}

function elit_story_footer_class( $layout ) {
  echo 'story-footer' . ( $layout == 'two-col' ? '' : '--full-width' );
}

function elit_secondary_class( $layout ) {
  echo 'content__secondary' . ( $layout == 'two-col' ? '' : '--full-width' );
}


