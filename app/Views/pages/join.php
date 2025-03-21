<main>

    <section id="form-section">

        <form id="form" action="/join" method="post">
            <?= csrf_field() ?>
            <div id="form-content">
                <div id="form-label">
                    <label for="username">아이디</label>
                    </p>
                    <label for="password">비밀번호</label>
                    </p>
                    <label for="nickname-for">닉네임</label>
                </div>

                <div id="form-input">
                    <input id="username" name="username"/>
                    </p>
                    <input id="password" name="password"/>
                    </p>
                    <input id="nickname-for" name="nickname"/>
                </div>
            </div>

            </p>

            <button class="btn" type="submit" id="join-btn">회원가입</button>

        </form>

        <div id="join-form-btn-wrap">
            <a href="/login" class="btn" id="login-btn">로그인</a>
        </div>

    </section>



</main>