<?php

/**
 * Permet de supprimer un ou plusieurs enregistrements d'une table.  
 * Prends en paramètre un tableau :
 * - 't' : la table depuis laquelle supprimer l'enregistrement, au format 'database.table' ou 'database/table'
 * - 'w' : une fonction permettant de filtrer les enregistrements. La fonction prend en paramètre chaque enregistrement : si la fonction retourne ***true***, l'enregistrement sera supprimer, sinon il sera ignoré
 *
 * @param  [string,function] $u_params Voir description
 */
function delete($u_params)
{
    $d_params = [
        'w' => function(){ return false; }
    ];
    $params = array_replace_recursive($d_params,$u_params);
    $params = (object) $params;

    $table = $params->t;
    list($before) = gtd($table,'data');
    $after = array_filter($before,function($item) use($params)
    {
        return !call_user_func($params->w,$item);
    });
    $after = array_values($after);
    majtd($table,'data',$after);
}