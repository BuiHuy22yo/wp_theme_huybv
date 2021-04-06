<?php

add_theme_support('post-thumbnails');
/**===================================================================================================
 *nạp , css
  ======================================================================================================*/
add_action('wp_enqueue_scripts', 'huybv_theme_register_style');

function huybv_theme_register_style()
{
  $lessUrl = get_template_directory_uri() . '/assets';
  wp_register_style('huybv_theme_bootstrap', $lessUrl . '/bootstrap/dist/css/bootstrap.css', array(), '1.0');
  wp_enqueue_style('huybv_theme_bootstrap');

  wp_register_style('huybv_theme_style', $lessUrl . '/css/style.css', array(), '1.0');
  wp_enqueue_style('huybv_theme_style');

  wp_register_style('huybv_theme_node_modules', $lessUrl . '/node_modules/bootstrap-icons/font/bootstrap-icons.css', array(), '1.0');
  wp_enqueue_style('huybv_theme_node_modules');

  wp_register_style('huybv_theme_fonts_gstatic', 'https://fonts.gstatic.com', array(), '1.0');
  wp_enqueue_style('huybv_theme_fonts_gstatic');

  wp_register_style('huybv_theme_fonts_googleapis', 'https://fonts.googleapis.com/css2?family=Arimo&family=Oswald&display=swap', array(), '1.0');
  wp_enqueue_style('huybv_theme_fonts_googleapis');
}

/**===================================================================================================
 *nạp js
    ======================================================================================================*/
add_action('wp_enqueue_scripts', 'huybv_theme_register_js');
function huybv_theme_register_js()
{
  $jsUrl = get_template_directory_uri() . '/assets';

  wp_register_script('huybv_theme_bootstrap', $jsUrl . '/bootstrap/dist/js/bootstrap.js', array('jquery'), '1.0');
  wp_enqueue_script('huybv_theme_bootstrap');

  wp_register_script('huybv_theme_fontawesome',  'https://kit.fontawesome.com/5bd0e41ddd.js', array(), '1.0');
  wp_enqueue_script('huybv_theme_fontawesome');

  wp_register_script('huybv_theme_jquery', $jsUrl . '/js/jquery.min.js', array('jquery'), '1.0');
  wp_enqueue_script('huybv_theme_jquery');
  wp_register_script('huybv_theme_isotope', $jsUrl . '/js/isotope.pkgd.min.js', array('jquery'), '1.0');
  wp_enqueue_script('huybv_theme_isotope');
  wp_register_script('huybv_theme_isotope-abc', $jsUrl . '/js/isotope.js', array('jquery'), '1.0');
  wp_enqueue_script('huybv_theme_isotope-abc');
}





