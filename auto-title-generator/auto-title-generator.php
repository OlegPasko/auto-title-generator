<?php
/*
Plugin Name: WordPress AI GPT-4 Title Generator Plugin
Description: Automatically generates post titles based on the content in the editor.
Version: 1.0
Author: Oleg Pasko
Author URI: https://everlabs.com
License: MIT
Text Domain: auto-title-generator
*/
function atg_enqueue_assets() {
    wp_enqueue_script(
        'atg-script',
        plugins_url('auto-title-generator.js', __FILE__),
        array('wp-data', 'wp-element', 'wp-edit-post'),
        filemtime(plugin_dir_path(__FILE__) . 'auto-title-generator.js'),
        true
    );
}
add_action('enqueue_block_editor_assets', 'atg_enqueue_assets');

function atg_create_settings_page() {
    add_options_page(
        'Auto Title Generator Settings',
        'Auto Title Generator',
        'manage_options',
        'atg-settings',
        'atg_render_settings_page'
    );
}
add_action('admin_menu', 'atg_create_settings_page');

function atg_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Auto Title Generator Settings</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields('atg-settings-group');
                do_settings_sections('atg-settings-group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">OpenAI API Key</th>
                    <td>
                        <input type="text" name="atg_openai_api_key" value="<?php echo esc_attr(get_option('atg_openai_api_key')); ?>" size="50" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function atg_register_settings() {
    register_setting('atg-settings-group', 'atg_openai_api_key');
}
add_action('admin_init', 'atg_register_settings');


require_once plugin_dir_path(__FILE__) . 'openai-api.php';