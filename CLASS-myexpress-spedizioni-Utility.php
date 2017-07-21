<?php

include_once('CLASS-myexpress-spedizioni-Routine.php');

class CLASS_myexpress_spedizioni_Utility extends CLASS_myexpress_spedizioni_Routine {

	public static function getPrefix() {
		return 'MyexpressSpedizioni';
	}

	public static function prefix($name) {
		$optionNamePrefix = self::getPrefix();
		if (strpos($name, $optionNamePrefix) === 0) {
			return $name;
		}
		return $optionNamePrefix . '_' . $name;
	}

	public function &unPrefix($name) {
		$optionNamePrefix = self::getPrefix();
		if (strpos($name, $optionNamePrefix) === 0) {
			return substr($name, strlen($optionNamePrefix));
		}
		return $name;
	}

	public function deleteOption($optionName) {
		$prefixedOptionName = $this->prefix($optionName);
		return delete_option($prefixedOptionName);
	}

	public function getOption($optionName) {
		$prefixedOptionName = $this->prefix($optionName);
		return get_option($prefixedOptionName);
	}

	public function updateOption($optionName, $value) {
		$prefixedOptionName = $this->prefix($optionName);
		return update_option(sanitize_text_field($prefixedOptionName), sanitize_text_field($value));
	}

	protected function getMySqlVersion() {
		global $wpdb;
		$rows = $wpdb->get_results('select version() as mysqlversion');
		if (!empty($rows)) {
			return $rows[0]->mysqlversion;
		}
		return false;
	}

	public static function msg_errore() {
		echo 'Si è verificato un errore, riprova più tardi o contatta l\'assistenza all\'email assistenza@myexpress.it';	
	}

	public static function option_nazioni($value = null) { 
		$STRINGA = '
		<option value="IT">Italia</option>
		<option value="AT">Austria</option>
		<option value="BE">Belgio</option>
		<option value="BG">Bulgaria</option>
		<option value="CY">Cipro</option>
		<option value="HR">Croazia</option>
		<option value="DK">Danimarca</option>
		<option value="EE">Estonia</option>
		<option value="FI">Finlandia</option>
		<option value="FR">Francia</option>
		<option value="DE">Germania</option>
		<option value="EL">Grecia</option>
		<option value="IE">Irlanda</option>
		<option value="LV">Lettonia</option>
		<option value="LT">Lituania</option>
		<option value="LU">Lussemburgo</option>
		<option value="MT">Malta</option>
		<option value="NL">Olanda</option>
		<option value="PL">Polonia</option>
		<option value="PT">Portogallo</option>
		<option value="UK">Regno Unito</option>
		<option value="CZ">Repubblica Ceca</option>
		<option value="RO">Romania</option>
		<option value="SK">Slovacchia</option>
		<option value="SI">Slovenia</option>
		<option value="ES">Spagna</option>
		<option value="SE">Svezia</option>
		<option value="HU">Ungheria</option> 
		';
		if (!empty($value)) {
			$STRINGA = str_replace('value="' . strtoupper($value) . '"', 'value="' . $value . '" selected="selected"', $STRINGA);
		}
		echo $STRINGA;
	}    

