<h4><?= $data['title'] ?></h4>
<h5>Datum: <?= $data['date']; ?> Tijd: <?= $data['time']; ?> </h5>

<table border="1">
    <thead>
        <th>Onderwerpen</th>
    </thead>
    <tbody>
        <?= $data['rows'] ?>
    </tbody>
</table>
<br>
<a href="<?= URLROOT; ?>/lessen/addTopic/<?= $data['lessonId']; ?>">
    <input type="button" value="Onderwerp Toevoegen">
</a>
    