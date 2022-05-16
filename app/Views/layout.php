<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--CSS Bootstrap 5 --><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Own CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/general.css'); ?>">
    <!--Unique head--><?= $this->renderSection('head') ?>
</head>
<body>

<nav id="main_nav" class="main-nav">
        <div class="menu-bar">
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
        </div>
        <ul class="menu">
            <li class="menu__item"><a href="<?php echo base_url('aboutUs')?>" class="menu__link">About Us</a></li>
            <li class="menu__item"><a onclick = "openRegister()" class="menu__link">Register</a></li>
            <li class="menu__item"><a onclick = "openLogin()" class="menu__link">Login</a></li>
            <li class="menu__item"><a href="<?php echo base_url('map')?>" class="menu__link">Map</a></li>
        </ul>
        
    </nav>
    <div class="d-none loginFormWrapper" id="divLoginWraper" onclick="">
        <div id="divLogin">
            <h1>LOGIN</h1>
        </div>
    </div>

    <div class="d-none loginFormWrapper" id="divRegisternWraper">
        <div id="divRegister">
            <h1>REGISTER</h1>
        </div>
    </div>

    <!--Typer-->
    
    
<!-- LOAD CONTENT --><?= $this->renderSection('content') ?>

</body>
<!-- Typer animation --><script src="https://unpkg.com/ityped@0.0.10"></script>

<!-- JS bootstrap 5 --><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- JS Menu --><script src="<?php echo base_url('js/menu.js'); ?>" crossorigin="anonymous"></script>

</html>