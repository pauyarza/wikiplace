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
                <li class="menu__item"><a class="menu__link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>                
                <li class="menu__item"><a class="menu__link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li>
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





