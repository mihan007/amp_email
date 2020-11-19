<?php

include "./vendor/autoload.php";

use Goutte\Client;

function parseUrl($url)
{
    $client = new Client();
    $crawler = $client->request('GET', $url);
    $data = $crawler->filter('.land-new__main-info-par')->each(
        function ($node) {
            return mapType($node->text());
        }
    );
    echo "Crawled $url\n";

    return [
        'type' => $data[0],
        'price' => count($data) > 5 ? $data[5] : $data[3],
        'square' => count($data) > 5 ? $data[2] : $data[1]
    ];
}

function mapType($inType)
{
    $mappingType = [
        "Продажа имущественного комплекса" => "имущественный комплекс",
        "Продажа здания и аренда земельного участка" => "здание и аренда земельного участка",
        "Продажа здания" => "здание",
        "Продажа помещения" => "помещение",
        "Продажа земельного участка" => "земельный участок"
    ];

    return $mappingType[$inType] ?? $inType;
}

$file = file_get_contents('./input/20201119.csv');
$lines = explode(PHP_EOL, $file);
$homes = [];
foreach ($lines as $line) {
    $parts = explode(';', $line);
    if (strlen($parts[0]) == 0) {
        continue;
    }
    $homes[] = array_slice($parts, 1);
}

$preprocessing = [];
foreach ($homes as $home) {
    $home[1] = str_replace("г. ", "", $home[1]);
    $addr = explode(",", $home[1]);
    $city = trim($addr[0]);
    $address = trim(implode(',', array_slice($addr, 1)));

    $from = [" ноября ", " декабря ", " января "];
    $to = [".11.", ".12.", ".01."];
    $expire = str_replace($from, $to, mb_strtolower($home[0]));

    $mappingCity = [
        "Нижегородская обл." => "Нижегородская область"
    ];

    $link = trim($home[4]);
    $result = parseUrl($link);
    if (empty($result['type'])) {
        continue;
    }

    $type = $result['type'];
    $price = str_replace(" ₽", " руб.", $result['price']);
    $price = strpos($price, "руб.") === false ? "-" : $price;
    $square = $result['square'];

    $preprocessing[] = [
        'city' => $mappingCity[$city] ?? $city,
        'address' => $address,
        'expire' => $expire,
        'type' => $type,
        'price' => $price,
        'square' => $square,
        'link' => $link
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

usort($preprocessing, "cmp");

$result = [];
foreach ($preprocessing as $item) {
    if (!isset($result[$item['city']])) {
        $result[$item['city']] = [];
    }
    $result[$item['city']][] = $item;
}

$json = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('./input/input2.json', $json);
