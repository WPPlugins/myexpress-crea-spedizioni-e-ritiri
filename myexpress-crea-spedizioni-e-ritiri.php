<?php
/*
   Plugin Name: MyEXPRESS Crea spedizioni e ritiri
   Plugin URI: http://wordpress.org/extend/plugins/myexpress-crea-spedizioni-e-ritiri/
   Version: 1.0.1
   Author: MyEXPRESS.it
   Description: Integra e velocizza la creazione delle spedizioni dai tuoi ordini WooCommerce. Crea e stampa i documenti e richiedi il ritiro. Il plugin è integrato con WooCommerce ma può essere usato liberamente come semplice plugin WordPress.
   Text Domain: MyEXPRESS crea spedizioni woocommerce
   License: GPLv3
   Tested up to: 4.7
   Requires at least: 3.5   
*/

add_action('init', 'MyExpressSpedizioniStartSession', 1);
function MyExpressSpedizioniStartSession() {
	if (!session_id()) { session_start(); }	
}

$MyexpressSpedizioni_minimalRequiredPhpVersion = '5.0';

function MyexpressSpedizioni_noticePhpVersionWrong() {
  global $MyexpressSpedizioni_minimalRequiredPhpVersion;
  echo '<div class="updated fade">' . __('Error: plugin "MyEXPRESS.it - Crea Spedizioni WooCommerce" richiede una versione di PHP più recente per funzionare.',  'myexpress_spedizioni').'<br/>' . __('Versione minima di PHP: ', 'myexpress_spedizioni') . '<strong>' . $MyexpressSpedizioni_minimalRequiredPhpVersion . '</strong>' . '<br/>' . __('La tua versione di PHP: ', 'myexpress_spedizioni') . '<strong>' . phpversion() . '</strong>' . '</div>';
}

function MyexpressSpedizioni_PhpVersionCheck() {
  global $MyexpressSpedizioni_minimalRequiredPhpVersion;
  if (version_compare(phpversion(), $MyexpressSpedizioni_minimalRequiredPhpVersion) < 0) {
    add_action('admin_notices', 'MyexpressSpedizioni_noticePhpVersionWrong');
    return false;
  }
  return true;
}

if (MyexpressSpedizioni_PhpVersionCheck()) {
  include_once('myexpress-crea-spedizioni-e-ritiri-init.php');
  MyexpressSpedizioni_init(__FILE__);
}

function MyexpressSpedizioni_check_cap() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
	$POST = array('ACTION' => 'CHECK-CAP', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN'], 'CAP' => $_POST['CAP']); 			
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'CHECK-CAP');									
	echo $RETURN['RICHIESTA'];	      
  wp_die();	
}

function MyexpressSpedizioni_check_accessori_possibili() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
	$POST = array('ACTION' => 'ACCESSORI_POSSIBILI', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN'], 'MITTENTE_NAZIONE' => $_POST['MITTENTE_NAZIONE'], 'DESTINATARIO_NAZIONE' => $_POST['DESTINATARIO_NAZIONE'], 'MITTENTE_CITTA' => $_POST['MITTENTE_CITTA'], 'DESTINATARIO_CITTA' => $_POST['DESTINATARIO_CITTA']); 			
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'ACCESSORI_POSSIBILI');									
	echo implode($RETURN);	      
  wp_die();	
}

function MyexpressSpedizioni_calcola_spedizione() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
  $POST = array('ACTION' => 'CALCOLA_SPEDIZIONE', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN']);    
  foreach ($_POST as $key => $value) {
    if (strpos($key,"MYEP") !== false)	{
    	$nome_key = str_replace('MYEP-','',$key);
    	$POST[$nome_key] = $value;
    }
  }
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'CALCOLA_SPEDIZIONE');									
	echo implode('#',$RETURN);	      
  wp_die();	
}

function MyexpressSpedizioni_aggiungi_a_carrello() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
  $POST = array('ACTION' => 'AGGIUNGI_A_CARRELLO', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN']);    
  foreach ($_POST as $key => $value) {
    if (strpos($key,"MYEP") !== false)	{
    	$nome_key = str_replace('MYEP-','',$key);
    	$POST[$nome_key] = $value;
    }
  }
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'AGGIUNGI_A_CARRELLO');									
	echo $RETURN;	      
  wp_die();	
}

function MyexpressSpedizioni_dettagli_spedizione() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
  $POST = array('ACTION' => 'GET_DETTAGLI_SPEDIZIONE', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN'], 'ID_SPEDIZIONE' => $_POST['ID_SPEDIZIONE']);  
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'GET_DETTAGLI_SPEDIZIONE');									
	echo $RETURN['DETTAGLI_SPEDIZIONE'];	      
  wp_die();	
}

function MyexpressSpedizioni_conferma_carrello() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
  $POST = array('ACTION' => 'CONFERMA_CARRELLO', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN']);    
  $indice = 1;
  foreach ($_POST['MYEP-date-ritiro'] as $key => $value) {
    $POST['date-ritiro_'.$indice] = $value;
    ++$indice;
  }    
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'CONFERMA_CARRELLO');									
	echo $RETURN;
  wp_die();  	
}

function MyexpressSpedizioni_tracking_spedizione() {	
  $url = "https://api.myexpress.it/wordpress/v1.0/curl";			
  $POST = array('ACTION' => 'GET_TRACKING_SPEDIZIONE', 'TOKEN' => $_COOKIE['MyexpressSpedizioni_TOKEN'], 'ID_SPEDIZIONE' => $_POST['ID_SPEDIZIONE']);  
	$RETURN = CLASS_myexpress_spedizioni_Routine::httpPOST($POST,$url,'GET_TRACKING_SPEDIZIONE');									
	echo $RETURN['TRACKING_SPEDIZIONE'];
  wp_die();	
}