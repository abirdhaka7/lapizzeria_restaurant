<?php get_header();?>

<?php
    $blog_page = get_option('page_for_posts');
    $image = get_post_thumbnail_id($blog_page);
    $image = wp_get_attachment_image_src($image, 'full');
?>


<div class="hero" data-parallax="scroll" data-image-src="<?php echo $image[0];?>" >
    <div class="hero-content">
        <div class="hero-text">
            <h2><?php echo get_the_title($blog_page);?></h2>
        </div>
    </div>
</div>

<div class="main-content container">
    <div class="container-grid">    
        <main class="columns2-3">
            <?php while(have_posts()) : the_post();?>  
                <article class="entry">
                    <a href="<?php the_permalink();?>">
                        <?the_post_thumbnail('specialties');?>
                    </a>
                </article>
                <header class="entry-header clear">
                    <div class="date">
                        <time>  
                            <?php echo the_time('d'); ?>
                            <span><?php echo the_time('M'); ?></span>
                        </time>
                    </div><!---/.date--->
                    <div class="entry-title">
                        <?php the_title('<h2>','</h2>');?>
                        <p class="author">
                            <i class="fa fa-user" area-hidden="true"></i>
                            <?php the_author();?>
                        </p><!---/.author--->
                    </div>
                </header>
                <div class="entry-content">
                    <?php the_excerpt();?>

                    <a href="<?php the_permalink();?>" class="button primary">Read more</a>
                </div><!---/.entry-content--->
            <?php endwhile;?>
        </main>

    <?php get_sidebar();?>

    </div><!---/.container-grid-->
</div><!---/.main-content container-->




<?php get_footer();?> 