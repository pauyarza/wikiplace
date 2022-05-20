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
        'class'  => 'needs-validation container new-spot-container',
        'novalidate' => 'true',
    ];
    ?>
    <?= form_open('SpotController/NewSpot', $formAttributes) ?>

        <select name="id_category">
            <?php foreach($categories as $category){ ?>
                <option value="<?=$category['id_category']?>">
                    <?=ucfirst($category['name'])?>
                </option>
            <?php } ?>
        </select>
        <br>
        <label>
            Name
            <input name="name" type="text" class="form-control">
        </label>
        <br>
        <label>Images</label>
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
        <br>
        <button type="submit">Enviar</button>
        <div class="alert alert-danger" role="alert">
            A simple danger alert—check it out!
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>