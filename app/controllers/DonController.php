<?php
// controllers/DonController.php
require_once 'models/DonModel.php';

class DonController {
    private $model;

    public function __construct() {
        $this->model = new DonModel();
    }

    public function liste() {
        $dons = $this->model->getAll();
        Flight::render('dons', ['dons' => $dons]);
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'];
            $designation = $_POST['designation'];
            $quantite = $_POST['quantite'];
            
            if ($this->model->create($type, $designation, $quantite)) {
                Flight::redirect('/dons');
            } else {
                Flight::render('don_form', ['error' => 'Erreur lors de l\'ajout']);
            }
        } else {
            Flight::render('don_form');
        }
    }

    public function editer($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'];
            $designation = $_POST['designation'];
            $quantite = $_POST['quantite'];
            
            if ($this->model->update($id, $type, $designation, $quantite)) {
                Flight::redirect('/dons');
            } else {
                $don = $this->model->getById($id);
                Flight::render('don_form', [
                    'don' => $don,
                    'error' => 'Erreur lors de la modification'
                ]);
            }
        } else {
            $don = $this->model->getById($id);
            Flight::render('don_form', ['don' => $don]);
        }
    }

    public function supprimer($id) {
        if ($this->model->delete($id)) {
            Flight::redirect('/dons');
        } else {
            Flight::redirect('/dons?error=suppression');
        }
    }
}
?>