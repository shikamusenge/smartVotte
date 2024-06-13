<?php
    //code...
    if(file_exists( '../config/database.php'))
    require_once '../config/database.php';
    if(file_exists( '../../config/database.php'))
    require_once '../../config/database.php';

class User extends Database
{

    public function login(array $user): array
    {
        $email = $user['email'];
        $password = $user['password'];
        $conn = $this->getConnection();
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            if (!$result) {
                return ["isLogged" => false, "message" => "Failed to log in. Email not found."];
            }

            // Verify password here
            if (!password_verify($password, $result['password'])) {
                return ["isLogged" => false, "message" => "Failed to log in. Incorrect password."];
            }

            return ["isLogged" => true, "message" => "Logged in successfully","role"=>$result['post'],"user_id"=>$result['user_id'],"account_id"=>$result['account_Id']];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ["isLogged" => false, "message" => "An unexpected error occurred."];
        }
    }
    public function register(array $userData){
       try {
    $accountId = $userData['account'];
    $email = $userData['email'];
    $password = password_hash($userData['password'],PASSWORD_DEFAULT) ;
$conn = $this->getConnection();
    // Use a prepared statement with named parameters
    $query = "INSERT INTO users (email, account_id, password) VALUES (:email, :account_id, :password)";
    $stmt = $conn->prepare($query);

    // Bind parameters with type hints
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':account_id', $accountId, PDO::PARAM_INT);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();
    // Return a success message or a boolean value
    return true;
} catch (PDOException $e) {
    // Log the error or throw a custom exception
    error_log($e->getMessage());
    throw new Exception('Failed to insert user data', 500);
}}
public function changePassword($userId,$newPassword,$oldPassword){
 try {
   $result=["success"=>false,"message"=>"Invalid password provided"];
   $conn=$this->getConnection();
   $query="SELECT * FROM users WHERE user_id=:id";
   $stmt = $conn->prepare($query);
   $stmt->bindParam(':id',$userId,PDO::PARAM_INT);
 $stmt->execute();
   $user=$stmt->fetch();
   if($user){
     if (password_verify($oldPassword, $user['password'])) {
            $password = password_hash($newPassword,PASSWORD_DEFAULT);
            $query="UPDATE users set password=:password WHERE user_id=:id";
            $stmt2 = $conn->prepare($query);
            $stmt2->bindParam(':id',$userId,PDO::PARAM_INT);
            $stmt2->bindParam(':password',$password,PDO::PARAM_STR);
            $stmt2->execute();
            $result=["success"=>true,"message"=>"password changed successfuly"];
            }
   }
   return $result;
 } catch (\Throwable $th) {
    throw $th;
 }
}
}