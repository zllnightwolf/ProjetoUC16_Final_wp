<?php

if ( ! class_exists( 'QodeEssentialAddons_Framework_Import_Plugins' ) ) {
	class QodeEssentialAddons_Framework_Import_Plugins {

		/**
		 * @var instance of current class
		 */
		private static $instance;
		private $plugins;

		function __construct() {
			$this->set_plugins();
			add_action( 'wp_ajax_install_plugin', array( $this, 'install_plugin' ) );
		}

		/**
		 * @return QodeEssentialAddons_Framework_Import_Plugins
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function set_plugins() {

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			if ( is_array( $plugins ) && count( $plugins ) > 0 ) {
				foreach ( $plugins as $plugin => $plugin_value ) {
					$plugin_parts                      = explode( '/', $plugin );
					$this->plugins[ $plugin_parts[0] ] = $plugin;
				}
			} else {
				$this->plugins[] = array();
			}
		}

		function get_plugins() {
			return $this->plugins;
		}

		function is_plugin_installed( $key ) {

			$plugins = $this->get_plugins();

			if ( isset( $plugins[ $key ] ) ) {
				return true;
			}

			return false;
		}

		function is_plugin_active( $key ) {

			$plugins = $this->get_plugins();

			if ( is_plugin_active( $plugins[ $key ] ) ) {
				return true;
			}

			return false;
		}

		function prepare_plugin( $plugin ) {
			$prepared_plugin = array();

			if ( ! empty( $plugin ) ) {

				$prepared_plugin['key'] = $plugin;
				$is_plugin_installed    = $this->is_plugin_installed( $plugin );

				if ( $is_plugin_installed ) {

					$is_plugin_active = $this->is_plugin_active( $plugin );

					if ( $is_plugin_active ) {

						$prepared_plugin['status'] = 'activated';
						$prepared_plugin['label']  = esc_html__( 'Activated', 'qode-essential-addons' );
						$prepared_plugin['action_label']  = esc_html__( 'Activated', 'qode-essential-addons' );

					} else {

						$prepared_plugin['status'] = 'activate';
						$prepared_plugin['label']  = esc_html__( 'Activate', 'qode-essential-addons' );
						$prepared_plugin['action_label']  = esc_html__( 'Activating', 'qode-essential-addons' );

					}
				} else {
					if ( 'qi-addons-for-elementor-premium' == $prepared_plugin['key'] ) {
						$prepared_plugin['status']       = 'not-installed';
						$prepared_plugin['label']        = esc_html__( 'Not Installed', 'qode-essential-addons' );
						$prepared_plugin['action_label'] = esc_html__( 'Installing', 'qode-essential-addons' );
					} else {
						$prepared_plugin['status']       = 'install';
						$prepared_plugin['label']        = esc_html__( 'Install', 'qode-essential-addons' );
						$prepared_plugin['action_label'] = esc_html__( 'Installing', 'qode-essential-addons' );
					}
				}
			}

			return $prepared_plugin;

		}

		function install_plugin() {

			if ( isset( $_POST ) ) {

				$download_url  = '';
				$plugins       = $this->get_plugins();
				$plugin_action = $_POST['pluginAction'];
				$plugin_slug   = $_POST['pluginSlug'];

				$source = empty( $plugin['source'] ) ? 'repo' : $plugin['source'];

				if ( 'repo' === $source || '|^http[s]?://wordpress\.org/(?:extend/)?plugins/|' ) {
					$source_type = 'repo';
				} elseif ( preg_match( '|^http[s]?://|', $source ) ) {
					$source_type = 'external';
				} else {
					$source_type = 'bundled';
				}

				switch ( $source_type ) {
					case 'repo':
						$download_url = $this->get_api_plugin_download_url( $plugin_slug );
						break;
					case 'external':
						$download_url = $plugin['source'];
						break;
					case 'bundled':
						$download_url = $plugin['source'];
						break;
				}

				if ( 'install' === $plugin_action ) {

					ob_start();
					include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
					wp_cache_flush();

					$skin     = new WP_Ajax_Upgrader_Skin();
					$upgrader = new Plugin_Upgrader( $skin );

					$install_result = $upgrader->install( $download_url );

					if ( ! is_wp_error( $install_result ) && $install_result ) {
						qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Activate', 'qode-essential-addons' ), array( 'action_label' => esc_html__( 'Activating', 'qode-essential-addons' ) ) );
					}
				} else {

					if ( ! function_exists( 'get_plugins' ) ) {
						require_once ABSPATH . 'wp-admin/includes/plugin.php';
					}

					$activate = activate_plugin( $plugins[ $plugin_slug ], '', false, true );

					do_action( 'qode_essential_addons_action_after_plugin_activation_' . $plugin_slug );

					if ( null === $activate ) {
						qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Activated', 'qode-essential-addons' ) );
					}
				}
				wp_die();

			}
		}

		function get_api_plugin_download_url( $slug ) {

			$download_url = '';

			if ( ! function_exists( 'plugins_api' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
			}

			$api = plugins_api( 'plugin_information', array( 'slug' => $slug ) );

			if ( false !== $api && isset( $api->download_link ) ) {
				$download_url = $api->download_link;
			}

			return $download_url;
		}
	}
}

//has to be cal on 'init' since get_plugins() function (ln. 34) is retriving list of plugins and set up global cache variable for that list too early.
// this list is used by Elementor also, so those two lists are interfearing with each other
add_action(
	'admin_init',
	function () {
		QodeEssentialAddons_Framework_Import_Plugins::get_instance();
	}
);
