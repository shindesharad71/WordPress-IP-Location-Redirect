<?php
/**
 * @package ip-location-redirect
 * @version 1.0.0v
 */
/*
Plugin Name: IP Location Redirect
Plugin URI: http://wordpress.org/plugins/register_user
Description: This plugin detects country of user and redirect to perticular country website.
Author: Sharad Shinde
Version: 1.0.0v
Author URI: http://sharadshinde.in/
*/

function get_client_ip() {
    
    ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            if(Cookies.get("REDIRECTED") != "1") {
                $.getJSON('//freegeoip.net/json/?callback=?', function (data) {
                    if(Cookies.get("COUNTRY") !== data.country_name) {
                        document.cookie = "COUNTRY="+data.country_name;
                        document.cookie = "REDIRECTED=1";
                        if(data.country_name === "India") {
                            window.location = "/home-india/"; // Redirect to perticular country website or page
                        }
                    
                        if(data.country_name === "Japan") {
                            window.location = "/home-japan/"; // Redirect to perticular country website or page
                        }
                    }
                });
            }
        });
    </script>
    
    <?php
}

add_action( 'init', 'get_client_ip');

?>
