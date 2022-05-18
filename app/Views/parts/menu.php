<nav id="main_nav" class="main-nav">
    <div class="menu-bar">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
    </div>
    <ul id="menu" class="menu">
        
        <li class="menu-item"><a href="<?php echo base_url('map')?>" class="menu-link">Map</a></li>
        <li class="menu-item"><a href="<?php echo base_url('aboutUs')?>" class="menu-link">About Us</a></li>

        <?php 
            //NOT LOGGED IN
            if(!$sessionData["logged_in"]){
            ?>
                <li class="menu-item"><a class="menu-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>                
                <li class="menu-item"><a class="menu-link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li>
            <?php 
            }
            //LOGGED IN
            else{
            ?>
                <li class="menu-item"><a href="<?php echo base_url('UserController/logout')?>" class="menu-link">Log Out</a></li>
            <?php 
            }
        ?>
    </ul>
</nav>





