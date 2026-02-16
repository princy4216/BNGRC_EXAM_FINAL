<?php
// controllers/DashboardController.php
require_once 'models/DashboardModel.php';
require_once 'models/AttributionModel.php';

class DashboardController {
    private $model;
    private $attributionModel;

    public function __construct() {
        $this->model = new DashboardModel();
        $this->attributionModel = new AttributionModel();
    }

    public function index() {
        $stats = $this->model->getStats();
        $statsParVille = $this->attributionModel->getStatsByVille();
        $besoinsNonSatisfaits = $this->model->getBesoinsNonSatisfaits();
        $dernieresAttributions = $this->model->getDernieresAttributions();
        
        Flight::render('tableau_bord', [
            'stats' => $stats,
            'statsParVille' => $statsParVille,
            'besoinsNonSatisfaits' => $besoinsNonSatisfaits,
            'dernieresAttributions' => $dernieresAttributions
        ]);
    }
}
?>