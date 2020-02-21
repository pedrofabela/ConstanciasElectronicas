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
		echo $_GET['CB_U2UAEM'] .'({"ESTATUS": "0", "MENSAJE": "'.$msgEsc.'"});';
		//"ID_EDO": "0", 
		exit();
	}
 
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $Curp = trim(strtoupper($_GET['CU']));
		if ( validate_curp($Curp) ){

			$sqlAlu = "SELECT ESTATUS, PAP AS APP, SAP AS APM, NOM, CCT, TRIM(E.NOMBRE) AS ESCUELA, 0 AS PROM_CICLO, 
				CASE 
					WHEN GRADO=0 THEN ROUND((PFG3 + PFG2 + PFG1)/3,1)
					WHEN GRADO=3 THEN ROUND((PFG2 + PFG1)/2,1)
					ELSE 0
					END AS PROM_GRAL, 
				'2018-08-24' AS FEC_INI, '2019-06-24' AS FEC_FIN, GRADO,PFG1,PFG2, PFG3
				FROM CEE_TBL_NIV3 L
				LEFT JOIN CEE_TBL_USUARIOS E ON E.CLAVE = L.CCT
				WHERE BNDEDO = 1
				AND GRADO IN(3,0)
				AND ESTATUS IN (1,3)
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
				echo $_GET['CB_U2UAEM'] .'('. json_encode( $rowD ) .');';
				$sqlEstats = "INSERT INTO CEE_ESTATS_WS2 (TPO, RES, DATA, IP) VALUES(2,1,'".$rowD['CCT']."','{$_SERVER['REMOTE_ADDR']}')";
				$stmt= oci_parse($dbConn, $sqlEstats);
				oci_execute($stmt);
				oci_close($dbConn);
				exit();
			}else{
				$msgEsc =	"La persona no se ha identificado."; 
				header("HTTP/1.1 200 OK");
				echo $_GET['CB_U2UAEM'] .'({"ESTATUS": "97", "MENSAJE": "'.$msgEsc.'"});';
				//"ID_EDO": "97", 
				$sqlEstats = "INSERT INTO CEE_ESTATS_WS2 (TPO, RES, INPUT, DATA, IP) VALUES(2,97,'ERR SIN INFO','$Curp','{$_SERVER['REMOTE_ADDR']}')";
				$stmt= oci_parse($dbConn, $sqlEstats);
				oci_execute($stmt);
				oci_close($dbConn);
				exit();
			}
    }else {
      header("HTTP/1.1 200 OK");
			echo $_GET['CB_U2UAEM'] .'({"ESTATUS": "0", "MENSAJE": "Parámetros insuficientes o incorrectos"});';
			//"ID_EDO": "99", 
			$pData = (isset($_GET['CU'])) ? $_GET['CU'] : "-";
			$sqlEstats = "INSERT INTO CEE_ESTATS_WS2 (TPO, RES, INPUT, DATA, IP) VALUES(3,99,'ERR NO PAR', '$pData','{$_SERVER['REMOTE_ADDR']}')";
			$stmt= oci_parse($dbConn, $sqlEstats);
			oci_execute($stmt);
			oci_close($dbConn);
      exit();
    }
	}
	oci_close($dbConn);
}
header("HTTP/1.1 400 Bad Request");
?>