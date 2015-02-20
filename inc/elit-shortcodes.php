<?php
/**
 * Plugin Name: Elit Shortcodes
 * Description: Set up shortcodes for elit theme
 * Version: 0.0.1
 * Author: Patrick Sinco
 */

function elit_hiya_shortcode($atts) {
  $a = shortcode_atts(
    array(
      'name' => 'Josie',
      'occupation' => 'Guitar player',
    ),
    $atts
  );

  return 'hiya ' . $a['name'] . '. You are a ' . $a['occupation'] . '.';
}
add_shortcode('hiya', 'elit_hiya_shortcode');

function elit_related_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
    ), $atts
  );

  $post = get_post( $a['id'] );

  // make sure the related post is published
  if ( !$post || $post->post_status != 'publish') {
    return $post; 
  }

  

  // build up our string to output
  $output  = '<div class="story__box">';
  $output .= '<div class="media">';
  $output .= '<div class="media__title">Related</div>';

  $thumb_id = get_post_thumbnail_id( $post->ID );
  $thumb = get_post( $thumb_id );

  if ( $thumb_id )  {
    $thumb_url = wp_get_attachment_thumb_url( $thumb_id );
    $output .= '<img class="media__img" src="' . $thumb_url . '" ';
    $output .= 'alt="' . $thumb->post_content . '" width="140" />';
  }

  $output .= '<div class="media__body">';
  $output .= '<h3 class="media__head">';
  $output .= '<a href="' . get_permalink( $post->ID ) . '" ';
  $output .= 'class="media__link">' . $post->post_title . '</a>';
  $output .= '</h3>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  
  return $output;
}
add_shortcode('related', 'elit_related_shortcode' );

function elit_story_image_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
      'size' => 'full',
    ), $atts
  );

  $attachment = get_post( $a['id'] );
  $size = $a['size'];

  if ( $size == 'mug' ) {
    $largest = wp_get_attachment_image_src( $a['id'], 'elit-mug', false );
    $caption = $attachment->post_content;
    $credit = null;
    $image_size = 'tertiary';
  } else {
    $largest = wp_get_attachment_image_src( $a['id'], 'article-mid-large', false );
    $caption = $attachment->post_excerpt;
    $credit = get_post_meta( $attachment->ID, 'elit_image_credit', true );
    $image_size = 'secondary';
  }
  
  // generates the string needed to use with the RICG Responsive Images plugin
  $ricg_responsive_str = '<figure class="image image--' . $image_size . '">';
  $ricg_responsive_str .= '<img class="image__img" src="' . $largest[0] . '" '; 
  if ( $size != 'mug' ) {
    // we'll need srcset if we're not serving up a mugshot
    $ricg_responsive_str .= tevkori_get_srcset_string( $a['id'], $largest[0] );
  } 
  $ricg_responsive_str .= '/>';
  $ricg_responsive_str .= '<figcaption class="caption">';

  $ricg_responsive_str .= $caption;
  $ricg_responsive_str .= $credit ? " <small>($credit)</small>" : "";
  $ricg_responsive_str .= '</figcaption></figure>';
  
  return $ricg_responsive_str;
}
add_shortcode('story-image', 'elit_story_image_shortcode' );

function elit_pull_quote_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'quote' => '',
      'style' => 'left',
      'speaker' => '',
      'image-id' => '',
    ), $atts
  );


  //we're using only speaker for now
  $str = '<aside class="pq';

  // so in this ternary operator, we're deciding whether we have full column width 
  // or a just a fraction
  $str .= ('full' == $a['style']) ? '--full fractional--full">' : ' fractional">';
  $str .= '<div class="pq__body">';
  $str .= $a['quote'];
  $str .= '</div>';
  $str .= '</aside>';
  
  return wptexturize($str);
}
add_shortcode( 'pullquote', 'elit_pull_quote_shortcode' );

function elit_sidebar_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
      'style' => 'left',
    ),
    $atts
  );

  $post = get_post($a['id']);

  // make sure the story-sidebar is published
  if ( !$post || $post->post_status != 'publish') {
    return false;
  }

  $str = '<aside class="story-sidebar fractional';
  // figure out whether our fractional class needs '--full'
  $str .= (($a['style'] == 'left') ? '">' : '--full">') . PHP_EOL;
  $str .= '<h3 class="story-sidebar__head">' . $post->post_title; 
  $str .= '</h3>' . PHP_EOL;
  $str .= '<div class="story-sidebar__body">' . PHP_EOL; 
  $str .= $post->post_content;
  $str .= '</div>' . PHP_EOL;
  $str .= '</aside>' . PHP_EOL;

  return $str;
}
add_shortcode('story-sidebar', 'elit_sidebar_shortcode');

function elit_advertisement_shortcode($atts, $content = null) {
  $a = shortcode_atts(
    array(
      'id' => '',
    ),
    $atts
  );

  $str = '<aside data-set="rover-' . $a['id'] . '-parent" ';
  $str .= 'class="ad ad__med-rect--article rover-' . $a['id'] . '-parent-a">';
  $str .= '<div class="rover-' . $a['id'] . '">';
  $str .= '<a href=';
  $str .= '"http://www.e-healthcaresolutions.com/forms/?did=ehs.pro.aoa.jaoatest"';
  $str .= ' target="_blank">';
  $str .= '<script> EHS_AD("t", "r", "300x250"); </script>';
  $str .= '</a></div></aside>';

  return $str;
}
add_shortcode('advertisement', 'elit_advertisement_shortcode');


