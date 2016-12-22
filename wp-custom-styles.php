<?php
/*
Plugin Name: Wordpress Custom Styles
Plugin URI: https://benjamingrobertson.com
Description: Add custom styles in your posts and pages content using TinyMCE WYSIWYG editor. The plugin adds a Format dropdown menu in the visual post editor.
Based on TinyMCE Kit plug-in for WordPress
http://plugins.svn.wordpress.org/tinymce-advanced/branches/tinymce-kit/tinymce-kit.php
*/
/**
 * Apply styles to the visual editor
 */
add_filter('mce_css', 'upup_mcekit_editor_style');
function upup_mcekit_editor_style($url) {

    if ( !empty($url) )
        $url .= ',';

    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/editor-styles.css';

    return $url;
}

/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'upup_mce_editor_buttons' );

function upup_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'upup_mce_before_init' );

function upup_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'button'
            )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

/**
 * Use the section below if you want to add in a new stylesheet that isn't in
 * your theme.
 */

/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */

// /*
//  * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
//  */
// add_action('wp_enqueue_scripts', 'upup_mcekit_editor_enqueue');
//
// /*
//  * Enqueue stylesheet, if it exists.
//  */
// function upup_mcekit_editor_enqueue() {
//   $StyleUrl = plugin_dir_url(__FILE__).'editor-styles.css'; // Customstyle.css is relative to the current file
//   wp_enqueue_style( 'myCustomStyles', $StyleUrl );
// }
?>
