<?php
require_once '../../config/database.php';
class VoterController extends Database{
    // register votter
    public function register(array $votter) {
    try {
            $conn = $this->getConnection();
            $fname=$votter['fname'];
            $lname=$votter['lname'];
            $dob=$votter['dob'];
            $nid=$votter['nid'];
            $phone=$votter['phone'];
            $sql = "INSERT INTO `votter`( `first_name`, `last_name`, `dob`, `nid`, `phoneNumber`) VALUES (:fname,:lname,:dob,:nid,:phone)"; 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':nid', $nid);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
         return $conn->lastInsertId();
        } catch (PDOException $th) {
            throw $th;
        }
   
     
    }
// get all votters 
  public function getAllVotters($limit = 10, $offset = 0)
{
    try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM votter LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: [];
    } catch (PDOException $e) {
        // Log the error or perform some other error handling mechanism
        // For example:
        error_log("Error retrieving voters: " . $e->getMessage());
        return []; // return an empty array to avoid exposing the error to the caller
    }
}

public function getTotalVotters() {
try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total_voters FROM votter");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total_voters'];
    } catch (PDOException $e) {
        error_log("Error retrieving voters: " . $e->getMessage());
    }
}
    /// approve votter
    public function approveVotter($id) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE votter SET status='approved' WHERE votter_id=:id") or die("failled to load data");
        $stmt2 = $conn->prepare("UPDATE users SET status=1 WHERE account_id=:id") or die("failled to load data");
        $stmt->bindParam(':id',$id);
        $stmt2->bindParam(':id',$id);
        $stmt->execute();
        $stmt2->execute();
        return true;
       } catch (\Throwable $th) {
        throw $th;
       }
    }
    /// reject votter
    public function rejectVotter($id) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("UPDATE votter SET status='rejected' WHERE votter_id=:id") or die("failled to load data");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return true;
       } catch (\Throwable $th) {
        //throw $th;
       }
    }

    // get single votter
    public function getSingleVoter($id) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM votter WHERE votter_id=:id") or die("failled to load data");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
       } catch (\Throwable $th) {
        throw $th;
       }
    }

    public function getPostsDetails($votter) {
       try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT title,posts.post_id postId, Description,posts.status post_status,COUNT(post_id) total_candidate FROM `posts` INNER JOIN candidate WHERE posts.post_id NOT IN (SELECT post FROM vottes WHERE votter = :votterId) AND candidate.post=posts.post_id GROUP BY candidate.post") or die("failled to load data");
        $stmt->bindParam(":votterId",$votter);
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
   public function getPostsCandidates($post){
    try {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM candidate WHERE post = :id") or die("failled to load data");
        $stmt->bindParam(":id",$post);
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
   public function vote($post,$votter,$candidate){
    try {
            $conn = $this->getConnection();
            $sql = "INSERT INTO `vottes`(`votter`, `post`, `candidate`)  VALUES (:votter,:post,:candidate)"; 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':votter', $votter);
            $stmt->bindParam(':post', $post);
            $stmt->bindParam(':candidate', $candidate);
            $stmt->execute();
         return true;
        } catch (PDOException $th) {
            throw $th;
        }
   }
   //delete
public   function deleteVotter($id) {
    $conn = $this->getConnection();
  $stmt = $conn->prepare("DELETE FROM votter WHERE votter_id=?");
 $stmt2=$conn->prepare('DELETE FROM users WHERE account_id=?') or die('');
 $stmt2->execute([$id]);
        return $stmt->execute([$id]);
   }
   // update 
 public   function updateVoter(array $data) {
    $conn = $this->getConnection();
     $stmt = $conn->prepare("
            UPDATE votter SET 
                first_name = ?, 
                last_name = ?, 
                dob = ?, 
                nid = ?, 
                phoneNumber = ? 
                WHERE votter_id=?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['dob'],
            $data['nid'],
            $data['phoneNumber'],
            $data['votter_id'],
        ]);
   }


}
?>