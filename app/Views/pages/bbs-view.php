<main>

    <div id="bbs-header">
        <h3><?= esc($bbs['title']) ?></h3>
    </div>
    <hr>
    <div class="ck-content" id="bbs-content">
        <?= $bbs['content'] ?>
    </div>
    <br>
    <h3>총 10개의 댓글</h3>
    <hr>

    <form id="create-cmnt-form" action="/cmnt" method="post">
        <label for="cmnt-input"></label><textarea id="cmnt-input"></textarea>
        <button class="btn" id="create-cmnt-btn">등록</button>
    </form>
    <hr style="box-shadow: none; height: 1px;">
    <div class="cmnt-area">
        <h3>개발자K군</h3>
        <h3>오..저도 요즘 PHP배우고 있었는데, 요것도 재밌어보이네유..</h3>
        <hr style="box-shadow: none; height: 1px;">
    </div>
    <div class="cmnt-area">
        <h3>개발자K군</h3>
        <h3>오..저도 요즘 PHP배우고 있었는데, 요것도 재밌어보이네유..</h3>
        <hr style="box-shadow: none; height: 1px;">
    </div>
    <div class="cmnt-area">
        <h3>개발자K군</h3>
        <h3>오..저도 요즘 PHP배우고 있었는데, 요것도 재밌어보이네유..</h3>
        <hr style="box-shadow: none; height: 1px;">
    </div>
    <div class="cmnt-area">
        <h3>개발자K군</h3>
        <h3>오..저도 요즘 PHP배우고 있었는데, 요것도 재밌어보이네유..</h3>
        <hr style="box-shadow: none; height: 1px;">
    </div>
    <div class="cmnt-area">
        <h3>개발자K군</h3>
        <h3>오..저도 요즘 PHP배우고 있었는데, 요것도 재밌어보이네유..</h3>
        <hr style="box-shadow: none; height: 1px;">
    </div>

    <!-- 페이지네이션 + 하단 -->
    <div id="bbs-bottom">
        <ol id="bbs-page">

<!--            <a href="?page=--><?php //= $pager->getFirstPage() ?><!--&search=--><?php //= $search ?><!--">&lt;&lt;</a>-->
<!--            <a href="?page=--><?php //= $pager->getPreviousPage() ?><!--&search=--><?php //= $search ?><!--">&lt;</a>-->
<!---->
<!--            --><?php //for ($i= $start; $i <= $end; $i++): ?>
<!--                <a href="?page=--><?php //= esc($i)?><!--&search=--><?php //= $search ?><!--">--><?php //= esc($i)?><!--</a>-->
<!--            --><?php //endfor; ?>
<!---->
<!--            <a href="?page=--><?php //= $pager->getNextpage() ?><!--&search=--><?php //= $search ?><!--">&gt;</a>-->
<!--            <a href="?page=--><?php //= $pager->getLastPage() ?><!--&search=--><?php //= $search ?><!--">&gt;&gt;</a>-->

        </ol>
    </div>

</main>