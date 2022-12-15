<?php declare(strict_types=1);

namespace Jnfdev\MyPlugin\Admin;

use Jnfdev\MyPlugin\MyPlugin;
use Jnfdev\MyPlugin\Singleton;

defined( 'ABSPATH' ) || exit;

final class AdminPage
{
    use Singleton;

    protected MyPlugin $plugin;

    protected const SLUG = 'jnfdev-admin-page';
    
    protected function init()
    {
        $this->plugin = MyPlugin::instance();

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAssets' ] );
        add_action( 'admin_menu', [ $this, 'registerMenu' ] );
    }

    public function enqueueAssets(): void
    {
        $screen = get_current_screen();
        if ( 'toplevel_page_' . self::SLUG !==  $screen->id ) {
            return;
        }

        wp_register_style( self::SLUG, $this->plugin->rootURL . 'admin/assets/build/admin-page.css' , [], $this->plugin->pluginVersion );
        wp_register_script( self::SLUG, $this->plugin->rootURL . 'admin/assets/build/admin-page.js', [ 'wp-i18n' ],  $this->plugin->pluginVersion, true );
    }

    public function registerMenu(): void
    {
        add_menu_page( 
            __( 'My Plugin Admin Page', 'boilerplate-plugin-domain' ), 
            __( 'My Plugin Admin Page', 'boilerplate-plugin-domain' ), 
            'manage_options', 
            self::SLUG, 
            [ $this, 'renderMenuPage' ], 
            'dashicons-rest-api' 
        );
    }

    public function renderMenuPage(): void
    {   
        /**
         * View's variables 
         */
        $assetUrl = $this->plugin->rootURL . '/admin/assets';

        // Add styles + script
        wp_enqueue_style( self::SLUG );
        wp_enqueue_script( self::SLUG );
        wp_set_script_translations( self::SLUG, 'boilerplate-plugin-domain', $this->plugin->rootPath . '/languages/' );
        
        require_once __DIR__ . '/views/admin-page.php';
    }
}