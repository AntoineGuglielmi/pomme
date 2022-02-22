<?php
function home()
{
    echo json_encode([
        'message' => 'Ça marche !'
    ]);
}

function vueDEnsemble()
{
    $result = [];
    $result['salaire'] = get_salaire();

    echo '<pre>';
    var_dump($result);
    echo '</pre>';
}