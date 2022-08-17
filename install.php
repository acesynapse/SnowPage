<?php
// If this file is called directly, the teapot refuses to brew coffee.
defined('ABSPATH') || die(http_response_code(418));

/**
 * @since     1.0.0
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

use Gantry\Framework\ThemeInstaller;

/**
 * Class snowpageInstallerScript
 */
class snowpageInstallerScript
{
    /**
     * Called by TemplateInstaller to customize post-installation.
     *
     * @param ThemeInstaller $installer
     */
    public function installDefaults(ThemeInstaller $installer)
    {
        // Create default outlines etc.
        $installer->createDefaults();
    }

    /**
     * Called by TemplateInstaller to customize sample data creation.
     *
     * @param ThemeInstaller $installer
     */
    public function installSampleData(ThemeInstaller $installer)
    {
        // Create sample data.
        $installer->createSampleData();
    }
}
