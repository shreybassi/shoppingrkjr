<?php
/*
 * @author Shrey Bassi
*/

function printErrorMessage($str) {
    echo '<div style="width:50%; margin:0 auto; border:2px solid #F00;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function printSuccessMessage($str) {
    echo '<div style="width:50%; margin:0 auto; border:2px solid #06C;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function redirectURL($url) {
    echo '<script> window.location.href="' . $url . '"</script>"';
}

?>