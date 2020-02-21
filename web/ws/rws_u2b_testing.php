<?php
header("Content-Type: application/json; charset=UTF-8");
include "../inc/config.inc";
include "utilities.php";
 
 
$dbConn =  connect_m($dbm);
 
/*
  listar todos los posts o solo uno
*/
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if ((isset($_GET['id'])) && ($_GET['id']>0))
    {
      //Mostrar un curso
			$qry = "SELECT `DSC`, `GUIA_DOC`,`GUIA_ALU` 
				FROM `cat_cursos` 
				WHERE `ID`=:id
				AND `ACTIVO`=1";
      $sql = $dbConn->prepare($qry);
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
			echo $_GET['myCallback'] .'('. json_encode( $sql->fetch(PDO::FETCH_ASSOC) ) .');';
      exit();
    }else {
      //Mostrar lista de cursos
			$qry = "SELECT `ID`, `DSC`, `GUIA_DOC`,`GUIA_ALU` FROM cat_cursos WHERE `ACTIVO`=1";
      $sql = $dbConn->prepare($qry);
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
			echo $_GET['myCallback'] .'('. json_encode( $sql->fetchAll()  ) .');';
      exit();
    }
}

/*
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO cat_cursos
          (`DSC`, `OBJETIVO`, `TEMARIO`, `ACTIVO`)
          VALUES
          (:title, :status, :content, 0)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
     }
}
 
//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM cat_cursos_ WHERE ID=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
 
//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id']*-1;
    $fields = getParams($input);
 
    $sql = "
          UPDATE cat_cursos
          SET $fields
          WHERE ID = $postId
           ";
 
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
 
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
 
*/

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
 
?>