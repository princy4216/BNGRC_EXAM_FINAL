<?php
// controllers/AttributionController.php
require_once 'models/AttributionModel.php';
require_once 'models/BesoinModel.php';
require_once 'models/DonModel.php';

class AttributionController {
    private $model;
    private $besoinModel;
    private $donModel;

    public function __construct() {
        $this->model = new AttributionModel();
        $this->besoinModel = new BesoinModel();
        $this->donModel = new DonModel();
    }

    public function index() {
        $attributions = $this->model->getAll();
        Flight::render('attributions', ['attributions' => $attributions]);
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $besoin_id = $_POST['besoin_id'];
            $don_id = $_POST['don_id'];
            $quantite = $_POST['quantite'];
            
            // Vérification des quantités
            $besoin = $this->besoinModel->getById($besoin_id);
            $don = $this->donModel->getById($don_id);
            
            // Règle de gestion: quantité donnée ne doit pas dépasser les dons disponibles
            if ($quantite > $don['quantite_restante']) {
                $besoins = $this->besoinModel->getAll();
                $dons = $this->donModel->getDisponibles();
                Flight::render('attribution_form', [
                    'besoins' => $besoins,
                    'dons' => $dons,
                    'error' => 'Erreur: La quantité donnée (' . $quantite . ') est supérieure au don disponible (' . $don['quantite_restante'] . ')'
                ]);
                return;
            }
            
            // Vérifier qu'on ne donne pas plus que le besoin restant
            if ($quantite > $besoin['quantite_restante']) {
                $besoins = $this->besoinModel->getAll();
                $dons = $this->donModel->getDisponibles();
                Flight::render('attribution_form', [
                    'besoins' => $besoins,
                    'dons' => $dons,
                    'error' => 'Erreur: La quantité donnée (' . $quantite . ') est supérieure au besoin restant (' . $besoin['quantite_restante'] . ')'
                ]);
                return;
            }
            
            // Tout est OK, on procède à l'attribution
            if ($this->model->create($besoin_id, $don_id, $quantite)) {
                // Mise à jour des quantités restantes
                $this->besoinModel->updateQuantiteRestante($besoin_id, $quantite);
                $this->donModel->updateQuantiteRestante($don_id, $quantite);
                Flight::redirect('/attributions');
            } else {
                $besoins = $this->besoinModel->getAll();
                $dons = $this->donModel->getDisponibles();
                Flight::render('attribution_form', [
                    'besoins' => $besoins,
                    'dons' => $dons,
                    'error' => 'Erreur lors de l\'attribution'
                ]);
            }
        } else {
            $besoins = $this->besoinModel->getAll();
            $dons = $this->donModel->getDisponibles();
            Flight::render('attribution_form', [
                'besoins' => $besoins,
                'dons' => $dons
            ]);
        }
    }
}
?>