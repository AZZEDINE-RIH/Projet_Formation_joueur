<?php
class Coach {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getCoachInfo($id) {
        $query = "SELECT * FROM members WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDiplomes($id) {
        $query = "SELECT * FROM diplomes WHERE coach_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSpecialisations($id) {
        $query = "SELECT * FROM specialisations WHERE coach_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarriere($id) {
        $query = "SELECT * FROM carriere WHERE coach_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
