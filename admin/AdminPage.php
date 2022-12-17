<?php declare(strict_types=1);

namespace Jnfdev\MyPlugin\Admin;

use Dotenv;
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

        add_filter( 'script_loader_tag', [ $this, 'addModuleToScript' ], 10, 3 );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAssets' ] );
        add_action( 'admin_menu', [ $this, 'registerMenu' ] );
    }

    public function addModuleToScript($tag, $handle, $src)
    {
        if ( $handle === self::SLUG ) {
            $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
        }

        return $tag;
    }

    public function enqueueAssets(): void
    {
        $screen = get_current_screen();
        if ( 'toplevel_page_' . self::SLUG !==  $screen->id ) {
            return;
        }

        $dotenv = Dotenv\Dotenv::createImmutable( $this->plugin->rootPath );
        $dotenv->safeLoad();
        
        if ( isset( $_ENV['ENV_MODE'] ) && 'dev' === strtolower( $_ENV['ENV_MODE'] ) ) {  
            wp_register_script( self::SLUG, esc_url( $_ENV['DEV_SERVER'] ) . 'src/main.js', [ 'jquery', 'wp-i18n' ], $this->plugin->pluginVersion, false );
        } else {
            wp_register_script( self::SLUG, $this->plugin->rootURL . 'build/main.js', [ 'jquery', 'wp-i18n' ], $this->plugin->pluginVersion, false );
            wp_register_style( self::SLUG, $this->plugin->rootURL . 'build/main.css' , [], $this->plugin->pluginVersion );
        }
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
        if ( empty( $_ENV['ENV_MODE'] ) || 'DEV' !== strtoupper( $_ENV['ENV_MODE'] ) ) {
            wp_enqueue_style(self::SLUG);
        } 

        wp_enqueue_script(self::SLUG);

        require_once __DIR__ . '/views/admin-page.php';
    }
}