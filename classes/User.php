<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class User extends Db
    {
        private $dbconn;

        public function __construct()
        {
            $this->dbconn = $this->connect();
        }

        public function sign_up($user_name, $user_email, $user_password, $confirm_user_pwd)
        {
            if ($user_password == $confirm_user_pwd) {
                $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
                
                $sql = "INSERT INTO user(user_name, user_email, user_password) VALUES(?,?,?)";
                $stmt = $this->dbconn->prepare($sql);
                $result = $stmt->execute([$user_name, $user_email,$hashed_password]);

                if ($result) {
                    $user_id = $this->dbconn->lastInsertId();
                    return $user_id;
                } else {
                    return 0;
                }
                
            } else {
                return 0;
            }
            
        }

        public function get_userbyid($id)
        {
            $query = "SELECT * FROM user WHERE user_id=?";
            $stmt = $this->dbconn->prepare($query);
            $stmt->execute([$id]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);

            return $records;
        }

        public function update_profile($user_dob, $user_gender, $user_weight, $user_height, $user_id)
        {
            $sql = 'UPDATE user SET user_dob = ?, user_gender = ?, user_weight = ?, user_height = ? WHERE user_id = ?';
            $stmt = $this->dbconn->prepare($sql);
            $Updated = $stmt->execute([$user_dob, $user_gender, $user_weight, $user_height , $user_id ]);

            if ($Updated) {
                return true;
            } else {
                return false;
            }
        }

        public function logout()
        {
            session_unset();
            session_destroy();
        }

        public function login($user_email, $user_password)
        {
            $query = "SELECT * FROM user WHERE user_email=? LIMIT 1";
            $stmt = $this->dbconn->prepare($query);
            $stmt->execute([$user_email]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            if($records){
                $hashed_password = $records['user_password'];
                $check = password_verify($user_password, $hashed_password);
                if($check){
                    return $records;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }

        public function add_dp($id, $dp)
        {
            $rsp = $this->upload_dp($dp);
            if ($rsp) {
                $sql = "DELETE FROM profile_pictures WHERE user_id = ?";
                $stmt = $this->dbconn->prepare($sql);
                $deleted = $stmt->execute([$id]);

                if ($deleted) {
                    $sql = "INSERT INTO profile_pictures(picture_file, user_id) VALUES(?,?)";
                    $stmt = $this->dbconn->prepare($sql);
                    $resp = $stmt->execute([$rsp, $id]);
                    
                    if ($resp) {
                        return true;
                    } else {
                        $_SESSION['error_message'] = "Upload failed please try again";
                    }
                } else {
                    $_SESSION['error_message'] = "Upload failed please try again";
                }
            }
        }

        public function upload_dp($dp)
        {

                $file_name = $dp['name'];
                $file_type = $dp["type"];
                $file_tmp_name = $dp["tmp_name"];
                $file_size = $dp["size"];
    
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

        public function fetch_dp($id){
            $sql = "SELECT * FROM profile_pictures WHERE user_id=?";
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

    $user = new User;

?>