
<footer>
    <?php
    $args = array(
        'theme_location' => 'header-menu', 
        'container' => 'nav', 
        'after' => '<span class="separator"> | </span>' 
    );
    wp_nav_menu($args);
    ?>

    <div class="location">
        <p><?php  echo esc_attr( get_option('lapizzeria_location'));?></p>
        <p>Phone Number: <?php  echo esc_attr( get_option('lapizzeria_phone_number'));?></p>
    </div>

    <p class="copyright">All rights reserved &copy;<?php echo date('Y');?> ABIR HASAN HIMEL</p>
</footer>


    <?php wp_footer();?>
</body>
</html>