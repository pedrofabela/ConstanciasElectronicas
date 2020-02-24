<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<%@ taglib prefix="s" uri="/struts-tags"%>
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    
    <link rel="shortcut icon" href="https://subfc.edomex.gob.mx/sites/subfc.edomex.gob.mx/files/indice_26.png" type="image/png" />
  <link href="css/docdig.css" rel="stylesheet">
	<style id="antiClickjack">body{display:none !important;}</style>
  <script type="text/javascript">
   if (self === top) {
       var antiClickjack = document.getElementById("antiClickjack");
       antiClickjack.parentNode.removeChild(antiClickjack);
   } else {
       top.location = self.location;
   }
  </script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  
  <title>Constancia de Estudios Electrónica</title>
  
      
   <link type="text/css" href="themes/seitheme2/css/uikit.min.css?paxzil" rel="stylesheet" /> 
  <link href="themes/seitheme2/css/style.css?paxzil" rel="stylesheet" type="text/css" />
  <link href="themes/seitheme2/font-awesome/css/font-awesome.min.css?paxzil" rel="stylesheet" type="text/css" />
   <link type="text/css" href="css/menu_dd.css" rel="stylesheet" />

      
      
  
  
  
  <style>
	.tooltip-inner {
		min-width:600px !important;
	}
	</style>
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

        <title>Curso CIC</title>

  

        <script type="text/javascript">

            function envio(accion){
            	
                document.formularioPrincipal.action = accion;
                document.formularioPrincipal.submit();
            }
            
            
              function guarda(accion){
            	
                document.forma.action = accion;
                document.forma.submit();
            }
           

            //PARA REGRESAR EN DONDE SE QUEDO...........
            window.onload = function() {
            	  var pos = window.name || 0;
            	  window.scrollTo(0, pos);
            	 }
            	 window.onunload = function() {
            	 window.name = self.pageYOffset
            	    || (document.documentElement.scrollTop + document.body.scrollTop);
            	 }
        </script>




</head>
<body>
<section id="header" class="container ">
<div class="row">
  <div id="logoheader" class="col-12 col-sm-12" ><img src="images/banner_67.jpg" alt="" > </div>
</div>
</section>
   

<!-- inicia MAIN -->

<div class="container" id="main_body" >
	<!-- INICIA CONTENIDO -->
