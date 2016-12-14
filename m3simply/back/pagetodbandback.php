<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class_name) {
    require_once $class_name.".php";
});


use Db\Backup;
use Db\Rxcode;
use \PDO;


$rest_json = file_get_contents("php://input");
$request = json_decode($rest_json, true);
//var_dump($request);

$user= $request["database"]["user"];
$password= $request["database"]["password"];
$ip= $request["database"]["ip"];
$porta= $request["database"]["porta"];
$dbname= $request["database"]["dbname"];

$dbaction= $request["action"]["do"];
$needle= $request["action"]["search"];

try{
$connessione = 
    new PDO(
        "mysql:host=$ip;dbname=$dbname",
        $user,
        $password);
} catch (PDOException $e) {
    die("Connection failed to mysql:host=$ip;dbname=$dbname: " . $e->getMessage());
}


$connessione->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
//    PDO::FETCH_BOTH);
    PDO::FETCH_ASSOC);
	


switch ($dbaction) {
    
    case "backup":
        $backu = new Backup($dbname,$ip,$user,$password,$needle);
        echo $backu->doBackup();
        break;
    
//    case "backdw":
//        $backdw = new Backup($dbname,$ip,$user,$password,$needle);
//        echo $backdw->loadBackup();
//        break;
    
     case "deleteb":
        $deleteb = new Backup($dbname,$ip,$user,$password,$needle);
        echo $deleteb->deleteBackup();
        break;
    
   case "showb":
        $showb = new Backup($dbname,$ip,$user,$password,$needle);
        echo $showb->showBackup();
        break;
    
    case "downloadb":
        $downloadb = new Backup($dbname,$ip,$user,$password,$needle);
        echo $downloadb->downBackup();
        break;
    
    case "rxcode":
        $research = new Rxcode($needle,$connessione);
		echo $research->search();
        break;
    
    default:
        echo "Non hai inserito nessun action valido";
}
