<?php
include "../inc/FunValIny.php";

if( (isset($_GET['CU'])) && (ValidarParInput($_GET['CU'])) ){

	header("Content-Type: application/json; charset=UTF-8");
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
		header("HTTP/1.1 200 OK");
		echo $_GET['CB_U2NMS'] .'({"ESTADO": "Error", "ID_EDO": "0", "MSG_ERR": "'.$msgEsc.'"});';
		exit();
	}
 
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		$Curp = trim(strtoupper($_GET['CU']));
		if ( validate_curp($Curp) ){
			$sqlAlu = "SELECT CASE 
				WHEN ESTATUS=1 THEN 'Inscrito(a)'
				WHEN ESTATUS=3 THEN 'Egresado(a)'
				WHEN ESTATUS=4 THEN 'Irregular'
				WHEN ESTATUS=6 THEN 'Sin Promedios'
				ELSE 'Desconocido'
				END AS ESTADO,
				ESTATUS as ID_EDO, PFG1, PFG2, PFG3, GRADO, CICLOESC, CCT
				FROM CEE_TBL_NIV3 
				WHERE BNDEDO = 1
				AND CURP = '$Curp'";
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
				echo $_GET['CB_U2NMS'] .'('. json_encode( $rowD ) .');';
				$sqlEstats = "INSERT INTO CEE_ESTATS_WS1 (TPO, RES, INPUT, DATA, IP) VALUES(2,1,'$Curp','".$rowD['CCT']."','{$_SERVER['REMOTE_ADDR']}')";
				$stmt= oci_parse($dbConn, $sqlEstats);
				oci_execute($stmt);
				oci_close($dbConn);
				exit();
			}else{
				$msgEsc =	"La persona no se ha identificado."; 
				header("HTTP/1.1 200 OK");
				echo $_GET['CB_U2NMS'] .'({"ESTADO": "Error", "ID_EDO": "97", "MSG_ERR": "'.$msgEsc.'"});';
				$sqlEstats = "INSERT INTO CEE_ESTATS_WS1 (TPO, RES, INPUT, DATA, IP) VALUES(2,97,'ERR SIN INFO','$Curp','{$_SERVER['REMOTE_ADDR']}')";
				$stmt= oci_parse($dbConn, $sqlEstats);
				oci_execute($stmt);
				oci_close($dbConn);
				exit();
			}
		}else {
			header("HTTP/1.1 200 OK");
			//header('200 OK');
			echo $_GET['CB_U2NMS'] .'({"ESTADO": "Error", "ID_EDO": "99", "MSG_ERR": "Parámetros insuficientes o incorrectos"});';
			$pData = (isset($_GET['CU'])) ? $_GET['CU'] : "-";
			$sqlEstats = "INSERT INTO CEE_ESTATS_WS1 (TPO, RES, INPUT, DATA, IP) VALUES(3,99,'ERR NO PAR', '$pData','{$_SERVER['REMOTE_ADDR']}')";
			$stmt= oci_parse($dbConn, $sqlEstats);
			oci_execute($stmt);
			oci_close($dbConn);
			exit();
		}
	}
}
header( '400 Bad Request' );
?>