	public static function option_province($value = null) {
		$STRINGA = '
		<option value="">Seleziona</option>
		<option value="AG">Agrigento (AG)</option>
		<option value="AL">Alessandria (AL)</option>
		<option value="AN">Ancona (AN)</option>
		<option value="AI">Aosta (AI)</option>
		<option value="AQ">Aquila (AQ)</option>
		<option value="AR">Arezzo (AR)</option>
		<option value="AP">Ascoli Piceno (AP)</option>
		<option value="AT">Asti (AT)</option>
		<option value="AV">Avellino (AV)</option>
		<option value="BA">Bari (BA)</option>
		<option value="BT">Barletta-Andria-Trani (BT)</option>
		<option value="BL">Belluno (BL)</option>
		<option value="BN">Benevento (BN)</option>
		<option value="BG">Bergamo (BG)</option>
		<option value="BI">Biella (BI)</option>
		<option value="BO">Bologna (BO)</option>
		<option value="BZ">Bolzano (BZ)</option>
		<option value="BS">Brescia (BS)</option>
		<option value="BR">Brindisi (BR)</option>
		<option value="CA">Cagliari (CA)</option>
		<option value="CL">Caltanissetta (CL)</option>
		<option value="CB">Campobasso (CB)</option>
		<option value="CI">Carbonia Iglesias (CI)</option>
		<option value="CE">Caserta (CE)</option>
		<option value="CT">Catania (CT)</option>
		<option value="CZ">Catanzaro (CZ)</option>
		<option value="CH">Chieti (CH)</option>
		<option value="CO">Como (CO)</option>
		<option value="CS">Cosenza (CS)</option>
		<option value="CR">Cremona (CR)</option>
		<option value="KR">Crotone (KR)</option>
		<option value="CN">Cuneo (CN)</option>
		<option value="EN">Enna (EN)</option>
		<option value="FM">Fermo (FM)</option>
		<option value="FE">Ferrara (FE)</option>
		<option value="FI">Firenze (FI)</option>
		<option value="FG">Foggia (FG)</option>
		<option value="FC">Forli Cesena (FC)</option>
		<option value="FR">Frosinone (FR)</option>
		<option value="GE">Genova (GE)</option>
		<option value="GO">Gorizia (GO)</option>
		<option value="GR">Grosseto (GR)</option>
		<option value="IM">Imperia (IM)</option>
		<option value="IS">Isernia (IS)</option>
		<option value="LT">Latina (LT)</option>
		<option value="LE">Lecce (LE)</option>
		<option value="LC">Lecco (LC)</option>
		<option value="LI">Livorno (LI)</option>
		<option value="LO">Lodi (LO)</option>
		<option value="LU">Lucca (LU)</option>
		<option value="MC">Macerata (MC)</option>
		<option value="MN">Mantova (MN)</option>
		<option value="MS">Massa Carrara (MS)</option>
		<option value="MT">Matera (MT)</option>
		<option value="VS">Medio Campidano (VS)</option>
		<option value="ME">Messina (ME)</option>
		<option value="MI">Milano (MI)</option>
		<option value="MO">Modena (MO)</option>
		<option value="MB">Monza Brianza (MB)</option>
		<option value="NA">Napoli (NA)</option>
		<option value="NO">Novara (NO)</option>
		<option value="NU">Nuoro (NU)</option>
		<option value="OG">Ogliastra (OG)</option>
		<option value="OT">Olbia Tempio (OT)</option>
		<option value="OR">Oristano (OR)</option>
		<option value="PD">Padova (PD)</option>
		<option value="PA">Palermo (PA)</option>
		<option value="PR">Parma (PR)</option>
		<option value="PV">Pavia (PV)</option>
		<option value="PG">Perugia (PG)</option>
		<option value="PU">Pesaro Urbino (PU)</option>
		<option value="PE">Pescara (PE)</option>
		<option value="PC">Piacenza (PC)</option>
		<option value="PI">Pisa (PI)</option>
		<option value="PT">Pistoia (PT)</option>
		<option value="PN">Pordenone (PN)</option>
		<option value="PZ">Potenza (PZ)</option>
		<option value="PO">Prato (PO)</option>
		<option value="RG">Ragusa (RG)</option>
		<option value="RA">Ravenna (RA)</option>
		<option value="RC">Reggio Calabria (RC)</option>
		<option value="RE">Reggio Emilia (RE)</option>
		<option value="RI">Rieti (RI)</option>
		<option value="RN">Rimini (RN)</option>
		<option value="RM">Roma (RM)</option>
		<option value="RO">Rovigo (RO)</option>
		<option value="SA">Salerno (SA)</option>
		<option value="SS">Sassari (SS)</option>
		<option value="SV">Savona (SV)</option>
		<option value="SI">Siena (SI)</option>
		<option value="SR">Siracusa (SR)</option>
		<option value="SO">Sondrio (SO)</option>
		<option value="SP">La Spezia (SP)</option>
		<option value="TA">Taranto (TA)</option>
		<option value="TE">Teramo (TE)</option>
		<option value="TR">Terni (TR)</option>
		<option value="TO">Torino (TO)</option>
		<option value="TP">Trapani (TP)</option>
		<option value="TN">Trento (TN)</option>
		<option value="TV">Treviso (TV)</option>
		<option value="TS">Trieste (TS)</option>
		<option value="UD">Udine (UD)</option>
		<option value="VA">Varese (VA)</option>
		<option value="VE">Venezia (VE)</option>
		<option value="VB">Verbano Cusio Ossola (VB)</option>
		<option value="VC">Vercelli (VC)</option>
		<option value="VR">Verona (VR)</option>
		<option value="VV">Vibo Valentia (VV)</option>
		<option value="VI">Vicenza (VI)</option>
		<option value="VT">Viterbo (VT)</option>
		';
		if (!empty($value)) {
			$selezionata = strtoupper(trim($value)); 
			$STRINGA = str_replace('value="' . strtoupper($selezionata) . '"', 'value="' . $selezionata . '" selected="selected"', $STRINGA);
		}
		echo $STRINGA;
	}        

}
