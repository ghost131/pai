<?php if (!empty($message)): ?>
    <strong><?= $message; ?></strong>
<?php endif; ?>

<h1>Dodaj użytkownika</h1>
<div class="login-form">
    <form action="" method="post">
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
            <label>Rola</label>
            <div class="form-row-input">
                <select name="role">
                    <option value="1">Admin</option>
                    <option value="2">Pracownik</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <label>Imię</label>
            <div class="form-row-input">
                <input type="text" name="first_name" required/>
            </div>
        </div>
        <div class="form-row">
            <label>Nazwisko</label>
            <div class="form-row-input">
                <input type="text" name="last_name" required/>
            </div>
        </div>
        <div class="form-row">
            <label>Numer telefonu</label>
            <div class="form-row-input">
                <input type="number" name="phone_number" required/>
            </div>
        </div>
        <div class="form-row">
            <input type="submit" value="Dodaj"/>
        </div>
    </form>
</div>