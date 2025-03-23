<main>

    <section id="form-section">

        <form id="form" action="/login" method="post">
            <?= csrf_field() ?>
            <div id="form-content">
                <div id="form-label">
                    <label for="username">아이디</label>
                    </p>
                    <label for="password">비밀번호</label>
                </div>

                <div id="form-input">
                    <input id="username" name="username"/>
                    </p>
                    <input type="password" id="password" name="password"/>
                </div>
            </div>

            </p>

            <button class="btn" type="submit" id="login-btn">로그인</button>

        </form>

        <div id="join-form-btn-wrap">
            <a href="/join" class="btn" id="join-form-btn">회원가입</a>
        </div>

    </section>



</main>