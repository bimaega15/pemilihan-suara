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

Breadcrumbs::for('tps', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('TPS', route('admin.tps.index'));
});

Breadcrumbs::for('koordinator', function (BreadcrumbTrail $trail) {
    $trail->parent('tps');
    $trail->push('Koordinator');
});

Breadcrumbs::for('pendukung', function (BreadcrumbTrail $trail) {
    $trail->parent('tps');
    $trail->push('Pendukung');
});
