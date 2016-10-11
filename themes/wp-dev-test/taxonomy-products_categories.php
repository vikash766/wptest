<?php
$slug = get_query_var( 'term' );
$term = get_term_by( 'slug', $slug , 'product_categories' );
$term_id = $term->term_id;
 
$args=array(
        'hide_empty'        => 0,  
        'parent'        => $term_id,
        'taxonomy'      => 'product_categories');
                         
$categories=get_categories($args);

if(!$categories){ 
         
    //get the product category name
    echo "<h1 class='entry-title'>".$term->name."</h1>";
 
    $args = array(
    'posts_per_page' => 2, //remember posts per page should be less or more that what's set in general settings
    'paged' => $paged,
    'meta_key' => 'price',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'tax_query' => array(
                array(
                'taxonomy' => 'product_categories',
                'field' => 'slug',
                'terms' => $slug)
        )
    );

$products_query = new WP_Query($args);
    if (have_posts()) :
    while($products_query->have_posts()) : $products_query->the_post(); 
 
        $post_thumbnail_id = get_post_thumbnail_id();
        $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
?>
        <div class="product">
            <a class="product-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php if($post_thumbnail_url){ echo $post_thumbnail_url; } else {  echo get_template_directory_uri()."/images/fallback.png"; } ?>&h=200&w=200" alt="<?php the_title(); ?>" />
            </a>
        </div>

<?php endwhile; else: ?>
    <p>Sorry no products were found.</p>
<?php endif; ?>
<?php wp_reset_query();  ?>
<div class="pagination">
    <?php next_posts_link('« More Products', $products_query->max_num_pages) ?>
    <?php previous_posts_link('Previous Products »') ?>
</div>
<?php
else{ 
         
    //output current category name
    echo '<h1 class="entry-title">'.$term->name.'</h1>';
    foreach($categories as $category) {
        echo '<div class="product-cat">'; 
 
        $thumb_url = get_option('taxonomy_image_plugin');
        $thumb_url = wp_get_attachment_url( $thumb_url[$category->term_taxonomy_id]);
        $product_cat_url = get_term_link( $category->slug, 'product_categories' );
?>
         
        <a href="<?php echo $product_cat_url; ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php if($thumb_url){ echo $thumb_url; } else{ echo get_template_directory_uri()."/images/fallback.png"; } ?>&h=200&w=200" alt="<?php the_title(); ?>" />
        </a>
        <a class="cat-title" href="<?php echo $product_cat_url ; ?>"><?php echo $category->name; ?></a>
        </div> <!--end product cat-->
                 
<?php } ?>  