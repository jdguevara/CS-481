<?php

class Dao {
//   private $host = "localhost";
//    private $db = "adoptameal";
//    private $user = "root";
//    private $pass = "root";
    private $host = "qs4006.pair.com";
    private $db = "tfdesign_adoptamealdev";
    private $user = "tfdesign_218";
    private $pass = "fk9we7E7M2D7Bvnx8jWB";

    public function getConnection () {
        try {
            $conn= new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
                $this->pass);
        } catch (Exception $e) {
            // $this->log->LogFatal($e);
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

    public function addAdmin($username, $email, $password, $permission){
        $conn = $this->getConnection();
        $hash = sha1($password . $username);
        $saveQuery =
        "INSERT INTO users
        (name, email, password, super_user)
        VALUES
        (:username, :email, :password, $permission)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":username", $username);
        $q->bindParam(":email", $email);
        $q->bindParam(":password", $hash);
        $q->execute();
    }

    public function deleteAdmin($id){
        $conn = $this->getConnection();
        $saveQuery = "DELETE FROM users WHERE id = $id";

        $q = $conn->prepare($saveQuery);
        return $q->execute();
    }

    public function adminValidation ($username, $password) {
        $hash = sha1($password . $username);
        $conn = $this->getConnection();
        $query = "SELECT * FROM users WHERE name=:username and password=:hash";

        $q = $conn->prepare($query);
        $q->bindParam(":username", $username);
        $q->bindParam(":hash", $hash);
        $q->execute();
    
        // $result = $conn->query($query);
        $count = $q->rowCount();
        if($count == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkUsername ($username) {
        $conn = $this->getConnection();
        $query = "SELECT * FROM users WHERE name='$username'";
    
        $result = $conn->query($query);
        $count = $result->rowCount();
        if($count > 0){
            return true;
        }
        else{
            return false;
        }
      }

    public function checkPermissions ($username) {
        $conn = $this->getConnection();
        return $conn->query("SELECT super_user FROM users WHERE name = '$username'")->fetchObject()->super_user;  
    }
    

    public function changePermission($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE users
        SET super_user = 1
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute(); 
    }
    
    public function getAdmins () {
        $conn = $this->getConnection();
        return $conn->query("select id, name, email, super_user from users", PDO::FETCH_ASSOC);
    }

    public function getID($username){
        $conn = $this->getConnection();
        return $conn->query("SELECT id FROM users WHERE name = '$username'")->fetchObject()->id;  
    }

    public function getPassword($username){
        $conn = $this->getConnection();
        return $conn->query("SELECT password FROM users WHERE name = '$username'")->fetchObject()->password;  
    }
    
    public function changePassword ($id, $username, $password) {
        $hash = sha1($password . $username);
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE users
        SET password = '$hash'
        WHERE  id = $id AND name = '$username'";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function mealIdea($title, $description, $ingredients, $instructions, $external_link, $name, $email){
        $conn = $this->getConnection();
        $saveQuery =
        "INSERT INTO meal_ideas
        (title, description, ingredients, instructions, external_link, name, email, meal_idea_status)
        VALUES
        (:title, :description, :ingredients, :instructions, :external_link, :name, :email, 0)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":title", $title);
        $q->bindParam(":description", $description);
        $q->bindParam(":ingredients", $ingredients);
        $q->bindParam(":instructions", $instructions);
        $q->bindParam(":external_link", $external_link);
        $q->bindParam(":name", $name);
        $q->bindParam(":email", $email);
        $q->execute();
    }

    public function getMealIdeas () {
        $conn = $this->getConnection();
        return $conn->query("select id, title, description, ingredients, instructions, external_link, name, email, meal_idea_status from meal_ideas", PDO::FETCH_ASSOC);
    }

    public function acceptMealIdea ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE meal_ideas
        SET meal_idea_status = 1
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function rejectMealIdea ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE meal_ideas
        SET meal_idea_status = 2
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function restoreMealIdea ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE meal_ideas
        SET meal_idea_status = 0
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function deleteMealIdea ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "DELETE FROM meal_ideas
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function getAcceptedMealIdeas(){
        $conn = $this->getConnection();
        return $conn->query("select title, description, ingredients, instructions from meal_ideas where meal_idea_status = 1", PDO::FETCH_ASSOC);
    }

    public function addVolunteer($organization_name, $email, $phone, $meal_description, $notes, $paper_goods, $event_date_time){
        $conn = $this->getConnection();
        $saveQuery =
        "INSERT INTO volunteer_forms
        (organization_name, email, phone, meal_description, notes, paper_goods, event_date_time, form_status)
        VALUES
        (:organization_name, :email, :phone, :meal_description, :notes, :paper_goods, :event_date_time, 0)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":organization_name", $organization_name);
        $q->bindParam(":email", $email);
        $q->bindParam(":phone", $phone);
        $q->bindParam(":meal_description", $meal_description);
        $q->bindParam(":notes", $notes);
        $q->bindParam(':paper_goods', $paper_goods);
        $q->bindParam(":event_date_time", $event_date_time);
        $q->execute();
    }

    public function acceptVolunteer ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE volunteer_forms
        SET form_status = 1
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function rejectVolunteer ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE volunteer_forms
        SET form_status = 2
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }
    
    public function restoreVolunteer ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE volunteer_forms
        SET form_status = 0
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function deleteVolunteer ($id) {
        $conn = $this->getConnection();
        $saveQuery =
        "DELETE FROM volunteer_forms
        WHERE  id = $id";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    
    public function rejectNonAcceptedVolunteers ($id, $date) {
        $conn = $this->getConnection();
        $saveQuery =
        "UPDATE volunteer_forms
        SET form_status = 2
        WHERE  event_date_time = '$date' AND id != $id";
        $q = $conn->prepare($saveQuery);
        
        return $q->execute();
    }
    
    public function getVolunteerEmail($id){
        $conn = $this->getConnection();
        return $conn->query("SELECT email from volunteer_forms WHERE id = $id")->fetchObject()->email;
    }

    public function getVolunteers () {
        $conn = $this->getConnection();
        return $conn->query("select id, organization_name, email, phone, meal_description, notes, paper_goods, form_status, event_date_time from volunteer_forms", PDO::FETCH_ASSOC);
    }

    public function getVolunteerDates () {
        $conn = $this->getConnection();
        return $conn->query("select id, date from volunteer_dates", PDO::FETCH_ASSOC);
    }

    public function getVolunteerDateByID ($id) {
        $conn = $this->getConnection();
        return $conn->query("SELECT event_date_time from volunteer_forms WHERE id = $id")->fetchObject()->event_date_time;
    }

    public function getDateByID ($id) {
        $conn = $this->getConnection();
        return $conn->query("SELECT date from volunteer_dates WHERE id = $id")->fetchObject()->date;
    }

    public function removeDate ($date) {
        $conn = $this->getConnection();
        $saveQuery =
        "DELETE FROM volunteer_dates
        WHERE  date = '$date'";
        $q = $conn->prepare($saveQuery);

        return $q->execute();
    }

    public function addVolunteerDate($date){
        $conn = $this->getConnection();
        $saveQuery =
        "INSERT INTO volunteer_dates
        (date)
        VALUES
        ('$date')";
        $q = $conn->prepare($saveQuery);
        $q->execute();
    }

    public function removeVolunteerDate($date){
        $conn = $this->getConnection();
        $saveQuery =
        "DELETE FROM volunteer_dates
        WHERE date = '$date'";
        $q = $conn->prepare($saveQuery);
        $q->execute();
    }
    
}
