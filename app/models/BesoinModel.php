<?php
// models/BesoinModel.php
require_once 'config.php';

class BesoinModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT b.*, v.nom as ville_nom, v.region 
            FROM besoins b
            JOIN villes v ON b.ville_id = v.id
            ORDER BY b.date_besoin DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByVille($ville_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM besoins 
            WHERE ville_id = ? 
            ORDER BY date_besoin DESC
        ");
        $stmt->execute([$ville_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT b.*, v.nom as ville_nom 
            FROM besoins b
            JOIN villes v ON b.ville_id = v.id
            WHERE b.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($ville_id, $type, $designation, $quantite) {
        $stmt = $this->db->prepare("
            INSERT INTO besoins (ville_id, type, designation, quantite, quantite_restante) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$ville_id, $type, $designation, $quantite, $quantite]);
    }

    public function update($id, $ville_id, $type, $designation, $quantite) {
        $stmt = $this->db->prepare("
            UPDATE besoins 
            SET ville_id = ?, type = ?, designation = ?, quantite = ?, 
                quantite_restante = quantite_restante + (? - quantite)
            WHERE id = ?
        ");
        return $stmt->execute([$ville_id, $type, $designation, $quantite, $quantite, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM besoins WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateQuantiteRestante($besoin_id, $quantite_attribuee) {
        $stmt = $this->db->prepare("
            UPDATE besoins 
            SET quantite_restante = quantite_restante - ? 
            WHERE id = ?
        ");
        return $stmt->execute([$quantite_attribuee, $besoin_id]);
    }
}
?>