<?php

/**
 * Insert l'enregistrement $record dans la table $dbDotTable.
 * L'enregistrement DOIT AVOIR un champ 'id'
 *
 * @param  string $dbDotTable La table dans laquelle insérer l'enregistrement, au format 'database.table' ou 'database/table'
 * @param  object $record L'enregistrement à insérer dans la table
 * @return void
 */
function insert($table,$object)
{
    list($before,$liid) = gtd($table,'data,liid');
    $liid++;
    $object->id = $liid;
    $before[] = $object;
    majtd($table,'data,liid',$before,$liid);
}