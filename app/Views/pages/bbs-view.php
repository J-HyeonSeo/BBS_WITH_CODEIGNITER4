<?php
    $session = session();
?>
<main>

    <div id="bbs-header">
        <h3><?= esc($bbs['title']) ?></h3>
        <?php if ($session->has('member_id') && $session->get('member_id') == $bbs['member_id']): ?>
            <div style="display: flex">
                <form style="margin-right: 10px" action="/bbs/edit/<?= esc($bbs['bbs_id']) ?>" method="get">
                    <?= csrf_field() ?>
                    <button class="btn" id="move-edit-bbs-btn">수정</button>
                </form>
                <form action="/bbs/<?= esc($bbs['bbs_id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE"/>
                    <button class="btn" id="delete-bbs-btn">삭제</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <hr>
    <div class="ck-content" id="bbs-content">
        <?= $bbs['content'] ?>
    </div>
    <br>
    <h3>총 10개의 댓글</h3>
    <hr>

    <form id="create-cmnt-form" action="/cmnt/<?= $bbs['bbs_id']?>" method="post">
        <?= csrf_field() ?>
        <label for="cmnt-input"></label><textarea id="cmnt-input" name="cmnt-input"></textarea>
        <button class="btn" id="create-cmnt-btn">등록</button>
    </form>
    <hr style="box-shadow: none; height: 1px;">

    <?php foreach ($cmntList as $cmnt): ?>
    <div class="cmnt-area">
        <div style="display: flex;">
            <h3><?= $cmnt['nickname'] ?></h3>

            <?php if ($session->has('member_id') && $session->get('member_id') == $cmnt['member_id']): ?>
                <form action="/cmnt/<?= $cmnt['cmnt_id'] ?>" method="post" style="display: flex; align-items: center; margin-left: 15px;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE"/>
                    <button class="btn" style="background-color: #b54040">삭제</button>
                </form>
            <?php endif; ?>
        </div>
        <h3><?= $cmnt['cmnt_cn'] ?></h3>
        <hr style="box-shadow: none; height: 1px;">
    </div>
    <?php endforeach; ?>

    <!-- 페이지네이션 + 하단 -->
    <div id="bbs-bottom">
        <ol id="bbs-page">

            <a href="?page=<?= $pager->getFirstPage() ?>">&lt;&lt;</a>
            <a href="?page=<?= $pager->getPreviousPage() ?>">&lt;</a>

            <?php for ($i= $start; $i <= $end; $i++): ?>
                <a href="?page=<?= esc($i)?>"><?= esc($i)?></a>
            <?php endfor; ?>

            <a href="?page=<?= $pager->getNextpage() ?>">&gt;</a>
            <a href="?page=<?= $pager->getLastPage() ?>">&gt;&gt;</a>

        </ol>
    </div>
    <br>
    <br>

</main>