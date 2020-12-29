<?php
function create_guid() { // Create GUID (Globally Unique Identifier)
    $guid = '';
    $namespace = rand(11111, 99999);
    $uid = uniqid('', true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = substr($hash,  0,  8) . '-' .
        substr($hash,  8,  4) . '-' .
        substr($hash, 12,  4) . '-' .
        substr($hash, 16,  4) . '-' .
        substr($hash, 20, 12);
    return $guid;
}
