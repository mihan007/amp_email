<?php
//Make amp
$file = file_get_contents('./input/input.json');
$input = (array)json_decode($file);
ob_start();
?>
<?php include "./parts/head_amp.php" ?>
<?php include "./parts/body_amp.php" ?>
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
file_put_contents("./output/html.html", $html);
