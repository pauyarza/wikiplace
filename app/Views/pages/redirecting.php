<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <title>Wikiplace | Redirecting...</title>
    <script>
        <?php
            if(isset($message))
            echo "alert('".$message."');"
        ?>
        window.location.href = "<?= $goTo?>";
    </script>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
    <div class="container">
        Error while redirecting
    </div>
<?= $this->endSection('content') ?>