<?php
/**
 * @package ip-location-redirect
 * @version 1.0.0v
 */
/*
Plugin Name: IP Location Redirect
Plugin URI: http://wordpress.org/plugins/register_user
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: DheveloperDhapare
Version: 1.0.0v
Author URI: http://ma.tt/
*/

function get_client_ip() {

    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    
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
