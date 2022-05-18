<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
<title>Wikiplace | New spot 📍</title>
<!-- if not coords on session storage redirect to map -->
<script>
    if (!localStorage.getItem("newLatitude")) {
        window.location.href = "<?= base_url('Map') ?>"
    }
</script>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
<div class="container">
    <h1>New spot</h1>
    <?php
    $formAttributes = [
        'class'  => 'needs-validation',
        'novalidate' => 'true',
    ];
    ?>
    <?= form_open('SpotController/NewSpot', $formAttributes) ?>
    <label>
        Name
        <input name="name" type="text" class="form-control">
    </label>
    <br>
    <label>
        Description
        <textarea name="description" rows="10" class="form-control"></textarea>
    </label>
    <input type="hidden" name="latitude" id="inputLat">
    <input type="hidden" name="longitude" id="inputLng">
    <script>
        //Set hidden input values
        $("#inputLat").val(localStorage.getItem("newLatitude"));
        $("#inputLng").val(localStorage.getItem("newLongitude"));

        //Remove from local storage
        localStorage.removeItem("newLatitude");
        localStorage.removeItem("newLongitude");
    </script>
    <script></script>
    <br>
    <button type="submit">Enviar</button>
    </form>
</div>
<?= $this->endSection('content') ?>