<?php
function error()
{
    echo json_encode([
        'message' => 'Erreur : le fichier demandé n\'existe pas'
    ]);
}