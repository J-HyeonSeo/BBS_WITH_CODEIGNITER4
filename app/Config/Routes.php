<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::loginForm');
$routes->post('/login', 'Login::doLogin');
$routes->post('/logout', 'Login::doLogout');

$routes->get('/join', 'Join::joinForm');
$routes->post('/join', 'Join::doJoin');

// 게시판 내용 관련 페이지
$routes->get('/bbs/new', 'BBS::bbsNewForm');
$routes->post('/bbs', 'BBS::createBbs');
$routes->get('/bbs/(:segment)', 'BBS::getBbs/$1');
$routes->get('/bbs/edit/(:segment)', 'BBS::bbsEditForm/$1');
$routes->put('/bbs/(:segment)', 'BBS::updateBbs/$1');
$routes->delete('/bbs/(:segment)', 'BBS::deleteBbs/$1');

$routes->post('/cmnt/(:segment)', 'Cmnt::createCmnt/$1');
$routes->delete('/cmnt/(:segment)', 'Cmnt::deleteCmnt/$1');