<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

/**
 * Class snowpageInstallerScript
 */
class snowpageInstallerScript
{
    /**
     * Called by TemplateInstaller to customize post-installation.
     *
     * @param \Gantry\Framework\ThemeInstaller $installer
     */
    public function installDefaults(Gantry\Framework\ThemeInstaller $installer)
    {
        // Create default outlines etc.
        $installer->createDefaults();
    }

    /**
     * Called by TemplateInstaller to customize sample data creation.
     *
     * @param \Gantry\Framework\ThemeInstaller $installer
     */
    public function installSampleData(Gantry\Framework\ThemeInstaller $installer)
    {
        // Create sample data.
        $installer->createSampleData();
    }
}
