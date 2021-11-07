<?php
/*Configuración de conecxión a base de datos*/
$Host = 'localhost';
$Usuario = 'root';
$pass = '';
$BaseDeDatos = 'retoLocalStorage';
$mysqli = new mysqli($Host, $Usuario, $pass, $BaseDeDatos) or die($mysqli->error);
$mysqli->query("SET NAMES 'utf8'");