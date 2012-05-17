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

class Categories extends Db {
    
    private $all;
    private $db;
    
    public function __construct() {
        parent::__construct();
        
        $this->db = new Db();
        
        $this->all = $this->db->get_all('category');
    }
    
    /**
     * Public function to output all the categories
     *
     * @since v7
     * @uses $db
     *
     * @return array key = client, value = number of votes
     */
    public function get_categories() {
        
        return $this->all;
        
    }
    
}

?>
