<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Category extends Db
    {
        private $dbconn;

        public function __construct()
        {
            $this->dbconn = $this->connect();
        }

        public function fetch_category()
        {
            $sql = "SELECT * FROM category";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $fetched = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($fetched) {
                return $fetched;
            } else {
                return false;
            }
            
        }

        public function fetch_cat_unit($id)
        {
            $sql = "SELECT cat_unit FROM category WHERE cat_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $fetched = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fetched) {
                return $fetched;
            } else {
                return false;
            }
        }
       
    }
    
    $category = new Category();

?>