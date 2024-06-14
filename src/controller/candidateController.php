<?php
require_once '../../config/database.php';

class CandidateController extends Database {
    // Register candidate
    public function addCandidate(array $candidate) {
        try {
            $conn = $this->getConnection();
            $fname = $candidate['fname'];
            $lname = $candidate['lname'];
            $dob = $candidate['dob'];
            $nid = $candidate['nid'];
            $party = $candidate['party'];
            $post = $candidate['post'];
            $image = $candidate['image'];
            $sql = "INSERT INTO `candidate` (`first_name`, `last_name`, `dob`, `nid`, `party`, `post`, `image`) VALUES (:fname, :lname, :dob, :nid, :party, :post, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':nid', $nid);
            $stmt->bindParam(':party', $party);
            $stmt->bindParam(':post', $post);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            throw $th;
        }
    }
        //update candidate

    public function updateCandidate($id,array $candidate) {
        try {
            $conn = $this->getConnection();
            $fname = $candidate['fname'];
            $lname = $candidate['lname'];
            $dob = $candidate['dob'];
            $nid = $candidate['nid'];
            $party = $candidate['party'];
            $post = $candidate['post'];
            $cid = $id;
            $sql = "UPDATE `candidate` SET `first_name`= :fname,`last_name`= :lname, `dob` = :dob, `nid`=:nid, `party`=:party, `post`=:post WHERE candidate_id=:cid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':nid', $nid);
            $stmt->bindParam(':party', $party);
            $stmt->bindParam(':post', $post);
            $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            throw $th;
        }
    }

    // Get all candidates with pagination
    public function getAllCandidates($limit, $offset) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare("SELECT * FROM candidate LIMIT :limit OFFSET :offset") or die("failed to load data");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            if (!$result) {
                return [];
            }
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Get candidates by post_id with pagination
    public function getCandidatesByPost($post_id, $limit, $offset) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare("SELECT * FROM candidate WHERE post = :post_id LIMIT :limit OFFSET :offset") or die("failed to load data");
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            if (!$result) {
                return [];
            }
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Approve candidate
    public function approveCandidate($id) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare("UPDATE candidate SET status='approved' WHERE candidate_id=:id") or die("failed to load data");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Reject candidate
    public function rejectCandidate($id) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare("UPDATE candidate SET status='rejected' WHERE candidate_id=:id") or die("failed to load data");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Get single candidate
    public function getCandidate($id) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare("SELECT * FROM candidate WHERE candidate_id=:id") or die("failed to load data");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // DELETE Candidate
    public function deleteCandidate($id) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare('DELETE FROM candidate WHERE candidate_id=:id') or die('');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch(PDOException $th){
            throw $th;
        }
    }
    //
}
?>
