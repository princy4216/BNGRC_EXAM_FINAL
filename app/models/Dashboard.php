<?php
// models/DashboardModel.php
require_once 'config.php';

class DashboardModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getStats() {
        $stats = [];
        
        // Stats villes
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM villes");
        $stats['villes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Stats besoins
        $stmt = $this->db->query("
            SELECT 
                COUNT(*) as total,
                SUM(quantite) as quantite_totale,
                SUM(quantite_restante) as reste_total
            FROM besoins
        ");
        $stats['besoins'] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Stats dons
        $stmt = $this->db->query("
            SELECT 
                COUNT(*) as total,
                SUM(quantite) as quantite_totale,
                SUM(quantite_restante) as reste_total
            FROM dons
        ");
        $stats['dons'] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Stats attributions
        $stmt = $this->db->query("
            SELECT 
                COUNT(*) as total,
                SUM(quantite) as quantite_totale
            FROM attributions
        ");
        $stats['attributions'] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $stats;
    }

    public function getBesoinsNonSatisfaits() {
        $stmt = $this->db->query("
            SELECT b.*, v.nom as ville_nom
            FROM besoins b
            JOIN villes v ON b.ville_id = v.id
            WHERE b.quantite_restante > 0
            ORDER BY b.quantite_restante DESC
            LIMIT 10
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDernieresAttributions() {
        $stmt = $this->db->query("
            SELECT a.*, b.designation as besoin, d.designation as don, v.nom as ville
            FROM attributions a
            JOIN besoins b ON a.besoin_id = b.id
            JOIN dons d ON a.don_id = d.id
            JOIN villes v ON b.ville_id = v.id
            ORDER BY a.date_attribution DESC
            LIMIT 10
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>