<?php declare(strict_types=1);

namespace Jnfdev\MyPlugin;

use Jnfdev\MyPlugin\Admin\AdminPage;

defined( 'ABSPATH' ) || exit;

final class MyPlugin 
{
    use Singleton;

    public const PLUGIN_SLUG = 'boilerplate-plugin';

    public string $pluginVersion;

    public string $rootPath;

    public string $rootURL;

    public function pluginInit() {
        $this->pluginSetup();
    
        if ( ! is_admin() ) {
            $this->public(); 
            return;
        }
    
        $this->admin(); 
    }
    
    protected function init()
    {
        add_action( 'init', [ $this, 'pluginInit' ] );
    }

    protected function pluginSetup()
    {
        /**
         * Define global stuff, such as registering custom post-types, 
         * loading the plugin's textdomain, or even registering global hooks.
         */

        $this->pluginVersion = defined('JNFDEV_MYPLUGIN_VERSION') ? JNFDEV_MYPLUGIN_VERSION : '1.0.0';
        $this->rootPath      = dirname( __DIR__ );
        $this->rootURL       = plugin_dir_url( $this->rootPath . '/' . self::PLUGIN_SLUG );

        $pluginLangPath = self::PLUGIN_SLUG . '/languages';

        load_plugin_textdomain( 'boilerplate-plugin-domain', false, $pluginLangPath );
    }

    protected function admin()
    {
        /**
         * Define admin stuff, like registering admin hooks, 
         * enqueue admin assets or any other admin-related stuff.
         */

         AdminPage::run();
    }

    protected function public()
    {
        /**
         * Define frontend stuff, like registering frontend hooks, 
         * enqueue frontend assets or any other frontend-related stuff.
         */
    }
}