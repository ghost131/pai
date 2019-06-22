<table class="users-list" border="1">
    <tr>
        <th>ID</th>
        <th>Nazwa użytkownika</th>
        <th>Akcje</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getId(); ?></td>
            <td><?= $user->getUsername(); ?></td>
            <td>
                <a href="/pcichon/admin/userdetail?userId=<?= $user->getId(); ?>">Informacje</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>