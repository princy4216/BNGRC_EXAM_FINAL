<?php
// controllers/VilleController.php
require_once 'models/VilleModel.php';

class VilleController {
    private $model;

    public function __construct() {
        $this->model = new VilleModel();
    }

    public function liste() {
        $villes = $this->model->getAll();
        Flight::render('villes', ['villes' => $villes]);
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $region = $_POST['region'];
            
            if ($this->model->create($nom, $region)) {
                Flight::redirect('/villes');
            } else {
                Flight::render('ville_form', ['error' => 'Erreur lors de l\'ajout']);
            }
        } else {
            Flight::render('ville_form');
        }
    }

    public function editer($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $region = $_POST['region'];
            
            if ($this->model->update($id, $nom, $region)) {
                Flight::redirect('/villes');
            } else {
                $ville = $this->model->getById($id);
                Flight::render('ville_form', ['ville' => $ville, 'error' => 'Erreur lors de la modification']);
            }
        } else {
            $ville = $this->model->getById($id);
            Flight::render('ville_form', ['ville' => $ville]);
        }
    }

    public function supprimer($id) {
        if ($this->model->delete($id)) {
            Flight::redirect('/villes');
        } else {
            Flight::redirect('/villes?error=suppression');
        }
    }
}
?>