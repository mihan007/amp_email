<?php

//Make amp
$file = file_get_contents('./input/input.json');
$input = (array)json_decode($file);
$typeCounter = [
    'zu' => 0,
    'ik' => 0,
    'zd' => 0,
    'pm' => 0
];

foreach ($input as $city => $objs) {
    foreach ($objs as $obj) {
        switch ($obj->type) {
            case "земельный участок":
                $typeCounter['zu']++;
                break;
            case "имущественный комплекс":
                $typeCounter['ik']++;
                break;
            case "помещение":
                $typeCounter['pm']++;
                break;
            case "здание":
                $typeCounter['zd']++;
                break;
            case "здание и аренда земельного участка":
                $typeCounter['zu']++;
                $typeCounter['zd']++;
                break;
        }
    }
}
ob_start();
?>
<?php
include "./parts/head_amp.php" ?>
<?php
include "./parts/body_amp.php" ?>
<?php
$amp = ob_get_contents();
ob_end_clean();
file_put_contents("./output/amp.html", $amp);

ob_start();
include "./parts/head_html.php";
include "./parts/body_amp.php";
$html = ob_get_contents();
ob_end_clean();
$html = str_replace("amp-img", "img", $html);
$html = str_replace("amp-accordion", "span", $html);

$start = strpos($html, '<span class="show-more">');
$endTag = '</span>';
$end = strpos($html, $endTag, $start);
$html = substr($html, 0, $start) . substr($html, $end + strlen($endTag));
do {
    $end = strpos($html, $endTag, $start);
    $html = substr($html, 0, $start) . substr($html, $end + strlen($endTag));
    $start = strpos($html, '<span class="show-more">');
    $endTag = '</span>';
} while ($start !== false);


$start = strpos($html, '<span class="show-less">');
$endTag = '</span>';
$end = strpos($html, $endTag, $start);
$html = substr($html, 0, $start) . substr($html, $end + strlen($endTag));
do {
    $end = strpos($html, $endTag, $start);
    $html = substr($html, 0, $start) . substr($html, $end + strlen($endTag));
    $start = strpos($html, '<span class="show-less">');
    $endTag = '</span>';
} while ($start !== false);

file_put_contents("./output/html.html", $html);
