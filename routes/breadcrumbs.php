<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.home.index'));
});
Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('About', route('admin.about.index'));
});
Breadcrumbs::for('formAbout', function (BreadcrumbTrail $trail) {
    $trail->parent('about');
    $trail->push('Form About');
});
