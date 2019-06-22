<?php if(!isset($_SESSION["logged_in"])): ?>
<div class="login-form">
    <form action="/pcichon/index/login" method="post">
        <div class="form-row">
            <label>Nazwa użytkownika</label>
            <div class="form-row-input">
                <input type="text" name="username" required/>
            </div>
        </div>
        <div class="form-row">
            <label>Hasło</label>
            <div class="form-row-input">
                <input type="password" name="password" required/>
            </div>
        </div>
        <div class="form-row">
            <input type="submit" value="Zaloguj"/>
        </div>
    </form>
</div>
<?php else: ?>
<h2>Zalogowany do systemu z rolą: <?= $_SESSION["role"]; ?>.</h2>
<?php endif; ?>