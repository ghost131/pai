<h1>Lista przesyłek</h1>
<table class="users-list" border="1">
    <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Kraj</th>
        <th>Kod pocztowy</th>
        <th>Miasto</th>
        <th>Ulica</th>
        <th>Number domu / mieszkania</th>
    </tr>
    <?php foreach ($parcels as $parcel): ?>
        <tr>
            <td><?= $parcel->getId(); ?></td>
            <td><?= $parcel->getStatus(); ?></td>
            <td><?= $parcel->getCountry(); ?></td>
            <td><?= $parcel->getPostalCode(); ?></td>
            <td><?= $parcel->getCity(); ?></td>
            <td><?= $parcel->getStreet(); ?></td>
            <td><?= $parcel->getHouseNumber() . (!empty($parcel->getApartmentNumber()) ? " / {$parcel->getApartmentNumber()}" : ""); ?></td>
        </tr>
    <?php endforeach; ?>
</table>