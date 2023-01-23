<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/countries/update" method="post">
  <!-- fieldsets -->
  <fieldset>
    <tr>
        <td>
            <label for="name">Naam van het Land</label>
            <input type="text" name="name" id="name">
        </td>
        <td>
            <label for="text">Naam van de Hoofdstad</label>
            <input type="text" name="capitalcity">
        </td>
        <td>
            <label for="text">Naam van het continent</label>
            <input type="text" name="continent">
        </td>
        <td>
            <label for="number">Aantal inwoners</label> 
            <input type="number" name="population">
        </td>
    </tr>
    <input type="submit" value="Update">
  </fieldset>
</form>