<?php
try{
		$dsn = "mysql:dbname=moswear";
		$username = "root";
		$password = "";
		$conn = new PDO( $dsn, $username, $password );
		} 
			catch ( PDOException $e ){
			echo "Connection failed: " . $e-> getMessage();
  }

   ?>