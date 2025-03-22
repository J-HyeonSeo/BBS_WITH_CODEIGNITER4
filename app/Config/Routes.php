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