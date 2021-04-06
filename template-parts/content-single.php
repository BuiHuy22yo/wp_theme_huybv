<!-- Title -->

<div class="title w80-mr-au"><?php echo get_the_title() ?></div>
<div class="date w80-mr-au"><?php echo get_the_date() ?>/<?php the_author_posts_link() ?>/<?php comments_number() ?></div>

<!-- Post Content -->
<div class="Content ">
<?php the_content() ?>
</div>


<!-- tag & share -->
<div class="tag-share w80-mr-au d-flex justify-content-between">
    <div class="tag "><?php the_tags(); ?> </div>
    <div class="share">
        <ul class="nav">
            <li class="px-2">
                <strong>Share :</strong>
            </li>
            <li class="px-2">
                <a href=""><i class="fab fa-facebook-f"></i></a>
            </li>
            <li class="px-2">
                <a href=""><i class="fab fa-twitter"></i></a>
            </li>
            <li class="px-2">
                <a href=""><i class="fab fa-pinterest-p"></i></a>
            </li>
            <li class="px-2">
                <a href=""><i class="fab fa-google-plus-g"></i></a>
            </li>
            <li class="px-2">
                <a href=""><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
    </div>
</div>

<nav class="nav-single d-flex justify-content-between w80-mr-au">
    <span class="nav-previous">
        <h3 class=" nav-title"> <?php previous_post_link('%link','%title')?></h3>
        <?php previous_post_link('%link', '<span class="meta-nav float-left">' . _x('&larr; Previous Article', 'Previous post link', '') . '</span> '); ?>
    </span>
    <span class="nav-next">
        <h3 class=" nav-title " ><?php next_post_link('%link','%title')?></h3>
        <?php next_post_link('%link', '<span class="meta-nav float-right">' . _x('Next Article &rarr;', 'Next post link', '') . '</span>'); ?>
    </span>
</nav>
<!-- comments -->
<?php

echo wpb_author_info_box()
?>
    


<!-- Recent posts -->
<div class=" w80-mr-au ">
    <?php echo Recent_posts( 'Recent posts',3) ?>
</div>


<!-- comments -->
<!-- comment vào bài viết -->
<hr>
<div class="mt-3 w80-mr-au">
    <?php 
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    ?>
</div>