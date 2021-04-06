<?php get_header(); ?>

<div class="content">
    <div class="container">
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('template-parts/content-single', get_post_format()); ?>

            <?php endwhile; ?>

        <?php endif; ?>
       
    </div>
</div>

<?php get_footer(); ?>