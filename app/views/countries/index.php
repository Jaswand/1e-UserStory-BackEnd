<h3><?= $data['title'] ?> .</h3>;   
<p><a href="<?= URLROOT; ?>/countries/create">Nieuw Record</a></p>
<table>
    <thead>
        <th>Id</th>
        <th>Naam</th>
        <th>Hoofdstad</th>
        <th>Continent</th>
        <th>Aantal inwoners</th>
        <th>Update</th>
        <th>Delete</th>
    </thead>

    <tbody>
        <?= $data['rows'] ?>
    </tbody>
</table>
<p><a href="<?= URLROOT; ?>/landingpages/index">back to landingpages</a></p>
    