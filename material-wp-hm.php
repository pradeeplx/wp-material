<?php
/**
 * Plugin Name: Material WP HM
 * Plugin URI: http://codecanyon.net/item/material-wp-material-design-dashboard-theme/12981098?ref=732
 * Text Domain: material-wp
 * Description: Bring Material Design to you WordPress Dashboard.
 * Version: 1.0.6
 * Author: Arindo Duque - NextPress (Formely 732)
 * Author URI: http://nextpress.co/
 * Copyright: Arindo Duque, NextPress.
 */

require_once plugin_dir_path(__FILE__) . '/inc/material-wp.php';

/**
 * Here starts our plugin.
 */
class MaterialWPHM extends MaterialWP
{
    public function adminPages()
    {

        // Load admin options
        require_once $this->path('inc/settings.php');

        /**
         * IMPORTANT: We need to initialize our export functionality
         */
        if (method_exists($this, 'addExportTab')) {

            $this->addExportTab($panel);

        } // end if;

        /**
         * IMPORTANT: We need to initialize our activation page
         */
        if (!function_exists('WP_Ultimo')) {

            $this->addAutoUpdateOptions($panel);

        } // end if;

        // Add this to branding
        $this->pages[] = $this->slugfy('settings');

    } // end adminPages;

    public function private_theme_functions()
    {
        // Adds plus button
        add_action('in_admin_header', [ & $this, 'addParallaxBlock'], -200);

        // Replace the common scripts
        add_action('wp_default_scripts', [$this, 'changeCommonScript'], 11);

    }
} // end MaterialWP;

function initialize_material_wp()
{
    if (class_exists('NextPress_Theme_Factory')) {
        // Now we need to load our config file
        $config = include plugin_dir_path(__FILE__) . './config.php';

        /**
         * We execute our plugin, passing our config file.
         */
        $MaterialWP = new MaterialWPHM($config);
        $MaterialWP->_refer_js = 'materialwpl10n';
    }
}

/*
 * Load the MaterialWP
 * @since 1.1.0
 */
add_action('plugins_loaded', 'initialize_material_wp', 11);
