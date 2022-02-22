<?php
function get_salaire()
{
    return select([
        't' => 'salaire'
    ])[0]->salaire;
}