<br>
  <div class="container">
    
    <div class="row">
      <div id="main" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- inicia DERECHA -->
        
        <div class="clearfix"></div>
				<h2>Constancia de Estudios Electrónica</h2>
        
        <div class="field-item even" property="content:encoded">
          <p class="rtejustify" align="justify">El Gobierno del Estado de México a través de la Secretaría de Educación, proporciona en un formato único la Constancia de Estudios Electrónica, para las y los estudiantes de escuelas públicas de esta entidad, que se encuentren inscritos(as) al presente ciclo escolar. Este documento cuenta con firma electrónica avanzada y sello electrónico de la Secretaría de Educación, por lo que no requiere sello y firma autógrafa de la Institución educativa para tener validez oficial.</p>
          <p class="rtejustify" align="justify">Para generar la constancia se requiere tener a la mano la siguiente información:</p>
          <ol>
          	<li>CURP (en caso de que no la conozcas consúltala 
            <b><a href="#" id="LnkCURP" class="text-success">aquí</a></b>), recuerda que la CURP se conforma de 18 caracteres.</li>
          	<li>Clave del Centro de Trabajo -CCT- 
            (se puede consultar <b><a href="#" class="text-success" data-toggle="tooltip" data-html="true" data-original-title="La Clave del Centro de Trabajo (CCT) se puede identificar en la boleta del estudiante.<br> <img src='images/boleta_muestra.png' widht='540'>" >en la boleta</a></b>), 
            en caso de no conocerla, puede solicitarla en su institución educativa.</li>
          </ol>
        </div>
        
        <div id="doc-container" >
          <span class="col-sm-2 col"></span>
        
          <s:form name="formularioPrincipal" id="formularioPrincipal" enctype="multipart/form-data">
              
              
              
              <input type="hidden" id="i" name="i" value="1"/>
            <div class="titulo">Constancia de Estudios Electrónica</div>
            <br>
            <div class="form-group row">
              <label for="TxtUsu" class="col-sm-2 col-form-label">CURP</label>
              <div class="col-sm-9">
	              
                  <s:textfield name="datos.CURP" id="CURP" cssStyle="width: 100%;" ></s:textfield>   
                          
                          
                          
  	            <div class="invalid-feedback">Escriba una CURP correcta para el estudiante.</div>
              </div>
              <div class="text-center col-sm col-12">
                <img src="images/info.png" class="rounded" data-toggle="tooltip" data-original-title="Recuerda que la CURP se conforma de 18 caracteres." style="cursor:help;" />
              </div>
            </div>
            <div class="form-group row">
              <label for="TxtPsw" class="col-sm-2 col-form-label">CCT</label>
              <div class="col-sm-9">
                   <s:textfield name="datos.CCT" id="CCT"  cssStyle="width: 100%;"></s:textfield>   
               
                    
                    <div class="invalid-feedback" id="feedCCT">Escriba la Clave del Centro de Trabajo donde estudia.</div>
              </div>
              <div class="text-center col-sm col-12">
                <img src="images/info.png" class="rounded" alt="Ayuda" data-toggle="tooltip" title="" data-html="true" data-original-title="La Clave del Centro de Trabajo (CCT) se puede identificar en la boleta del estudiante.<br> <img src='images/boleta_muestra.png'>" style="cursor:help;" />
              </div>
            </div>
            <div class="form-group row">
              <label for="LstMot" class="col-sm-4 col-form-label">Motivo de la constancia</label>
              <div class="col-sm-6">
                  <select id="LstMot" name="LstMot" class="form-control form-control-sm"  style="width: 100%;" required >
                	
                  <option value="1">Solicitud de beca</option>
                  <option value="2">Solicitud de preinscripción escolar</option>
                  <option value="3">Tramite en alguna institución de salud</option>
                  <option value="4">Solicitud de cartilla militar</option>
                  <option value="5">Otros servicios...</option>
                </select>
                <div class="invalid-feedback" id="feedCCT">Escriba la Clave del Centro de Trabajo donde estudia.</div>
              </div>
              
              
              
              
              <div class="text-center col-sm col-12">
              	<img src="images/info.png" class="rounded" data-toggle="tooltip" data-original-title="Es importante para nosotros conocer los motivo que le hacen solicitar una constancia de este tipo, gracias por su apoyo." style="cursor:help;" />
              </div>
              
            </div>
            
            <div class="form-group row">
              <div class="col-sm-2 col">&nbsp;</div>
              <div class="col-sm-6 col-12 text-right"><small>He leido y acepto el Aviso de Privacidad</small>
                <input type="hidden" id="Aux" name="Aux" class="form-check-input">
                <div class="invalid-feedback">Debe leer y aceptar el Aviso de privacidad.</div>
              </div>
              <div class="text-center col-sm col-12">
                <!-- <img src="images/info.png" class="rounded" alt="Ayuda" data-toggle="tooltip" title="" data-html="true" data-original-title="Para elegir tu respuesta haz clic en el botón <img src='images/btn_priv.png'>" style="cursor:help;" /> 
                -->
              </div>
              <div class="col-sm-2 col-12">
              <s:checkbox name="datos.AVISOS" id="AVISOS">
                  
              </s:checkbox>
              </div>
              <div class="col-sm-2">&nbsp;</div>
            </div>
            
           
            <center>
               
                  <a class="dropdown-item" style="background-color:#71a447; border:0; width: 50%; color: white; border-radius: 10px; margin-top: 10px;" href="Javascript:envio('validarDatos')">Generar Constancia</a>
                
          
            </center>
            
                <s:fielderror  fieldName="ERRORDATOS" cssClass="col-lg-12 alert alert-danger"></s:fielderror>    
                   
                   
            
         </s:form>
          <span class="col-sm-2 col"></span>
        </div>
        <div class="field-item even" property="content:encoded">
          <div class="alert alert-secondary" role="alert">
            <strong>Aviso de privacidad:</strong> Los datos personales que se recaban serán utilizados con la finalidad de buscar, generar, validar y obtener la constancia de estudios electrónica. Si deseas conocer nuestro aviso de privacidad integral, lo podrás consultar en el portal <a href="http:\\avisosdeprivacidad.edugem.gob.mx/" target="nueva">http:\\avisosdeprivacidad.edugem.gob.mx/</a>.
          </div>
        </div>
        
        
        <!-- termina DERECHA -->
      </div>
    </div>
    
  </div>
  <!-- TERMINA CONTENIDO -->
