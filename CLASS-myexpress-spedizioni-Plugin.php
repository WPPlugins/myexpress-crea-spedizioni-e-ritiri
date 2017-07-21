<?php

include_once('CLASS-myexpress-spedizioni-LifeCycle.php');

class CLASS_myexpress_spedizioni_Plugin extends CLASS_myexpress_spedizioni_LifeCycle {

	public function getPluginDisplayName() {
		return 'Myexpress Crea spedizioni e ritiri';
	}

	protected function getMainPluginFileName() {
		return 'myexpress-crea-spedizioni-e-ritiri.php';
	}

	protected function installDatabaseTables() {
	}

	protected function unInstallDatabaseTables() {
	}

	public function addActionsAndFilters() {
		add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));
		function load_custom_wp_admin_style($hook) {
			wp_enqueue_style( 'custom_wp_admin_css', plugins_url('css/myexpress.min.css', __FILE__) );
			wp_enqueue_style( 'font-awesonme', plugins_url('css/font-awesome.min.css', __FILE__) );				  
			wp_enqueue_script('bootstrap-validator', plugins_url('/js/bootstrap-validator.js', __FILE__));
			wp_enqueue_script('custom', plugins_url('/js/custom.min.js', __FILE__));
		}
	  add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

		add_action( 'wp_ajax_MYEP-check-cap', 'MyexpressSpedizioni_check_cap' );
		add_action( 'wp_ajax_MYEP-check-accessori-possibili', 'MyexpressSpedizioni_check_accessori_possibili' );
		add_action( 'wp_ajax_MYEP-calcola-spedizione', 'MyexpressSpedizioni_calcola_spedizione' );
		add_action( 'wp_ajax_MYEP-aggiungi-a-carrello', 'MyexpressSpedizioni_aggiungi_a_carrello' );
		add_action( 'wp_ajax_MYEP-dettagli-spedizione', 'MyexpressSpedizioni_dettagli_spedizione' );
		add_action( 'wp_ajax_MYEP-conferma-carrello', 'MyexpressSpedizioni_conferma_carrello' );
		add_action( 'wp_ajax_MYEP-tracking-spedizione', 'MyexpressSpedizioni_tracking_spedizione' );
	}

  public function deactivate() {
		global $wpdb;
		$prefisso = $this->getPrefix();
		$wpdb->query('DELETE FROM '.$wpdb->options.' WHERE option_name LIKE "'.$prefisso.'%"');  	
  }

}
