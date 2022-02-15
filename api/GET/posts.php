<?php
function get_by_id($id)
{
    // echo "Returning post with id $id !";
    echo json_encode([
        'data' => [
            [
                'id' => 2,
                'title' => 'Title of the post',
                'body' => 'Body of the post, blablabla...'
            ]
        ]
    ]);
}