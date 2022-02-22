<?php
function add_budget()
{
    $budget = new stdClass();
    foreach($_POST as $k => $v)
    {
        $budget->$k = $v;
    }

    $budget->ordre = getMaxOrdre() + 1;
    
    insert('budgets',$budget);
}