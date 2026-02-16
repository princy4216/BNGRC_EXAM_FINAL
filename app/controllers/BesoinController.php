<?php
// controllers/BesoinController.php
require_once 'models/BesoinModel.php';
require_once 'models/VilleModel.php';

class BesoinController {
    private $model;
    private $villeModel;

    public function __construct() {
        $this->model = new BesoinModel();
        $this->villeModel = new VilleModel();
    }

    public function liste() {
        $besoins = $this->model->getAll();
        Flight::render('besoins', ['besoins' => $besoins]);
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ville_id = $_POST['ville_id'];
            $type = $_POST['type'];
            $designation = $_POST['designation'];
            $quantite = $_POST['quantite'];
            
            if ($this->model->create($ville_id, $type, $designation, $quantite)) {
                Flight::redirect('/besoins');
            } else {
                $villes = $this->villeModel->getAll();
                Flight::render('besoin_form', [
                    'villes' => $villes,
                    'error' => 'Erreur lors de l\'ajout'
                ]);
            }
        } else {
            $villes = $this->villeModel->getAll();
            Flight::render('besoin_form', ['villes' => $villes]);
        }
    }

    public function editer($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ville_id = $_POST['ville_id'];
            $type = $_POST['type'];
            $designation = $_POST['designation'];
            $quantite = $_POST['quantite'];
            
            if ($this->model->update($id, $ville_id, $type, $designation, $quantite)) {
                Flight::redirect('/besoins');
            } else {
                $besoin = $this->model->getById($id);
                $villes = $this->villeModel->getAll();
                Flight::render('besoin_form', [
                    'besoin' => $besoin,
                    'villes' => $villes,
                    'error' => 'Erreur lors de la modification'
                ]);
            }
        } else {
            $besoin = $this->model->getById($id);
            $villes = $this->villeModel->getAll();
            Flight::render('besoin_form', [
                'besoin' => $besoin,
                'villes' => $villes
            ]);
        }
    }

    public function supprimer($id) {
        if ($this->model->delete($id)) {
            Flight::redirect('/besoins');
        } else {
            Flight::redirect('/besoins?error=suppression');
        }
    }
}
?>