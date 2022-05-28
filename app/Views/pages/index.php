<?= $this->extend('layout') ?>

<!-- Title -->
<!-- Unique head -->
<?= $this->section('head')?>
    <title>Wikiplace</title>
    <!-- Index CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/index.css'); ?>">
<?= $this->endSection('head')?>

<!-- Content -->
<?= $this->section('content') ?>
<div class="index d-flex"> 
    <div class="container index-box align-self-center">
        <img 
            class="earth" 
            src="<?php echo base_url('img/earth.gif'); ?>" 
            alt="earth gif"
            onclick="location.replace('map')"
        >
        <img class="index-logo" src="<?php echo base_url('img/logo.svg'); ?>" alt="wikiplace.org">
        <?=form_open('map',"id='formCategory'")?>
            <div class="input-group <?php if(isset($error)) echo "is-invalid"?>">
                <input 
                    name="category_name"
                    id="searchCategory"
                    type="text" 
                    class="form-control search-input <?php if(isset($error)) echo "is-invalid"?>" 
                    placeholder="Search a category" 
                    aria-describedby="button-addon2"
                    autocomplete="off"
                    value="<?php if(isset($categoryTry)) echo $categoryTry?>"
                >
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="d-flex" id="autocompleteWrap" style="display: none !important;">                
                <div id='catAutcomplete' class="flex-fill"></div>
                <div id=autocompleteFiller></div>
            </div>
            <div class="invalid-feedback">
                <?php if(isset($error)) echo $error?>
            </div>
        </form>
        <!--Typer-->
        <h2 class="typer"><span class="ityped"></span></h2>
        <!-- Typer script --><script src="https://unpkg.com/ityped@0.0.10"></script>
    </div>
</div>


<script>
    //load catogries
    var categories = [];
    <?php
        foreach($categories as $category){
            echo "categories.push('".$category['name']."');";
        }
    ?>

    //typer
    window.ityped.init(document.querySelector('.ityped'),{
        strings: categories,
        loop: true,
        typeSpeed:  90,
        startDelay: 200,
        backDelay:  700,
    });

    //autocomplete
    $("#searchCategory").focusin(displayAutocomplete);
    $("#searchCategory").keyup(displayAutocomplete);

    function displayAutocomplete(){
        var catFound = 0;
        $("#catAutcomplete").empty();
        var searchString = $("#searchCategory").val();
        $.each(categories, function( index, categoria ) {
            if(categoria.includes(searchString)){
                catFound++;
                categoriaBold = boldString(categoria, searchString); 
                $("#catAutcomplete").append('<button type="button" value="'+categoria+'" class="category">'+categoriaBold+'</button>');
            }
            if(catFound >= 5) return false;
        });
        if(!catFound && searchString){
            $("#catAutcomplete").html('<span class="noCatFound">No category found</span>');
        }
        $("#autocompleteWrap").slideDown();
    }

    function boldString(str, substr) {
        var strRegExp = new RegExp(substr, 'g');
        return str.replace(strRegExp, '<b>'+substr+'</b>');
    }

    //on category click
    $(document).on('mousedown', '.category', function () {
        location.replace('<?= base_url('Map?category_name=')?>'+this.value);
    });

    //on input focus out
    $("#searchCategory").focusout(function() {
        setTimeout(function(){//fix bug where submit didn't perform 
            $("#autocompleteWrap").slideUp(200,function(){
                $("#autocompleteWrap").attr('style','display:none !important');
            });
        }, 50);
    });
</script>


<?= $this->endSection('content') ?>