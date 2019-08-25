<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La Pizzeria</title>
    <!---/.Make this Ios Compatible--->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="La Pizzeria Restaurant">
    <link rel="apple-touch-icon" content="<?php echo get_template_directory_uri()?>/apple-touch-icon.jpeg">
    
     <!---/.Make this Android Compatible--->
    <meta name="theme-color" content="#a61206">
    <meta name="mobile-web-app-compatible" content="yes">
    <meta name="application-name" content="La Pizzeria Restaurant">
    <link rel="icon" content="<?php echo get_template_directory_uri()?>/apple-touch-icon.jpeg"> 


<?php wp_head();?>
</head>
<body <?php body_class();?> >

<header class="site-header">
    <div class="container">
    <div class="logo">
        <a href="<?php echo esc_url( home_url('/') );?>">
        <img src="<?php echo get_template_directory_uri();?>/img/logo.svg" alt="">
        </a>
    </div><!---logo--->


        <div class="header-information">
            <div class="socials">
            <?php
                    $args = array(
                    'theme_location' => 'social-menu',
                    'container'      => 'nav',
                    'container_class'=> 'socials',
                    'container_id'   => 'socials',
                    'link_before'    => '<span class="sr-text">',
                    'link_after'     => '</span>'
                    );
                    wp_nav_menu($args);
                ?>
            </div>
            <div class="address">
                <p><?php  echo esc_attr( get_option('lapizzeria_location'));?></p>
                <p>Phone Number: <?php  echo esc_attr( get_option('lapizzeria_phone_number'));?></p>
            </div>
        </div><!---/.header-information-->
    </div><!---/.container--->
</header>
<div class="main-menu">
    <div class="mobile-menu">
        <a href="#" class="mobile"> <i class="fa fa-bars"> Menu </i> </a>
    </div>

    <div class="navigation container">
        <?php
            $args = array(
            'theme_location' => 'header-menu',
            'container' => 'nav',
            'container_class' => 'site-nav',
            );
            wp_nav_menu($args);
        ?>
    </div>
</div>