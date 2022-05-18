<nav id="main_nav" class="main-nav">
    <div onclick="openMenu()" id="menu-bar" class="menu-bar">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
    </div>


    <ul id="menu" class="menu">

        <li class="menu-item"><a href="<?php echo base_url('map') ?>" class="menu-link">Map</a></li>
        <li class="menu-item"><a href="<?php echo base_url('aboutUs') ?>" class="menu-link">About Us</a></li>

        <?php
        //NOT LOGGED IN
        if (!$sessionData["logged_in"]) {
        ?>
            <li class="menu-item"><a class="menu-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
            <li class="menu-item"><a class="menu-link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li>
        <?php
        }
        //LOGGED IN
        else {
            if ($sessionData["is_admin"]) {
                ?><li class="menu-item"><a href="<?php echo base_url('admin') ?>" class="menu-link">Admin</a></li><?php
            }
                  
        }
        ?>
    </ul>
    
    <?php 
    //LOGGED IN USERBOX
    if ($sessionData["logged_in"]) {
      
    ?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            D
        </button>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="form-switch ps-0" onclick="event.stopPropagation();">
                <label class="dropdown-item d-flex flex-row" for="dark-reader-mode-switch" style="cursor: pointer;">
                    <span class="">Dark Mode Toggle</span>
                    <input class="form-check-input mx-1 ms-3" type="checkbox" id="dark-reader-mode-switch" onchange="toggleDarkReaderModeSwitch();" style="cursor: pointer;">
                </label>
            </li>
            <li class="menu-item"><a href="<?php echo base_url('UserController/logout') ?>" class="menu-link">Log Out</a></li>
        </ul>
    </div><?php

    }
    ?>

</nav>
