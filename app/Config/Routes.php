<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::login');
$routes->get('/join', 'Join::join');

// 게시판 내용 관련 페이지
$routes->get('/bbs/new', 'BBS::new');