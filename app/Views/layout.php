<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo base_url('img/miniLogo.svg');?>" type="image/x-icon">
    <!--CSS Bootstrap 5--><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--JS bootstrap 5--><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--SweetAlert2--><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--JQuery--><script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--Own CSS--><link rel="stylesheet" type="text/css" href="<?php echo base_url('css/general.css'); ?>">
    <!--Font Awesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--JS Menu--><script src="<?php echo base_url('js/menu.js');?>"></script>
    <!--JS General--><script src="<?php echo base_url('js/general.js');?>"></script>
    <!--Unique head--><?= $this->renderSection('head')?>
    <script>
        <?php 
            //save php variables to js
            if(isset($sessionData["logged_in"]) && $sessionData["logged_in"]){
                echo "var logged_in = true;";
            }
            else{
                echo "var logged_in = false;";
            }
            echo "var base_url='".base_url('/')."';";
        ?>
    </script>
</head>
<body data-nosnippet>
    <?php 
        echo $this->include('parts/menu',$sessionData);
        if(!$sessionData["logged_in"]){
            echo $this->include('parts/login');
            echo $this->include('parts/register');
            ?><!--JS Login/Register--><script src="<?php echo base_url('js/loginRegister.js'); ?>"></script><?php
        }
        echo $this->renderSection('content');
    ?>
</body>
        
<?php if($sessionData["welcome_message"]){ ?>
    <script>
        Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
        }).fire({
            icon: 'success',
            title: '<?=$sessionData["welcome_message"]?>'
        })
    </script>
<?php } ?>
</html>