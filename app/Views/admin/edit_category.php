<?= $this->extend('layout') ?>

<!-- Unique head -->
<?= $this->section('head') ?>
    <!-- Title --><title>Wikiplace | Admin 🔑</title>
    <!--Font Awesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Admin CSS--><link rel="stylesheet" type="text/css" href="<?= base_url('css/admin.css')?>">
    <!--Admin script--><script src="<?php echo base_url('js/admin.js'); ?>"></script>
<?= $this->endSection('head') ?>

<!-- Content -->
<?= $this->section('content') ?>
    <div class="container admin">
        <h1>Manage Wikiplace</h1>
        <div class="row">
            <div class="col col-md-4 categories">
                <h2>Categories</h2>
                <?=form_open('admin/editCategory');?>
                    <div class="input-group mb-3">
                        <input type="text" value="<?=$name?>" class="form-control" name="name" placeholder="<?= $name?>">
                        <button class="btn btn-success" type="submit">Edit category</button>
                    </div>
                    <input type="hidden" name="id_category" value="<?=$id_category?>">
                    <br>
                </form>
                <a 
                    class="btn btn-secondary"
                    href="<?=base_url("admin")?>"
                >
                    <i class="fa-solid fa-circle-left"></i>
                </a>
            </div>
        </div>
    </div>
    

<?= $this->endSection('content') ?>