<?php

function MyexpressSpedizioni_init($file) {

	require_once('CLASS-myexpress-spedizioni-Plugin.php');    
	$aPlugin = new CLASS_myexpress_spedizioni_Plugin();  

	if (!$aPlugin->isInstalled()) {
		$aPlugin->install();
	}

	$aPlugin->addActionsAndFilters();

	if (!$file) {
		$file = __FILE__;
	}

	register_activation_hook($file, array(&$aPlugin, 'activate'));

	register_deactivation_hook($file, array(&$aPlugin, 'deactivate'));

	add_action( 'admin_menu', 'myexpress_spedizioni_creazione_menu' ); 
	function myexpress_spedizioni_creazione_menu() {
		$pluginDir = dirname(plugin_basename(__FILE__));
		add_menu_page(
			'MyEXPRESS.it',
			'MyEXPRESS.it',
			'manage_options',
			'myexpress_spedizioni',
			'MyexpressSpedizioni_html_page_crea_front_page',
			plugins_url( $pluginDir . '/imgs/myexpress-icon.png' ),
			55
		);		    
		add_submenu_page('myexpress_spedizioni', 'Crea', 'Crea', 'manage_options', 'myexpress_spedizioni' );
		add_submenu_page('myexpress_spedizioni', 'Carrello', 'Carrello', 'manage_options', 'myexpress_spedizioni-carrello', 'MyexpressSpedizioni_html_page_carrello' );		    		    
		add_submenu_page('myexpress_spedizioni', 'Storico', 'Storico', 'manage_options', 'myexpress_spedizioni-storico' , 'MyexpressSpedizioni_html_page_storico' );		    		    
		add_submenu_page('myexpress_spedizioni', 'Assistenza', 'Assistenza', 'manage_options', 'myexpress_spedizioni-assistenza' , 'MyexpressSpedizioni_html_page_assistenza' );		    		    
		add_submenu_page('myexpress_spedizioni', 'Guida', 'Guida', 'manage_options', 'myexpress_spedizioni-guida' , 'MyexpressSpedizioni_html_page_guida' );		    		    
		add_submenu_page('myexpress_spedizioni', 'Impostazioni', 'Impostazioni', 'manage_options', 'myexpress_spedizioni-impostazioni' , 'MyexpressSpedizioni_html_page_impostazioni' );		    		          
  }  

	require_once('myexpress-crea-spedizioni-e-ritiri-html.php');     

}
