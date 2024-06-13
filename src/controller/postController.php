<?php
require_once '../../config/database.php';
class PostController extends Database{
    // register posts
    public function registerPost($title,$desc,$date) {
    try {
            $conn = $this->getConnection();
            $sql = "INSERT INTO `posts`( `title`, `Description`, `date`)  VALUES (:title,:description,:date)"; 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $desc);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
         return true;
        } catch (PDOException $th) {
            throw $th;
        }
   
     
    }
    // update posts
    public function editPost($id,$title,$desc,$date) {
    try {
            $conn = $this->getConnection();
            $sql = "UPDATE `posts` set `title`=:title, `Description`=:description, `date`=:date WHERE post_id=:id"; 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $desc);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
         return true;
        } catch (PDOException $th) {
            throw $th;
        }
   
     
    }
// get all postss 
    public function getAllPosts() {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM posts") or die("failled to load data");
        $stmt->execute();
        $result=$stmt->fetchAll();
        if(!$result){
            return [];
        }
        return $result;
       } catch (\Throwable $th) {
        throw $th;
       }
    }

    /// set posts ready
    public function setPostReady($id) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE posts SET status='ready' WHERE post_id=:id") or die("failled to load data");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return true;
       } catch (\Throwable $th) {
        throw $th;
       }
    }
    /// close posts
    public function closePost($id) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE posts SET status='CLOSED' WHERE post_id=:id") or die("failled to load data");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return true;
       } catch (\Throwable $th) {
        throw $th;
       }
    }

    // get single posts
    public function getpost($id) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id=:id") or die("failled to load data");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetch();
        if(!$result){
            return [];
        }
        return $result;
       } catch (\Throwable $th) {
        throw $th;
       }
    }
   public function getActivePosts(){
    try{
      $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT post_id id,title FROM posts WHERE status='onhold'") or die("failled to load data");
        $stmt->execute();
        $result=$stmt->fetchAll();
        if(!$result){
            return [];
        }
        return $result;
       } catch (\Throwable $th) {
        throw $th;
       }
    }
}
?>