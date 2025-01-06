<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Adds the legacy menu to the WordPress admin panel.
 *
 * This method registers the legacy settings page for the plugin under the
 * WordPress admin menu. The page is used for compatibility with older browsers.
 *
 * @since 0.10.0
 */

if (!class_exists('Smtrm_Legacy_Menu')) {
    class Smtrm_Legacy_Menu
    {
        public function add_legacy_menu()
        {
            add_menu_page(
                __('Same Term Pager Legacy Settings', 'wp-sameterm-pager'),
                __('Same Term Pager Legacy Settings', 'wp-sameterm-pager'),
                'manage_options',
                'wp_sameterm_pager',
                array(&$this, 'legacy_menu_page'),
                'dashicons-admin-post'
            );
        }

        /**
         * Displays the legacy settings page.
         *
         * This method renders the HTML for the legacy settings page. It includes options
         * for configuring the plugin and saving the settings. The settings are saved
         * securely with a nonce verification to prevent unauthorized access.
         *
         * @since 0.10.0
         */
        public function legacy_menu_page()
        {
            $replaced_uri = str_replace('%7E', '~', $_SERVER['REQUEST_URI']);
            $saved_setting = new Smtrm_Get_Setting();
            $top_checked = $saved_setting->pager_top() ? 'checked' : '';
            $bottom_checked = $saved_setting->pager_bottom() ? 'checked' : '';
            $oldest_text = esc_html($saved_setting->pager_oldest_text());
            $latest_text = esc_html($saved_setting->pager_latest_text());
            $ap_css_value = esc_html($saved_setting->ap_param_css_value());
            $smtrm_top = SMTRM_TOP;
            $smtrm_ap_css = SMTRM_AP_PARAM_CSS;
            $smtrm_bottom = SMTRM_BOTTOM;
            $smtrm_oldest = SMTRM_OLDEST_POST;
            $smtrm_latest = SMTRM_LATEST_POST;
            $smtrm_nonce = wp_nonce_field('smtrm_save_settings', 'smtrm_nonce');

            $page_title = __('Same Term Pager Legacy Settings', 'wp-sameterm-pager');
            $general_settings = __('General Settings', 'wp-sameterm-pager');
            $advanced_settings = __('Advanced Settings', 'wp-sameterm-pager');

            $pager_a_b_title = __('Pager Above and Below Posts', 'wp-sameterm-pager');
            $pager_above_title = __('Display pager above the post', 'wp-sameterm-pager');
            $pager_below_title = __('Display pager below the post', 'wp-sameterm-pager');

            $oldest_title = __('Text for "Read the oldest post"', 'wp-sameterm-pager');
            $latest_title = __('Text for "Read the latest post"', 'wp-sameterm-pager');

            $ap_param_title = __('Archive Page Setting', 'wp-sameterm-pager');
            $ap_param_detail = __('CSS selectors to use if the filter function is not working (multiple selectors can be separated by commas)', 'wp-sameterm-pager');

            $save = __('Save', 'wp-sameterm-pager');
            $saved_message = '';
            $legacy_message = '';
            if (isset($_GET['legacy']) && $_GET['legacy'] === '1') {
                $legacy_message .= __('Your current browser environment does not support the modern settings interface. You are now viewing the legacy settings page for compatibility. We recommend switching to a supported browser for the best experience.', 'wp-sameterm-pager');
            }
            if (version_compare(get_bloginfo('version'), '6.6', '<')) {
                $legacy_message .= __('Your current WordPress version is below the recommended version (6.6). For the best experience, please update WordPress to the latest version. You are currently viewing the legacy settings page for compatibility.', 'wp-sameterm-pager');
            }

            if (isset($_POST['posted']) == 'smtrm_save') {
                if (isset($_POST[$smtrm_ap_css])) {
                    $smtrm_sanitize = new Smtrm_Sanitize();
                    $ap_css_value = $smtrm_sanitize->sanitize_css_selector(wp_unslash($_POST[$smtrm_ap_css]));
                    update_option($smtrm_ap_css, $ap_css_value);
                }
                if (isset($_POST[$smtrm_top])) {
                    update_option($smtrm_top, intval($_POST[$smtrm_top]));
                }
                if (isset($_POST[$smtrm_bottom])) {
                    update_option($smtrm_bottom, intval($_POST[$smtrm_bottom]));
                }
                if (isset($_POST[$smtrm_oldest])) {
                    $oldest_text = wp_kses_post(wp_unslash($_POST[$smtrm_oldest]));
                    update_option($smtrm_oldest, $oldest_text);
                }
                if (isset($_POST[$smtrm_latest])) {
                    $latest_text = wp_kses_post(wp_unslash($_POST[$smtrm_latest]));
                    update_option($smtrm_latest, $latest_text);
                }
                if (!isset($_POST['smtrm_nonce']) || !wp_verify_nonce($_POST['smtrm_nonce'], 'smtrm_save_settings')) {
                    wp_die(__('Failed security check.', 'wp-sameterm-pager'));
                }
                $top_checked = $saved_setting->pager_top() ? 'checked' : '';
                $bottom_checked = $saved_setting->pager_bottom() ? 'checked' : '';
                $ap_css_value = esc_html($saved_setting->ap_param_css_value());
                $oldest_text = esc_html($saved_setting->pager_oldest_text());
                $latest_text = esc_html($saved_setting->pager_latest_text());
                $saved_message = '<div><p>' . __('Settings have been saved!', 'wp-sameterm-pager') . ' </p></div>';
            }
            echo <<<"EOT"
        <section style="padding-top:32px;">
          <h1>{$page_title}</h1>
          <p>{$legacy_message}</p>
          <h2>{$general_settings}</h2>
          <form method="post" action="{$replaced_uri}">
          {$smtrm_nonce}
            <table class="form-table">
              <tr>
                <th rowspan="2"><p>{$pager_a_b_title}</p></th>
                <td>
                  <input type="hidden" name="{$smtrm_top}" value="0">
                  <input type="checkbox" id="{$smtrm_top}" name="{$smtrm_top}" value="1" {$top_checked}/>
                  <label for="{$smtrm_top}">{$pager_above_title}</label>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" name="{$smtrm_bottom}" value="0">
                  <input type="checkbox" id="{$smtrm_bottom}" name="{$smtrm_bottom}" value="1" {$bottom_checked}/>
                  <label for="{$smtrm_bottom}">{$pager_below_title}</label>
                </td>
              </tr>
              <tr valign="top">
                <th scope="row"><label>{$oldest_title}<label></th>
                <td><input type="text" size="50" name="{$smtrm_oldest}" id="{$smtrm_oldest}" value="{$oldest_text}">
                </td>
              </tr>
              <tr>
              <tr valign="top">
                <th scope="row"><label>{$latest_title}<label></th>
                <td><input type="text" size="50" name="{$smtrm_latest}" id="{$smtrm_latest}" value="{$latest_text}">
                </td>
              </tr>
              </tr>
            </table>
            <h2>{$advanced_settings}</h2>
            <table>
              <tr valign="top">
              <th scope="row"><label>{$ap_param_title}<label></th>
              <td><input type="text" size="50" name="{$smtrm_ap_css}" id="{$smtrm_ap_css}" value="{$ap_css_value}">
              <p>{$ap_param_detail}</p>
              </td>
              </tr>
            </table>
            <input type="hidden" name="posted" value="smtrm_save">
            <input type="submit" name="submit" class="submit_btn" value="{$save}">
          </form>
          <div>
            <p>{$saved_message}</p>
          </div>
        </section>
        EOT;
        }
    }
}
