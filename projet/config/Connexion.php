<?php
	class Connexion{
		static private $hostname='127.0.0.1';
		static private $database='project';
		static private $login='root';//gsantos
		static private $password='';//vC4Jdx94dWTSw8rz

		static $tabUTF8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		static private $pdo;
		static private $con;

		static public function pdo(){
			return self::$pdo;
		}

		static public function con(){
			return self::$con;
		}
		static public function sqlConnect(){
			self::$con = mysqli_connect("localhost","root","","project");
		}
		static public function connect() {
			$h = self::$hostname;
			$d = self::$database;
			$l = self::$login;
			$p = self::$password;
			$t = self::$tabUTF8;

			try{
				self::$pdo=new PDO("mysql:host=$h;port=3306;dbname=$d",$l,$p,$t);
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				echo "erreur de connexion !";
			}
		}
	}
	?>