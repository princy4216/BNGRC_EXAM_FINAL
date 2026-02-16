<?php
// models/DonModel.php
require_once 'config.php';

class DonModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM dons ORDER BY date_don DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM dons WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($type, $designation, $quantite) {
        $stmt = $this->db->prepare("
            INSERT INTO dons (type, designation, quantite, quantite_restante) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$type, $designation, $quantite, $quantite]);
    }

    public function update($id, $type, $designation, $quantite) {
        $stmt = $this->db->prepare("
            UPDATE dons 
            SET type = ?, designation = ?, quantite = ?,
                quantite_restante = quantite_restante + (? - quantite)
            WHERE id = ?
        ");
        return $stmt->execute([$type, $designation, $quantite, $quantite, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM dons WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateQuantiteRestante($don_id, $quantite_attribuee) {
        $stmt = $this->db->prepare("
            UPDATE dons 
            SET quantite_restante = quantite_restante - ? 
            WHERE id = ?
        ");
        return $stmt->execute([$quantite_attribuee, $don_id]);
    }

    public function getDisponibles() {
        $stmt = $this->db->query("
            SELECT * FROM dons 
            WHERE quantite_restante > 0 
            ORDER BY date_don DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>