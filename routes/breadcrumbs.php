<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.home.index'));
});
Breadcrumbs::for('pernyataan', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Kuisioner Jawaban', route('admin.pernyataan.index'));
});
Breadcrumbs::for('pernyataanDetail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('pernyataan');
    $trail->push('Detail Kuisioner', route('admin.pernyataanDetail.index', $id));
});

Breadcrumbs::for('hasil', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Hasil', route('admin.hasil.index'));
});
Breadcrumbs::for('hasilDetail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('hasil');
    $trail->push('Hasil Detail', route('admin.hasil.detail', $id));
});
