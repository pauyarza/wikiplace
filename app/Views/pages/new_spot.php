<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | New spot 📍</title>
    <!-- if not coords on session storage redirect to map and no errors set -->
    <?php if(!isset($errors)){ ?>
        <script>
            if (!localStorage.getItem("newLatitude")) {
                window.location.href = "<?= base_url('Map') ?>"
            }
        </script>
    <?php } ?>
    <!-- New Spot CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_spot.css'); ?>">
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
<div class="container">
    <h1 class="h1-newspot">New spot</h1>
    <?php
    $formAttributes = [
        'class'  => 'new-spot-form',
        'novalidate' => 'true',
    ];
    ?>
    <?= form_open_multipart('SpotController/NewSpot', $formAttributes) ?>
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- NAME -->
                <label for="inputName">Name</label>
                <input 
                    name="spot_name" 
                    type="text" 
                    id="inputName"
                    class="form-control <?php if(isset($errors["name"])) echo "is-invalid"?>"
                    value="<?= $lastTry['name'] ?? ''?>"
                >
                <div class="invalid-feedback">
                    <?php if(isset($errors["name"])) echo $errors["name"]?>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- CATEGORY -->
                <label for="categorySelect">Category</label>
                <select 
                    name="id_category" 
                    required 
                    id="categorySelect"
                    class="form-select <?php if(isset($errors["id_category"])) echo "is-invalid"?>" 
                >
                    <option disabled <?php if(!isset($lastTry["id_category"])) echo "selected"?>>Select a category</option>
                    <?php foreach($categories as $category){ ?>
                        <option 
                            value="<?=$category['id_category']?>"
                            <?php
                                if(isset($lastTry["id_category"]) && $category['id_category'] == $lastTry["id_category"])
                                echo "selected";
                            ?>
                        >
                            <?=ucfirst($category['name'])?>
                        </option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">
                    <?php if(isset($errors["id_category"])) echo $errors["id_category"]?>
                </div>
            </div>
        </div>
        <!-- IMAGES -->
        <label for="images">Images (optional)</label>
        <input
            type="file" name="images[]"
            multiple
            accept=".png, .jpg, .jpeg"
            class="form-control <?php if(isset($errors["images"])) echo "is-invalid"?>"
        >
        <div class="invalid-feedback">
            <?php if(isset($errors["images"])) echo $errors["images"]?>
        </div>

        <!-- DESCRIPTION -->
        <label for="descriptionInput">Description (optional)</label>
        <textarea 
            name="description" 
            id="descriptionInput" 
            class="form-control <?php if(isset($errors["description"])) echo "is-invalid"?>"
            rows="2"><?= $lastTry['description'] ?? ''?></textarea>
        <div class="invalid-feedback">
                <?php if(isset($errors["description"])) echo $errors["description"]?>
        </div>
        <input type="hidden" name="latitude" id="inputLat" value="<?= $lastTry['latitude'] ?? ''?>">
        <input type="hidden" name="longitude" id="inputLng" value="<?= $lastTry['longitude'] ?? ''?>">
        <script>
            if(localStorage.getItem("newLatitude")){
                //Set hidden input values
                $("#inputLat").val(localStorage.getItem("newLatitude"));
                $("#inputLng").val(localStorage.getItem("newLongitude"));
                
                //Remove from local storage
                localStorage.removeItem("newLatitude");
                localStorage.removeItem("newLongitude");
            }
        </script>
        <br>
        <button type="submit" class="btn btn-success send">Send petition</button>
    </form>

    <script>

    </script>
</div>
<?= $this->endSection('content') ?>