<?php 

  function MyexpressSpedizioni_settingsPage() { 				
	?>		
	
	    <?php 

		    require_once('CLASS-myexpress-spedizioni-Plugin.php');
		    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	      
		    
	      /*VARIABILI BASE*/
	      if (!empty($_GET['page'])) { $NAV = $_GET['page'] ; }
	      else { $NAV = ''; }	      
	      $STATO_LOGIN = '';
	      /*FINE VARIABILI BASE*/
	      
	    ?>

			<?php /* LOGIN */	?>			
			<?php if (!empty($_POST['do_login'])) { ?>
			  <?php $STATO_LOGIN = $CLASS_MYE->do_login($_POST); ?>	
			<?php } ?>

			<?php /* LOGIN FOR REFRESH SESSIONE */	?>			
			<?php if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN']) AND empty($_SESSION['MyexpressSpedizioni']['MyEXPRESS_TOKEN']) AND empty($STATO_LOGIN)) { ?>
			  <?php $STATO_LOGIN = $CLASS_MYE->check_token(); ?>
			<?php } ?>								

			<?php /* LOGOUT */	?>
			<?php if (!empty($_GET['nav']) AND ($_GET['nav'] == 'logout') AND empty($STATO_LOGIN)) { ?>
			  <?php echo $CLASS_MYE->do_logout(); ?>	
			<?php } ?>
			
      <div class="wrap MYEP-container MYEP-bg-white">							  	
        <div class="MYEP-row MYEP-p-y-1 MYEP-bg-info">
        	<div class="MYEP-col-xs-12 MYEP-text-xs-center">
        		<img src="<?php echo plugins_url('/imgs/myexpress.svg',__FILE__); ?>" width="250" />
        	</div>        	
        </div>      		
        <div class="MYEP-container">
			  	<?php 
			  	  if (empty($_COOKIE['MyexpressSpedizioni_TOKEN']) AND empty($STATO_LOGIN) AND ($NAV != 'myexpress_spedizioni-guida')) {
			  	    MyexpressSpedizioni_html_do_login();
			  	  } else { 
			  	?>        	
					<div class="MYEP-row">				  	
						<div class="MYEP-col-xs-12 MYEP-m-b-2" style="overflow-x:auto;overflow-y:hidden;">
							<ul class="MYEP-nav MYEP-nav-tabs MYEP-m-t-1" style="white-space:nowrap;">
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-p-y-1 <?php if ($NAV == 'myexpress_spedizioni' || $NAV == '') { echo 'MYEP-btn-info MYEP-text-white'; } else { echo 'MYEP-btn-link'; } ?>" href='<?php echo admin_url('admin.php?page=myexpress_spedizioni'); ?>'>Crea</a></li>								
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-p-y-1 <?php if ($NAV == 'myexpress_spedizioni-carrello') { echo 'MYEP-btn-info MYEP-text-white'; } else { echo 'MYEP-btn-link'; } ?>" href='<?php echo admin_url('admin.php?page=myexpress_spedizioni-carrello'); ?>'>Carrello</a></li>
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-p-y-1 <?php if ($NAV == 'myexpress_spedizioni-storico') { echo 'MYEP-btn-info MYEP-text-white'; } else { echo 'MYEP-btn-link'; } ?>"  href='<?php echo admin_url('admin.php?page=myexpress_spedizioni-storico'); ?>'>Storico</a></li>
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-p-y-1 <?php if ($NAV == 'myexpress_spedizioni-assistenza') { echo 'MYEP-btn-info MYEP-text-white'; } else { echo 'MYEP-btn-link'; } ?>"  href='<?php echo admin_url('admin.php?page=myexpress_spedizioni-assistenza'); ?>'>Assistenza</a></li>									  
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-p-y-1 <?php if ($NAV == 'myexpress_spedizioni-guida') { echo 'MYEP-btn-info MYEP-text-white'; } else { echo 'MYEP-btn-link'; } ?>"  href='<?php echo admin_url('admin.php?page=myexpress_spedizioni-guida'); ?>'>Guida</a></li>
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-p-y-1 <?php if ($NAV == 'myexpress_spedizioni-impostazioni') { echo 'MYEP-btn-info MYEP-text-white'; } else { echo 'MYEP-btn-link'; } ?>"  href='<?php echo admin_url('admin.php?page=myexpress_spedizioni-impostazioni'); ?>'>Impostazioni</a></li>									  									  
							  <li class="MYEP-nav-item MYEP-d-inline-block MYEP-pull-xs-none MYEP-p-y-0"><a class="MYEP-nav-link MYEP-btn-link MYEP-p-y-1" href='<?php echo admin_url('admin.php?page=myexpress_spedizioni&nav=logout'); ?>'>Logout</a></li>
							</ul>																			
						</div>				  					  					  											  	
			  	</div>									  	        	
          <?php } ?>
		  	</div>
			</div>						  
			
			<?php
  
      return $STATO_LOGIN;
  
  }


	function MyexpressSpedizioni_html_do_login() {
		
	?>
					  	<div class="MYEP-row MYEP-flex-items-xs-top MYEP-p-y-2 ">
					  		<div class="MYEP-col-xs-12 MYEP-col-md-6">
					  			<div class="MYEP-row MYEP-flex-items-xs-center">
					  				<div class="MYEP-col-xs-12 MYEP-col-lg-8">
											<div class="MYEP-card MYEP-p-a-0">
												<div class="MYEP-card-header MYEP-bg-success">
												  <h4 class="MYEP-card-title">
												    Registrati!
												  </h4>		
												</div>	
											  <div class="MYEP-card-block">
											    <p class="MYEP-card-text MYEP-m-y-0">
											    	Se non sei ancora iscritto fallo subito gratuitamente e approfitta della comodità di spedire direttemanete dal tuo ambiente Wordpress!</p>
											  </div>
											  <ul class="MYEP-list-group MYEP-list-group-flush">
											    <li class="MYEP-list-group-item"><img src="<?php echo plugins_url('/imgs/check.svg',__FILE__); ?>" width="15" />&nbsp;Creazione documenti di trasporto</li>
											    <li class="MYEP-list-group-item"><img src="<?php echo plugins_url('/imgs/check.svg',__FILE__); ?>" width="15" />&nbsp;Richiesta ritiro</li>
											    <li class="MYEP-list-group-item"><img src="<?php echo plugins_url('/imgs/check.svg',__FILE__); ?>" width="15" />&nbsp;Storico spedizioni</li>
											    <li class="MYEP-list-group-item"><img src="<?php echo plugins_url('/imgs/check.svg',__FILE__); ?>" width="15" />&nbsp;Resi spedizione</li>
											  </ul>
											  <div class="MYEP-card-block">
													<a class="MYEP-btn MYEP-btn-success MYEP-btn-block" href="https://myexpress.it/registrazione" target="_blank">
														REGISTRATI
													</a>				  							
													<div class="MYEP-container-fluid MYEP-m-t-1">
														<small>											  
												  		<a href="https://myexpress.it/tariffe-spedizioni-easy" target="blank">
												  			Tariffe
												  		</a>
												  		-
												  		<a href="https://myexpress.it/zone-servite" target="blank">
												  			Zone servite
												  		</a>											  		
												  		-
												  		<a href="https://myexpress.it/materiale-proibito" target="blank">
												  			Materiale proibito
												  		</a>  		
												  	</small>
													</div>		
											  </div>
											</div>
					  				</div>
					  			</div>
					  		</div>				  		
					  		<div class="MYEP-col-xs-12 MYEP-col-md-6">
					  			<div class="MYEP-row MYEP-flex-items-xs-center">
					  				<div class="MYEP-col-xs-12 MYEP-col-lg-8">
							  			<div class="MYEP-card MYEP-p-a-0">
							  				<div class="MYEP-card-header MYEP-bg-inverse">
							  					LOGIN
							  				</div>
							  				<div class="MYEP-card-block">
									  			<form action="" method="POST" data-toggle="validator">
									  			  <input type="hidden" name="do_login" value="do_login" />
									  			  <?php if (!empty($_POST['do_login'])) { ?>
										  			  <?php if (empty($STATO_LOGIN)) { ?>
											  			  <div class="MYEP-alert MYEP-alert-danger">
											  			  	I dati inseriti non sono corretti.
											  			  </div>
										  			  <?php } ?>									  			  
									  			  <?php } ?>
									  				<div class="MYEP-form-group">
									  					<label class="MYEP-label">
									  						Email
									  					</label>
									  					<input class="MYEP-form-control" type="email" name="email" maxlength="255" required />
									  					<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
									  				</div>
									  				<div class="MYEP-form-group">
									  					<label class="MYEP-label">
									  						Password
									  					</label>
									  					<input class="MYEP-form-control MYEP-w-100" type="password" name="password" maxlength="255" required />
									  					<div class="MYEP-help-block MYEP-with-errors"></div>
									  				</div>				  				
									  				<div class="MYEP-form-group">
															<button class="MYEP-btn MYEP-btn-block">
																ACCEDI
															</button>
									  				</div>				  				
									  			</form>				  							  					
							  				</div>
							  			</div>				  					
					  				</div>				  				
					  			</div>
					  		</div>					  		
					  	</div>				  		
	<?php	
	}
	
  
  function MyexpressSpedizioni_html_page_carrello() {

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	      
  	
  	MyexpressSpedizioni_settingsPage();
  	
  	if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN'])) {  	  		
  	
  	  $CLASS_MYE->check_token();
  		  		  	
  	  if (!empty($_POST['MYE_spedizione']) && ($_POST['MYE_spedizione'] == 'elimina')) {
  	  	$RETURN = $CLASS_MYE->do_elimina_spedizione($_POST['id_spedizione']);
  	  	if (!empty($RETURN['RICHIESTA'])) {
  	  	  $STATO_ELIMINAZIONE = $RETURN['RICHIESTA']; 	
  	  	} else {
  	  		$STATO_ELIMINAZIONE = '';
  	  	}  	  	
  	  } 
  	  
  	  $CLASS_MYE->do_check_quantita_carrello();
  	
  ?>					
  					<div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
  						<div class="MYEP-row MYEP-flex-items-xs-center">
  							<div id="JS-MYEP-DIV-OK-CARRELLO" class="MYEP-col-xs-12 MYEP-p-t-2 MYEP-p-b-3" style="display:none;">
									<div class="MYEP-container-fluid">
										<h2 class="MYEP-text-xs-center MYEP-text-success">Spedizione confermate!</h2>
										<div class="MYEP-text-xs-center">
											<p>Attendi qualche minuto mentre i sistemi creano i documenti di trasporto.</p>
											<a href="<?php echo admin_url('admin.php?page=myexpress_spedizioni-storico'); ?>">Vai allo storico spedizioni</a>
										</div>														
									</div>		
  							</div>
                <div id="JS-MYEP-MAIN-DIV-CONFERMA-CARRELLO" class="MYEP-col-xs-12">
									<div class="MYEP-container-fluid">
										<div class="MYEP-row">
											<div class="MYEP-col-xs-12 MYEP-col-md-9">
												
												<?php if ($_SESSION['MyexpressSpedizioni']['RCST'] > 0) { ?>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12"><a class="MYEP-btn MYEP-btn-secondary MYEP-m-b-1" href="<?php echo admin_url('admin.php?page=myexpress_spedizioni&MYE_spedizione=crea'); ?>">Crea spedizione</a>
														<a class="MYEP-btn MYEP-btn-secondary MYEP-m-b-1" href="<?php admin_url('edit.php?post_type=shop_order'); ?>">Crea spedizione da Woocommerce</a></div>
													</div>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12">
															<?php if (!empty($_POST['MYE_spedizione'])) { ?>
															  <?php if ($STATO_ELIMINAZIONE) { ?>
															  	<div class="MYEP-alert MYEP-alert-success">
															  		Spedizione eliminata correttamente
															  	</div>
															  <?php } else { ?>
															  	<div class="MYEP-alert MYEP-alert-warning">
															  		<?php $CLASS_MYE->msg_errore(); ?>
															  	</div>															  
															  <?php } ?>
															<?php } ?>
														</div>
													</div>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12">
															<div class="MYEP-table-responsive">
																<table class="MYEP-table">
																	<form id="JS-MYEP-form-conferma-carrello" action="" method="POST" data-target="validator">
																		<tr>
																			<th class="MYEP-text-xs-left">#</th>
																			<th class="MYEP-text-xs-left">Destinatario</th>
																			<th class="MYEP-text-xs-left">Tipo Spedizione</th>
																			<th class="MYEP-text-xs-left">Imponibile</th>
																			<th class="MYEP-text-xs-left">IVA</th>
																			<th class="MYEP-text-xs-left">Data ritiro</th>
																			<th class="MYEP-text-xs-left"></th>
																		</tr>																			
																		<?php
																																			    																																		   
																		   $SPEDIZIONI_RAW = $CLASS_MYE->do_get_carrello();
																		   $OBJ_SPEDIZIONI = json_decode($SPEDIZIONI_RAW['SPEDIZIONI'],true);

																		   $indice = 1;
																		   $totale_imponibile = 0;
																		   $totale_iva = 0;
																		   
																		   foreach ($OBJ_SPEDIZIONI as $SPEDIZIONE_CARRELLO) {
																		   	 $DATE_RITIRO = $CLASS_MYE->get_date_ritiro($SPEDIZIONE_CARRELLO['ID_SPEDIZIONE']);
																		   	 echo '																	   	 
															   	        <tr>
																			   	   <td>'.$indice.'</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['NOMINATIVO_DESTINATARIO'].'</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['TIPO_SPEDIZIONE'].'</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['TOTALE_IMPONIBILE_SPEDIZIONE'].'€</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['TOTALE_IVA_SPEDIZIONE'].'€</td>
																			   	   <td>
																			   	     <select name="MYEP-date-ritiro[]">
																			   	       '.$DATE_RITIRO['DATE_RITIRO'].'
																			   	     </select>
																			   	   </td>
																			   	   <td>
																			   	   	 <small>
																				   	     <button class="JS-MYEP-button-dettagli-spedizione MYEP-cm-button-dettagli-spedizione MYEP-btn-sm MYEP-btn-link" type="button" value="'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" style="cursor:pointer;">Dettagli</button>
																			   	     </small>
																			   	   </td>	
																			   	 </tr>
																			   	 <tr>																   	        
															   	           <td id="JS-DIV-DETTAGLI-SPEDIZIONE-'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" class="MYEP-p-y-0 MYEP-bg-faded" colspan="7" style="display:none;">
															   	             <div id="JS-DETTAGLI-SPEDIZIONE-'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'"></div>
															   	             <div class="MYEP-text-xs-right MYEP-p-b-3">
																				   	     <form class="MYEP-m-y-0 MYEP-d-inline-block" action="admin.php" method="GET">
																				   	       <input type="hidden" name="page" value="myexpress_spedizioni-carrello" />
																				   	       <input type="hidden" name="MYE_spedizione" value="elimina" />
																				   	       <input type="hidden" name="id_spedizione" value="'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" />
																				   	     	 <button class="MYEP-btn-sm MYEP-btn-danger" type="submit" style="cursor:pointer;">Elimina</button>
																				   	     </form>																   	             
																				   	     <form class="MYEP-m-y-0 MYEP-d-inline-block" action="admin.php" method="GET">
																				   	       <input type="hidden" name="page" value="myexpress_spedizioni" />
																				   	       <input type="hidden" name="MYE_spedizione" value="modifica" />
																				   	       <input type="hidden" name="id_spedizione" value="'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" />
																				   	     	 <button class="MYEP-btn-sm" type="submit" style="cursor:pointer;">Modifica</button>
																				   	     </form>																   	         
															   	             </div>
															   	           </td>
															   	         </tr>
																		   	 ';		
																		   	 $totale_imponibile += $SPEDIZIONE_CARRELLO['TOTALE_IMPONIBILE_SPEDIZIONE'];
																		   	 $totale_iva        += $SPEDIZIONE_CARRELLO['TOTALE_IVA_SPEDIZIONE'];					
																		   	 ++$indice;																			   	 
																		   }										
																		?>														
																		<?php if ($indice > 2) { ?>			
																		<tr>
																			<th class="MYEP-text-xs-right" colspan="3">TOTALE</th>
																			<th class="MYEP-text-xs-left"><?php echo $totale_imponibile; ?>€</th>
																			<th class="MYEP-text-xs-left"><?php echo $totale_iva; ?>€</th>
																			<th></th>
																		</tr>												
																		<?php } ?>																				
																	</form>
																</table>
															</div>															
														</div>
													</div>													
												<?php } else { ?>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12"><a class="MYEP-btn MYEP-btn-secondary MYEP-m-b-1" href="<?php echo admin_url('admin.php?page=myexpress_spedizioni&MYE_spedizione=crea'); ?>">Crea spedizione</a>
														<a class="MYEP-btn MYEP-btn-secondary MYEP-m-b-1" href="<?php echo admin_url('edit.php?post_type=shop_order'); ?>">Crea spedizione da Woocommerce</a></div>
													</div>									
													<figure>
														<img class="MYEP-w-100" src="<?php echo plugins_url('/imgs/plugin-woocommerce-screenshot-crea-spedizione.png',__FILE__); ?>" />
													</figure>	
												<?php } ?>
												
											</div>
											<div class="MYEP-col-xs-12 MYEP-col-md-3 MYEP-text-xs-center MYEP-p-b-2">
												<div class="MYEP-container-fluid">
													<div class="MYEP-row">														
														<?php if ($_SESSION['MyexpressSpedizioni']['FATTURAZIONE'] == 2) { ?>
															<div class="MYEP-col-xs-12 MYEP-bg-faded MYEP-p-y-1">
															  <div class="MYEP-text-xs-left">
															  	<div><b>Prossima fattura</b></div>
															  	<div>Effettuate: <?php echo $_SESSION['MyexpressSpedizioni']['RDFST']; ?></div>
															  	<div>Spesa: <?php echo $_SESSION['MyexpressSpedizioni']['RDFCT']; ?>€</div>
															  </div>
															</div>  
															<?php if ($_SESSION['MyexpressSpedizioni']['RCCT'] > 0) { ?>
															<div class="MYEP-col-xs-12 MYEP-bg-info MYEP-p-y-1">
															  <div class="MYEP-text-xs-center">
															  	<div class="MYEP-lead MYEP-m-b-2"><b>TOTALE</b></div>
															  	<div><span class="MYEP-display-3"><?php echo $_SESSION['MyexpressSpedizioni']['RCCT']; ?></span>€</div>
															  </div>											
															</div>															
															<div class="MYEP-col-xs-12 MYEP-p-x-0">
																<p class="MYEP-text-muted">
																	<small>Continuando accetti le Condizioni di Trasporto e le Condizioni delle Privacy presenti sul sito internet <a href="https://myexpress.it" target="_blank">MyEXPRESS.it</a></small>
																</p>																
									              <button id="JS-carrello-conferma-spedizioni" class="MYEP-btn MYEP-btn-info MYEP-w-100 MYEP-text-white" type="button">CONFERMA</button>
															</div>	
															<?php } ?>
														<?php } else { ?>
															<div class="MYEP-col-xs-12 MYEP-bg-faded MYEP-p-y-1">
																<p><b>Crediti disponibili:</b></p>
																<h1 class="MYEP-p-t-0"><?php echo $_SESSION['MyexpressSpedizioni']['CREDITI']; ?>€</h1>
															</div>
															<div class="MYEP-col-xs-12 MYEP-bg-info MYEP-p-y-1">
															  <div class="MYEP-text-xs-center">
															  	<div class="MYEP-lead MYEP-m-b-2"><b>TOTALE</b></div>
															  	<div><span class="MYEP-display-3"><?php echo $_SESSION['MyexpressSpedizioni']['RCCT']; ?></span>€</div>
															  </div>											
															</div>															
															<?php if (($_SESSION['MyexpressSpedizioni']['CREDITI'] >= $_SESSION['MyexpressSpedizioni']['RCCT']) AND ($_SESSION['MyexpressSpedizioni']['RCCT'] > 0)) { ?>																
																<div class="MYEP-col-xs-12 MYEP-p-x-0">
																	<p class="MYEP-text-muted">
																		<small>Continuando accetti le Condizioni di Trasporto e le Condizioni delle Privacy presenti sul sito internet <a href="https://myexpress.it" target="_blank">MyEXPRESS.it</a></small>
																	</p>																																
										              <button id="JS-carrello-conferma-spedizioni" class="MYEP-btn MYEP-btn-info MYEP-w-100 MYEP-text-white" type="button">CONFERMA</button>
																</div>																													
															<?php } elseif ($_SESSION['MyexpressSpedizioni']['RCCT'] > 0) { ?>
																<div class="MYEP-col-xs-12 MYEP-p-x-0">
																	<div class="MYEP-alert MYEP-alert-danger MYEP-m-b-0">
																		<small>Crediti insufficenti per procedere</small>
																		<a class="MYEP-btn MYEP-btn-block MYEP-btn-danger MYEP-text-white" href="https://myexpress.it/reservedarea/user/crediti" target="_blank">
																		RICARICA CONTO
																	  </a>
																	</div>  
																</div>															
															<?php } ?>
														<?php } ?>																																															
													</div>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12 MYEP-p-x-0 MYEP-p-t-1">
															<div id="JS-MYEP-errore-conferma-carrello" class="MYEP-col-xs-12 MYEP-p-y-1 MYEP-p-x-0" style="display:none;">
																<div class="MYEP-alert MYEP-alert-danger">
																	<?php $CLASS_MYE->msg_errore(); ?>
																</div>
															</div>
															<div id="JS-MYEP-errore-credito-insufficente" style="display:none;">
																<div class="MYEP-alert MYEP-alert-danger MYEP-m-b-0"><small>Crediti insufficenti</small></div>
																<a class="MYEP-btn MYEP-btn-block MYEP-btn-danger MYEP-text-white" href="https://myexpress.it/reservedarea/user/crediti" target="_blank">
																	RICARICA CONTO
																</a>																
															</div>																																																									
														</div>																									
													</div>

												</div>																							
											</div>
										</div>
									</div>
								</div>  
							</div>									
						</div>										
  <?php	
    }
  }


  function MyexpressSpedizioni_html_page_impostazioni() {  	

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	

		/* CHECK */
		if (!empty($_POST['do_impostazioni_base'])) {
		  $STATO_IMPOSTAZIONI = $CLASS_MYE->do_impostazioni_base($_POST);
		} elseif (!empty($_POST['do_impostazioni_indirizzo_base'])) {
		  $STATO_IMPOSTAZIONI = $CLASS_MYE->do_impostazioni_indirizzo_base($_POST);
    } else { $STATO_IMPOSTAZIONI = ''; }
  	
  	MyexpressSpedizioni_settingsPage();
  	
  	if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN'])) {
  		
  		$versione_plugin = $CLASS_MYE->getVersion();
  		  	    	
  ?>
            <div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
              <div class="MYEP-row">
								<div class="MYEP-col-xs-12">
									<div class="MYEP-container-fluid">
										<?php if (!empty($_POST['do_impostazioni_base']) || !empty($_POST['do_impostazioni_indirizzo_base'])) { ?>												  
											<?php if (!empty($STATO_IMPOSTAZIONI)) { ?>												  
											   <div class="MYEP-alert MYEP-alert-success">
											   	 Modifiche apportate correttamente.
											   </div>
											<?php } else { ?>
											   <div class="MYEP-alert MYEP-alert-warning">
											   	 <?php $CLASS_MYE->msg_errore(); ?>
											   </div>													
											<?php } ?>
										<?php } ?>										
										<div class="MYEP-row">
											<div class="MYEP-col-xs-12 MYEP-col-md-6">
												<div class="MYEP-card MYEP-m-x-auto">
													<div class="MYEP-card-header MYEP-bg-white">
														<p class="MYEP-m-y-0 MYEP-h4">Riepilogo dati registrazione</p>
													</div>
													<div class="MYEP-card-block">
														<div class="MYEP-row">
																<div class="MYEP-form-group MYEP-col-xs-12">
																	<table class="MYEP-text-xs-left">
																		<tr><th>Codice cliente</th><td class="MYEP-p-l-1"><?php echo str_pad($_SESSION['MyexpressSpedizioni']['ID_CLIENTE'],11,0,STR_PAD_LEFT); ?></td></tr>
																		<?php if (!empty($_SESSION['MyexpressSpedizioni']['RAGIONE_SOCIALE'])) { ?>
																		  <tr><th>Ragione sociale</th><td class="MYEP-p-l-1"><?php echo $_SESSION['MyexpressSpedizioni']['RAGIONE_SOCIALE']; ?></td></tr>
																		<?php } ?>																			
																		<tr><th>Nome</th><td class="MYEP-p-l-1"><?php echo $_SESSION['MyexpressSpedizioni']['NOME']; ?></td></tr>																			
																		<tr><th>Cognome</th><td class="MYEP-p-l-1"><?php echo $_SESSION['MyexpressSpedizioni']['COGNOME']; ?></td></tr>																
																		<tr><th>Email</th><td class="MYEP-p-l-1"><?php echo $_SESSION['MyexpressSpedizioni']['EMAIL']; ?></td></tr>																
																		<tr><th>Scadenza login</th><td class="MYEP-p-l-1"><?php echo date('d/m/Y',$_COOKIE['MyexpressSpedizioni_TOKEN_TIME']); ?></td></tr>	
																		<tr><th>VERSIONE PLUGIN</th><td class="MYEP-p-l-1"><?php echo $versione_plugin; ?></td></tr>	
																	</table>
																</div>									
														</div>																															
													</div>
												</div>												
												<div class="MYEP-card MYEP-m-x-auto">
													<div class="MYEP-card-header">
														<p class="MYEP-m-y-0 MYEP-h4">Impostazioni base</p>
													</div>
													<div class="MYEP-card-block">

														<form role="form" data-toggle="validator" action="" method="POST">
															<input type="hidden" name="do_impostazioni_base" value="MODIFICA" />										
															<div class="MYEP-row">
																	<div class="MYEP-form-group MYEP-col-xs-12">
																		<label class="MYEP-label">Nominativo contrassegno</label>
																		<input id="cm-input-contrassegno-nominativo" class="MYEP-form-control MYEP-form-control-sm" type="text" name="NOMINATIVO_CONTRASSEGNO" value="<?php echo $CLASS_MYE->getOption('NOMINATIVO_CONTRASSEGNO'); ?>" maxlength="50" pattern="^[a-zA-Z\s]*$" data-pattern-error="Solo caratteri alfabetici." />
																		<div class="MYEP-help-block MYEP-with-errors"></div>
																	</div>																
																	<div class="MYEP-form-group MYEP-col-xs-12">
																		<label class="MYEP-label">Iban contrassegno</label>
																		<input id="cm-input-contrassegno-iban" class="MYEP-form-control MYEP-form-control-sm" type="text" name="IBAN_CONTRASSEGNO" value="<?php echo $CLASS_MYE->getOption('IBAN_CONTRASSEGNO'); ?>" maxlength="50" pattern="^[0-9a-zA-Z]*$" data-pattern-error="Solo caratteri alfanumerici." />
																		<div class="MYEP-help-block MYEP-with-errors"></div>
																	</div>									
																	<div class="MYEP-col-xs-12">
																		<button type="submit">Modifica</button>
																	</div>																  	
															</div>																	
														</form>
														
													</div>
												</div>												
											</div>											
											<div class="MYEP-col-xs-12 MYEP-col-md-6">
												<div class="MYEP-card MYEP-m-x-auto">
													<div class="MYEP-card-header">
														<p class="MYEP-m-y-0 MYEP-h4">Indirizzo ritiro spedizioni</p>
													</div>
													<div class="MYEP-card-block">

														<form role="form" data-toggle="validator" action="" method="POST">
															<input type="hidden" name="do_impostazioni_indirizzo_base" value="MODIFICA" />										
															<div class="MYEP-row">
																	<div class="MYEP-form-group MYEP-col-xs-12">
																		<label class="MYEP-label">Mittente</label>
																		<input id="cm-input-mittente" class="MYEP-form-control MYEP-form-control-sm MYEP-text-capitalize" type="text" name="impostazioni_mittente" value="<?php echo $CLASS_MYE->getOption('NOMINATIVO'); ?>" maxlength="40" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." required />
																		<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																	</div>									
																	<div class="MYEP-form-group MYEP-col-xs-12">
																		<label class="MYEP-label">Referente <small class="MYEP-text-muted">(Opzionale)</small></label>
																		<input id="cm-input-referente" class="MYEP-form-control MYEP-form-control-sm MYEP-text-capitalize" type="text" name="impostazioni_referente" value="<?php echo $CLASS_MYE->getOption('REFERENTE'); ?>" maxlength="20" pattern="^[a-zA-Z\s]*$" data-pattern-error="Solo caratteri alfanumerici." />
																		<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																	</div>																																												
																	<div class="MYEP-form-group MYEP-col-xs-12">
																		<label class="MYEP-label">Email <small class="MYEP-text-muted">(Opzionale)</small></label>
																		<input id="cm-input-email" class="MYEP-form-control MYEP-form-control-sm" type="email" name="impostazioni_email" value="<?php echo $CLASS_MYE->getOption('EMAIL'); ?>" maxlength="50" />
																		<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																	</div>																																																													
																	<div class="MYEP-form-group MYEP-col-xs-12">
																		<label class="MYEP-label">Telefono</label>
																		<input class="MYEP-form-control MYEP-form-control-sm MYEP-text-capitalize" type="text" name="impostazioni_telefono" value="<?php echo $CLASS_MYE->getOption('TELEFONO'); ?>" maxlength="15" pattern="^[0-9\s]*$" data-pattern-error="Solo caratteri numerici." />
																		<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>							
																</div>	
																<div class="MYEP-col-xs-12">
																	<div class="MYEP-row">
																		<div class="MYEP-col-xs-8">
																			<div class="MYEP-form-group">
																				<label class="MYEP-label">Indirizzo</label>
																				<input class="MYEP-form-control MYEP-form-control-sm MYEP-text-capitalize" type="text" name="impostazioni_indirizzo" value="<?php echo $CLASS_MYE->getOption('INDIRIZZO'); ?>" maxlength="30" pattern="^[a-zA-Z'\s]*$" data-pattern-error="Solo caratteri alfabetici." required />
																				<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																			</div>																
																		</div>
																		<div class="MYEP-col-xs-4">
																			<div class="MYEP-form-group">
																				<label class="MYEP-label">Civico</label>
																				<input class="MYEP-form-control MYEP-form-control-sm MYEP-text-capitalize" type="text" name="impostazioni_civico" value="<?php echo $CLASS_MYE->getOption('CIVICO'); ?>" maxlength="5" pattern="^[a-zA-Z0-9-/\\]*$" data-pattern-error="Solo caratteri alfanumerici." required />
																				<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																			</div>																
																		</div>															
																	</div>
																</div>	
																<div class="MYEP-form-group MYEP-col-xs-12 MYEP-col-md-4">
																	<label class="MYEP-label">Cap</label>
																	<input class="MYEP-form-control MYEP-form-control-sm " type="text" name="impostazioni_cap" value="<?php echo $CLASS_MYE->getOption('CAP'); ?>" maxlength="5" pattern="^[0-9]*$" data-minlength="5" data-pattern-error="Solo caratteri numerici." data-minlength-error="Minimo 5 caratteri." required />
																	<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																</div>
																<div class="MYEP-form-group MYEP-col-xs-12 MYEP-col-md-8">
																	<label class="MYEP-label">Città</label>
																	<input class="MYEP-form-control MYEP-form-control-sm MYEP-text-capitalize" type="text" name="impostazioni_citta" value="<?php echo $CLASS_MYE->getOption('CITTA'); ?>" maxlength="40" pattern="^[a-zA-Z'\s]*$" data-pattern-error="Solo caratteri alfabetici." required />
																	<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																</div>
																<div class="MYEP-form-group MYEP-col-xs-12 MYEP-col-md-6">
																	<label class="MYEP-label">Provincia</label>
																	<select class="MYEP-form-control MYEP-form-control-sm" name="impostazioni_provincia" required>
																		<?php CLASS_myexpress_spedizioni_Utility::option_province($CLASS_MYE->getOption('PROVINCIA')); ?>
																	</select>
																	<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																</div>
																<div class="MYEP-form-group MYEP-col-xs-12 MYEP-col-md-6">
																	<label class="MYEP-label">Nazione</label>
																	<input class="MYEP-form-control MYEP-form-control-sm MYEP-text-uppercase" type="text" name="impostazioni_nazione" value="<?php echo $CLASS_MYE->getOption('NAZIONE'); ?>" maxlength="2" pattern="^[A-Za-z]*$" data-pattern-error="Solo caratteri alfabetici." required readonly />
																	<div class="MYEP-help-block MYEP-with-errors MYEP-text-danger"></div>
																</div>																
																<div class="MYEP-form-group MYEP-col-xs-12">
																	<label class="MYEP-label">Note</label>
																	<input id="cm-input-note" class="MYEP-form-control MYEP-form-control-sm" type="text" name="impostazioni_note" value="<?php echo $CLASS_MYE->getOption('NOTE'); ?>" maxlength="30" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." />
																	<div class="MYEP-help-block MYEP-with-errors"></div>
																</div>																		
																<div class="MYEP-col-xs-12">																	
																	<button type="submit">Modifica</button>
																</div>																																															
															</div>
																	
														</form>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>  
							</div>  	
						</div>	
  <?php
    }	
  }


  function MyexpressSpedizioni_html_page_storico() {

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	      
  	
  	MyexpressSpedizioni_settingsPage();
  	
  	if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN'])) {  	  		
  		
  		$CLASS_MYE->check_token();
 
	  	if (empty($_GET['tipo-estrai-spedizioni']) OR ($_GET['tipo-estrai-spedizioni'] == 'ritiro')) {  			  		
	  		$sel_in_ritiro   = 'MYEP-btn-primary';
	  		$sel_ritirate    = 'MYEP-btn-secondary';
	  	  $tipo_estrai_spedizioni = 'ritiro';
	  	} else {  		
	  	  $sel_ritirate    = 'MYEP-btn-primary';
	  	  $sel_in_ritiro   = 'MYEP-btn-secondary';
	  	  $tipo_estrai_spedizioni = 'ritirate';
	  	}

      $display_opzioni_ricerca = 0;
      
  	  if (!empty($_GET['data-ritiro-from'])) { 
  	    $data_spedizioni_from = $_GET['data-ritiro-from'];  	    
  	    $display_opzioni_ricerca += 1;
  	  } else {  
  	  	$data_spedizioni_from = '';
  	  }

  	  if (!empty($_GET['data-ritiro-to'])) { 
  	    $data_spedizioni_to = $_GET['data-ritiro-to'];
  	    $display_opzioni_ricerca += 1;
  	  } else {  
  	  	$data_spedizioni_to = '';
  	  }
  	  
  	  if (!empty($_GET['tracking'])) { 
  	    $tracking = $_GET['tracking'];
  	    $display_opzioni_ricerca += 1;
  	  } else {  
  	  	$tracking = '';
  	  }   	  

  	  if (!empty($_GET['ordine_woocommerce'])) { 
  	    $ordine_woocommerce = $_GET['ordine_woocommerce'];
  	    $display_opzioni_ricerca += 1;
  	  } else {  
  	  	$ordine_woocommerce = '';
  	  } 
      
      if ($display_opzioni_ricerca == 0)  {	 $display_opzioni_ricerca = 'display:none;'; $testo_opzioni_ricerca = 'Mostra'; } 
      else { $display_opzioni_ricerca = ''; $testo_opzioni_ricerca = 'Nascondi'; }
      
  	  if (!empty($_GET['paginazione'])) { 
  	    $paginazione = $_GET['paginazione'];
  	  } else {  
  	  	$paginazione = 0;
  	  }  	  
  	  
  ?>
            <div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
              <div class="MYEP-row">
								<div class="MYEP-col-xs-12">
									<div class="MYEP-container-fluid">
										<div class="MYEP-row">
											<div class="MYEP-col-xs-12 MYEP-col-md-9">

													<div class="MYEP-row">
														<div class="MYEP-col-xs-12">
															<a class="MYEP-btn <?php echo $sel_in_ritiro; ?> MYEP-m-b-1" href="<?php echo admin_url('admin.php?page=myexpress_spedizioni-storico'); ?>">In ritiro</a>
														  <a class="MYEP-btn <?php echo $sel_ritirate; ?> MYEP-m-b-1" href="<?php echo admin_url('admin.php?page=myexpress_spedizioni-storico&tipo-estrai-spedizioni=ritirate&data-ritiro-from='.$data_spedizioni_from.'&data-ritiro-to='.$data_spedizioni_to); ?>">Ritirate</a>
														</div>
													</div>
													<?php if ($tipo_estrai_spedizioni == 'ritirate') { ?>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12">
															<button id="JS-MYEP-opzioni-ricerca-storico" class="MYEP-btn MYEP-btn-sm MYEP-btn-faded MYEP-m-b-1"><?php echo $testo_opzioni_ricerca; ?> opzioni ricerca</button>
														</div>
														<div id="JS-MYEP-opzioni_ricerca" class="MYEP-col-xs-12" style="<?php echo $display_opzioni_ricerca; ?>">
															<div class="MYEP-p-a-1" style="border:1px dotted gray;">
																<h3 class="MYEP-m-t-0">Opzioni ricerca</h3>
																<form class="MYEP-form-inline" action="<?php echo admin_url('admin.php');?>" method="GET">
																  <input type="hidden" name="page" value="myexpress_spedizioni-storico" />
																  <input type="hidden" name="tipo-estrai-spedizioni" value="ritirate" />
																	<div class="MYEP-form-group">
																		<label>Da</label>
																		<input type="date" name="data-ritiro-from" value="<?php echo $data_spedizioni_from; ?>" />
																	</div>															  
																	<div class="MYEP-form-group">
																		<label>A</label>
																		<input type="date" name="data-ritiro-to" value="<?php echo $data_spedizioni_to; ?>" />
																	</div>												
																	<div class="MYEP-p-t-1">
																		<label>Tracking</label>
																		<input type="text" name="tracking" value="<?php echo $tracking; ?>" />
																	</div>
																	<div class="MYEP-p-t-1">
																		<label>Ordine Woocommerce</label>
																		<input type="text" name="ordine_woocommerce" value="<?php echo $ordine_woocommerce; ?>" />
																	</div>																
																	<div class="MYEP-form-group MYEP-p-t-1">
																		<button class="MYEP-btn MYEP-btn-sm" type="submit">Cerca</button>
																	</div>
															  </div>
															</form>																														
														</div>
													</div>
													<?php } else { ?>													
										   	     <form class="MYEP-m-b-0" method="post" target="_blank" action="https://api.myexpress.it/wordpress/v1.0/stampa-riepilogo-ritiro">
										   	       <input type="hidden" name="ACTION" value="STAMPA_RIEPILOGO_RITIRO" />
										   	       <input type="hidden" name="TOKEN" value="<?php echo $_COOKIE['MyexpressSpedizioni_TOKEN']; ?>" />
										   	       <button class="MYEP-btn-sm MYEP-btn-link MYEP-text-info" type="submit" style="cursor:pointer;">Stampa riepilogo ritiro</button>
										   	     </form>																		   														
													<?php } ?>
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12">
															<div class="MYEP-table-responsive">
																<table id="JS-MYEP-table-storico-spedizioni" class="MYEP-table">
																	<tr>
																		<th class="MYEP-text-xs-left">#</th>
																		<th class="MYEP-text-xs-left">Destinatario</th>																			
																		<th class="MYEP-text-xs-left">Tipo Spedizione</th>
																		<th class="MYEP-text-xs-left">Data ritiro</th>
																		<th class="MYEP-text-xs-left">Tracking</th>
																		<th class="MYEP-text-xs-left">ID ordine</th>
																		<th class="MYEP-text-xs-left"></th>
																		<th class="MYEP-text-xs-left"></th>
																	</tr>																			
																	<?php
																																	
																		 $TOTALE_SPEDIZIONI = '';															 	    																																		   
																	   $SPEDIZIONI_RAW = $CLASS_MYE->do_get_storico($tipo_estrai_spedizioni,$data_spedizioni_from,$data_spedizioni_to,$paginazione,$tracking,$ordine_woocommerce);
																	   $OBJ_SPEDIZIONI = json_decode($SPEDIZIONI_RAW['SPEDIZIONI'],true);

																	   $indice = 1;																	   

																	   if (is_array($OBJ_SPEDIZIONI)) {

																	   	 $count_array = count($OBJ_SPEDIZIONI) - 1;
																	   	 $TOTALE_SPEDIZIONI = implode($OBJ_SPEDIZIONI[$count_array]);																	   	 
																	   	 unset($OBJ_SPEDIZIONI[$count_array]);
																	   	
																		   foreach ($OBJ_SPEDIZIONI as $SPEDIZIONE_CARRELLO) {																		   	

																		   	 echo '																	   	 
															   	        <tr>
																			   	   <td>'.$indice.'</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['NOMINATIVO_DESTINATARIO'].'</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['TIPO_SPEDIZIONE'].'</td>
																			   	   <td>'.$SPEDIZIONE_CARRELLO['DATA_RITIRO_SPEDIZIONE'].'</td>																			   	   
																			   	   <td>'.$SPEDIZIONE_CARRELLO['TRACKING'].'</td>
																			   	   <td><a href="'.admin_url('post.php?post='.$SPEDIZIONE_CARRELLO['RIFERIMENTO_SPEDIZIONE'].'&action=edit').'" target="_blank">'.$SPEDIZIONE_CARRELLO['RIFERIMENTO_SPEDIZIONE'].'</a></td>';
																			   	   if ($tipo_estrai_spedizioni == 'ritirate') {
																			   	   	echo '<td>
																			   	   	<a href="admin.php?page=myexpress_spedizioni&MYE_spedizione=reso&id_spedizione='.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'">Crea reso</a>
																			   	   	</td>';
																			   	   } else {
																			   	   	echo '																			   	   
																			   	   <td class="MYEP-v-align-middle">
																			   	     <form class="MYEP-m-b-0" method="post" target="_blank" action="https://api.myexpress.it/wordpress/v1.0/documento">
																			   	       <input type="hidden" name="ACTION" value="GET_DOCUMENTI" />
																			   	       <input type="hidden" name="TOKEN" value="'.$_COOKIE['MyexpressSpedizioni_TOKEN'].'" />
																			   	       <input type="hidden" name="ID_SPEDIZIONE" value="'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" />
																			   	       <button class="MYEP-btn-sm MYEP-btn-link MYEP-text-info" type="submit">Documento</button>
																			   	     </form>
																			   	   </td>';	
																			   	   }
																			   	   echo '
																			   	   <td class="MYEP-v-align-middle"> 
																			   	   	 <small>
																				   	     <button class="JS-MYEP-button-tracking-spedizione MYEP-cm-button-dettagli-spedizione MYEP-btn-sm MYEP-btn-link MYEP-text-info" type="button" value="'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" style="cursor:pointer;">Tracking</button>
																			   	     </small>
																			   	   </td>																				   	   
																			   	 </tr>
																			   	 <tr>																   	        
															   	           <td id="JS-DIV-TRACKING-SPEDIZIONE-'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'" class="MYEP-p-y-0 MYEP-bg-faded" colspan="8" style="display:none;">
															   	             <div id="JS-TRACKING-SPEDIZIONE-'.$SPEDIZIONE_CARRELLO['ID_SPEDIZIONE'].'"></div>
															   	           </td>
															   	         </tr>
																		   	 ';		
																		   	 ++$indice;																			   	 
																		   }										
																	   } 
																	   
																	?>																
																</table>
																
																<?php if ($TOTALE_SPEDIZIONI > 5) { ?>
																
																	<div class="MYEP-p-a-1">
																		<form class="MYEP-m-b-0" action="<?php echo admin_url('admin.php');?>" method="GET">
																			<input type="hidden" name="page" value="myexpress_spedizioni-storico" />
																			<input type="hidden" name="paginazione" value="<?php echo $paginazione; ?>" />
																			<input type="hidden" name="tipo-estrai-spedizioni" value="<?php echo $tipo_estrai_spedizioni; ?>" />
																			<input type="hidden" name="data-ritiro-from" value="<?php echo $data_spedizioni_from; ?>" />
																			<input type="hidden" name="data-ritiro-to" value="<?php echo $data_spedizioni_to; ?>" />
																			<nav>
																			  <ul class="MYEP-pagination">
																			  	<?php $ciclo_paginazione = ceil($TOTALE_SPEDIZIONI / 5); ?>
																			  	<?php for ($indice_paginazione = 0; $indice_paginazione < $ciclo_paginazione; $indice_paginazione++) { ?>
																			  	  <?php if ($indice_paginazione == $paginazione) { ?>
																							<li class="MYEP-page-item"><button class="MYEP-btn-link MYEP-page-link" name="paginazione" value="<?php echo $indice_paginazione; ?>" style="background-color:#333 !important; color:#fff;"><?php echo $indice_paginazione + 1; ?></button></li>																			  	  
																			  	  <?php } else { ?>
																							<li class="MYEP-page-item"><button class="MYEP-btn-link MYEP-page-link" name="paginazione" value="<?php echo $indice_paginazione; ?>"><?php echo $indice_paginazione + 1; ?></button></li>																			  	  
																			  	  <?php } ?>																			    	
																			    <?php } ?>
																			  </ul>
																			</nav>
																		</form>
																	</div>																
																<?php } elseif ($TOTALE_SPEDIZIONI <= 0) { ?>
																  <div class="MYEP-alert MYEP-text-xs-center"><h3>Non ci sono spedizioni</h3></div>
																<?php } ?>
															</div>															
														</div>
													</div>													

											</div>
											<div class="MYEP-col-xs-12 MYEP-col-md-3 MYEP-text-xs-center MYEP-p-b-2">
												<div class="MYEP-container-fluid">
													<div class="MYEP-row">
														<div class="MYEP-col-xs-12 MYEP-bg-faded MYEP-p-y-1">
															<?php if ($_SESSION['MyexpressSpedizioni']['FATTURAZIONE'] == 2) { ?>
															  <div class="MYEP-text-xs-left">
															  	<div><b>Prossima fattura</b></div>
															  	<div>Effettuate: <?php echo $_SESSION['MyexpressSpedizioni']['RDFST']; ?></div>
															  	<div>Spesa: <?php echo $_SESSION['MyexpressSpedizioni']['RDFCT']; ?>€</div>
															  </div>
															<?php } else { ?>
																<div class="MYEP-display-4">
																	<p><b>Crediti disponibili:</b></p>
																	<h1 class="MYEP-p-t-0"><?php echo $_SESSION['MyexpressSpedizioni']['CREDITI']; ?>€</h1>
																</div>
																<div>
																	<a class="MYEP-btn MYEP-btn-block MYEP-btn-success MYEP-text-white" href="https://myexpress.it/reservedarea/user/crediti" target="_blank">
																		RICARICA CONTO
																	</a>																	
																</div>					
															<?php } ?>																									
														</div>
													</div>
												</div>																							
											</div>
										</div>
									</div>
								</div>  
							</div>	
						</div>	
  <?php	
    }
  }

  
  function MyexpressSpedizioni_html_page_guida() {

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	      
  	
  	MyexpressSpedizioni_settingsPage();
  	
  ?>
            <div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
              <div class="MYEP-row">
								<div class="MYEP-col-xs-12">
									<div class="MYEP-container-fluid">
										<div class="MYEP-row MYEP-flex-items-xs-center">
											<div class="MYEP-col-xs-12 MYEP-col-md-10">
												<ul style="list-style:disc;">
													<li>
														<section>
															<h3 class="MYEP-m-b-0">Login</h3>
															<p class="MYEP-m-t-0">Il sistema ammette un login per volta, ciò vuol dire che non è possibile lavorare da più postazioni contemporaneamente.<br /> 
															Effettuando il login vengono automaticamente escluse tutte le altre postazioni.</p>
															<br />
														</section>														
													</li>
													<li>
														<section>
															<h3 class="MYEP-m-b-0">Pagamento spedizioni</h3>
															<p class="MYEP-m-t-0">Di base il pagamento delle spedizione viene effettuato con i crediti che caricherai sul tuo conto MyExpress.it.<br /> 
															Dovrai effettuare il login dal nostro sito internet e effettuare il pagamento con Paypal (accredito immediato) o Bonifico bancario.<br /> 
															Il tuo saldo si aggiornerà e potrai effettuare i pagamenti per le spedizioni.</p>
															<p>Se ti è stato attivato un contratto a fatturazione mensile avrai una visione aggiornata dello stato della prossima fattura.</p>
															<p>I crediti e il riepilogo della prossima fattura li trovi nel box a destra nella pagina carrello e storico spedizioni.</p>
															<br />
														</section>														
													</li>
													<li>
														<section>
															<h3 class="MYEP-m-b-0">Creazione spedizioni</h3>
															<p class="MYEP-m-t-0">Puoi creare spedizioni a partire dai tuoi ordini Woocommerce o liberamente.</p>
															<p>Nella lista degli ordini Woocommerce è stata aggiunto un bottone blu che ti permette di richiamare e autocompilare i campi del destinatario per creare la spedizione (l'autocompilazione può presentare degli errori, ricontrollare sempre i dati).<br />
															Se la spedizione è già stata creata, al click del bottone si verra rediretti allo storico che mostrerà tutte le spedizioni associate.</p>															
															<p>Nello storico delle spedizioni, sezione Ritirate, è possibile cliccare su Reso e autocompilare una spedizione con i dati inseriti in precedenza.</p>
															<br />
														</section>
													</li>
													<li>
														<section>
															<h3 class="MYEP-m-b-0">Documenti spedizioni</h3>
															<p class="MYEP-m-t-0">Nello storico delle spedizioni, nella sezione 'In ritiro' sono presenti due link per la stampa dei documenti:<br />
															Il link 'Stampa riepilogo ritiro' da far firmare all'incaricato del ritiro.<br />
															Il link 'Documento' da stampare e apporre sul pacco.</p>
															<br />
														</section>
													</li>
													<li>
														<section>
															<h3 class="MYEP-m-b-0">Tracking spedizione</h3>
															<p class="MYEP-m-t-0">E' sempre possibile seguire l'avanzamento della spedizione cliccando su 'Tracking' nella spedizione desiderata.<br />
															Le spedizioni dopo essere state ritirate verranno aggiornate e spostate nella sezione Ritirate.</p>
															<br />
														</section>
													</li>
													<li>
														<section>
															<h3 class="MYEP-m-b-0">Impostazioni</h3>
															<p class="MYEP-m-t-0">Al primo login il sistema autocompilerà l'indirizzo di ritiro che potrà essere sempre modificabile nelle impostazioni.</p>
															<p>E' possibile memorizzare anche i dati del contrassegno.</p>
															<br />
														</section>
													</li>																																																		<li>
														<section>
															<h3 class="MYEP-m-b-0">Assistenza</h3>
															<p class="MYEP-m-t-0">Per ogni domanda o problema l'assistenza è sempre a disposizione, compila i campi nella pagina apposita e verrà ricontattato nel più breve tempo possibile.</p>
															<br />
														</section>
													</li>
												</ul>																								
											</div>
										</div>
									</div>
								</div>  
							</div>	
						</div>	
  <?php	
	
  }


  function MyexpressSpedizioni_html_page_assistenza() {

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	

    /* CHECK */
		if (!empty($_POST['do_assistenza'])) {
		  $STATO_ASSISTENZA = $CLASS_MYE->do_assistenza($_POST);
		} else { $STATO_ASSISTENZA = ''; }
  	
  	MyexpressSpedizioni_settingsPage();
  	
  	if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN'])) {  	  		
  	
  ?>
            <div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
              <div class="MYEP-row">
								<div class="MYEP-col-xs-12">
									<div class="MYEP-container-fluid">
										<div class="MYEP-row MYEP-flex-items-xs-left">
											<div class="MYEP-col-xs-12 MYEP-col-sm-9 MYEP-col-md-8 MYEP-col-lg-7 MYEP-col-xl-6">
												<?php if (!empty($_POST['do_assistenza'])) { ?>												  
													<?php if (!empty($STATO_ASSISTENZA)) { ?>												  
													   <div class="MYEP-alert MYEP-alert-success">
													   	 Messaggio inviato correttamente.
													   </div>
													<?php } else { ?>
													   <div class="MYEP-alert MYEP-alert-warning">
													   	 <?php $CLASS_MYE->msg_errore(); ?>
													   </div>													
													<?php } ?>
												<?php } ?>
												<p class="MYEP-lead"><small>Inviaci la tua richiesta, la nostra assistenza è lieta di aiutarti.</small></p>
												<form action="" method="POST" data-toggle="validator">
													<input type="hidden" name="do_assistenza" value="do_assistenza" />
													<div class="MYEP-form-group">
														<label class="MYEP-label">Oggetto</label>
														<select class="MYEP-form-control" name="OGGETTO" required>															
															<option disabled selected value="">Seleziona</option>
															<option value="Spedizione">Spedizione</option>
															<option value="Fatturazione">Fatturazione</option>
															<option value="Assistenza">Assistenza tecnica</option>
															<option value="Altro">Altro</option>
														</select>
														<div class="MYEP-help-block MYEP-with-errors"></div>
													</div>
													<div class="MYEP-form-group">
														<label class="MYEP-label">Messaggio</label>
														<textarea name="MESSAGGIO" style="width:100%;height:300px;" maxlength="5000" required></textarea>
														<div class="MYEP-help-block MYEP-with-errors"></div>
													</div>													
													<div class="MYEP-form-group">
														<button class="MYEP-form-control" type="submit">Invia</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>  
							</div>	
						</div>	
  <?php	
    }
  }

  
  function MyexpressSpedizioni_html_page_crea_front_page() {

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	      
  	
  	$STATO_LOGIN = MyexpressSpedizioni_settingsPage();
  	
  	if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN']) || !empty($STATO_LOGIN)) {  	  		
  		
  	
  		if (!empty($_GET['MYE_spedizione']) AND ($_GET['MYE_spedizione'] == 'crea' || $_GET['MYE_spedizione'] == 'modifica' || $_GET['MYE_spedizione'] == 'reso')) { 
  			if ($_GET['MYE_spedizione'] == 'crea') {  
  			  MyexpressSpedizioni_html_page_crea_spedizione(); 
  			} elseif ($_GET['MYE_spedizione'] == 'modifica') {  
  			  MyexpressSpedizioni_html_page_crea_spedizione('','',$_GET['id_spedizione']); 
  			} elseif ($_GET['MYE_spedizione'] == 'reso') {  
          MyexpressSpedizioni_html_page_crea_spedizione('',$_GET['id_spedizione']);   			
  			}
  		}	else {
  	
  ?>					
  					<div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
  						<div class="MYEP-row">
                <div class="MYEP-col-xs-12">
									<div class="MYEP-container-fluid">
										<div class="MYEP-row MYEP-flex-items-xs-center">
											<div class="MYEP-col-xs-12 MYEP-col-md-10">
												<div class="MYEP-row">
													<div class="MYEP-col-xs-12"><a class="MYEP-btn MYEP-btn-secondary MYEP-m-b-1" href="<?php echo admin_url('admin.php?page=myexpress_spedizioni&MYE_spedizione=crea'); ?>">Crea spedizione</a>
													<a class="MYEP-btn MYEP-btn-secondary MYEP-m-b-1" href="<?php echo admin_url('edit.php?post_type=shop_order'); ?>">Crea spedizione da Woocommerce</a></div>
												</div>									
												<figure>
													<img class="MYEP-w-100" src="<?php echo plugins_url('/imgs/plugin-woocommerce-screenshot-crea-spedizione.png',__FILE__); ?>" />
												</figure>	
											</div>
										</div>
									</div>
								</div>  
							</div>									
						</div>										
  <?php	
  
      }
  
    }  	
  }


  function MyexpressSpedizioni_html_page_crea_spedizione($ID_ORDINE = null, $RESO = null, $ID_SPEDIZIONE = null) {

    require_once('CLASS-myexpress-spedizioni-Plugin.php');
    $CLASS_MYE = new CLASS_myexpress_spedizioni_Plugin();	      
  	
  	/* CHECK */
  	if (!empty($_GET['id_ordine'])) {  
  		$ID_ORDINE = $_GET['id_ordine'];
  	} else { $ID_ORDINE = ''; }
  		
  	if (!empty($_GET['id_spedizione'])) {  
  		$RESO = $_GET['id_spedizione'];
  	} else { $RESO = ''; }  			

    if (!empty($_COOKIE['MyexpressSpedizioni_TOKEN'])) {  	  		

	    $SPEDIZIONE['MITTENTE_NOMINATIVO']     = '';
	    $SPEDIZIONE['MITTENTE_REFERENTE']      = '';
	    $SPEDIZIONE['MITTENTE_TELEFONO']       = '';
	    $SPEDIZIONE['MITTENTE_EMAIL']          = '';
	    $SPEDIZIONE['MITTENTE_INDIRIZZO']      = '';
	    $SPEDIZIONE['MITTENTE_CIVICO']         = '';
	    $SPEDIZIONE['MITTENTE_CAP']            = '';
	    $SPEDIZIONE['MITTENTE_CITTA']          = '';
	    $SPEDIZIONE['MITTENTE_PROVINCIA']      = '';
	    $SPEDIZIONE['MITTENTE_NAZIONE']        = '';
	    $SPEDIZIONE['MITTENTE_NOTE']           = '';

	    $SPEDIZIONE['DESTINATARIO_NOMINATIVO'] = '';
	    $SPEDIZIONE['DESTINATARIO_REFERENTE']  = '';
	    $SPEDIZIONE['DESTINATARIO_TELEFONO']   = '';
	    $SPEDIZIONE['DESTINATARIO_EMAIL']      = '';
	    $SPEDIZIONE['DESTINATARIO_INDIRIZZO']  = '';
	    $SPEDIZIONE['DESTINATARIO_CIVICO']     = '';
	    $SPEDIZIONE['DESTINATARIO_CAP']        = '';
	    $SPEDIZIONE['DESTINATARIO_CITTA']      = '';
	    $SPEDIZIONE['DESTINATARIO_PROVINCIA']  = '';
	    $SPEDIZIONE['DESTINATARIO_NAZIONE']    = '';
	    $SPEDIZIONE['DESTINATARIO_NOTE']       = '';

	    $SPEDIZIONE['MERCE_ALTEZZA']           = '';
	    $SPEDIZIONE['MERCE_LARGHEZZA']         = '';
	    $SPEDIZIONE['MERCE_LUNGHEZZA']         = '';
	    $SPEDIZIONE['MERCE_PERIMETRO']         = '';    
	    $SPEDIZIONE['MERCE_PESO']              = '';
	    $SPEDIZIONE['MERCE_CONTENUTO']         = '';
	    $SPEDIZIONE['MERCE_VALORE']            = '';
	    
	    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE']       = '';
	    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_BENEFICIARIO'] = '';
	    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_IBAN']         = '';
	    $SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE']      = '';
	    $SPEDIZIONE['ACCESSORI_AL_PIANO']                  = '';
	    $SPEDIZIONE['ACCESSORI_ENTRO_LE_10']               = '';
	    $SPEDIZIONE['ACCESSORI_ENTRO_LE_12']               = '';
	    $SPEDIZIONE['ACCESSORI_SU_APPUNTAMENTO']           = '';
	    $SPEDIZIONE['ACCESSORI_DI_SERA']                   = '';

      $TESTO_BOTTONE = 'Aggiungi';

		  if (!empty($RESO)) {

				$DATI_SPEDIZIONE_RAW = $CLASS_MYE->do_crea_reso($RESO);																	   
				$OBJ_SPEDIZIONI = json_decode($DATI_SPEDIZIONE_RAW['MODIFICA_SPEDIZIONE'],true);	    	  

        $TESTO_BOTTONE = 'Aggiungi';

        $SPEDIZIONE['MITTENTE_NOMINATIVO'] = $OBJ_SPEDIZIONI['NOMINATIVO_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_REFERENTE']  = $OBJ_SPEDIZIONI['REFERENTE_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_EMAIL']      = $OBJ_SPEDIZIONI['EMAIL_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_TELEFONO']   = $OBJ_SPEDIZIONI['TELEFONO_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_INDIRIZZO']  = $OBJ_SPEDIZIONI['INDIRIZZO_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_CIVICO']     = $OBJ_SPEDIZIONI['CIVICO_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_CAP']        = $OBJ_SPEDIZIONI['CAP_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_CITTA']      = $OBJ_SPEDIZIONI['CITTA_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_PROVINCIA']  = $OBJ_SPEDIZIONI['PROVINCIA_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_NAZIONE']    = $OBJ_SPEDIZIONI['NAZIONE_DESTINATARIO'];
		    $SPEDIZIONE['MITTENTE_NOTE']       = $OBJ_SPEDIZIONI['NOTE_DESTINATARIO'];

	      $SPEDIZIONE['DESTINATARIO_NOMINATIVO']  = $OBJ_SPEDIZIONI['NOMINATIVO_MITTENTE'];
	      $SPEDIZIONE['DESTINATARIO_REFERENTE']   = $OBJ_SPEDIZIONI['REFERENTE_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_TELEFONO']    = $OBJ_SPEDIZIONI['TELEFONO_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_EMAIL']       = $OBJ_SPEDIZIONI['EMAIL_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_NAZIONE']     = $OBJ_SPEDIZIONI['NAZIONE_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_INDIRIZZO']   = $OBJ_SPEDIZIONI['INDIRIZZO_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_CIVICO']      = $OBJ_SPEDIZIONI['CIVICO_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_CAP']         = $OBJ_SPEDIZIONI['CAP_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_CITTA']       = $OBJ_SPEDIZIONI['CITTA_MITTENTE'];
		    $SPEDIZIONE['DESTINATARIO_PROVINCIA']   = $OBJ_SPEDIZIONI['PROVINCIA_MITTENTE'];
        $SPEDIZIONE['DESTINATARIO_NOTE']        = $OBJ_SPEDIZIONI['NOTE_MITTENTE'];
						
				$merce_raw = explode(' ',$OBJ_SPEDIZIONI['MERCE']);		
				$SPEDIZIONE['MERCE_ALTEZZA']   = $merce_raw[1];
				$SPEDIZIONE['MERCE_LUNGHEZZA'] = $merce_raw[2];
				$SPEDIZIONE['MERCE_LARGHEZZA'] = $merce_raw[3];
				$SPEDIZIONE['MERCE_PESO']      = $merce_raw[4];
				$SPEDIZIONE['MERCE_CONTENUTO'] = $OBJ_SPEDIZIONI['CONTENUTO'];
				$SPEDIZIONE['MERCE_VALORE']    = $OBJ_SPEDIZIONI['VALORE_SPEDIZIONE'];
				        				
		   	$ACCESSORI_POSSIBILI = $CLASS_MYE->do_controllo_accessori_possibili($SPEDIZIONE);
        
        $ID_ORDINE = $OBJ_SPEDIZIONI['RIFERIMENTO_SPEDIZIONE'];
        
		    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE']       = '';
		    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_BENEFICIARIO'] = '';
		    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_IBAN']         = '';
		    $SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE']      = '';
		    $SPEDIZIONE['ACCESSORI_AL_PIANO']                  = '';
		    $SPEDIZIONE['ACCESSORI_ENTRO_LE_10']               = '';
		    $SPEDIZIONE['ACCESSORI_ENTRO_LE_12']               = '';
		    $SPEDIZIONE['ACCESSORI_SU_APPUNTAMENTO']           = '';
		    $SPEDIZIONE['ACCESSORI_DI_SERA']                   = '';
	      	      	      
		  } elseif (!empty($ID_ORDINE)) {

		    $SPEDIZIONE['MITTENTE_NOMINATIVO'] = $CLASS_MYE->getOption('NOMINATIVO');
		    $SPEDIZIONE['MITTENTE_REFERENTE']  = $CLASS_MYE->getOption('REFERENTE');
		    $SPEDIZIONE['MITTENTE_EMAIL']      = $CLASS_MYE->getOption('EMAIL');
		    $SPEDIZIONE['MITTENTE_TELEFONO']   = $CLASS_MYE->getOption('TELEFONO');
		    $SPEDIZIONE['MITTENTE_INDIRIZZO']  = $CLASS_MYE->getOption('INDIRIZZO');
		    $SPEDIZIONE['MITTENTE_CIVICO']     = $CLASS_MYE->getOption('CIVICO');
		    $SPEDIZIONE['MITTENTE_CAP']        = $CLASS_MYE->getOption('CAP');
		    $SPEDIZIONE['MITTENTE_CITTA']      = $CLASS_MYE->getOption('CITTA');
		    $SPEDIZIONE['MITTENTE_PROVINCIA']  = strtoupper($CLASS_MYE->getOption('PROVINCIA'));
		    $SPEDIZIONE['MITTENTE_NAZIONE']    = strtoupper($CLASS_MYE->getOption('NAZIONE'));
		    $SPEDIZIONE['MITTENTE_NOTE']       = $CLASS_MYE->getOption('NOTE');

	      $SPEDIZIONE['DESTINATARIO_NOMINATIVO']  = get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_company', true);
	      if (!empty($SPEDIZIONE['DESTINATARIO_NOMINATIVO'])) {
		      $SPEDIZIONE['DESTINATARIO_REFERENTE']   = get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_first_name', true) . ' ' . get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_last_name', true);  	    
		    } else {
		      $SPEDIZIONE['DESTINATARIO_NOMINATIVO']  = get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_first_name', true) . ' ' . get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_last_name', true);  	    
		      $SPEDIZIONE['DESTINATARIO_REFERENTE'] = '';	    	
		    }
		    $SPEDIZIONE['DESTINATARIO_TELEFONO']    = str_replace(array('-','/','\\'),'',get_post_meta(sanitize_text_field($ID_ORDINE),'_billing_phone', true));
		    $SPEDIZIONE['DESTINATARIO_EMAIL']       = get_post_meta(sanitize_text_field($ID_ORDINE),'_billing_email', true);
		    $SPEDIZIONE['DESTINATARIO_NAZIONE']     = strtoupper(get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_country', true));
		    
		    $indirizzo_raw = explode(' ',get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_address_1', true));
		    if (is_array($indirizzo_raw)) {
		      $count_indirizzo_raw = count($indirizzo_raw) - 1;
		      $SPEDIZIONE['DESTINATARIO_CIVICO']    = $indirizzo_raw[$count_indirizzo_raw];
		      unset($indirizzo_raw[$count_indirizzo_raw]);
		      $SPEDIZIONE['DESTINATARIO_INDIRIZZO'] = implode(' ',$indirizzo_raw);
		    } else {
		    	$SPEDIZIONE['DESTINATARIO_INDIRIZZO'] = $indirizzo_raw;
		    	$SPEDIZIONE['DESTINATARIO_CIVICO']    = '';
		    }
		    	    
		    $SPEDIZIONE['DESTINATARIO_CITTA']       = get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_city', true);
		    $SPEDIZIONE['DESTINATARIO_PROVINCIA']   = strtoupper(get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_state', true));
		    $SPEDIZIONE['DESTINATARIO_CAP']         = get_post_meta(sanitize_text_field($ID_ORDINE),'_shipping_postcode', true);

				global $wpdb;								
				$rows = $wpdb->get_results('SELECT post_excerpt FROM '.$wpdb->prefix.'posts WHERE id='.sanitize_text_field($ID_ORDINE));
				foreach( $rows as $row ) { 
			    if (!empty($row->post_excerpt)) {
			      $SPEDIZIONE['DESTINATARIO_NOTE'] = $row->post_excerpt;	
			    }
		    }
		    
		    $riepilogo_indirizzo_destinatario = get_post_meta($ID_ORDINE,'_shipping_company', true) . '<br />' . get_post_meta($ID_ORDINE,'_shipping_first_name', true) . ' ' . get_post_meta($ID_ORDINE,'_shipping_last_name', true) . ' <br />' . get_post_meta($ID_ORDINE,'_billing_phone', true) . '<br />' . get_post_meta($ID_ORDINE,'_billing_email', true) . '<br />' . get_post_meta($ID_ORDINE,'_shipping_address_1', true) . '<br />' . get_post_meta($ID_ORDINE,'_shipping_postcode', true) . ' ' . strtoupper(get_post_meta($ID_ORDINE,'_shipping_state', true)) . ' ' . get_post_meta($ID_ORDINE,'_shipping_city', true) . ' ' . strtoupper(get_post_meta($ID_ORDINE,'_shipping_country', true)) . '<br />' . $SPEDIZIONE['DESTINATARIO_NOTE'];

		   	$ACCESSORI_POSSIBILI = $CLASS_MYE->do_controllo_accessori_possibili($SPEDIZIONE);

		    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_BENEFICIARIO'] = $CLASS_MYE->getOption('NOMINATIVO_CONTRASSEGNO');
		    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_IBAN']         = $CLASS_MYE->getOption('IBAN_CONTRASSEGNO');    

				$order = new WC_Order( $ID_ORDINE );
				$items = $order->get_items();
				$ARTICOLI = '';
				foreach ( $items as $item ) {
			 	 $ARTICOLI .=  $item['name'] . ' QNT: '.$item['qty'] . '<br />';
				}		
				
				$RIEPILOGO_ORDINE = get_post_meta(sanitize_text_field($ID_ORDINE),'_billing_first_name', true) . ' ' . get_post_meta(sanitize_text_field($ID_ORDINE),'_billing_last_name', true);  	    


	    
	    } elseif (!empty($ID_SPEDIZIONE)) {
	    	  
    	  $DATI_SPEDIZIONE_RAW = $CLASS_MYE->do_modifica_spedizione($ID_SPEDIZIONE);																	   
				$OBJ_SPEDIZIONI = json_decode($DATI_SPEDIZIONE_RAW['MODIFICA_SPEDIZIONE'],true);	    	  

        $TESTO_BOTTONE = 'Modifica';

        $SPEDIZIONE['MITTENTE_NOMINATIVO'] = $OBJ_SPEDIZIONI['NOMINATIVO_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_REFERENTE']  = $OBJ_SPEDIZIONI['REFERENTE_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_EMAIL']      = $OBJ_SPEDIZIONI['EMAIL_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_TELEFONO']   = $OBJ_SPEDIZIONI['TELEFONO_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_INDIRIZZO']  = $OBJ_SPEDIZIONI['INDIRIZZO_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_CIVICO']     = $OBJ_SPEDIZIONI['CIVICO_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_CAP']        = $OBJ_SPEDIZIONI['CAP_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_CITTA']      = $OBJ_SPEDIZIONI['CITTA_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_PROVINCIA']  = $OBJ_SPEDIZIONI['PROVINCIA_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_NAZIONE']    = $OBJ_SPEDIZIONI['NAZIONE_MITTENTE'];
		    $SPEDIZIONE['MITTENTE_NOTE']       = $OBJ_SPEDIZIONI['NOTE_MITTENTE'];

	      $SPEDIZIONE['DESTINATARIO_NOMINATIVO']  = $OBJ_SPEDIZIONI['NOMINATIVO_DESTINATARIO'];
	      $SPEDIZIONE['DESTINATARIO_REFERENTE']   = $OBJ_SPEDIZIONI['REFERENTE_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_TELEFONO']    = $OBJ_SPEDIZIONI['TELEFONO_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_EMAIL']       = $OBJ_SPEDIZIONI['EMAIL_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_NAZIONE']     = $OBJ_SPEDIZIONI['NAZIONE_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_INDIRIZZO']   = $OBJ_SPEDIZIONI['INDIRIZZO_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_CIVICO']      = $OBJ_SPEDIZIONI['CIVICO_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_CAP']         = $OBJ_SPEDIZIONI['CAP_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_CITTA']       = $OBJ_SPEDIZIONI['CITTA_DESTINATARIO'];
		    $SPEDIZIONE['DESTINATARIO_PROVINCIA']   = $OBJ_SPEDIZIONI['PROVINCIA_DESTINATARIO'];
        $SPEDIZIONE['DESTINATARIO_NOTE']        = $OBJ_SPEDIZIONI['NOTE_DESTINATARIO'];
						
				$merce_raw = explode(' ',$OBJ_SPEDIZIONI['MERCE']);		
				$SPEDIZIONE['MERCE_ALTEZZA']   = $merce_raw[1];
				$SPEDIZIONE['MERCE_LUNGHEZZA'] = $merce_raw[2];
				$SPEDIZIONE['MERCE_LARGHEZZA'] = $merce_raw[3];
				$SPEDIZIONE['MERCE_PESO']      = $merce_raw[4];
				$SPEDIZIONE['MERCE_CONTENUTO'] = $OBJ_SPEDIZIONI['CONTENUTO'];
				$SPEDIZIONE['MERCE_VALORE']    = $OBJ_SPEDIZIONI['VALORE_SPEDIZIONE'];
				        				
		   	$ACCESSORI_POSSIBILI = $CLASS_MYE->do_controllo_accessori_possibili($SPEDIZIONE);
        
        $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE'] = $OBJ_SPEDIZIONI['CONTRASSEGNO_VALORE'];  
        if (!empty($SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE'])) {
			    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_BENEFICIARIO'] = $OBJ_SPEDIZIONI['CONTRASSEGNO_BENEFICIARIO'];
			    $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_IBAN']         = $OBJ_SPEDIZIONI['CONTRASSEGNO_IBAN'];        
        } else {
      	  $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_BENEFICIARIO'] = $CLASS_MYE->getOption('NOMINATIVO_CONTRASSEGNO');
		      $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_IBAN']         = $CLASS_MYE->getOption('IBAN_CONTRASSEGNO'); 
      	}      
		    
        $SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE'] = $OBJ_SPEDIZIONI['ASSICURAZIONE_VALORE'];

			  if (!empty($OBJ_SPEDIZIONI['ACCESSORIO_AL_PIANO']))        { $SPEDIZIONE['ACCESSORIO_AL_PIANO'] = 1; }
			  if (!empty($OBJ_SPEDIZIONI['ACCESSORIO_ENTRO_LE_10']))     { $SPEDIZIONE['ACCESSORIO_ENTRO_LE_10'] = 1; }
			  if (!empty($OBJ_SPEDIZIONI['ACCESSORIO_ENTRO_LE_12']))     { $SPEDIZIONE['ACCESSORIO_ENTRO_LE_12'] = 1; }
			  if (!empty($OBJ_SPEDIZIONI['ACCESSORIO_DI_SERA']))         { $SPEDIZIONE['ACCESSORIO_DI_SERA'] = 1; }
			  if (!empty($OBJ_SPEDIZIONI['ACCESSORIO_SU_APPUNTAMENTO'])) { $SPEDIZIONE['ACCESSORIO_SU_APPUNTAMENTO'] = 1; }

        $ID_ORDINE = $OBJ_SPEDIZIONI['RIFERIMENTO_SPEDIZIONE'];

				$order = new WC_Order($ID_ORDINE);
				$items = $order->get_items();
				$ARTICOLI = '';
				foreach ( $items as $item ) {
			 	 $ARTICOLI .=  $item['name'] . ' QNT: '.$item['qty'] . '<br />';
				}		
				
				$RIEPILOGO_ORDINE = get_post_meta(sanitize_text_field($ID_ORDINE),'_billing_first_name', true) . ' ' . get_post_meta(sanitize_text_field($ID_ORDINE),'_billing_last_name', true);  	    
	      	      	      
		  } else {
		    
		    $SPEDIZIONE['MITTENTE_NOMINATIVO'] = $CLASS_MYE->getOption('NOMINATIVO');
		    $SPEDIZIONE['MITTENTE_REFERENTE']  = $CLASS_MYE->getOption('REFERENTE');
		    $SPEDIZIONE['MITTENTE_EMAIL']      = $CLASS_MYE->getOption('EMAIL');
		    $SPEDIZIONE['MITTENTE_TELEFONO']   = $CLASS_MYE->getOption('TELEFONO');
		    $SPEDIZIONE['MITTENTE_INDIRIZZO']  = $CLASS_MYE->getOption('INDIRIZZO');
		    $SPEDIZIONE['MITTENTE_CIVICO']     = $CLASS_MYE->getOption('CIVICO');
		    $SPEDIZIONE['MITTENTE_CAP']        = $CLASS_MYE->getOption('CAP');
		    $SPEDIZIONE['MITTENTE_CITTA']      = $CLASS_MYE->getOption('CITTA');
		    $SPEDIZIONE['MITTENTE_PROVINCIA']  = $CLASS_MYE->getOption('PROVINCIA');
		    $SPEDIZIONE['MITTENTE_NAZIONE']    = $CLASS_MYE->getOption('NAZIONE');
		    $SPEDIZIONE['MITTENTE_NOTE']       = $CLASS_MYE->getOption('NOTE');
		  																	  	
		  }

		?>  
	            <div class="wrap MYEP-container MYEP-bg-white MYEP-m-t-0">
								<div class="MYEP-row">
									<div class="MYEP-col-xs-12">
										<div class="MYEP-container-fluid">
											<div id="JS-MYEP-div-aggiunta-a-carrello" style="display:none;">
												<div class="MYEP-row MYEP-flex-items-xs-center MYEP-p-y-3">
													<div class="MYEP-col-xs-12 MYEP-col-sm-10 MYEP-col-md-8 MYEP-col-lg-7 MYEP-col-xl-6">
														<h2 class="MYEP-text-xs-center MYEP-text-success">Spedizione aggiunta al carello!</h2>
														<div class="MYEP-text-xs-center">
															<a href="<?php echo admin_url('admin.php?page=myexpress_spedizioni-carrello'); ?>">Vai al carrello</a> &nbsp; <a href="<?php echo admin_url('admin.php?page=myexpress_spedizioni'); ?>">Aggiungi un altra spedizione</a>	
														</div>														
													</div>
												</div>
											</div>
											
											<div id="JS-MYEP-div-errore-a-carrello" style="display:none;">
												<div class="MYEP-row MYEP-flex-items-xs-center MYEP-p-y-3">
													<div class="MYEP-col-xs-12 MYEP-col-sm-10 MYEP-col-md-8 MYEP-col-lg-7 MYEP-col-xl-6">
													   <div class="MYEP-alert MYEP-alert-warning">
													   	 <?php $CLASS_MYE->msg_errore(); ?>
													   </div>																									
													</div>
												</div>
											</div>											
											
											<div id="JS-MYEP-div-main-crea-spedizione" class="MYEP-row">
												<div class="MYEP-col-xs-12 MYEP-col-md-9">
													<form id="JS-MYEP-form-spedizione" action="" method="POST">
														<input id="JS-MYEP-input-azione-form" type="hidden" name="MYEP-azione-form" value="calcola-spedizione" />													
														<input id="JS-MYEP-tipo-spedizione-form" type="hidden" name="MYEP-tipo_spedizione" />			
														<input id="JS-MYEP-riferimento-spedizione-form" type="hidden" name="MYEP-riferimento_spedizione" value="<?php echo $ID_ORDINE; ?>" />			
														<input id="JS-MYEP-id-spedizione-form" type="hidden" name="MYEP-id_spedizione_modifica" value="<?php echo $ID_SPEDIZIONE; ?>" />
														<div>
															<div class="MYEP-container">
																<div class="MYEP-row">
																	
																	<div class="MYEP-col-xs-12 MYEP-col-sm-6">
																		<div class="MYEP-row">
																			 <div class="MYEP-col-xs-12">
																			 	 <h3>Mittente</h3>
																			 </div>																		 
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-nominativo-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-nominativo_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_NOMINATIVO']; ?>" maxlength="40" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." required placeholder="Nominativo" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-referente-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-referente_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_REFERENTE']; ?>" maxlength="20" pattern="^[a-zA-Z\s]*$" data-pattern-error="Solo caratteri alfabetici." placeholder="Referente (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-email-mittente" class="MYEP-form-control MYEP-form-control-sm" type="email" name="MYEP-email_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_EMAIL']; ?>" maxlength="50" placeholder="Email (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>											
																			 </div>																		 
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-telefono-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-telefono_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_TELEFONO']; ?>" maxlength="15" pattern="^[0-9\s]*$" data-pattern-error="Solo caratteri numerici." placeholder="Telefono (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>											
																			 </div>											 		
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-8">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-indirizzo-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-indirizzo_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_INDIRIZZO']; ?>" maxlength="30" pattern="^[a-zA-Z'\s]*$" data-pattern-error="Solo caratteri alfabetici." required placeholder="Indirizzo" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-4">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-civico-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-civico_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_CIVICO']; ?>" maxlength="5" pattern="^[a-zA-Z0-9-/\\]*$" data-pattern-error="Solo caratteri alfanumerici." required placeholder="Civico (*)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-4">																					
																					<div class="MYEP-form-group MYEP-m-b-0">
																						<input id="JS-MYEP-input-cap-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-cap_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_CAP']; ?>" maxlength="5" pattern="^[0-9]*$" data-minlength="5" data-pattern-error="Solo caratteri numerici." data-minlength-error="Minimo 5 caratteri." required placeholder="Cap" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																					<div class="MYEP-form-group">
																						<input class="MYEP-form-control" type="text" id="JS-MYEP-cap-hidden-associato-mittente" name="JS-MYEP-cap-hidden-associato-mittente" data-minlength="2" data-minlength-error="Cap inesistente." style="display:none;" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>																																												
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-8">													
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-citta-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-citta_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_CITTA']; ?>" maxlength="40" pattern="^[a-zA-Z'\s]*$" data-pattern-error="Solo caratteri alfabetici." required placeholder="Città" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>								
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">													
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-nazione-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-nazione_mittente" value="IT" readonly />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>																		 
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">																						
																					<div class="MYEP-form-group">
																						<select id="JS-MYEP-input-provincia-mittente" class="MYEP-form-control MYEP-form-control-sm" name="MYEP-provincia_mittente" required>
																					    <?php CLASS_myexpress_spedizioni_Utility::option_province($SPEDIZIONE['MITTENTE_PROVINCIA']); ?>
																					  </select>													  														
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>						
																			 </div>											 											 
																			 <div class="MYEP-col-xs-12">																											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-note-mittente" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-note_mittente" value="<?php echo $SPEDIZIONE['MITTENTE_NOTE']; ?>" maxlength="30" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." placeholder="Note (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>																																																							
																			 </div>												
												 						</div>								
																	</div>		
																																	
																	<div class="MYEP-col-xs-12 MYEP-col-sm-6">
																		<div class="MYEP-row">
																			 <div class="MYEP-col-xs-12">
																			 	 <h3>Destinatario</h3>
																			 </div>																		 
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-nominativo-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-nominativo_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_NOMINATIVO']; ?>" maxlength="40" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." required placeholder="Nominativo" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-referente-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-referente_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_REFERENTE']; ?>" maxlength="20" pattern="^[a-zA-Z\s]*$" data-pattern-error="Solo caratteri alfabetici." placeholder="Referente (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-email-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="email" name="MYEP-email_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_EMAIL']; ?>" maxlength="50" placeholder="Email (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>											
																			 </div>																		 
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-telefono-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-telefono_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_TELEFONO']; ?>" maxlength="15" pattern="^[0-9\s]*$" data-pattern-error="Solo caratteri numerici." placeholder="Telefono (**)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>											
																			 </div>											 		
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-8">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-indirizzo-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-indirizzo_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_INDIRIZZO']; ?>" maxlength="30" pattern="^[a-zA-Z'\s]*$" data-pattern-error="Solo caratteri alfabetici." required placeholder="Indirizzo" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-4">											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-civico-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-civico_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_CIVICO']; ?>" maxlength="5" pattern="^[a-zA-Z0-9-/\\]*$" data-pattern-error="Solo caratteri alfanumerici." required placeholder="Civico (*)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-4">																					
																					<div class="MYEP-form-group MYEP-m-b-0">
																						<input id="JS-MYEP-input-cap-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-cap_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_CAP']; ?>" maxlength="5" pattern="^[0-9]*$" data-minlength="5" data-pattern-error="Solo caratteri numerici." data-minlength-error="Minimo 5 caratteri." required placeholder="Cap" />																					
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																					<div class="MYEP-form-group">
																						<input class="MYEP-form-control" type="text" id="JS-MYEP-cap-hidden-associato-destinatario" name="JS-MYEP-cap-hidden-associato-destinatario" data-minlength="2" data-minlength-error="Cap inesistente." style="display:none;" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>																																														
																			 </div>
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-8">													
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-citta-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-citta_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_CITTA']; ?>" maxlength="40" pattern="^[a-zA-Z'\s]*$" data-pattern-error="Solo caratteri alfabetici." required placeholder="Città" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>								
																			 <div class="MYEP-col-xs-12 MYEP-col-sm-6">													
																					<div class="MYEP-form-group">
																						<select id="JS-MYEP-input-nazione-destinatario" class="MYEP-form-control MYEP-form-control-sm" name="MYEP-nazione_destinatario" required>
																					    <?php CLASS_myexpress_spedizioni_Utility::option_nazioni($SPEDIZIONE['DESTINATARIO_NAZIONE']); ?>
																					  </select>													  														
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>
																			 </div>																		 
																			 <div id="JS-MYEP-col-provincia-destinatario" class="MYEP-col-xs-12 MYEP-col-sm-6">
																					<div class="MYEP-form-group">
																						<select id="JS-MYEP-input-provincia-destinatario" class="MYEP-form-control MYEP-form-control-sm" name="MYEP-provincia_destinatario" required>
																					    <?php CLASS_myexpress_spedizioni_Utility::option_province($SPEDIZIONE['DESTINATARIO_PROVINCIA']); ?>
																					  </select>													  														
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>						
																			 </div>											 											 
																			 <div class="MYEP-col-xs-12">																											
																					<div class="MYEP-form-group">
																						<input id="JS-MYEP-input-note-destinatario" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-note_destinatario" value="<?php echo $SPEDIZIONE['DESTINATARIO_NOTE']; ?>" maxlength="30" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." placeholder="Note (opzionale)" />
																						<div class="MYEP-help-block MYEP-with-errors"></div>
																					</div>																																																							
																			 </div>												
												 						</div>								
																	</div>							
																											
																	<div class="MYEP-col-xs-12 MYEP-col-sm-6 MYEP-p-y-2">
																		<div class="MYEP-row">
																			<div class="MYEP-col-xs-12">
																				<h3>Merce</h3>

																				<div class="MYEP-row">
																					<div class="MYEP-col-xs-12 MYEP-col-sm-3">											
																						<div class="MYEP-form-group">
																							<label><small>Altezza</small></label>
																							<input id="JS-MYEP-input-altezza" class="MYEP-form-control MYEP-form-control-sm JS-MYEP-somma-perimetro" type="number" name="MYEP-altezza" min="1" max="100" step="1" data-min-error="Minimo 1 Cm." data-max-error="Max 100 Cm." data-step-error="No decimali." required placeholder="Cm." value="<?php echo $SPEDIZIONE['MERCE_ALTEZZA']; ?>" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																						</div>
																					</div>																														
																					<div class="MYEP-col-xs-12 MYEP-col-sm-3">											
																						<div class="MYEP-form-group">
																							<label><small>Larghezza</small></label>
																							<input id="JS-MYEP-input-larghezza" class="MYEP-form-control MYEP-form-control-sm JS-MYEP-somma-perimetro" type="number" name="MYEP-larghezza" min="1" max="100" step="1" data-min-error="Minimo 1 Cm." data-max-error="Max 100 Cm." data-step-error="No decimali." required placeholder="Cm." value="<?php echo $SPEDIZIONE['MERCE_LARGHEZZA']; ?>" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																						</div>
																					</div>
																					<div class="MYEP-col-xs-12 MYEP-col-sm-3">											
																						<div class="MYEP-form-group">
																							<label><small>Lunghezza</small></label>
																							<input id="JS-MYEP-input-lunghezza" class="MYEP-form-control MYEP-form-control-sm JS-MYEP-somma-perimetro" type="number" name="MYEP-lunghezza" min="1" max="100" step="1" data-min-error="Minimo 1 Cm." data-max-error="Max 100 Cm." data-step-error="No decimali." required placeholder="Cm." value="<?php echo $SPEDIZIONE['MERCE_LUNGHEZZA']; ?>" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																						</div>
																					</div>
																					<div class="MYEP-col-xs-12 MYEP-col-sm-3">											
																						<div class="MYEP-form-group">
																							<label><small>Peso</small></label>
																							<input id="JS-MYEP-input-peso" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-peso" min="1" max="30" step="0.1" data-min-error="Minimo 1 Kg." data-max-error="Max 30 Kg." data-pattern-error="Solo caratteri numerici." data-step-error="Max 1 decimale." required placeholder="Kg." value="<?php echo $SPEDIZIONE['MERCE_PESO']; ?>" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																						</div>
																					</div>										 										 
																					<div id="JS-MYEP-div-perimetro" class="MYEP-col-xs-12 MYEP-col-sm-9" style="display:none;">											
																						<div class="MYEP-form-group">
																							<input id="JS-MYEP-input-perimetro" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-merce_perimetro" max="150" data-max-error="Somma dei lati max 150 Cm." style="display:none;" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																						</div>
																					</div>	
																					<div class="MYEP-col-xs-12">
																						<div class="MYEP-form-group">
																							<input id="JS-MYEP-input-contenuto" class="MYEP-form-control MYEP-form-control-sm" type="text" name="MYEP-contenuto" maxlength="30" pattern="^[a-zA-Z0-9\s]*$" data-pattern-error="Solo caratteri alfanumerici." placeholder="Contenuto spedizione" required value="<?php echo $SPEDIZIONE['MERCE_CONTENUTO']; ?>" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																						</div>											
																					</div>
																					<div class="MYEP-col-xs-12 MYEP-col-sm-6">
																						<div class="MYEP-form-group">
																							<?php if ($SPEDIZIONE['DESTINATARIO_NAZIONE'] == 'IT' || $SPEDIZIONE['DESTINATARIO_NAZIONE'] == '') { ?>	
																							<input id="JS-MYEP-input-valore" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-valore_spedizione" min="1" max="100000" step="1" pattern="^[0-9]*$" data-pattern-error="Solo caratteri numerici e numeri interi." placeholder="Valore dichiarato (**)" value="<?php echo $SPEDIZIONE['MERCE_VALORE']; ?>" />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																							<?php } else { ?>
																							<input id="JS-MYEP-input-valore" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-valore_spedizione" min="1" max="100000" step="1" pattern="^[0-9]*$" data-step-error="Solo caratteri numerici e numeri interi." placeholder="Valore dichiarato (**)" value="<?php echo $SPEDIZIONE['MERCE_VALORE']; ?>" required />
																							<div class="MYEP-help-block MYEP-with-errors"></div>
																							<?php } ?>														
																						</div>											
																					</div>												
																					<div class="MYEP-col-xs-12 MYEP-col-sm-6">											
																					</div>
																				</div>																			

																			</div>
																		</div>																		
																	</div>


																	<div class="MYEP-col-xs-12 MYEP-col-sm-6 MYEP-p-y-2">
																		<div class="MYEP-row">
																			<div class="MYEP-col-xs-12">
																				<h3>Accessori</h3>

																				
																				<div class="MYEP-row MYEP-m-b-1">

																					<div class="MYEP-col-xs-12 MYEP-col-sm-6">
																					
																						<?php if ($SPEDIZIONE['DESTINATARIO_NAZIONE'] == 'IT' || $SPEDIZIONE['DESTINATARIO_NAZIONE'] == '') { ?>	
																							<div id="JS-MYEP-col-contrassegno-main" class="MYEP-row">
																								<div class="MYEP-col-xs-12">
																									<div class="MYEP-form-group">
																										<label class="MYEP-custom-control MYEP-custom-checkbox">
																										  <input id="JS-MYEP-toogle-contrassegno" type="checkbox" class="MYEP-custom-control-input" name="MYEP-contrassegno" <?php if (!empty($SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE'])) { echo 'checked="checked"'; } ?> />
																										  <span class="MYEP-custom-control-indicator"></span>
																										  <span class="MYEP-custom-control-description"><small class="MYEP-text-muted">Contrassegno</small></span>
																										</label>								
																								  </div>					
																								</div>
																								<div id="JS-MYEP-col-contrassegno-1" class="MYEP-col-xs-12" <?php if (empty($SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE'])) { echo 'style="display:none;"'; } ?>>
																									<div class="MYEP-form-group">
																										<input id="JS-MYEP-input-contrassegno-valore" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-contrassegno_valore" min="0" max="999" step="0.01" data-step-error="Max 2 decimali." placeholder="Valore" value="<?php echo $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE']; ?>" />
																										<div class="MYEP-help-block MYEP-with-errors"></div>
																									</div>													
																								</div>
																								<div id="JS-MYEP-col-contrassegno-2" class="MYEP-col-xs-12" <?php if (empty($SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE'])) { echo 'style="display:none;"'; } ?>>
																									<div class="MYEP-form-group">
																										<input id="JS-MYEP-input-contrassegno-beneficiario" class="MYEP-form-control MYEP-form-control-sm MYEP-w100" type="text" name="MYEP-contrassegno_beneficiario" maxlength="50" pattern="^[a-zA-Z\s]*$" data-pattern-error="Solo caratteri alfabetici." placeholder="Beneficiario" value="<?php echo $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_BENEFICIARIO']; ?>" />
																										<div class="MYEP-help-block MYEP-with-errors"></div>
																									</div>													
																								</div>																								
																								<div id="JS-MYEP-col-contrassegno-3" class="MYEP-col-xs-12" <?php if (empty($SPEDIZIONE['ACCESSORI_CONTRASSEGNO_VALORE'])) { echo 'style="display:none;"'; } ?>>
																									<div class="MYEP-form-group">
																										<input id="JS-MYEP-input-contrassegno-iban" class="MYEP-form-control MYEP-form-control-sm MYEP-w100" type="text" name="MYEP-contrassegno_iban" maxlength="50" pattern="^[0-9a-zA-Z]*$" data-pattern-error="Solo caratteri alfanumerici." placeholder="Beneficiario IBAN" value="<?php echo $SPEDIZIONE['ACCESSORI_CONTRASSEGNO_IBAN']; ?>" />
																										<div class="MYEP-help-block MYEP-with-errors"></div>
																									</div>													
																								</div>												
																							</div>	
																						<?php } ?>												
																						
																						<div class="MYEP-row">
																							<div class="MYEP-col-xs-12">
																								<div class="MYEP-form-group">
																									<label class="MYEP-custom-control MYEP-custom-checkbox">
																									  <input id="JS-MYEP-toogle-assicurazione" type="checkbox" class="MYEP-custom-control-input" name="MYEP-assicurazione" <?php if (!empty($SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE'])) { echo 'checked="checked"'; } ?> />
																									  <span class="MYEP-custom-control-indicator"></span>
																									  <span class="MYEP-custom-control-description"><small class="text-muted">Assicurazione</small></span>
																									</label>															
																								</div>													
																							</div>
																							<div id="JS-MYEP-col-assicurazione" class="MYEP-col-xs-12" <?php if (empty($SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE'])) { echo 'style="display:none;"'; } ?> >
																								<?php if ($SPEDIZIONE['DESTINATARIO_NAZIONE'] == 'IT') { ?>														
																									<div class="MYEP-form-group">
																										<input id="JS-MYEP-input-assicurazione-valore" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-assicurazione_valore" min="0" max="2500" pattern="^[0-9]*$" data-pattern-error="Solo caratteri numerici e numeri interi." placeholder="Valore" value="<?php echo $SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE']; ?>" />
																										<div class="MYEP-help-block MYEP-with-errors"></div>
																									</div>
																								<?php } else { ?>																											
																									<div class="MYEP-form-group">
																										<input id="JS-MYEP-input-assicurazione-valore" class="MYEP-form-control MYEP-form-control-sm" type="number" name="MYEP-assicurazione_valore" min="0" max="1500" pattern="^[0-9]*$" data-pattern-error="Solo caratteri numerici e numeri interi." placeholder="Valore" value="<?php echo $SPEDIZIONE['ACCESSORI_ASSICURAZIONE_VALORE']; ?>" />
																										<div class="MYEP-help-block MYEP-with-errors"></div>
																									</div>																		
																								<?php } ?>																											
																							</div>												
																						</div>
																																																	
																					</div>
																					<div class="MYEP-col-xs-12 MYEP-col-sm-6">
																																		
																						<div class="MYEP-row">
																							<div class="MYEP-col-xs-12">																																			
																								<div class="MYEP-form-group JS-MYEP-accessori-base" <?php if (empty($ACCESSORI_POSSIBILI['BASE'])) { echo 'style="display:none;"'; } ?> >
																								  <label class="MYEP-custom-control MYEP-custom-checkbox">
																								    <input id="JS-MYEP-input-accessorio-alpiano" type="checkbox" class="MYEP-custom-control-input time-definite-toggle" name="MYEP-accessorio_al_piano" <?php if (!empty($SPEDIZIONE['ACCESSORI_AL_PIANO'])) { echo 'checked="checked"'; } ?> />
																								    <span class="MYEP-custom-control-indicator"></span>
																								    <span class="MYEP-custom-control-description"><small class="MYEP-text-muted">Al piano</small></span>
																								  </label>
																								</div>											
																								<div class="MYEP-form-group JS-MYEP-accessori-timedefinite" <?php if (empty($ACCESSORI_POSSIBILI['TIMEDEFINITE'])) { echo 'style="display:none;"'; } ?> >
																								  <label class="MYEP-custom-control MYEP-custom-checkbox">
																								    <input id="JS-MYEP-input-accessorio-entrole10" type="checkbox" class="MYEP-custom-control-input time-definite-toggle" name="MYEP-accessorio_entro_le_10" <?php if (!empty($SPEDIZIONE['ACCESSORI_ENTRO_LE_10'])) { echo 'checked="checked"'; } ?> />
																								    <span class="MYEP-custom-control-indicator"></span>
																								    <span class="MYEP-custom-control-description"><small class="MYEP-text-muted">Entro le 10</small></span>
																								  </label>
																								</div>
																								<div class="MYEP-form-group JS-MYEP-accessori-timedefinite" <?php if (empty($ACCESSORI_POSSIBILI['TIMEDEFINITE'])) { echo 'style="display:none;"'; } ?> >
																								  <label class="MYEP-custom-control custom-checkbox">
																								    <input id="JS-MYEP-input-accessorio-entrole12" type="checkbox" class="MYEP-custom-control-input time-definite-toggle" name="MYEP-accessorio_entro_le_12" <?php if (!empty($SPEDIZIONE['ACCESSORI_ENTRO_LE_12'])) { echo 'checked="checked"'; } ?> />
																								    <span class="MYEP-custom-control-indicator"></span>
																								    <span class="MYEP-custom-control-description"><small class="MYEP-text-muted">Entro le 12</small></span>
																								  </label>
																								</div>
																								<div class="MYEP-form-group JS-MYEP-accessori-timedefinite" <?php if (empty($ACCESSORI_POSSIBILI['TIMEDEFINITE'])) { echo 'style="display:none;"'; } ?> >
																								  <label class="MYEP-custom-control MYEP-custom-checkbox">
																								    <input id="JS-MYEP-input-accessorio-disera" type="checkbox" class="MYEP-custom-control-input time-definite-toggle" name="MYEP-accessorio_di_sera" <?php if (!empty($SPEDIZIONE['ACCESSORI_DI_SERA'])) { echo 'checked="checked"'; } ?> />
																								    <span class="MYEP-custom-control-indicator"></span>
																								    <span class="MYEP-custom-control-description"><small class="MYEP-text-muted">Di sera</small></span>
																								  </label>
																								</div>
																								<div class="MYEP-form-group JS-MYEP-accessori-base" <?php if (empty($ACCESSORI_POSSIBILI['BASE'])) { echo 'style="display:none;"'; } ?> >
																								  <label class="MYEP-custom-control MYEP-custom-checkbox">
																								    <input id="JS-MYEP-input-accessorio-suappuntamento" type="checkbox" class="MYEP-custom-control-input time-definite-toggle" name="MYEP-accessorio_su_appuntamento" <?php if (!empty($SPEDIZIONE['ACCESSORI_SU_APPUNTAMENTO'])) { echo 'checked="checked"'; } ?> />
																								    <span class="MYEP-custom-control-indicator"></span>
																								    <span class="MYEP-custom-control-description"><small class="MYEP-text-muted">Su appuntamento</small></span>
																								  </label>
																							  </div>													  
																						  </div>
																						</div>  						
																			   
																			   </div>	
																				</div>
																				
																			</div>
																		</div>																		
																	</div>
																	
																	<div class="MYEP-col-xs-12 MYEP-text-xs-left">
																		<div class="MYEP-small">
																			Legenda:
																		</div>
																		<div class="MYEP-text-muted MYEP-small">
																			(*) Nel caso di spedizioni senza numero civico, inserire la sigla -> SNC <br />
																			(**) I campi Telefono destinatairo e Valore dichiarato diventano obbligatori per le spedizioni all'estero. 
																		</div>																
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>
												<div class="MYEP-col-xs-12 MYEP-col-md-3 MYEP-text-xs-center">
													<div class="MYEP-container-fluid">
														<div class="MYEP-row">										
															<?php if (!empty($RIEPILOGO_ORDINE)) { ?>
															  <div class="MYEP-col-xs-12 MYEP-m-t-1 MYEP-p-a-1 MYEP-bg-faded MYEP-text-xs-left">
															  	<div><b>ID ORDINE</b><br /><?php echo $ID_ORDINE; ?></div>
															  	<div><b>CLIENTE</b><br /><?php echo $RIEPILOGO_ORDINE; ?></div>
															  	<div><b>ARTICOLI</b><br /><?php echo $ARTICOLI; ?></div>
															  	<?php if (!empty($riepilogo_indirizzo_destinatario)) { ?>
																  	<div><b>INDIRIZZO ACQUIRENTE</b></div>
																  	<div><?php echo $riepilogo_indirizzo_destinatario; ?></div>
																  	<p><small>Nota che l'indrizzo viene autocompilato nei campi destinatario dal sistema, controllare sempre la correttezza dell'inserimento.</small></p>
															  	<?php } ?>
															  </div>															  
															<?php } ?>
																																													
															<div class="MYEP-col-xs-12 MYEP-m-t-1 MYEP-p-x-0">															
																<button id="JS-MYEP-button-calcola-spedizione" class="MYEP-btn MYEP-btn-info MYEP-text-white MYEP-w-100 JS-MYEP-invio-form-spedizione" type="button">Calcola costo spedizione</button>
															</div>
															
															<div id="JS-MYEP-errore-campi" class="MYEP-col-xs-12 MYEP-p-y-1 MYEP-p-x-0" style="display:none;">
																<div class="MYEP-alert MYEP-alert-danger">
																	Completa tutti i campi obbligatori prima di procedere.
																</div>
															</div>
															
															<div id="JS-MYEP-errore-calcola-spedizione" class="MYEP-col-xs-12 MYEP-p-y-1 MYEP-p-x-0" style="display:none;">
																<div class="MYEP-alert MYEP-alert-danger">
																	<?php $CLASS_MYE->msg_errore(); ?>
																</div>
															</div>															
															
															<div id="JS-MYEP-div-costo-express" class="MYEP-col-xs-12 MYEP-bg-faded MYEP-m-t-2 MYEP-p-y-1" style="display:none;">
																<div class="MYEP-small MYEP-m-b-1"><b>EXPRESS (1/2gg)</b></div>
																<span class="MYEP-display-4">00.00</span>€
																<button class="MYEP-m-t-1 MYEP-btn MYEP-btn-info MYEP-text-white MYEP-w-100 JS-MYEP-invio-form-spedizione" type="button" name="JS-aggiungi-a-carrello" value="express"><?php echo $TESTO_BOTTONE; ?></button>
															</div>																												
															<div id="JS-MYEP-div-costo-economy" class="MYEP-col-xs-12 MYEP-bg-faded MYEP-m-t-2 MYEP-p-y-1" style="display:none;">
																<div class="MYEP-small MYEP-m-b-1"><b>ECONOMY (3/5gg)</b></div>
																<span class="MYEP-display-4">00.00</span>€
																<button class="MYEP-m-t-1 MYEP-btn MYEP-btn-info MYEP-text-white MYEP-w-100 JS-MYEP-invio-form-spedizione" type="button" name="JS-aggiungi-a-carrello" value="economy"><?php echo $TESTO_BOTTONE; ?></button>
															</div>														
														</div>
													</div>																							
												</div>
											</div>
										</div>
									</div>  
								</div>	
							</div>		
  <?php	
    }
  }




?>