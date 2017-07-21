<?php

include_once('CLASS-myexpress-spedizioni-InstallIndicator.php');

class CLASS_myexpress_spedizioni_LifeCycle extends CLASS_myexpress_spedizioni_InstallIndicator {

	public function install() {
		$this->initOptions();
		$this->installDatabaseTables();
		$this->otherInstall();
		$this->saveInstalledVersion();
		$this->markAsInstalled();
	}

	public function uninstall() {
		$this->otherUninstall();
		$this->unInstallDatabaseTables();
		$this->deleteSavedOptions();
		$this->markAsUnInstalled();
	}

	public function upgrade() {
	}

	public function activate() {
	}

	public function deactivate() {
	}

	protected function initOptions() {
	}

	public function addActionsAndFilters() {
	}

	protected function installDatabaseTables() {
	}

	protected function unInstallDatabaseTables() {
	}

	protected function otherInstall() {
	}

	protected function otherUninstall() {
	}

	public function addSettingsSubMenuPage() {
		$this->addSettingsSubMenuPageToPluginsMenu();
	}

	protected function requireExtraPluginFiles() {
		require_once(ABSPATH . 'wp-includes/pluggable.php');
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}

	protected function getSettingsSlug() {
		return get_class($this) . 'Settings';
	}

	protected function addSettingsSubMenuPageToPluginsMenu() {
		$this->requireExtraPluginFiles();
		$displayName = $this->getPluginDisplayName();      
		add_submenu_page('wpdocs_register_my_custom_menu_page',$displayName,$displayName,'manage_options',$this->getSettingsSlug(),array(&$this, 'settingsPage'));
		add_filter( 'woocommerce_admin_order_actions', 'add_spedizione_order_actions_button', 10, 2 );
		function add_spedizione_order_actions_button( $actions, $the_order ) {										  
			require_once('CLASS-myexpress-spedizioni-Plugin.php');
			$CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();						  
			$result = $CLASS_MYE->do_check_storico_ordine($the_order->id);					  
			if ($result > 0) {
				$actions['cancel'] = array(
				'url'       => wp_nonce_url( admin_url( 'admin.php?page=myexpress_spedizioni-storico&tipo-estrai-spedizioni=ritirate&ordine_woocommerce=' . $the_order->id ), 'woocommerce-mark-order-status' ),
				'name'      => __( 'Spedizione', 'woocommerce' ),
				'action'    => "view spedizione", // setting "view" for proper button CSS
				);					  	
		  } else {
				$actions['cancel'] = array(
				'url'       => wp_nonce_url( admin_url( 'admin.php?page=myexpress_spedizioni&MYE_spedizione=crea&id_ordine=' . $the_order->id ), 'woocommerce-mark-order-status' ),
				'name'      => __( 'Spedizione', 'woocommerce' ),
				'action'    => "view spedizione", // setting "view" for proper button CSS
				);
		  }
		  return $actions;
		}		
		add_action( 'admin_head', 'add_spedizione_order_actions_button_css' );
		function add_spedizione_order_actions_button_css() {	
			echo '<style>.view.spedizione:after { content: "\f0d1" !important; font-family:FontAwesome !important; color:#FFF !important; } .view.spedizione:hover:after { color:#000 !important; } .view.spedizione{ background-color:#327CCB; }</style>';
		}                         
	}

	protected function addSettingsSubMenuPageToSettingsMenu() {
	  $this->requireExtraPluginFiles();
	  $displayName = $this->getPluginDisplayName();
	  add_options_page($displayName,$displayName,'manage_options',$this->getSettingsSlug(),array(&$this, 'settingsPage'));
	}

	protected function prefixTableName($name) {
	  global $wpdb;
	  return $wpdb->prefix . strtolower($this->prefix($name));
	}

	public function getAjaxUrl($actionName) {
	  return admin_url('admin-ajax.php') . '?action=' . $actionName;
	}

}
