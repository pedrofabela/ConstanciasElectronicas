<?php
 
  //Abrir conexion a la base de datos
  function connect($dbo)
  {
      try {
          $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);
 
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
          return $conn;
      } catch (PDOException $exception) {
          exit($exception->getMessage());
      }
  }
	
	function connect_o($dbo)
  {
			global $dbo;
			
      try {
					$db_username = $dbo['username'];
					$db_password = $dbo['password'];
					//$db = "oci:dbname=". $dbo['db'];
					$db = '//'.$dbo['host'].'/'.$dbo['db'];
					$conn = new PDO($db,$db_username,$db_password);
          //$conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);
 
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
          return $conn;
      } catch (PDOException $exception) {
          exit($exception->getMessage());
      }
  }
	
	
	function connect_m($dbm)
  {
      try {
          $conn = new PDO("mysql:host={$dbm['host']};dbname={$dbm['db']};charset=UTF8;", $dbm['username'], $dbm['password']);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
      } catch (PDOException $exception) {
          exit($exception->getMessage());
      }
  }
 
/*
 	//Obtener parametros para updates
	function getParams($input){
    $filterParams = [];
    foreach($input as $param => $value){
			$filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
  }
 
  //Asociar todos los parametros a un sql
  function bindAllValues($statement, $params){
		foreach($params as $param => $value){
			$statement->bindValue(':'.$param, $value);
		}
    return $statement;
  }
*/
?>