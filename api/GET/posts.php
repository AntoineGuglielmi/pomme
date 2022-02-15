<?php
function get_by_id($id)
{
    // $post = new stdClass();
    // $post->title = 'Titre du post 1';
    // $post->body = '<h1>Body du post 1</h1><p>Contenu, blablabla...</p>';
    // insert('posts',$post);
    $post = select([
        't' => 'posts',
        'w' => function($p) use($id)
        {
            return $p->id === (int)$id;
        },
        'm' => function($p)
        {
            // $p->body = html_entity_decode($p->body);
            // $p->body = strip_tags($p->body,['h1','p']);
            $p->body = preg_replace('/\<script\>.*\<\/script\>/',' --- CONTENU CENSURÉ --- ',$p->body);
        },
        'i' => 'Post'
    ])[0];
    // echo '<pre>';
    // var_dump($post);
    // echo '</pre>';
    echo $post->body;
}