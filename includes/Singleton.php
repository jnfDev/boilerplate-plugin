<?php declare(strict_types=1);

namespace Jnfdev\MyPlugin;

defined( 'ABSPATH' ) || exit;

trait Singleton 
{
    private static $instance;

    private function __construct() 
    {
        $this->init();
    }

    public static function instance()
    {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Shorthand for instance.
     */
    public static function run(): void
    {
        self::instance();
    }

    abstract public function init();
}