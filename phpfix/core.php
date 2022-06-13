<?php

# -- Library --
// Persian Swear Words
require 'lib/PersianSwear.php';
// PHP Mailer
use Jasny\Auth\Session\Jwt\Cookie;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'lib/Exception.php';
require 'lib/PHPMailer.php';
require 'lib/SMTP.php';
// Jalaly Date
require 'lib/jdf.php';
# -- Autoload --
require 'vendor/autoload.php';
# -- PHP Functions --
// Not Empty Function
function not_empty($var) {
    if(!empty($var)){
        $r=false;
    }else{
        $r=true;
    }
    return !empty($var);
}
// Err Function
function err($name) {
    if(not_empty($name)) {
        return trigger_error($name,E_USER_ERROR);
    }else{
        return trigger_error('err function input cannot be empty!',E_USER_ERROR);
    }
}
// Clean Function
function clean($text){
	if(not_empty($text)) {
	    $text=str_replace('/','',$text);
	    $text=str_replace('*','',$text);
	    $text=str_replace('+','',$text);
	    $text=str_replace('-',' ',$text);
	    $text=str_replace('_',' ',$text);
	    $text=str_replace('=','',$text);
	    $text=str_replace('`','',$text);
	    $text=str_replace('"','',$text);
	    $text=str_replace("'",'',$text);
	    $text=str_replace('!','',$text);
	    $text=str_replace('~','',$text);
	    $text=str_replace('@','',$text);
	    $text=str_replace('#','',$text);
	    $text=str_replace('$','',$text);
	    $text=str_replace('%','',$text);
	    $text=str_replace('^','',$text);
	    $text=str_replace('&','',$text);
	    $text=str_replace(')','',$text);
	    $text=str_replace('(','',$text);
	    $text=str_replace('|','',$text);
	    $text=str_replace('{','',$text);
	    $text=str_replace('}','',$text);
	    $text=str_replace('[','',$text);
	    $text=str_replace(']','',$text);
	    $text=str_replace(':','',$text);
	    $text=str_replace(';','',$text);
	    $text=str_replace('?','',$text);
	    $text=str_replace('<','',$text);
	    $text=str_replace('>','',$text);
	    $text=str_replace(',',' ',$text);
	    $text=str_replace('.',' ',$text);
	    $r=$text;
	}else{
        $r=err('clean function inputs cannot be empty!');
	}
	return $r;
}
// Redirect Function
function redirect($go) {
    if(not_empty($go)) {
        $r=header('Location: '.$go);
    }else{
        $r=err('redirect function url input cannot be empty!');
    }
    return $r;
}
// Error Function
function error($text) {
    if(not_empty($text)) {
        $r=die('<style>body{background-color: #df9696;}center{padding: 20%;font-size: 50px;border-radius: 10px;}</style><center>'.$text.'</center>');
    }else{
        $r=err('error function input cannot be empty!');
    }
    return $r;
}
// MB Word Count
function mb_str_word_count($str='ERR',$f=0) {
	if (empty($str) || $str == 'ERR') {
		return err("Error, value can't be empty!");
	} else {
            $as = explode(" ", $str);

            switch ($f) {
                case 0:
                    $r = count($as);
                    break;
                case 1:
                case 2:
                    $r = array_values($as);
                    break;
                default:
                    $r = err("The format can only contain 0, 1 and 2!");
                    break;
            }

            return $r;
	}
}
# -- System Function --
// Query Function
function query($conn,$query) {
    if(not_empty($conn)){
        $r=mysqli_query($conn,$query);
    }else{
        $r=err('query function inputs cannot be empty!');
    }
    return $r;
}
// Query To Array Function
function qta($query) {
    if(not_empty($query)){
        $r=mysqli_fetch_array($query);
    }else{
        $r=err('query to array function inputs cannot be empty!');
    }
    return $r;
}
// Constant Function
function set_constant($name,$value,$status=false) {
    if(not_empty($name) &&  not_empty($value)) {
        if($status == false || $status == true){
            $r=define($name,$value,$status);
        }else{
            $r=err('set_constant function status input only true or flase!');
        }
    }else{
        $r=err('set_constant function inputs cannot be empty!');
    }
    return $r;
}
// Find Constant Function
function find_constant($name) {
    if(not_empty($name)){
        $r=defined($name);
    }else{
        $r=err('find_contant function input cannot be empty!');
    }
    return $r;
}
// Post Clean Function
function post($name) {
    if(not_empty($name)){
        $r=clean($_POST[$name]);
    }else{
        $r=err('post function inputs cannot be empty!');
    }
    return $r;
}
// Get Clean Function
function get($name) {
    if(not_empty($name)){
        $r=clean($_GET[$name]);
    }else{
        $r=err('get function inputs cannot be empty!');
    }
    return $r;
}
// Request Function
function request($name) {
    if(not_empty($name)){
        $r=clean($_REQUEST[$name]);
    }else{
        $r=err('request function inputs cannot be empty!');
    }
    return $r;
}
// Visitor Information Function
function vinfo($type) {
    if(not_empty($type)){
        switch ($type){
            case 'ip':
                $r=$_SERVER['REMOTE_ADDR'];
                break;
            case 'header':
                $r=$_SERVER['HTTP_USER_AGENT'];
                break;
            case 'ref':
                $r=$_SERVER['HTTP_REFERER'];
                break;
            default:
                $r=err('vinfo function input value only can ip or header or ref!');
                break;
        }
    }else{
        $r=err('vinfo function input cannot be empty!');
    }
    return $r;
}
// Server Function
function server($type) {
    if(not_empty($type)){
        switch ($type){
            case 'self':
                $r=$_SERVER['PHP_SELF'];
                break;
            case 'host':
                $r=$_SERVER['HTTP_HOST'];
                break;
            default:
                $r=err('server function input value only can self or host!');
                break;
        }
    }else{
        $r=err('server function input cannot be empty!');
    }
    return $r;
}
// Cookie Function
function cookie($name,$value,$expire=0,$path='',$domain='') {
    if(not_empty($name) && not_empty($value)){
        $r=setcookie($name,$value,$expire,$path,$domain);
    }else{
        $r=err('cookie function inputs cannot be empty!');
    }
    return $r;
}
// Read Cookie Function
function rcookie($name) {
    if(not_empty($name)){
        $r=clean($name);
    }else{
        $r=err('rcookie function inputs cannot be empty!');
    }
    return $r;
}
// Time Zone Set Function
function timezone_set($zone='Asia/Tehran') {
    if(not_empty($zone)){
        $r=date_default_timezone_set($zone);
    }else{
        $r=err('timezone_set function input cannot be empty!');
    }
    return $r;
}
// Upload Function
function upload($name,$path) {
    if(not_empty($name,$path)){
        $file=$_FILES[$name];
        $move=move_uploaded_file($file['tmp_name'],$path);
        if($move){
            $r=true;
        }else{
            $r=false;
        }
    }else{
        $r=err('upload function inputs cannot be empty!');
    }
    return $r;
}
// File Function
function file($name) {
    if(not_empty($name)){
        $r=$_FILES[$name];
    }else{
        $r=err('file function input cannot be empty!');
    }
    return $r;
}
