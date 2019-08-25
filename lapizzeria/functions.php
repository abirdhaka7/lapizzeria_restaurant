<?php
 
//Link to database.php file(this contain the sql code)
require get_template_directory() . '/inc/database.php'; 

//Handle the submission to the database
require get_template_directory() . '/inc/reservation.php'; 

//Creates option Pages for theme
require get_template_directory() . '/inc/options.php'; 


function lapizzeria_theme_setup(){
    
    add_theme_support('post-thumbnails');

    add_image_size('boxes', 437, 291, true);
    add_image_size('specialties', 768, 515, true);
    add_image_size('specialties-portrait', 435, 530, true);

    //this code will change the default value of thumbnail size in wordPress setting
    update_option('thumbnail_size_w', 253);
    update_option('thumbnail_size_h', 164);
}
add_action('after_setup_theme','lapizzeria_theme_setup');

function lapizzeria_styles(){
    // adding stylesheets
    wp_register_style( 'google-font','https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900&display=swap', array() , '1.0' );
    wp_register_style( 'normalize', get_template_directory_uri() .'/css/normalize.css', array() , '8.0.1' );
    wp_register_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css', array() , '4.7.0' );
    wp_register_style( 'date-time-local', get_template_directory_uri() .'/css/datetime-local-polyfill.css', array() , '1.0.0' );
    wp_register_style( 'fluid-box', get_template_directory_uri() .'/css/fluidbox.min.css', array() , '8.0.1' );
    wp_register_style( 'style', get_template_directory_uri() .'/style.css', array('normalize') , time());
    
    // Enqueue the Style
    wp_enqueue_style('google-font');
    wp_enqueue_style('normalize');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('date-time-local');
    wp_enqueue_style('fluid-box');
    wp_enqueue_style('style');


    $apikey= esc_attr( get_option('lapizzeria_gmaps_api_key'));

    // Register js scripts
    wp_register_script( 'fluid-box-js', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array('jquery','debounce'), '1.0.0', true );
    

    wp_register_script( 'debounce', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js', array('jquery'), '1.0.0', true );
    
    wp_register_script( 'daytime-polyfill-js', get_template_directory_uri() . '/js/datetime-local-polyfill.min.js', array('jquery','jquery-ui-core','jquery-ui-datepicker','modernizr'), '1.0.0', true );
    
    wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=' . $apikey . '&callback=initMap', array(), '', true );
   
    wp_register_script( 'parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery',), '1.5.0', true );

    //This js file is for firefox if you active this will cause responsive issue in chrome so i comment this file and searching solution.
    // wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), '2.8.3', true );
   
    wp_register_script( 'script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );
    
    // Add Javascript files
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('fluid-box-js');
    wp_enqueue_script('debounce');
    wp_enqueue_script('daytime-polyfill-js');
    wp_enqueue_script('google-map');
    wp_enqueue_script('parallax');
    wp_enqueue_script('modernizr');
    wp_enqueue_script('script');

    wp_localize_script(
        'script', 
        'options',
        array(
            'latitude'  => esc_html( get_option('lapizzeria_gmaps_latitude') ),
            'longitude' => esc_html( get_option('lapizzeria_gmaps_longitude') ),
            'zoom'      => esc_html( get_option('lapizzeria_gmaps_zoom') )
            )
        );

}
add_action( 'wp_enqueue_scripts','lapizzeria_styles');

//this function will define the length of excerpt
function control_excerpt_length( $length ){
    return 45;
}
add_filter('excerpt_length','control_excerpt_length');

//this function will remove the [...] from excerpt
function remove_dot_from_excerpt( $remove ){
    return '...';
}
add_filter('excerpt_more', 'remove_dot_from_excerpt');


//Add menu
function lapizzeria_menus(){

    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'lapizzeria'),
        'social-menu' => __('Social Menu', 'lapizzeria'),
    ));
} 
add_action('init','lapizzeria_menus');

// Function fo new custom post type
function lapizzeria_specialties(){
    $labels = array(
        'name'               => _x('Pizzas', 'lapizzeria'),
        'singular_name'      => _x('Pizza','post type singular name', 'lapizzeria'),
        'menu_name'          => _x('Pizzas','admin menu' ,'lapizzeria'),
        'menu_admin_bar'     => _x('Pizzas','add new on admin bar ' ,'lapizzeria'),
        'add_new'            => _x('Add New','book ' ,'lapizzeria'),
        'add_new_item'       => _x('Add New Pizza','lapizzeria'),
        'new_item'           => _x('New Pizzas','lapizzeria'),
        'edit_item'          => _x('Edit Pizzas','lapizzeria'),
        'view_item'          => _x('View Pizzas','lapizzeria'),
        'all_items'          => _x('All Pizzas','lapizzeria'),
        'search_items'       => _x('Search Pizzas','lapizzeria'),
        'parent_item_colon'  => _x('Parent Pizzas','lapizzeria'),
        'not_found'          => _x('No Pizzas found','lapizzeria'),
        'not_found_in_trash' => _x('No Pizzas found in Trash','lapizzeria')
    );

    $args = array(
        'labels'                => $labels,
        'description'           => __('Description', 'lapizzeria'),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'specialties'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 6,
        'supports'              => array('title','editor','thumbnail'),
        'taxonomies'            => array('category')
    );
    
    register_post_type( 'specialties', $args );
}
add_action('init','lapizzeria_specialties');

/*===widget zone===*/

function lapizzeria_widgets(){

    register_sidebar( array(
        'name' => 'Blog Sidebar',
        'id'   => 'blog_sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}
add_action('widgets_init','lapizzeria_widgets');


function add_async_defer($tag, $handle){
  if('google-map' !== $handle){
      return $tag;
  }
  return str_replace(' src', 'async="async" defer="defer" src', $tag);
  
}
add_filter( 'script_loader_tag', 'add_async_defer', 10, 2);