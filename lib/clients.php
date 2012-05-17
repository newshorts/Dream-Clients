<?php
/**
 * Database class to handle socket connection (automatically detects
 * which configuration we have)
 *
 * @author Mike Newell
 * @copyright U can haz c0pie
 * @version 0.1.1
 * 
 * 
 */
require_once 'db.php';

class Clients extends Db {
    
    private $all;
    private $db;
    private $u_clients;
    private $s_clients;
    
    public function __construct() {
        parent::__construct();
        
        $this->db = new Db();
        
        $this->all = $this->db->get_all('entry');
    }
    
    /**
     * Get all clients with more than three votes
     *
     * @since v7
     * @uses $db
     *
     * @return boolean True if able to get clients, also sets a private var
     * 
     * @test -  Negative, successful, returns full amount of data successfully
     * 
     */
    private function popular_clients() {
        
        $query = "SELECT c1, c2, c3, c4, c5 FROM entry";
        
        $arr = array();
        
        $unfiltered = $this->db->get_query($query, $arr);
        
        $this->u_clients = $unfiltered;
        
        $this->sort_clients();
        
    }
    
    /**
     * Private function to sort the array of clients
     *
     * @since v7
     * @uses $this
     *
     * @return array Sets unsorted clients to sorted clients
     * 
     * @test -  Positive, results indicate that PHP is not counting full array
     *          in production this count is half, local host counts this result
     *          as expected
     */
    private function sort_clients() {
        $values = array();
        
        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($this->u_clients));
        
        foreach($it as $v) {
            $values[] = $v;
        }
        
        $this->s_clients = array_count_values($values);
        
//        print_r($values);
        
        // good
//        $objTmp = (object) array('aFlat' => array());
//        // u_clients is good
//        
//        array_walk_recursive($this->u_clients, create_function('&$v, $k, &$t', 'if(!empty($v)) {$t->aFlat[] = $v; }'), $objTmp);
//        
//        $this->s_clients = array_count_values($objTmp->aFlat);
        
        
        
    }
    
    /**
     * Public function to return clients with more than three votes
     *
     * @since v7
     * @uses $db
     *
     * @return array key = client, value = number of votes
     */
    public function get_sorted_clients() {
        
        $this->popular_clients();
        
        return $this->s_clients;
        
    }
    
}

?>
