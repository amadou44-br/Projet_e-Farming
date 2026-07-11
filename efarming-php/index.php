<?php


session_start();

require_once __DIR__ . '/config/database.php';

spl_autoload_register(function ($classe) {
    $chemins = [
        __DIR__ . '/app/models/' . $classe . '.php',
        __DIR__ . '/app/controllers/' . $classe . '.php',
    ];
    foreach ($chemins as $chemin) {
        if (file_exists($chemin)) {
            require_once $chemin;
            return;
        }
    }
});

require_once __DIR__ . '/routes/web.php';

$route = $_GET['route'] ?? 'dashboard/index';

if (isset($routes[$route])) {
    [$controleur, $action] = $routes[$route];

    if (class_exists($controleur) && method_exists($controleur, $action)) {
        $instance = new $controleur();
        $instance->$action();
    } else {
        http_response_code(500);
        echo "Erreur : contrôleur ou action introuvable ($controleur -> $action)";
    }
} else {
    http_response_code(404);
    echo "Page introuvable.";
}
