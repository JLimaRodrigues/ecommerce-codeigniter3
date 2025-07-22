<?php 

function encriptar($id) {
    $CI =& get_instance();
    $CI->load->library('encryption');
    return base64_encode($CI->encryption->encrypt($id));
}

function decriptar($string) {
    $CI =& get_instance();
    $CI->load->library('encryption');
    return $CI->encryption->decrypt(base64_decode($string));
}