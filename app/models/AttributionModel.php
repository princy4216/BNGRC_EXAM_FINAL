<?php
// models/AttributionModel.php
require_once 'config.php';

class AttributionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT a.*, 
                   b.designation as besoin_designation, b.type as besoin_type,
                   d.designation as don_designation, d.type as don_type,
                   v.nom as ville_nom
            FROM attributions a
            JOIN besoins b ON a.besoin_id = b.id
            JOIN dons d ON a.don_id = d.id
            JOIN villes v ON b.ville_id = v.id
            ORDER BY a.date_attribution DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByBesoin($besoin_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM attributions 
            WHERE besoin_id = ? 
            ORDER BY date_attribution DESC
        ");
        $stmt->execute([$besoin_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($besoin_id, $don_id, $quantite) {
        $stmt = $this->db->prepare("
            INSERT INTO attributions (besoin_id, don_id, quantite) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$besoin_id, $don_id, $quantite]);
    }

    public function getStatsByVille() {
        $stmt = $this->db->query("
            SELECT 
                v.id,
                v.nom,
                v.region,
                COALESCE(SUM(b.quantite), 0) as total_besoins,
                COALESCE(SUM(a.quantite), 0) as total_dons_recus,
                COUNT(DISTINCT b.id) as nombre_besoins
            FROM villes v
            LEFT JOIN besoins b ON v.id = b.ville_id
            LEFT JOIN attributions a ON b.id = a.besoin_id
            GROUP BY v.id, v.nom, v.region
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>