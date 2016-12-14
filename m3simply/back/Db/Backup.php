<?php
namespace Db;

//use \PDO;
//use \PDOException;

//use Rah\Danpu\Dump;
//use Rah\Danpu\Config;
//use Rah\Danpu\Export;
//use Rah\Danpu\Import;


class Backup {
    public $dbname;
    public $ip;
    public $user;
    public $password;

    public function __construct($dbname,$ip,$user,$password,$needle){
        $this->dbname = $dbname;
        $this->ip = $ip;
        $this->user = $user;
        $this->password = $password;
        $this->needle = $needle;
        
    }

    public function doBackup(){
        $dumpSettings = array(
            'compress' => Mysqldump::NONE,
            'no-data' => false,
            'add-drop-table' => true,
            'single-transaction' => true,
            'lock-tables' => true,
            'add-locks' => true,
            'extended-insert' => false,
            'disable-keys' => true,
            'skip-triggers' => false,
            'add-drop-trigger' => true,
            'routines' => true,
            'databases' => false,
            'add-drop-database' => false,
            'hex-blob' => true,
            'no-create-info' => false,
        );
        
        

        $dump = new Mysqldump(
            "mysql:host=$this->ip;dbname=$this->dbname",
            "$this->user",
            "$this->password",
            $dumpSettings);
        $today = date("ymd_H_i_s");
	$dump->start(dirname(__FILE__)."dumpster/$today.$this->dbname".".sql");
        
        
	$allFiles = scandir(dirname(__FILE__)."dumpster/");
        $files = array_diff($allFiles, array('.', '..'));
        
        $path  = "dumpster/";
        
        $response = ["message"=>""];
        
        foreach ($files as $key => $value){
            $item = [];
            $item['id'] = $key;
            $item['filename'] = $value;
            $item['fullpath'] = "$path$value";            
            $item['size'] = filesize(dirname(__FILE__)."dumpster/".$value);
            $list[] = $item; 
        }

        $response["items"] = $list;
        
        die(json_encode($response));
    }
    
    function deleteBackup(){
        $file  = dirname(__FILE__)."dumpster/".$this->needle;
        
        if (!unlink($file)){
            echo ("Error deleting $file");
            
        }else{
            $allFiles = scandir(dirname(__FILE__)."dumpster/");
            $files = array_diff($allFiles, array('.', '..'));
            
            $path  = "Dbdumpster/";
            $response = ["message"=>""];

            foreach ($files as $key => $value){
                $item = [];
                $item['id'] = $key;
                $item['filename'] = $value;
                $item['fullpath'] = "$path$value";            
                $item['size'] = filesize(dirname(__FILE__)."dumpster/".$value);
                $list[] = $item; 
            }

            $response["items"] = $list;

            die(json_encode($response));
        }
    }
    
    function downBackup(){
        $file  = dirname(__FILE__)."dumpster/".$this->needle;
        $response["items"] = $file;
        die(json_encode($response));
    }
    
    function showBackup(){
        $allFiles = scandir(dirname(__FILE__)."dumpster/");
        $files = array_diff($allFiles, array('.', '..'));

        $path  = "Dbdumpster/";
        $response = ["message"=>""];

        foreach ($files as $key => $value){
            $item = [];
            $item['id'] = $key;
            $item['filename'] = $value;
            $item['fullpath'] = "$path$value";            
            $item['size'] = filesize(dirname(__FILE__)."dumpster/".$value);
            $list[] = $item; 
        }

        $response["items"] = $list;

        die(json_encode($response));
    }
}  
//                      prima possibilità di loadBackup con dunpu   
//    function loadBackup(){
//            $dump = new Dump;
//            $dump
//                ->file($restore_file)
//                ->dsn('mysql:dbname='.$this->dbname.';host='.$this->ip)
//                ->user($this->user)
//                ->pass($this->password)
//                ->tmp('/tmp');
//            // Imports the database.
//            new Import($dump);
//        }
//        
//        
//                      seconda possibilità di loadBackup da comandi 
//        
//        function loadBackup(){
//            
//            $error = "we got a problem";
//            $restore_file  = dirname(__FILE__)."dumpster/".$this->needle;
//            
//            try {
//            $conn = new PDO("mysql:host=$this->ip;dbname=$this->dbname", $this->user, $this->password);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//            // sql to delete a database and prove it
//            $killdbill = "DROP DATABASE mainsim3_demo2";
//            $proveit = "SHOW DATABASES";
//
//            // use exec() because no results are returned
//            $conn->exec($killdbill);
//            echo "Database deleted successfully <br/>";
//            $conn->exec($proveit);
//            echo "Databases checked successfully <br/>";
//            
//            // try to recreate db from backup
//            $myvar = fopen("$restore_file", "r+") or die("Unable to open file!");
//            $myfile = (string)$myvar;
//            $conn->exec($myfile);
//            
//            fclose($myvar);
//            }
//        catch(PDOException $e)
//            {
//            echo $error . "<br>" . $e->getMessage();
//            }

//            $cmd = "mysql -h {$this->ip} -u {$this->user} -p{$this->password} {$this->dbname} < $restore_file";
//            exec($cmd);
            
//        }