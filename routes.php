<?php
$r->get('/')->name('home')->file('home')->func('home');
$r->get('/posts/{id}')->name('get_post_by_id')->file('posts')->func('get_by_id');