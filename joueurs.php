<?php
// Player.php
require_once 'conn.php';

class Player {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllPlayers($filter = null) {
        try {
            $query = "SELECT * FROM joueurs";
            if ($filter && $filter !== 'all') {
                $query .= " WHERE status = :status";
            }
            $query .= " ORDER BY performance DESC";

            $stmt = $this->db->prepare($query);
            if ($filter && $filter !== 'all') {
                $stmt->bindParam(':status', $filter);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    public function getPlayerById($id) {
        try {
            $query = "SELECT * FROM joueurs WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    public function updatePlayerStatus($id, $status) {
        try {
            $query = "UPDATE joueurs SET status = :status WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function updatePlayerPerformance($id, $physicalCondition, $performanceScore, $weeklyChange) {
        try {
            $query = "UPDATE joueurs SET 
                     physical_condition = :physical_condition,
                     performance = :performance_score,
                     changement_performance = :weekly_change 
                     WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':physical_condition', $physicalCondition);
            $stmt->bindParam(':performance', $performanceScore);
            $stmt->bindParam(':weekly_change', $weeklyChange);
            $stmt->bindParam(':id', $id);
            
            return $stmt->execute();
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function getStatistics() {
        try {
            $stats = [];
            
            // Nombre de joueurs actifs
            $stmt = $this->db->query("SELECT COUNT(*) FROM joueurs WHERE status = 'active'");
            $stats['active_players'] = $stmt->fetchColumn();
            
            // Nombre de joueurs blessés
            $stmt = $this->db->query("SELECT COUNT(*) FROM joueurs WHERE status = 'blessee'");
            $stats['injured_players'] = $stmt->fetchColumn();
            
            // Performance moyenne
            $stmt = $this->db->query("SELECT AVG(performance) FROM joueurs");
            $stats['avg_performance'] = round($stmt->fetchColumn(), 0);
            
             // Nombre de matchs à venir
             $stmt = $this->db->query("SELECT COUNT(*) FROM matches WHERE match_date > CURRENT_DATE");
             $stats['upcoming_matches'] = $stmt->fetchColumn();
            
            return $stats;
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
}