</div>
<br><br>
<!-- termina MAIN -->
<div class="container">
	<footer>
		<div class="row">
      <div id="logoheader" class="col-12 col-sm-12" ><img src="images/footer_68.jpg" alt="" > </div>
    </div>
	</footer>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
		<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" ></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/funciones.js" type="text/javascript"></script> 
    <script>
  
    $(document).ready(function(){		
			$("#TxtMot").hide();
			
  		$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
			
			$('input[type=text]').blur(function () {
				$(this).val($(this).val().toUpperCase()) ;
			})

			$("#LnkCURP").click(function(){
				window.open("https://www.gob.mx/curp/");
			})
			
			$("#LstMot").change(function(){
				if($(this).val() == 5){
					$("#TxtMot").show();
					$("#TxtMot").val('');
				}else{
					$("#TxtMot").hide();
					$("#TxtMot").val( $("#LstMot option:selected").text() );
				}
			})
			
      $("#BtnNxt").click(function(){
				$('#Aux').removeClass('is-invalid');
				var BndOK = true;
				var form = $("#FrmDoc");
				$("#Actions").html('');
				$("#feedCCT").html('Escriba la Clave del Centro de Trabajo donde estudia.');
				
				if( (validar_cct_min( $("#TxtCct").val() )) === false ){
					$("#feedCCT").html('La Clave del Centro de Trabajo es incorrecta.');
					$('#TxtCct').addClass('is-invalid');
					BndOK = false;
					event.preventDefault();
					event.stopPropagation();
				}else{$('#TxtCct').removeClass('is-invalid');}
                                
                                if(validarCURP((datos.getCURP()))=== false){
                                    
                                }
                                
				if( (validar_curp( $("#TxtCurp").val() )) === false ){
					$('#TxtCurp').addClass('is-invalid');
					BndOK = false;
					event.preventDefault();
					event.stopPropagation();
				}else{$('#TxtCurp').removeClass('is-invalid');}	
				
				if($("#flipswitch").is(':checked')){
					$('#Aux').addClass('is-invalid');
					BndOK = false;
					event.preventDefault();
					event.stopPropagation();
				}else	if(BndOK){	// use Ajax
					var datos = form.serializeArray();
					$.ajax({
						dataType: "html",
						contentType: "application/x-www-form-urlencoded",
						url:'verif_sol.php',
						data:datos,
						type:'POST',
						success: function(msg) {
							if (msg.toUpperCase().indexOf('ERROR:') == -1) {
								//alert('todo bien');
								form.removeClass('was-validated');
								$("#doc-container").html(msg);
							}else{
								var res = msg.replace("ERROR: ", "") + '</div><div>&nbsp;</div>';
								$("#Actions").html(res);
							}
						}
					})	        	
				}
				form.addClass('was-validated');
      });
			
    })
    
  </script>
  </body>
</html>