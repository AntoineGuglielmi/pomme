<?php
$r->get('/')->name('home')->file('home')->func('home');
$r->get('/posts/{id}')->name('get_post_by_id')->file('posts')->func('get_by_id');
$r->get('/vue-d-ensemble')->name('vue_d_ensemble')->file('home')->func('vueDEnsemble');
$r->get('/budgets')->name('get_budgets')->file('budgets')->func('get_all');
$r->post('/add-budget')->name('add_budgets')->file('budgets')->func('add_budget');