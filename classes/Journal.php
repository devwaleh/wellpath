<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Journal extends Db
    {
        private $dbconn;

        public function __construct()
        {
            $this->dbconn = $this->connect();
        }


        public function add_journal($journal_content, $journal_img, $userId)
        {
                $upload_image = $this->upload_journal_img($journal_img);
                if ($upload_image) {
                    $sql = "INSERT INTO journal(journal_content, journal_img, userId) VALUES(?,?,?)";
                    $stmt = $this->dbconn->prepare($sql);
                    $added = $stmt->execute([$journal_content, $upload_image, $userId]);
                }

            if ($added) {
                return $added;
            } else {
                $_SESSION['error_message'] = "Please select an image";
            }
            
            
        }

        public function edit_journal($journal_content, $journal_img, $journal_id)
        {
            $upload_image = $this->upload_journal_img($journal_img);
                if ($upload_image) {
                    $sql = "UPDATE journal SET journal_content = ?, journal_img = ? WHERE journal_id = ?";
                    $stmt = $this->dbconn->prepare($sql);
                    $added = $stmt->execute([$journal_content, $upload_image, $journal_id]);
                }

            if ($added) {
                return $added;
            } else {
                $_SESSION['error_message'] = "Please select an image";
            }
        }

        public function upload_journal_img($img)
        {
            
            $file_name = $img['name'];
            $file_type = $img["type"];
            $file_tmp_name = $img["tmp_name"];
            $file_size = $img["size"];

            if ($file_size > 2*1024*1024) {
                $_SESSION['error_message'] = "FIle is too large. Maximum file allowed is 2MB";
                return false;
            } 

            $files_allowed = ["image/jpeg", "image/jpg", "image/png"];

            if (!in_array($file_type, $files_allowed)) {
                $_SESSION['error_message'] = "Sorry only PNG, JPG and JPEG are supported";
                return false;
            }

            
            $unique_filename = "wellpath" . "_" . time() . "_" . uniqid() . "_" . $file_name;

            $destination = "../uploads/" . $unique_filename;

            if (move_uploaded_file($file_tmp_name, $destination)) {
                return $unique_filename;
            }else{
                return false;
            }
        }

        public function fetch_journal($userId)
        {
            $sql = "SELECT * FROM journal WHERE userId=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$userId]);
            $fetched = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($fetched) {
                return $fetched;
            } else {
                return false;
            }
            
        }

        public function delete_journal($id)
        {
            $sql = "DELETE FROM journal WHERE journal_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $deleted = $stmt->execute([$id]);

            if ($deleted) {
                return $deleted;
            } else {
                return false;
            }
            
        }

        public function search_journal($content,$id)
        {
            $sql = "SELECT * FROM journal WHERE journal_content LIKE '%' ? '%' AND userId=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$content,$id]);
            $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if ($search) {
            return $search;
           } else {
                return false;
           }
        }

    }

    $journal = new Journal();

?>