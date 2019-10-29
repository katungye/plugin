<?php

/**
 * Plugin Name: room custom
 * Pungin URI:
 * Discription: This plugin helps to extends custom post type
 * Version: 1.0
 * Author: Katungye Johnson
 * Licence: GPL2
 */

if(! defined('ABSPATH')){
    die;
}

// creating custom post type function
function create_posttype() {
 
    register_post_type( 'Room',
    // Options
        array(
            'labels' => array(
                'name' => __( 'Room' ),
                'singular_name' => __( 'Rooms' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Room'),
        )
    );
}
// Hooking up our function 
add_action( 'init', 'create_posttype' );


/* redirect them to the default place
            $url = get_template_directory_uri().'/custom/custom.php';
            wp_safe_redirect( $url );
            exit;*/


//restrict admin dashboad to admin and redirect other users to home page
function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default page
            $url = get_template_directory_uri().'custom.php';
            wp_safe_redirect( $url );
            
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
 
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
