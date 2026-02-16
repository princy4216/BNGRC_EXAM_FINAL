<?php
// index.php - Point d'entrée principal
require_once __DIR__ . '/config.php';

// Chargement automatique des classes
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/controllers/' . $class . '.php',
        __DIR__ . '/models/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Configuration de Flight
Flight::set('flight.views.path', __DIR__ . '/views');
Flight::set('flight.log_errors', true);

// Routes pour les villes
Flight::route('/villes', 'VilleController@liste');
Flight::route('/villes/ajouter', 'VilleController@ajouter');
Flight::route('/villes/editer/@id', 'VilleController@editer');
Flight::route('/villes/supprimer/@id', 'VilleController@supprimer');

// Routes pour les besoins
Flight::route('/besoins', 'BesoinController@liste');
Flight::route('/besoins/ajouter', 'BesoinController@ajouter');
Flight::route('/besoins/editer/@id', 'BesoinController@editer');
Flight::route('/besoins/supprimer/@id', 'BesoinController@supprimer');

// Routes pour les dons
Flight::route('/dons', 'DonController@liste');
Flight::route('/dons/ajouter', 'DonController@ajouter');
Flight::route('/dons/editer/@id', 'DonController@editer');
Flight::route('/dons/supprimer/@id', 'DonController@supprimer');

// Routes pour les attributions
Flight::route('/attributions', 'AttributionController@index');
Flight::route('/attributions/ajouter', 'AttributionController@ajouter');

// Route pour le tableau de bord (page d'accueil)
Flight::route('/', 'DashboardController@index');
Flight::route('/tableau-bord', 'DashboardController@index');

// Layout personnalisé
Flight::map('render', function($template, $data){
    // S'assurer que le dossier layout existe
    $headerPath = __DIR__ . '/views/layout/header.php';
    $footerPath = __DIR__ . '/views/layout/footer.php';
    
    if (file_exists($headerPath)) {
        Flight::render('layout/header', $data);
    }
    
    Flight::render($template, $data);
    
    if (file_exists($footerPath)) {
        Flight::render('layout/footer', $data);
    }
});

// Démarrage de l'application
Flight::start();
?>