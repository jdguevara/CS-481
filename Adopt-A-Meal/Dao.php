<?php
require_once 'KLogger.php';
date_default_timezone_set('America/Denver');

class Dao {

    private $host = "qs4006.pair.com";
    private $db = "tfdesign_adoptamealdev";
    private $user = "tfdesign_218";
    private $pass = "fk9we7E7M2D7Bvnx8jWB";
    private $log;

    public function __construct () {
        $this->log = new KLogger("log.txt", KLogger::INFO);
    }

    public function getConnection () {
        try {
            $conn= new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
                $this->pass);
        } catch (Exception $e) {
            $this->log->LogFatal($e);
        }
        return $conn;
    }

    public function checkDuplicateUser($username, $email) {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT 1 FROM users WHERE username= :username and email= :email";
            $q = $conn->prepare($sql);
            $q->bindParam(":username", $username);
            $q->bindParam(":email", $email);
            $q->execute();
            if($q->rowCount() == 1) {
                return 1;
            } else if ($q->rowCount() > 1) {
                echo "<script type='text/javascript'>alert('Duplicates in DB');</script>";
                exit;
            }
        } catch (Exception $e) {
            $this->log->LogFatal($e);
        }
        return 0;
    }

    public function userExists($username, $password) {
        try{
            $conn = $this->getConnection();
            $hash = hash("sha256", $password . "fKd93Vmz!k*dAv5029Vkf9$3Aa");
            $sql = "SELECT 1 FROM users WHERE username= :username and password= :hash";
            $q = $conn->prepare($sql);
            $q->bindParam(":username", $username);
            $q->bindParam(":hash", $hash);
            $q->execute();
            if ($q->rowCount() == 1) {
                $this->log->LogInfo("User logged in:[{$username}] [" . date("Y-m-d h:i:s A"). "]");
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            $this->log->LogFatal($e);
        }
        return 0;
    }

    public function createUser ($username, $email, $password) {
        $this->log->LogInfo("User created:[{$username}] [{$email}] [" . date("Y-m-d h:i:s A"). "]");
        $conn = $this->getConnection();
        $hash = hash("sha256", $password . "fKd93Vmz!k*dAv5029Vkf9$3Aa");
        $saveQuery =
            "INSERT INTO users 
            (username, email, password)
            VALUES
            (:username, :email, :hash)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":username", $username);
        $q->bindParam(":email", $email);
        $q->bindParam(":hash", $hash);
        $q->execute();
    }

    public function getProjects ($user) {
        $this->log->LogDebug("Getting {$user}'s projects");
        $conn = $this->getConnection();
        $sql = "select * from project where collaborators like concat('%', :user, '%')";
        $q = $conn->prepare($sql);
        $q->bindParam(":user", $user);
        $q->execute();
        // For the moment get what we have in the user's table, need to get some dummy projects in the projects table
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMyProjects ($user) {
        $this->log->LogDebug("Getting {$user}'s projects");
        $conn = $this->getConnection();
        $sql = "select * from project where user_ID = (select ID from users where username = :user) order by ID;";
        $q = $conn->prepare($sql);
        $q->bindParam(":user", $user);
        $q->execute();
        // For the moment get what we have in the user's table, need to get some dummy projects in the projects table
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSharedProjects ($user) {
        $this->log->LogDebug("Getting shared projects");
        $conn = $this->getConnection();
        $sql = "select * from project where collaborators like concat('%', :user, '%') and project_owner != :user;";
        $q = $conn->prepare($sql);
        $q->bindParam(":user", $user);
        $q->execute();
        // For the moment get what we have in the user's table, need to get some dummy projects in the projects table
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveProject ($project, $owner, $program_language, $program) {
        $this->log->LogInfo("Saving project:[{$project}]");
        $conn = $this->getConnection();
        $saveQuery =
            "INSERT INTO project 
            (user_ID, project_name, project_owner, date_modified, collaborators, program_language, program)
            VALUES
            ((select ID from users where username = :user), :project_name, :project_owner, now(), :project_owner, :program_language, :program)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":user", $owner);
        $q->bindParam(":project_name", $project);
        $q->bindParam(":project_owner", $owner);
        $q->bindParam(":program_language", ucfirst($program_language));
        $q->bindParam(":program", $program);
        $q->execute();
    }

    public function getSavedProject($user, $project_name) {
        $this->log->LogInfo("Fetching project:[{$project_name}]");
        $conn = $this->getConnection();
        $sql = "select * from project where user_ID = (select ID from users where username = :user) and project_name = :project_name";
        $q = $conn->prepare($sql);
        $q->bindParam(":user", $user);
        $q->bindParam(":project_name", $project_name);
        $q->execute();
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
}
