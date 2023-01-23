<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/countries/update" method="post">
  <!-- fieldsets -->
  <fieldset>
    <input type="text" name="name" id="name" value="<?= $data['row']->Name; ?>"/>
    <input type="text" name="capitalcity" id="Capitalcity" value="<?= $data['row']->CapitalCity; ?>">
    <input type="text" name="continent" id="continent" value="<?= $data['row']->Continent; ?>">
    <input type="number" name="population" id="name" value="<?= $data['row']->Population; ?>">
    <input type="hidden" name="id" value="<?= $data['row']->id; ?>">

    <input type="submit" value="Update">
  </fieldset>
</form>