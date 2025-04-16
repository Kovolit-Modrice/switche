<?php
echo "<h1>Seznam switchů Kovolit, a.s.</h1>";

function ping($ip) {
    exec("ping -n 1 -w 1000 $ip", $output, $status);
    return $status === 0 ? "online" : "offline";
}

$csvFile = fopen("switche.csv", "r");
$header = fgetcsv($csvFile, 1000, ";");

$switches = [];

while (($data = fgetcsv($csvFile, 1000, ";")) !== FALSE) {
    $switches[] = [
        'brand' => trim($data[0]),
        'model' => trim($data[1]),
        'ip' => trim($data[2]),
        'mac' => trim($data[3]),
        'location' => trim($data[4]),
        'status' => ping($data[2])
    ];
}
fclose($csvFile);

// Třídění
usort($switches, function($a, $b) {
    return [$a['brand'], $a['model']] <=> [$b['brand'], $b['model']];
});

// Strukturování
$grouped = [];
foreach ($switches as $s) {
    $grouped[$s['brand']][$s['model']][] = $s;
}

// Výpis
foreach ($grouped as $brand => $models) {
    echo "<div class='brand'><h2>$brand</h2>";
    foreach ($models as $model => $entries) {
        echo "<div class='model'><h3>$model</h3><ul>";
        foreach ($entries as $sw) {
            $statusClass = $sw['status'] === "online" ? "online" : "offline";
            $statusText = $sw['status'] === "online" ? "✅ Online" : "❌ Offline";

            echo "<li>
                    <div class='status $statusClass'></div>
                    <div class='printer-info'>
                        <span>Model:</span> {$sw['brand']} - {$sw['model']} &nbsp;
                        <span>IP:</span> <a href='http://{$sw['ip']}' target='_blank' class='ip-link'>{$sw['ip']}</a> &nbsp;
                        <span>MAC:</span> {$sw['mac']} &nbsp;
                        <span>Lokace:</span> {$sw['location']} &nbsp;
                    </div>
                  </li>";
        }
        echo "</ul></div>";
    }
    echo "</div>";
}
?>
