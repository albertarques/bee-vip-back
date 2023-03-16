<?php

// Rutas públicas
require __DIR__.'/public_routes.php';

// Rutas con autenticación JWT
require __DIR__.'/jwt_routes.php';

// Rutas con autenticación y permisos de Spatie
require __DIR__.'/private_routes.php';
