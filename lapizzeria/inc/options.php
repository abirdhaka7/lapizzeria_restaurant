<?php

function lapizzeria_option(){

    add_menu_page( 'La Pizzeria', 'La Pizzeria Options', 'administrator','lapizzeria_options','lapizzeria_adjustments','',20 ); 

    add_submenu_page( 'lapizzeria_options', 'Reservation', 'Reservation', 'administrator', 'lapizzeria_reservations', 'lapizzeria_reservations');
}
add_action('admin_menu','lapizzeria_option');

function lapizzeria_settings(){

    //Google map group
    register_setting('lapizzeria_options_gmaps','lapizzeria_gmaps_latitude');
    register_setting('lapizzeria_options_gmaps','lapizzeria_gmaps_longitude');
    register_setting('lapizzeria_options_gmaps','lapizzeria_gmaps_zoom');
    register_setting('lapizzeria_options_gmaps','lapizzeria_gmaps_api_key');

    //Information group
    register_setting('lapizzeria_options_info','lapizzeria_location' );
    register_setting('lapizzeria_options_info','lapizzeria_phone_number');
}
add_action('init','lapizzeria_settings');

function lapizzeria_adjustments(){ ?>

    <div class="wrap">
        <h1>La Pizzeria Adjustments</h1>
        <form action="options.php" method="post">
            <?php
                settings_fields( 'lapizzeria_options_gmaps' );
                do_settings_sections('lapizzeria_options_gmaps');
            ?>
            <h2>Google Maps</h2>
            <table class="form-table">
                <tr valing="top">
                    <th scope="row">Latitude</th>
                    <td>
                        <input type="text" name="lapizzeria_gmaps_latitude" value="<?php echo esc_attr__( get_option(lapizzeria_gmaps_latitude) );?>">
                    </td>
                </tr>
                <tr valing="top">
                    <th scope="row">Longitude</th>
                    <td>
                        <input type="text" name="lapizzeria_gmaps_longitude" value="<?php echo esc_attr__( get_option(lapizzeria_gmaps_longitude) );?>">
                    </td>
                </tr>
                <tr valing="top">
                    <th scope="row">Zoom Level</th>
                    <td>
                        <input type="number"  max="21" min="12" name="lapizzeria_gmaps_zoom" value="<?php echo esc_attr__( get_option(lapizzeria_gmaps_zoom) );?>">
                    </td>
                </tr>
                <tr valing="top">
                    <th scope="row">Api Key</th>
                    <td>
                        <input type="text" name="lapizzeria_gmaps_api_key" value="<?php echo esc_attr__( get_option(lapizzeria_gmaps_api_key) );?>">
                    </td>
                </tr>
            </table>

            <?php
                settings_fields( 'lapizzeria_options_info' );
                do_settings_sections('lapizzeria_options_info');
            ?>
            <h2>Other Adjustments</h2>
            <table class="form-table">
                <tr valing="top">
                    <th scope="row">Location</th>
                    <td>
                        <input type="text" name="lapizzeria_location" value="<?php echo esc_attr__( get_option(lapizzeria_location) );?>">
                    </td>
                </tr>
                <tr valing="top">
                    <th scope="row">Phone Number</th>
                    <td>
                        <input type="text" name="lapizzeria_phone_number" value="<?php echo esc_attr__( get_option(lapizzeria_phone_number) );?>">
                    </td>
                </tr>
            </table>
            <?php submit_button();?>
        </form>
    </div>

<?php }

function lapizzeria_reservations(){ ?>

<div class="wrap">
    <h1>Reservations</h1>
    <table class="wp-list-table widefat striped">
        <thead>
            <tr>
                <th class="manage-column">ID</th>
                <th class="manage-column">Name</th>
                <th class="manage-column">Date of Reservation</th>
                <th class="manage-column">Email</th>
                <th class="manage-column">Phone</th>
                <th class="manage-column">Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
               global $wpdb;
               $table = $wpdb->prefix . 'reservations';
               $reservations = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
               foreach ($reservations as $reservation): 
                ?>
                
                <tr>
                    <td><?php echo $reservation['id'];?></td>
                    <td><?php echo $reservation['name'];?></td>
                    <td><?php echo $reservation['date'];?></td>
                    <td><?php echo $reservation['email'];?></td>
                    <td><?php echo $reservation['phone'];?></td>
                    <td><?php echo $reservation['message'];?></td>
                </tr>
    
                <?php endforeach; ?>
        
        </tbody>
    </table>
</div>

<?php

}

?>