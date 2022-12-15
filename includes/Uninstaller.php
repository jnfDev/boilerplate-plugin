<?php declare(strict_types=1);

namespace Jnfdev\MyPlugin;

defined( 'ABSPATH' ) || exit;

final class Uninstaller
{
    use Singleton;

    public function init() {
        // Run unistall tasks here...
    }
}