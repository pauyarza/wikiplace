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

<!-- Unique head -->
<?= $this->section('head') ?>
    <!-- Title --><title>Wikiplace | Admin 🔑</title>
    <!--Font Awesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Admin CSS--><link rel="stylesheet" type="text/css" href="<?= base_url('css/admin.css')?>">
    <!--Admin script--><script src="<?php echo base_url('js/admin.js'); ?>"></script>
<?= $this->endSection('head') ?>


<!-- Content -->
<?= $this->section('content') ?>
<script>
    var message = '<?php if(isset($message)) echo $message?>';
    if (message) alert(message);
</script>
    <div class="container admin">
        <h1>Manage Wikiplace</h1>
        <div class="row">
            <!--------POST REPORTS-------->
            <div class="col-12 col-lg-7">
                <div class="adminBox">
                    <h2>Post reports</h2>
                    <div class="reportDiv row d-flex align-items-center">
                        <div class="col reportMsg">
                            <a href="" class="reporter">
                                <b>Reporter:</b> <i class="fa-solid fa-user"></i> xapase
                            </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae adipisci iure necessitatibus rerum. Maiores ipsam aut veniam obcaecati esse voluptatem? Beatae omnis consectetur ipsum maiores. Odio nobis amet accusantium quisquam.</p>
                        </div>
                        <div class="actions col-12">
                            <button class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="fa-solid fa-circle-minus"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-user-slash"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-delete-left"></i></button>

                        </div>
                    </div>
                    <div class="reportDiv row d-flex align-items-center">
                        <div class="col reportMsg">
                            <a href="" class="reporter">
                                <b>Reporter:</b> <i class="fa-solid fa-user"></i> yarzapau
                            </a>
                            <p>Repudiandae adipisci iure necessitatibus rerum. Maiores ipsam aut veniam obcaecati esse voluptatem?</p>
                        </div>
                        <div class="actions col-12">
                            <button class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="fa-solid fa-circle-minus"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-user-slash"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-delete-left"></i></button>

                        </div>
                    </div>
                    <div class="reportDiv row d-flex align-items-center">
                        <div class="col reportMsg">
                            <a href="" class="reporter">
                                <b>Reporter:</b> <i class="fa-solid fa-user"></i> xapase
                            </a>
                            <p>oopsie</p>
                        </div>
                        <div class="actions col-12">
                            <button class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="fa-solid fa-circle-minus"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-user-slash"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-delete-left"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--------CATEGORIES-------->
            <div class="col col-lg-5">
                <div class="adminBox">
                    <h2>Categories</h2>
                    <?php
                        $formAttributes = [
                            'id'  => 'categoryForm',
                            'class'  => 'needs-validation',
                            'novalidate' => 'true',
                        ];
                        echo form_open('Admin/newCategory', $formAttributes);
                    ?>
                        <div class="input-group mb-3">
                            <input name="name" type="text" class="form-control" value="<?= $last_cat_name ?>"  placeholder="New category">
                            <button class="btn btn-success" type="submit">Add category</button>
                        </div>
                        <?= $cat_errors["name"] ?>
                    </form>
                    <ul>
                        <?php foreach($categories as $category){ ?>
                            <li class="category">
                                <button 
                                    class="btn btn-danger btn-sm"
                                    onclick="deleteCategory(<?=$category['id_category']?>,'<?=$category['name']?>','<?=base_url('admin/deleteCategory')?>','<?=base_url('admin')?>')"
                                >
                                        <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <a
                                    class="btn btn-success btn-sm"
                                    href="<?=base_url('admin/loadEditCategory').'?id_category='.$category['id_category'].'&name='.$category['name']?>"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <?=$category['name']?>
                            </li>
                            <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    

<?= $this->endSection('content') ?>