function Recent_posts($title = 'Recent posts', $count = 5)
{

  global $post;
  $tag_ids = array();
  $current_cat = get_the_category($post->ID);
  $current_cat = $current_cat[0]->cat_ID;
  $this_cat = '';
  $tags = get_the_tags($post->ID);
  if ($tags) {
    foreach ($tags as $tag) {
      $tag_ids[] = $tag->term_id;
    }
  } else {
    $this_cat = $current_cat;
  }

  $args = array(
    'post_type'   => get_post_type(),
    'numberposts' => $count,
    'orderby'     => 'rand',
    'tag__in'     => $tag_ids,
    'cat'         => $this_cat,
    'exclude'     => $post->ID
  );
  $related_posts = get_posts($args);

  if (empty($related_posts)) {
    $args['tag__in'] = '';
    $args['cat'] = $current_cat;
    $related_posts = get_posts($args);
  }
  if (empty($related_posts)) {
    return;
  }
  $post_list = '';
  foreach ($related_posts as $related) {

    $post_list .= '<div class="media mb-4 ">';
    $post_list .= '<img class="mr-3 img-thumbnail"  src="' . get_the_post_thumbnail_url($related->ID,) . '" alt="Generic placeholder image">';
    $post_list .= '<div class="media-body align-self-center">';
    $post_list .= '<h5 class="mt-0"><a href="' . get_permalink($related->ID) . '">' . $related->post_title . '</a></h5>';
    $post_list .=   '<div>' . get_the_date() . '/' . get_comments_number($related->ID) . ' comments</div>';

    $post_list .= '<div>' . wp_trim_words(get_the_excerpt($related->ID), 6) . '</div>';

    $post_list .= '</div>';
    $post_list .= '</div>';
  }

  return sprintf('
        <div class="card my-4">
            <h4 class="card-header">%s</h4>
            <div class="card-body">%s</div>
        </div>
    ', $title, $post_list);
}



//comment
function mini_blog_comment($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment;
?>
  <?php if ($comment->comment_approved == '1') : ?>
    <li class="d-flex">
      <?php echo '<img class="w-h d-flex mr-3 " src="' . get_avatar_url($comment) . '" ">' ?>
      <div class="media-body">
        <div class="d-flex justify-content-between">
          <?php echo  '<h5 class="mt-0 mb-0"><a rel="nofllow" href="' . get_comment_author_url() . '">' . get_comment_author() . '</a> <br> <small>' . get_comment_date() . ' at ' . get_comment_time() . '</small></h5>' ?>
          <div class="reply">
            <?php comment_reply_link(array_merge($args, array('reply_text' => 'reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
          </div>
        </div>

        <div class="mt-2">
          <?php comment_text() ?>
        </div>


      </div>
    </li>
    <?php endif;
}



// Hiển thị thông tin tác giả trong khung
function wpb_author_info_box()
{
  global $post;
  // Detect if it is a single post with a post author
  if (is_single() && isset($post->post_author)) {
    // Get author’s display name
    $display_name = get_the_author_meta('display_name', $post->post_author);
    // If display name is not available then use nickname as display name
    if (empty($display_name))
      $display_name = get_the_author_meta('nickname', $post->post_author);
    // Get author’s biographical information or description
    $user_description = get_the_author_meta('user_description', $post->post_author);

    $author_details = '';
    if (!empty($user_description))
      // Author avatar and bio
      $author_details .= '<div class="author w80-mr-au d-flex"> <div class="author_detai--avata  " >' . get_avatar(get_the_author_meta('user_email'), 68) . '</div> <div class="author_detai--info px-3" >' . '<h3>' . $display_name . '</h3>' . '<p>' . nl2br($user_description) . '</p>' . '</div></div>';
  }
  return $author_details;
}
// Allow HTML in author bio section
remove_filter('pre_user_description', 'wp_filter_kses');




//list post
add_filter('list', 'list_post');
function list_post($post_count = 11)
{


  $args_my_query = array(
    'post_type' => 'post',
    'post_status' => 'publish',

    'posts_per_page' => $post_count,
    'orderby' => 'date'

  );

  $date = '';
  $my_query = new WP_Query($args_my_query);

  if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <div class="abc-item <?php
                            if (strtotime(get_the_date()) > $date) {
                              echo 'col-md-6 col-lg-6 col-xl-6';
                              $date = strtotime(get_the_date());
                              
                            } else {
                              echo 'col-md-3 col-lg-3 col-xl-3';
                             
                            }
                            ?> ">

        <?php if (has_post_thumbnail() == 1) { ?>
          <div class="<?php if (strtotime(get_the_date()) >= $date) { echo 'inner';}?>" >
          <div class="page-image"><a href="<?php the_permalink(); ?>"></a><?php the_post_thumbnail('post-large',['class' => 'img-full']); ?></div>
          <div class="<?php if (strtotime(get_the_date()) >= $date) { echo 'first-post';}?>" >
          <div class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
          <div class="page-date"><?php echo get_the_date().' / ';echo comments_number(); ?> </div>
          <div class="trim-content"><?php if (strtotime(get_the_date()) >= $date) { echo wp_trim_words(get_the_content(), 24);} else {echo wp_trim_words(get_the_content(), 10);} ?></div>
          <?php if (strtotime(get_the_date()) >= $date) {?> <div class="read-more"><a href="<?php the_permalink(); ?> ">Read More </a></div><?php }?>
          </div>
          </div>
        <?php } else { ?>
          <div class="post-not-image">
            <div class="not-image"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <div class="page-date"><?php echo get_the_date() . ' / ';echo comments_number(); ?> </div>

          </div>


        <?php } ?>

      </div>
      
<?php

    endwhile;
    
  endif;
  
}
