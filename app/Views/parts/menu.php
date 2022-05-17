<nav id="main_nav" class="main-nav">
    <div class="menu-bar">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
    </div>
    <ul id="menu" class="menu">
        
        <li class="menu__item"><a href="<?php echo base_url('map')?>" class="menu__link">Map</a></li>
        <li class="menu__item"><a href="<?php echo base_url('aboutUs')?>" class="menu__link">About Us</a></li>

        <?php 
            //NOT LOGGED IN
            if(!$sessionData["logged_in"]){
            ?>
                <li class="menu__item"><a onclick = "openLogin()" class="menu__link">Login</a></li>                
                <li class="menu__item"><a  onclick = "openRegister()" class="menu__link">Register</a></li>
            <?php 
            }
            //LOGGED IN
            else{
            ?>
                <li class="menu__item"><a href="<?php echo base_url('UserController/logout')?>" class="menu__link">Log Out</a></li>
            <?php 
            }
        ?>
    </ul>
</nav>
<!--Typer-->
<h2><span class="ityped"></span></h2>
<!-- Necessary for typer --><script src="https://unpkg.com/ityped@0.0.10"></script>
<!-- CSS Menu --><link rel="stylesheet" src="<?php echo base_url('css/general.css'); ?>">
<!-- JS Menu --><script src="<?php echo base_url('js/menu.js'); ?>" crossorigin="anonymous"></script>




