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
                    <?php 
                    if(!count($spotReports)) echo "No reports found...";
                    foreach($spotReports as $spotReport){?>
                        <div 
                            class="reportDiv row d-flex align-items-top spot<?=$spotReport['id_spot']?>"
                        >
                            <div class="col reportMsg">
                                <!-- reporter -->
                                <a 
                                    href="<?=base_url('UserController/displayProfile/'.$spotReport['username_reporter'])?>"
                                    target="_blank"
                                    class="reporter"
                                >
                                    <i class="fa-solid fa-user"></i>
                                    <?php 
                                        if($spotReport['username_reporter']) echo $spotReport['username_reporter'];
                                        else echo "{ banned }";
                                    ?>
                                </a>
                                reported
                                <!-- reported -->
                                <a 
                                    href="<?=base_url('UserController/displayProfile/'.$spotReport['username_reported'])?>"
                                    target="_blank"
                                    class="reporter"
                                >
                                    <i class="fa-solid fa-user"></i> 
                                    <?php 
                                        if($spotReport['username_reported']) echo $spotReport['username_reported'];
                                        else echo "{ banned }"
                                    ?>
                                </a>
                                <!-- report message -->
                                <p><?=$spotReport['report_message']?></p>
                            </div>
                            <div class="actions col-12">
                                <!-- display spot button -->
                                <a 
                                    href="<?=base_url('SpotController/displaySpot/'.$spotReport['id_spot'])?>"
                                    target="_blank"
                                    class="btn btn-sm btn-success" 
                                    title="See spot"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <!-- delete spot button -->
                                <a 
                                    onclick="deleteSpot(<?=$spotReport['id_spot']?>)"
                                    class="btn btn-sm btn-warning" 
                                    title="Delete spot"
                                >
                                    <i class="fa-solid fa-circle-minus"></i>
                                </a>
                                <!-- delete spot ban user button -->
                                <a 
                                    onclick="deleteSpotBanUser(<?=$spotReport['id_spot']?>,<?=$spotReport['id_reported']?>)"
                                    class="btn btn-sm btn-danger" 
                                    title="Delete spot and ban user"
                                >
                                    <i class="fa-solid fa-user-slash"></i>
                                </a>
                                <a class="btn btn-sm btn-secondary" title="Discard report">
                                    <i class="fa-solid fa-delete-left"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
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