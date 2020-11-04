<?php

$file = file_get_contents('./input/dataminer_dom_rf.csv');
$lines = explode(PHP_EOL, $file);
$homes = [];
foreach ($lines as $line) {
    $parts = explode(';', $line);
    if (strlen($parts[0]) > 1) {
        $homes[] = $parts;
    }
}

$result = [];
foreach ($homes as $home) {
    $home[0] = str_replace("г. ", "", $home[0]);
    $addr = explode(",", $home[0]);
    $city = $addr[0];

    $addr = explode(" ", $home[2]);
    $expire = $addr[1];

    $addrParts = explode(",", $home[0]);
    $address = trim(implode(',', array_slice($addrParts, 1)));

    $result[] = [
        'city' => $city,
        'address' => $address,
        'expire' => $expire,
        'type' => $home[1],
        'price' => $home[3],
        'square' => trim($home[5]),
        'link' => "https://xn--d1aqf.xn--p1ai{$home[4]}"
    ];
}

function cmp($a, $b)
{
    $priorities = [
        "Москва",
        "Московская",
        "Санкт",
        "Ленинград"
    ];

    foreach ($priorities as $priority) {
        if (strpos($a["city"], $priority) !== false) {
            return -1;
        }
        if (strpos($b["city"], $priority) !== false) {
            return 1;
        }
    }

    return strcmp($a["city"], $b["city"]);
}

usort($result, "cmp");

$json = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('./input/input.json', $json);
