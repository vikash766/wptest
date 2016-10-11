<?php get_header(); ?>
 
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
         
        <?php 
            //get post thumbnail url
            $post_thumbnail_id = get_post_thumbnail_id();
            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
        ?>
        <img id="product-img" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php if(!empty($post_thumbnail_url)){ echo $post_thumbnail_url; } else {  echo get_template_directory_uri()."/images/fallback.png"; } ?>&h=300&w=300" alt="<?php the_title(); ?>" />       
         
        <div id="product-desc">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
             
        <?php if( get_post_meta($post->ID, 'price', true)): ?>
            Price: <?php echo get_post_meta($post->ID, 'price', true); ?>
        <?php endif; ?>
             
        <div> 
          
    <?php endwhile; ?>
 
<?php get_footer(); ?>