<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--CSS Bootstrap 5 --><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--CSS leaflet--><link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <!--CSS MarkerCluster--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/MarkerCluster.css'); ?>">
    <!--Map CSS--><link rel="stylesheet" type="text/css"  href="<?php echo base_url('css/map.css'); ?>"/>
    <!--Own CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/general.css'); ?>">
    <!--Unique head--><?= $this->renderSection('head') ?>
</head>
<body>

<ul id="menu">
    <li><a href="<?php echo base_url('map')?>">Map</a></li>
    <li onclick = "openLogin()">Login</li>
    <li onclick = "openRegister()">Register</li>
    <li><a href="<?php echo base_url('aboutUs')?>">About us</a></li>
</ul>

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

<!-- LOAD CONTENT --><?= $this->renderSection('content') ?>

</body>
<!-- JS bootstrap 5 --><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- JS Menu --><script src="<?php echo base_url('js/menu.js'); ?>" crossorigin="anonymous"></script>

</html>