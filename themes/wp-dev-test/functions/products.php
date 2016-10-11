<?php
add_action( 'init', 'product_register' );
function product_register() {
  $labels = array(
    'name' => _x('Products', 'post type general name'),
    'singular_name' => _x('Product', 'post type singular name'),
    'add_new' => _x('Add New', 'Product'),
    'add_new_item' => __('Add New Product'),
    'edit_item' => __('Edit Product'),
    'new_item' => __('New Product'),
    'all_items' => __('All Products'),
    'view_item' => __('View Products'),
    'search_items' => __('Search Products'),
    'not_found' =>  __('No products found'),
    'not_found_in_trash' => __('No products found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Products'
 
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
  ); 
  register_post_type('products',$args);
}

add_action("admin_init", "price_meta");
 function price_meta(){
  add_meta_box("price", "Price", "Price", "products", "normal", "low");
}
 
 function price(){
  global $post;
  $custom = get_post_custom($post->ID);
  $price = $custom["price"][0];
  ?>
  <label>Price:</label>
  <input id="price" name="price" type="text"  value="<?php echo $price; ?>" />
  <?php
}



add_action("admin_init", "saleprice_meta");
 function saleprice_meta(){
  add_meta_box("saleprice", "SalePrice", "SalePrice", "products", "normal", "low");
}
 
 function saleprice(){
  global $post;
  $custom = get_post_custom($post->ID);
  $price = $custom["saleprice"][0];
  ?>
  <label>Sale Price:</label>
  <input id="saleprice" name="saleprice" type="text"  value="<?php echo $saleprice; ?>" />
  <?php
}
  add_action('save_post', 'save_meta');
function save_meta(){
  global $post;
  update_post_meta($post->ID, price, $_POST["price"]);
  update_post_meta($post->ID, saleprice, $_POST["saleprice"]);
}

$labels = array(
    'name' => _x( 'Product Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product Categories' ),
    'all_items' => __( 'All Product Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Product Category' ), 
    'update_item' => __( 'Update Product Category' ),
    'add_new_item' => __( 'Add Product Category' ),
    'new_item_name' => __( 'New Product Category' ),
    'menu_name' => __( 'Product Categories' )
  );    
 
register_taxonomy('product_categories',array('products'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'query_var' => true,
    'show_ui' => true
 ));

?>