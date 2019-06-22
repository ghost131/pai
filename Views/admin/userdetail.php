<a href="/pcichon/admin/userlist"><strong><i class="fas fa-backward"></i> Powrót do listy</strong></a>

<table class="users-list" border="1">
    <tr>
        <td>Id użytkownika</td>
        <td><?= $id; ?></td>
    </tr>
    <tr>
        <td>Login</td>
        <td><?= $username; ?></td>
    </tr>
    <tr>
        <td>Rola</td>
        <td><?= $role_name === "admin" ? 'Administrator' : 'Pracownik'; ?></td>
    </tr>
    <tr>
        <td>Imię</td>
        <td><?= $first_name; ?></td>
    </tr>
    <tr>
        <td>Nazwisko</td>
        <td><?= $last_name; ?></td>
    </tr>
    <tr>
        <td>Telefon</td>
        <td><?= $phone_number; ?></td>
    </tr>

</table>