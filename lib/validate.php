<?php
require_once 'db.php';

class Validate extends Db {
    
    private $ip;
    
    public function __construct() {
        
        parent::__construct();
        
        $this->ip = $this->getip();
        
    }
    
    private function validip($ip) {

        if (!empty($ip) && ip2long($ip)!=-1) {

            $reserved_ips = array (

                array('0.0.0.0','2.255.255.255'),

                array('10.0.0.0','10.255.255.255'),

                array('127.0.0.0','127.255.255.255'),

                array('169.254.0.0','169.254.255.255'),

                array('172.16.0.0','172.31.255.255'),

                array('192.0.2.0','192.0.2.255'),

                array('192.168.0.0','192.168.255.255'),

                array('255.255.255.0','255.255.255.255')

            );

            foreach ($reserved_ips as $r) {

                $min = ip2long($r[0]);

                $max = ip2long($r[1]);

                if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;

            }

            return true;

        } else {

            return false;

        }
    }
    
    private function getip() {

        if (isset($_SERVER["HTTP_CLIENT_IP"]) && $this->validip($_SERVER["HTTP_CLIENT_IP"])) {

            return $_SERVER["HTTP_CLIENT_IP"];

        }
        
        if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            
            foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {

                if ($this->validip(trim($ip))) {

                    return $ip;

                }

            }
            
        }
        
        if (isset($_SERVER["HTTP_X_FORWARDED"]) && $this->validip($_SERVER["HTTP_X_FORWARDED"])) {

            return $_SERVER["HTTP_X_FORWARDED"];

        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]) && $this->validip($_SERVER["HTTP_FORWARDED_FOR"])) {

            return $_SERVER["HTTP_FORWARDED_FOR"];

        } elseif (isset($_SERVER["HTTP_FORWARDED"]) && $this->validip($_SERVER["HTTP_FORWARDED"])) {

            return $_SERVER["HTTP_FORWARDED"];

        } elseif (isset($_SERVER["HTTP_X_FORWARDED"]) && $this->validip($_SERVER["HTTP_X_FORWARDED"])) {

            return $_SERVER["HTTP_X_FORWARDED"];

        } else {

            return $_SERVER["REMOTE_ADDR"];

        }
        
    }
    
    public function insert($arr) {
        
        $problems = array();
        
        foreach($arr as $key => $name) {
            
            $name = ucwords($name);
            
            /*
             * @TODO: validate the entries here
             * 
             */
            $cleaned_name = filter_var($name, FILTER_SANITIZE_STRING);
            
            if(empty($cleaned_name)) {   
//                $problems[] = $name;
                $cleaned_name = "N/A";
            }
            
            $arr[$key] = $cleaned_name;
            
        }
        
        if(!empty($problems)) {
            
            print_r($problems);
            
            die("There was an error validating your clients on line " . __LINE__ . " of file " . __FILE__);
            
        }
        
        $arr['ip'] = $this->ip;
        
        return $this->create($arr);
        
        
    }
    
}
?>
