<?php
// models/VilleModel.php
require_once 'config.php';

class VilleModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM villes ORDER BY nom");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM villes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom, $region) {
        $stmt = $this->db->prepare("INSERT INTO villes (nom, region) VALUES (?, ?)");
        return $stmt->execute([$nom, $region]);
    }

    public function update($id, $nom, $region) {
        $stmt = $this->db->prepare("UPDATE villes SET nom = ?, region = ? WHERE id = ?");
        return $stmt->execute([$nom, $region, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM villes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>