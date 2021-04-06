<?php

/**
 * 
 * Template name: Page-list post
 *
 */
?>
<?php get_header(); ?>
<div class="content">
    <div class="container">
        <div class="row abc">
            <?php apply_filters('list', 15); 
            ?>
        </div>
        <div class="load-more">
            <a href="">
                Load More
            </a>
        </div>
    </div>

</div>

<?php get_footer(); ?>