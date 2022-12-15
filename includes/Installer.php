<?php declare(strict_types=1);

namespace Jnfdev\MyPlugin;

defined( 'ABSPATH' ) || exit;

final class Installer
{
    use Singleton;

    public function init() {
        // Run install tasks here...
    }
}