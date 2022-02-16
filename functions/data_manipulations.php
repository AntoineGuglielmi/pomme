<?php

function gtd($table,$whats)
{
    $output = [];
    $whats = explode(',',$whats);
    $object = json_decode(file_get_contents("data/$table.json"));
    foreach($whats as $w)
    {
        $output[] = $object->$w;
    }
    return $output;
}

function majtd($tableName,$whats,...$maj)
{
    $tableFile = "data/$tableName.json";
    $tableContent = json_decode(file_get_contents($tableFile));
    $whats = explode(',',$whats);
    for($i = 0; $i < count($whats); $i++)
    {
        $field = $whats[$i];
        $value = $maj[$i];
        $tableContent->$field = $value;
    }
    file_put_contents("data/$tableName.json",json_encode($tableContent));
}

function result($data)
{
    return [
        'date' => time(),
        'data' => $data
    ];
}