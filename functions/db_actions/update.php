<?php

/**
 * Permet de modifier un ou plusieurs enregistrements d'une table.  
 * Prends en paramètre un tableau :
 * - 't' : la table dans laquelle modifier l'enregistrement, au format 'database.table' ou 'database/table'
 * - 'w' : une fonction permettant de filtrer les enregistrements. La fonction prend en paramètre chaque enregistrement : si la fonction retourne ***true***, l'enregistrement sera modifier, sinon il sera ignoré
 * - 's' : modificateur de l'enregistrement. Peut être  un tableau de paires ***champ*** => ***valeur*** ou une fonction prenant en paramètre chaque enregistrement
 *
 * @param  mixed $u_params
 */
function update($u_params = [])
{
    $d_params = [
        'w' => function(){ return true; },
        's' => function(){ return; }
    ];
    $params = array_replace_recursive($d_params,$u_params);
    $params = (object) $params;
    
    $table = $params->t;

    list($tableRecords) = gtd($table,'data');
    array_walk($tableRecords,function(&$item) use($params)
    {
        $sType = gettype($params->s);
        if(call_user_func($params->w,$item))
        {
            switch($sType)
            {
                case 'object':
                    call_user_func($params->s,$item);
                    break;
                case 'array':
                    foreach($params->s as $k => $v)
                    {
                        $item->$k = $v;
                    }
                    break;
            }
        }
    });
    majtd($table,'data',$tableRecords);
}