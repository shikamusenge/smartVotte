<?php
require_once '../../config/database.php';
class ReportController extends Database{
  
    public function getPostsData() {
       try {
        $conn = $this->getConnection();
$query = "
    SELECT p.post_id, p.title, p.Description, p.date, p.status, c.first_name AS candidate_first_name, c.last_name AS candidate_last_name, COUNT(v.vts_id) AS vote_count FROM posts p JOIN vottes v ON p.post_id = v.post JOIN candidate c ON v.candidate = c.candidate_id GROUP BY p.post_id, c.candidate_id;
";
$stmt = $conn->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $results;
       } catch (\Throwable $th) {
        throw $th;
       }
    }

}
?>