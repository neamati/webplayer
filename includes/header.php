<?php

session_start();
include_once "includes/functions.php";
$checkLicense = "nulled";
$bar = "/";
$XCStreamHostUrl = isset($XCStreamHostUrl) ? $XCStreamHostUrl : "";
$XClicenseIsval = isset($XClicenseIsval) ? $XClicenseIsval : "";
$XClocalKey = isset($XClocalKey) ? $XClocalKey : "";
$SessioStoredUsername = !empty($_SESSION["webTvplayer"]["username"]) ? $_SESSION["webTvplayer"]["username"] : "";
if (substr($XCStreamHostUrl, -1) == "/") {
    $bar = "";
}
if ($configFileCheck["result"] == "success") {
    if ($configFileCheck["permission"] == "0777" || $configFileCheck["permission"] == "0755") {
        require "configuration.php";
    } else {
        require "configuration.php";
    }
} else {
    if (!file_exists("configuration.php")) {
        $my_file = "configuration.php";
        $handle = fopen($my_file, "w") or exit("Cannot open file:  " . $my_file);
    }
}
if (!isset($_SESSION["webTvplayer"]) && empty($_SESSION["webTvplayer"]) && $activePage !== "index") {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}
if (empty($XClicenseIsval)) {
    echo "<script>window.location.href = 'player_install.php';</script>";
    exit;
}
$checkLicense = "nulled";
if ($checkLicense == "Active" && isset($checkLicense["localkey"]) && !empty($checkLicense["localkey"])) {
    $New_XCStreamHostUrl = $FirstDNs;
    $XCStreamHostUrl = $FirstDNs;
    $New_XCStreamHostUrl_2 = isset($XCStreamHostUrl_2) && !empty($XCStreamHostUrl_2) ? $XCStreamHostUrl_2 : "";
    $New_XCStreamHostUrl_3 = isset($XCStreamHostUrl_3) && !empty($XCStreamHostUrl_3) ? $XCStreamHostUrl_3 : "";
    $New_XCStreamHostUrl_4 = isset($XCStreamHostUrl_4) && !empty($XCStreamHostUrl_4) ? $XCStreamHostUrl_4 : "";
    $New_XCStreamHostUrl_5 = isset($XCStreamHostUrl_5) && !empty($XCStreamHostUrl_5) ? $XCStreamHostUrl_5 : "";
    $New_XClogoLinkval = $XClogoLinkval;
    $New_XCcopyrighttextval = $XCcopyrighttextval;
    $New_XCcontactUslinkval = $XCcontactUslinkval;
    $New_XChelpLinkval = $XChelpLinkval;
    $New_XClicenseIsval = $XClicenseIsval;
    $New_XClocalKey = "nulled";
    $New_XCsitetitleval = $XCsitetitleval;
    $New_FirstDNs = $FirstDNs;
    $response["result"] = "no";
    $content = "<?php 
";
    $content .= "\$XCStreamHostUrl = \"" . $New_XCStreamHostUrl . "\";" . "\n";
    if ($New_XCStreamHostUrl_2 != "") {
        $content .= "\$XCStreamHostUrl_2 = \"" . $New_XCStreamHostUrl_2 . "\";" . "\n";
    }
    if ($New_XCStreamHostUrl_3 != "") {
        $content .= "\$XCStreamHostUrl_3 = \"" . $New_XCStreamHostUrl_3 . "\";" . "\n";
    }
    if ($New_XCStreamHostUrl_4 != "") {
        $content .= "\$XCStreamHostUrl_4 = \"" . $New_XCStreamHostUrl_4 . "\";" . "\n";
    }
    if ($New_XCStreamHostUrl_5 != "") {
        $content .= "\$XCStreamHostUrl_5 = \"" . $New_XCStreamHostUrl_5 . "\";" . "\n";
    }
    $content .= "\$XClogoLinkval = \"" . $New_XClogoLinkval . "\";" . "\n";
    $content .= "\$XCcopyrighttextval = \"" . $New_XCcopyrighttextval . "\";" . "\n";
    $content .= "\$XCcontactUslinkval = \"" . $New_XCcontactUslinkval . "\";" . "\n";
    $content .= "\$XChelpLinkval = \"" . $New_XChelpLinkval . "\";" . "\n";
    $content .= "\$XClicenseIsval = \"" . $New_XClicenseIsval . "\";" . "\n";
    $content .= "\$XClocalKey = \"" . $New_XClocalKey . "\";" . "\n";
    $content .= "\$XCsitetitleval = \"" . $New_XCsitetitleval . "\";" . "\n";
    $content .= "\$FirstDNs = \$XCStreamHostUrl;" . "\n";
    $content .= "\$XCStreamHostUrl = (isset(\$_SESSION[\"selectedhost\"]) && !empty(\$_SESSION[\"selectedhost\"]))?\$_SESSION[\"selectedhost\"]:\$XCStreamHostUrl;" . "\n";
    $content .= "?>";
    if (file_exists("configuration.php")) {
        unlink("configuration.php");
    }
    $fp = fopen("configuration.php", "w");
    fwrite($fp, $content);
    fclose($fp);
    chmod("configuration.php", 420);
    if (file_exists("configuration.php")) {
        echo "<script>location.reload();</script>";
        exit;
    }
}

if (isset($_SESSION["webTvplayer"])) {
    $username = $_SESSION["webTvplayer"]["username"];
    $password = $_SESSION["webTvplayer"]["password"];
    $hostURL = $XCStreamHostUrl;
}
$ShiftedTimeEPG = 0;
$headerparentcondition = "";
$GlobalTimeFormat = "12";
if (isset($_COOKIE["settings_array"])) {
    $SettingArray = json_decode($_COOKIE["settings_array"]);
    if (isset($SettingArray->{$SessioStoredUsername}) && !empty($SettingArray->{$SessioStoredUsername})) {
        $ShiftedTimeEPG = $SettingArray->{$SessioStoredUsername}->epgtimeshift;
        $GlobalTimeFormat = $SettingArray->{$SessioStoredUsername}->timeformat;
        $headerparentcondition = $SettingArray->{$SessioStoredUsername}->parentpassword;
    }
}
echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<title>";
echo isset($XCsitetitleval) ? $XCsitetitleval : "";
echo "</title>

<!-- Bootstrap -->
<style>
:root {
  --primary-color: #fff;
  --dark-gray: #222;
  --almost-black: #111;
  --semi-white: #ccc;
  --blue: #3498db;
  --red: #e74c3c;
  
  --standard: 1.25rem;
  --big: 2rem;
  --small: 0.7rem;
  
  --serif: Georgia, serif;
}
</style>
<link href=\"css/bootstrap.css\" rel=\"stylesheet\">
<link href=\"css/style.css\" rel=\"stylesheet\">
<link href=\"css/owl.carousel.css\" rel=\"stylesheet\">
<link href=\"css/font-awesome.min.css\" rel=\"stylesheet\">
<link href=\"css/scrollbar.css\" rel=\"stylesheet\">

<script src=\"js/jquery-1.11.3.min.js\"></script> 
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/rippler.css\" />


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
    <style>
    #cbp-spmenu-s1
    {
      padding-bottom: 80px;
    }
  </style>
</head>
<body>

	<div class=\"body-content\">
  	<div class=\"overlay\"></div>
    
  	";

?>