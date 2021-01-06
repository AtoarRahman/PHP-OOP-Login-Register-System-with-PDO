<?php
    include "config.php";

    class Database{
        private static $pdo;
        private static function Connection(){
            if (!isset(self::$pdo)){
                try {
                    self::$pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME,DB_USER, DB_PASS);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$pdo->exec("SET CHARACTER SET utf8");
                }catch (PDOException $e){
                    echo $e->getMessage();
                }
            }
            return self::$pdo;
        }
        public static function prepare($sql){
            return self::Connection()->prepare($sql);
        }
    }