<?php
    $session = session();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- css -->
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.css">
    
    <title>PHP & CodeIgniter 게시판</title>
</head>
<body>
    <header>
        <!-- 제목 스타일링 -->
        <a href="/">
            <img id="title" src="../../../public/image/bbs_logo.png" alt="CodeIgniter BBS">
        </a>

        <?php if ( $session->has('member_id') && $session->has('nickname') ): ?>
            <!-- 사용자명 + 로그아웃 -->
            <h4 id="nickname"><?= esc($session->get('nickname'))?></h4>

            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button class="btn" id="logout">로그아웃</button>
            </form>
        <?php else: ?>
            <!-- 로그인 -->
            <div class="btn" id="login">
                <a href="/login">로그인</a>
            </div>
        <?php endif; ?>

    </header>
