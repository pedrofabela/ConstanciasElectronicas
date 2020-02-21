<?php
header("Content-Type: application/json; charset=UTF-8");
include "../inc/config.inc";
include "utilities.php";

//$dbConn =  connect_o($dbo);
$username = "U_CONSTAELEC";
$password = "C0NST4#18";
$port = 1521;
$set_char='UTF8';
$protocol = "TCP";
$NAME = "oraudai";
$ORACLE_SERVER_IP_ADDRESS = "10.33.220.169";
$dbConn = oci_connect($username, $password, "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = $protocol)(HOST = $ORACLE_SERVER_IP_ADDRESS)(PORT = $port)) ) (CONNECT_DATA = (SID = $NAME) ) )",$set_char) or die (oci_error());
if (!$dbConn) {
	$msgEsc = "ERROR: Error en la conexión a base de datos.";
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	exit();
}
 
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if ((isset($_GET['curp'])) && (isset($_GET['cct']))){
      $Curp = trim(strtoupper($_GET['curp']));
			$CCT = trim($_GET['cct']);
			$sqlCCT = "SELECT CVE_NIVEDU, ESTATUS_USU
				FROM CEE_TBL_USUARIOS
				WHERE CLAVE = '$CCT'
				AND CVE_NIVEDU >=1";
//echo "133: $sqlCCT <br>";
			$sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM (' . $sqlCCT . ')';
			$stmt= oci_parse($dbConn, $sql_query);
			$number_of_rows = 0;
			oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $number_of_rows);
			oci_execute($stmt);
			oci_fetch($stmt);
			if($number_of_rows == 0){
				$msgEsc =	"La clave de CCT es incorrecta."; 
				header("HTTP/1.1 200 OK");
				echo $_GET['myCallback'] .'({"ESTADO": "Error", "ID_EDO": "98", "MSG_ERR": "'.$msgEsc.'"});';
				exit();
			}else{
				$resCCT = oci_parse($dbConn,$sqlCCT);
				oci_execute($resCCT,OCI_DEFAULT);
				$rowCCT = oci_fetch_row($resCCT);
				if($rowCCT[0]==1){	// PREESCOLAR
					$sqlAlu = "SELECT ESTATUS, PFG1, PFG2, PFG3, 0, 0, 
						0, GRADO, CICLOESC
						FROM CEE_TBL_NIV1 L
						LEFT JOIN CEE_TBL_USUARIOS E ON E.CLAVE = L.CCT
						WHERE BNDEDO = 1
						AND L.CCT = '$CCT'
						AND L.CURP = '$Curp'";
				}elseif($rowCCT[0]==2){	// PRIMARIA
					$sqlAlu = "SELECT CASE 
            WHEN ESTATUS=1 THEN 'Inscrito(a)'
            WHEN ESTATUS=3 THEN 'Egresado(a)'
            ELSE 'Desconocido'
            END AS ESTADO,
						ESTATUS as ID_EDO, PFG1, PFG2, PFG3, PFG4, PFG5, PFG6, 
						GRADO, CICLOESC
						FROM CEE_TBL_NIV2 
						WHERE BNDEDO = 1
						AND CCT = '$CCT'
						AND CURP = '$Curp'";
				}elseif($rowCCT[0]==3){	// SECUNDARIA
					$sqlAlu = "SELECT CASE 
            WHEN ESTATUS=1 THEN 'Inscrito(a)'
            WHEN ESTATUS=3 THEN 'Egresado(a)'
            ELSE 'Desconocido'
            END AS ESTADO,
            ESTATUS as ID_EDO, PFG1, PFG2, PFG3, GRADO, CICLOESC
						FROM CEE_TBL_NIV3 
						WHERE BNDEDO = 1
						AND CCT = '$CCT'
						AND CURP = '$Curp'";
				}
//echo "75: $sqlAlu <br>";
				$sql_query = 'SELECT COUNT(*) AS NUMBER_OF_ROWS FROM (' . $sqlAlu . ')';
				$stmt= oci_parse($dbConn, $sql_query);
				$number_of_rows = 0;
				oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $number_of_rows);
				oci_execute($stmt);
				oci_fetch($stmt);
				if($number_of_rows > 0){
					$sAlu=oci_parse($dbConn,$sqlAlu);
					oci_execute($sAlu,OCI_DEFAULT);
					$rowD = oci_fetch_array($sAlu,OCI_ASSOC);
					
					header("HTTP/1.1 200 OK");
					echo $_GET['myCallback'] .'('. json_encode( $rowD ) .');';
					exit();
				}else{
					$msgEsc =	"La persona no se identifica inscrita en la Escuela."; 
					header("HTTP/1.1 200 OK");
					echo $_GET['myCallback'] .'({"ESTADO": "Error", "ID_EDO": "97", "MSG_ERR": "'.$msgEsc.'"});';
					exit();
				}
			}
    }else {
      header("HTTP/1.1 200 OK");
			echo $_GET['myCallback'] .'({"ESTADO": "Error", "ID_EDO": "99", "MSG_ERR": "Parámetros insuficientes"});';
      exit();
    }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>