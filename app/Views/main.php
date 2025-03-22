<main>

    <!-- 갯수 표시 및 검색창 -->
    <div id="bbs-header">
        <h4>총 <?= $pager->getTotal() ?>개</h4>
        <div id="search">
            <form>
                <input name="search" placeholder="검색어를 입력해주세요.." value="<?=$search?>">
                <button></button>
            </form>
        </div>
    </div>
    <hr>
    <!-- 게시글 내용 순회 -->
    <ol id="bbs-content">
        <?php foreach ($bbsList as $bbs): ?>
        <li class="bbs-row">
            <h4 class="number"><?= esc($bbs['bbs_id'])?></h4>
            <a href="/bbs/<?= esc($bbs['bbs_id'])?>" class="title"><?= esc($bbs['title'])?></a>
            <h4 class="view">[ <?= esc($bbs['view'])?>읽음 ]</h4>
            <h4 class="writer"><?= esc($bbs['nickname'])?></h4>
        </li>
        <?php endforeach; ?>

    </ol>

    <!-- 페이지네이션 + 하단 -->
    <div id="bbs-bottom">
        <ol id="bbs-page">

            <a href="?page=<?= $pager->getFirstPage() ?>&search=<?= $search ?>">&lt;&lt;</a>
            <a href="?page=<?= $pager->getPreviousPage() ?>&search=<?= $search ?>">&lt;</a>

            <?php for ($i= $start; $i <= $end; $i++): ?>
                <a href="?page=<?= esc($i)?>&search=<?= $search ?>"><?= esc($i)?></a>
            <?php endfor; ?>

            <a href="?page=<?= $pager->getNextpage() ?>&search=<?= $search ?>">&gt;</a>
            <a href="?page=<?= $pager->getLastPage() ?>&search=<?= $search ?>">&gt;&gt;</a>

        </ol>
        <a href="/bbs/new" class="btn" id="new-form-btn">+ 작성</a>
    </div>

</main>