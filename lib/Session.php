<?php
class Session{
    public static function init(){
        if(version_compare(phpversion(), '5.4.0', '<' )){
            if(session_id() == ""){
                session_start();
            }
        }else{
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }
    }
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    // Logout
    public static function destroy(){
        session_destroy();
        session_unset();
        header("Location: login.php");
    }
    // Check Login True
    public static function checkLoginTrue(){
        if(self::get("login") == true){
            header("Location: index.php");
        }
    }
    // Check Login False
    public static function checkLoginFalse(){
        if(self::get("login") == false){
            self::destroy();
            header("Location: login.php");
        }
    }
}