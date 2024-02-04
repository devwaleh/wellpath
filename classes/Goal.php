<?php

    error_reporting(E_ALL);
    require_once('Db.php');

    class Goal extends Db
    {
        private $dbconn;

        public function __construct()
        {
            $this->dbconn = $this->connect();
        }

        public function add_goal($user_id, $goal_target, $cat_id)
        {
            $sql = "INSERT INTO goals(user_id, goal_target, cat_id) VALUES(?,?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $done = $stmt->execute([$user_id, $goal_target, $cat_id]);

            if ($done) {
                return $done;
            } else {
                return false;
            }
            
        }

        public function fetch_goals($id)
        {
            $sql="SELECT * FROM goals LEFT JOIN category ON goals.cat_id=category.cat_id WHERE goals.user_id=? LIMIT 10";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $fetched = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($fetched) {
                return $fetched;
            } else {
                return false;
            }
            
        }

        public function fetch_goals_cat($id)
        {
            $sql="SELECT * FROM goals LEFT JOIN category ON goals.cat_id=category.cat_id LEFT JOIN activities ON goals.goal_id=activities.goal_id WHERE goals.goal_id=? ORDER BY activity_id  DESC";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $fetched = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fetched) {
                return $fetched;
            } else {
                return false;
            }
            
        }

        public function add_activity($user_id, $goal_id, $activity_amt)
        {
            $sql = "INSERT INTO activities(user_id,goal_id,activity_amt) VALUES(?,?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $added = $stmt->execute([$user_id, $goal_id, $activity_amt]);

            if ($added) {
                return $added;
            } else {
                return false;
            }
            
        }

        public function delete_goal($id){
            $sql = "DELETE FROM goals WHERE goal_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $deleted = $stmt->execute([$id]);

            if ($deleted) {
                return $deleted;
            } else {
                return false;
            }
            
        }

        public function edit_goal($goal_target, $goal_id)
        {
            $sql = 'UPDATE goals SET goal_target = ? WHERE goal_id = ?';
            $stmt = $this->dbconn->prepare($sql);
            $update = $stmt->execute([$goal_target,$goal_id]);

            if ($update) {
                return $update;
            } else {
                return false;
            }
            
        }

        public function update_status($id)
        {
            $query = "UPDATE goals SET goal_status=? WHERE goal_id=?";
            $stmt = $this->dbconn->prepare($query);
            $updated = $stmt->execute(['Completed',$id]);

            if ($updated) {
                return $updated;
            } else{
                return false;
            }
        }
       
    }

    $goal = new Goal();

?>