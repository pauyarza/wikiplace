<ul id="menu">
    <a href="<?php echo base_url('map')?>"><li>Map</li></a>

    <a href="<?php echo base_url('aboutUs')?>"><li>About us</li></a>
    <?php 
        //NOT LOGGED IN
        if(!$sessionData["logged_in"]){
        ?>
            <li onclick = "openLogin()">Login</li>
            <li onclick = "openRegister()">Register</li>
        <?php 
        }
        //LOGGED IN
        else{
        ?>
            <a href="<?php echo base_url('UserController/logout')?>"><li>Log out</li></a>
        <?php 
        }
    ?>
</ul>

<!-- JS Menu --><script src="<?php echo base_url('js/menu.js'); ?>" crossorigin="anonymous"></script>