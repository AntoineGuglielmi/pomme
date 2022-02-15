<?php

/**
 * Permet de sélectionner tout ou partie des enregistrements d'une table.  
 * Prends en paramètre un tableau :
 * - 'c' : les colonnes de la table à sélectionner, sous la forme d'une chaîne de caractère regroupant les noms des colonnes séparés par une virgule. Par défaut : '*' (tous)
 * - 't' : la table dans laquelle effectuer la sélection, au format 'database.table' ou 'database/table'
 * - 'w' : une fonction permettant de filtrer les enregistrements. La fonction prend en paramètre chaque enregistrement : si la fonction retourne ***true***, l'enregistrement sera sélectionner, sinon il sera ignoré
 * - 'm' : une fonction permettant de modifier l'enregistrement avant sa sélection, par exemple pour ajouter un champ ou une colonne. La fonction prend en paramètre chaque enregistrement
 * - 'o' : un tableau de chaînes de caractères définissant les règles du tri des résultats. Les règles sont au format ***champ***:***direction***, le ***champ*** étant l'une des propriétés des enregistrements et la ***direction*** étant 'asc' ou 'desc'
 * - 'l (L minuscule)' : une chaîne de caractères définissant le nombre limite de résultats, au format ***quantité***:***décalage_compris***. Exemple : '2:3' sélectionnera les 2 premiers résultats à partir du 3ème compris ; '2' sélectionnera les 2 premiers résultats sans décalage
 * - 'i' : une chaîne de caractères définissant la class de l'objet à retourner
 * 
 * @param  [string,string,function,function,string[],string] $u_params Voir description
 */
function select($u_params = [])
{
    $output = [];
    
    $d_params = [
        'c' => '*',
        'w' => function(){ return true; },
        'm' => function(){ return; },
        'o' => null,
        'l' => null,
        'i' => 'stdClass'
    ];
    $params = array_replace_recursive($d_params,$u_params);
    $params = (object) $params;

    if($params->c !== '*')
    {
        $params->c = explode(',',$params->c);
    }

    $table = $params->t;

    list($tableRecords) = gtd($table,'data');

    $output = array_filter($tableRecords,function($item) use($params)
    {
        return call_user_func($params->w,$item);
    });

    if($params->c !== '*')
    {
        $cs = $params->c;
        array_walk($output,function(&$v,$i) use($cs,$params)
        {
            $class = $params->i;
            $newV = new $class();
            foreach($cs as $c)
            {
                $newV->$c = $v->$c;
            }
            $v = $newV;
        });
    }

    array_walk($output,function(&$v,$i) use($params)
    {
        call_user_func($params->m,$v);
    });

    $orderBys = $params->o;
    if(!is_null($orderBys))
    {
        usort($output,function($a,$b) use($orderBys)
        {
            for($i = 1; $i < count($orderBys); $i++)
            {
                $previousOrderByRule = $orderBys[$i-1];
                $previousOrderByRule = explode(':',$previousOrderByRule);
                $previousOrderByField = $previousOrderByRule[0];
                $currentOrderByRule = $orderBys[$i];
                $currentOrderByRule = explode(':',$currentOrderByRule);
                $currentOrderByField = $currentOrderByRule[0];
                $orderByDirection = $currentOrderByRule[1];
                if($a->$previousOrderByField == $b->$previousOrderByField)
                {
                    switch($orderByDirection)
                    {
                        case 'desc':
                            return $a->$currentOrderByField < $b->$currentOrderByField ? 1 : -1;
                            break;
                        case 'asc':
                            return $a->$currentOrderByField > $b->$currentOrderByField ? 1 : -1;
                            break;
                    }
                }
            }
            $firstOrderByRule = $orderBys[0];
            $firstOrderByRule = explode(':',$firstOrderByRule);
            $firstOrderByField = $firstOrderByRule[0];
            $orderByDirection = $firstOrderByRule[1];
            switch($orderByDirection)
            {
                case 'desc':
                    return $a->$firstOrderByField < $b->$firstOrderByField ? 1 : -1;
                    break;
                case 'asc':
                    return $a->$firstOrderByField > $b->$firstOrderByField ? 1 : -1;
                    break;
            }
        });
    }

    $limit = $params->l;
    if(!is_null($limit))
    {
        $limit = explode(':',$limit);
        $length = $limit[0];
        $offset = $limit[1] ?? 1;
        $output = array_slice($output,$offset-1,$length);
    }

    if($params->i !== 'stdClass')
    {
        include ROOT."classes/$params->i.php";
        array_walk($output,function(&$v,$k) use($params)
        {
            $v = unserialize(sprintf(
                'O:%d:"%s"%s',
                strlen($params->i),
                $params->i,
                strstr(strstr(serialize($v), '"'), ':')
            ));
        });
    }

    $output = array_values($output);
    return $output;
}