<?php 
if(!isset($cat_errors)){
    $cat_errors["name"] = "";
    $last_cat_name = "";
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            alert("Category added!");
        });
    </script>
    <?php 
}
?>



<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | Admin 🔑</title>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
    <div class="container">
        <h1>Manage Wikiplace</h1>
        <h2>Categories</h2>
        <?php
            $formAttributes = [
                'id'  => 'categoryForm',
                'class'  => 'needs-validation',
                'novalidate' => 'true',
            ];
            echo form_open('Admin/newCategory', $formAttributes);
        ?>
            <h3>New category</h3>
            <input name="name" type="text" class="form-control" value="<?= $last_cat_name ?>">
            <?= $cat_errors["name"] ?>
            <br>
            <button type="su" class="btn btn-success">Add category</button>
        </form>
    </div>

<?= $this->endSection('content') ?>