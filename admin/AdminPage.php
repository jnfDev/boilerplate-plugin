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

        
        require_once __DIR__ . '/views/admin-page.php';
    }
}