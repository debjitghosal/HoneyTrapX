<?php

// Set timezone to IST (India)
date_default_timezone_set('Asia/Kolkata');
// ------------------ BACKEND: CONTINUOUS LOGS ------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['continuous'])) {

    $lat = $_POST['lat'] ?? '';
    $lon = $_POST['lon'] ?? '';
    $address = $_POST['address'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    file_put_contents(
        "log.txt",
        date("Y-m-d H:i:s") . " | CONTINUOUS | IP: $ip | LAT: $lat | LON: $lon | ADDRESS: $address\n",
        FILE_APPEND
    );

    echo "OK";
}
?>
