<?php
/*
Plugin Name: Thank You NHS
Plugin URI: https://www.successlocal.co.uk/thank-you-nhs
Description: Adding rainbows to your site to spread hope and say thank you to the NHS and key workers.
Version: 1.0
Author: Andrew Chadwick, Success Local Limited
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Author URI: https://www.successlocal.co.uk
*/

// Register settings and page if admin
if ( is_admin() ){
  add_action( 'admin_menu', 'tynhs_options_add_page' );
}

// Create plugin settings page
function tynhs_options_add_page() {
  add_options_page("Thank You NHS Banner Settings", "NHS Banner Settings", "administrator", "thank_you_nhs_options", "tynhs_banner_settings"); 
}
// add the settings link on the plugins page
function tynhs_settings_link($links, $file) {
  $plugin_file = basename(__FILE__);
  if (basename($file) == $plugin_file) {
      $settings_link = '<a href="options-general.php?page=thank_you_nhs_options">Settings</a>';
      array_unshift($links, $settings_link);
  }
  return $links;
}
add_filter('plugin_action_links', 'tynhs_settings_link', 10, 2);

//Tie function to admin initialisation
add_action( 'admin_init', 'thank_you_nhs_options_init' );
// Register Settings
function thank_you_nhs_options_init(){
  register_setting( 'thank_you_nhs_options', 'thank_you_nhs_settings');
}

// Register Stylesheet
if(!class_exists('tynhsAddStyles')) {

    class tynhsAddStyles {

        public function __construct() {
            add_filter('query_vars', array($this, 'tynhs_add_wp_var'));
            add_action( 'wp_enqueue_scripts', array($this, 'tynhs_add_custom_css'), 9999 );
        }

        public static function tynhs_add_wp_var($public_query_vars) {
            $public_query_vars[] = 'tynhs_display_custom_css';
            return $public_query_vars;
        }

        public static function tynhs_display_custom_css(){
            $tynhs_display_css = get_query_var('tynhs_display_custom_css');
            if ($tynhs_display_css == 'css'){
                include_once (plugin_dir_path( __FILE__ ) . '/css/styles.php');
                exit;
            }
        }

        public function tynhs_add_custom_css() {
            $css_base_url = get_bloginfo('url');
            if ( is_ssl() ) {
                $css_base_url = str_replace('http://', 'https://', $css_base_url);
            }
            wp_register_style( 'tynhs-rainbow-styles', $css_base_url . '?tynhs_display_custom_css=css');
            wp_enqueue_style( 'tynhs-rainbow-styles' );
        }

    }

}

if(class_exists('tynhsAddStyles')) {
    add_action('template_redirect', array('tynhsAddStyles', 'tynhs_display_custom_css'));
    $tynhs_styles = new tynhsAddStyles();
}

//Register Scripts
if(!class_exists('tynhsAddScripts')) {

  class tynhsAddScripts {

      public function __construct() {
          add_filter('query_vars', array($this, 'tynhs_add_wp_var'));
          add_action( 'wp_enqueue_scripts', array($this, 'tynhs_add_custom_scripts'), 9999 );
      }

      public static function tynhs_add_wp_var($public_query_vars) {
          $public_query_vars[] = 'tynhs_display_custom_scripts';
          return $public_query_vars;
      }

      public static function tynhs_display_custom_scripts(){
          $tynhs_display_scripts = get_query_var('tynhs_display_custom_scripts');
          if ($tynhs_display_scripts == 'js'){
              include_once (plugin_dir_path( __FILE__ ) . '/js/script.php');
              exit;
          }
      }

      public function tynhs_add_custom_scripts() {
          $js_base_url = get_bloginfo('url');
          if ( is_ssl() ) {
              $js_base_url = str_replace('http://', 'https://', $js_base_url);
          }
          wp_register_script( 'tynhs-rainbow-scripts', $js_base_url . '?tynhs_display_custom_scripts=js');
          wp_enqueue_script( 'tynhs-rainbow-scripts' );
      }

  }

}

if(class_exists('tynhsAddScripts')) {
  add_action('template_redirect', array('tynhsAddScripts', 'tynhs_display_custom_scripts'));
  $tynhs_styles = new tynhsAddScripts();
}

// Include the plugin settings page
//include 'thank-you-nhs-settings.php';
//require(plugin_dir_path(__FILE__) . 'thank-you-nhs-settings.php');
function tynhs_banner_settings() {
  require(plugin_dir_path(__FILE__) . 'thank-you-nhs-settings.php');
}