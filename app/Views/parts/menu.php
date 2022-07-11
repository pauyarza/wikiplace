<body onload="checkMenu()">
    <nav id="main_nav" class="main-nav" >
        <div onclick="openMenu()" id="menu-bar" class="menu-bar">
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
        </div>

        <ul id="menu" class="menu d-none d-flex">
            <li class="menu-item"><a href="<?=base_url('map') ?>" class="menu-link">Map</a></li>
            <li class="menu-item"><a href="<?=base_url('aboutUs') ?>" class="menu-link">About Us</a></li>

            <?php
            //NOT LOGGED IN
            if (!$sessionData["logged_in"]) {
            ?>
                <li class="menu-item"><a class="menu-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                <li class="menu-item"><a class="menu-link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></li>
            <?php
            }
            ?>
        </ul>
        <?php 
        //menu logo
        if(url_is('map')){
            echo '<a href="'.base_url().'" id="menu-logo"><img src="'.base_url('img/logo.svg').'" alt="wikiplace.org"></a>';
        }
        else if(!url_is('')){
            echo '<a href="'.base_url().'" id="menu-logo"><img src="'.base_url('img/logo2.svg').'" alt="wikiplace.org"></a>';
        }
        ?>
        
        <?php 
        //LOGGED IN USERBOX
        if ($sessionData["logged_in"]) {
        ?>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                <div 
                    id="dropdown-profile-pic"
                    class="profile_pic"
                    style="background-image: url('<?=$sessionData['profile_pic_src']?>');"
                >
                </div>
                <span class="dropdown-username"><?php echo $sessionData["username"] ?></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item" href="<?=base_url('Home') ?>"><img class="logo-dropdown" src="<?php echo base_url('img/logo2.svg') ?>"></a></li>
                <?php 
                    if ($sessionData["is_admin"]) {
                        ?><li><a class="dropdown-item" href="<?=base_url('admin')?>">Admin 🔑</a></li><?php
                    }
                ?>
                <li>
                    <a 
                        class="dropdown-item"
                        href="<?=base_url('UserController/displayProfile').'/'.$sessionData["username"]?>"
                    >
                        Profile
                    </a>
                </li>
                <li>
                    <a 
                        class="dropdown-item" 
                        href="<?=base_url('SpotController/displaySavedSpots/'.$sessionData["id_user"])?>"
                    >
                        Saved spots
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?=base_url('UserController/logout')?>" >Log Out<i style="margin-left: 7px;" class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div>
        <?php
            }
        ?>
    </nav>
</body>
