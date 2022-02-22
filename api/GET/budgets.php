<?php
function get_all()
{
    $budgets = select([
        't' => 'budgets',
        'o' => ['ordre:asc']
    ]);
    echo json_encode(result($budgets));
}