<body onload="checkMenu()">
    <nav id="main_nav" class="main-nav" >
        <div onclick="openMenu()" id="menu-bar" class="menu-bar">
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
        </div>

        <ul id="menu" class="menu d-none d-flex justify-content-evenly">

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
            $sessionData["username"] = session()->username;
        ?>
        <div class="dropdown">

            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo base_url('public/img/profile.png') ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo $sessionData["username"] ?></strong>
            </a>


            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            
                <li><a class="dropdown-item" href="<?php echo base_url('Home/index') ?>"><img class="logo-dropdown" src="<?php echo base_url('public/img/logo2.svg') ?>"></a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url('Usercontroller/displayEditProfile') ?>">Edit profile</a></li>
                <li><a class="dropdown-item" href="#">My collections</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="menu-link dropdown-item" href="<?php echo base_url('UserController/logout') ?>" >Log Out<i style="margin-left: 7px;" class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div><?php

        }
        ?>

    </nav>
</body>
