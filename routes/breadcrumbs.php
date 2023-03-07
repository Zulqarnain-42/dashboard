<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});


Breadcrumbs::for('createslider', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Slider', route('slider.create'));
});

// Breadcrumbs::for('updateslider', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Update Slider', route('slider.update'));
// });


Breadcrumbs::for('slider', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Slider', route('slider.index'));
});

Breadcrumbs::for('barnds', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Brands', route('brand.index'));
});

Breadcrumbs::for('createbrand', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Brand', route('brand.create'));
});


Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Categories', route('categories.index'));
});

Breadcrumbs::for('createcategories', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Categories', route('categories.create'));
});


Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Products', route('product.index'));
});

Breadcrumbs::for('createproduct', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Products', route('product.create'));
});

Breadcrumbs::for('opening', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Opening Stock', route('stock.opening'));
});

Breadcrumbs::for('createpromotion', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Creat Promotion', route('promotions.create'));
});

Breadcrumbs::for('promotions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Promotions', route('promotions.index'));
});
