<?php
function get_by_id($id)
{
    $post = select([
        't' => 'posts',
        'w' => function($p) use($id)
        {
            return $p->id === (int)$id || ($p->id === (int)($id+1));
        },
        'm' => function($p)
        {
            $p->body = html_entity_decode($p->body);
        },
        'i' => 'Post'
    ]);

    $result = result($post);
    echo json_encode($result);
}