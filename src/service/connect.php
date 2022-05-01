<?php 
  //Connect

  $connect = new mysqli('localhost', 'root', '', 'academia');

  if ($connect === false) {
    die ("ERRO: não foi possível conectar ao BD." . $connect->connect_error);
  }

?>