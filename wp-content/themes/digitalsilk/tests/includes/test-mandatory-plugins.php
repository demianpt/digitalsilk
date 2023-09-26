<?php

class ThemePluginTest extends WP_UnitTestCase {
    
    public function setUp() : void {
        parent::setUp();
        // Additional setup if needed
    }

    public function test_mandatory_plugins_activated() {
        $mandatory_plugins = array(
            'advanced-custom-fields-pro/acf.php',
            'classic-editor/classic-editor.php',
        );

        foreach ($mandatory_plugins as $plugin) {
            $this->assertTrue(is_plugin_active($plugin), "The plugin {$plugin} is not active.");
        }
    }

    public function tearDown() : void {
        // Cleanup if needed
        parent::tearDown();
    }
}
