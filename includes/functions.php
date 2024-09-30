<?php

$FileNameExtension = basename(strtok($_SERVER["REQUEST_URI"], "?"));
$fileName = explode("/", $_SERVER["SCRIPT_FILENAME"]);
$activePage = str_replace(".php", "", end($fileName));
$streamData = "";
$configFileCheck = webtvpanel_checkFilePermission("configuration.php");
function webtvpanel_date_sort($a, $b)
{
    if (strtotime($time1) < strtotime($time2)) {
        return 1;
    }
    if (strtotime($time2) < strtotime($time1)) {
        return -1;
    }
    return 0;
}
function webtvpanel_CallApiRequest($ApiLinkIs = "")
{
    $returnData = "0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ApiLinkIs);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    if (curl_exec($ch) === false) {
        return array("result" => "error", "data" => "Invalid Host Url");
    }
    $Result = json_decode(curl_exec($ch));
    if (!empty($Result)) {
        $returnData = $Result;
        return array("result" => "success", "data" => $returnData);
    }
    return array("result" => "error");
}
function webtvpanel_checkFilePermission($fileName = "")
{
    if (file_exists($fileName)) {
        $Permission = substr(sprintf("%o", fileperms($fileName)), -4);
        if ($Permission == "0644" || $Permission == "0755" || $Permission == "0777") {
            return array("result" => "success", "permission" => $Permission);
        }
        return array("result" => "error");
    }
}
function webtvpanel_CheckstreamLine($username = "", $password = "", $hostURL = "")
{
    $returnData = "0";
    $bar = "/";
    if (substr($hostURL, -1) == "/") {
        $bar = "";
    }
    $Servername = $hostURL . $bar;
    $ApiLinkIs = $Servername . "player_api.php?username=" . $username . "&password=" . $password;
    $CallApi = webtvpanel_callapirequest($ApiLinkIs);
    if (!empty($CallApi) && $CallApi["result"] == "success") {
        if (isset($CallApi["data"]->user_info->auth) && $CallApi["data"]->user_info->auth != 0 && $CallApi["data"]->user_info->status == "Active") {
            $returnData = "1";
        }
    } else {
        $returnData = "0";
    }
    return $returnData;
}
function webtvpanel_getLoggedInCategories()
{
    $username = $_SESSION["webTvplayer"]["username"];
    $password = $_SESSION["webTvplayer"]["password"];
    $hostURL = $_SESSION["webTvplayer"]["username"];
}
function getLiveVideoLink($streamID = "", $streamType = "")
{
}
function webtvpanel_starRating($rating = "")
{
    if (is_float($rating)) {
        $floatVal = explode(".", $rating);
        $j = 0;
        for ($i = 0; $i < $floatVal[0]; $i++) {
            $j++;
            echo "<span class=\"fa fa-star\"></span>";
        }
        if (5 <= $floatVal[1] || $floatVal[1] <= 5) {
            $j++;
            echo "<span class=\"fa fa-star-half\"></span>";
        }
        for ($remainigStar = 5 - intval($j); $j < 5; $j++) {
            echo "<span class=\"fa fa-star-o\"></span>";
        }
    } else {
        $j = 0;
        for ($i = 0; $i < $rating; $i++) {
            $j++;
            echo "<span class=\"fa fa-star\"></span>";
        }
        for ($remainigStar = 5 - intval($j); $j < 5; $j++) {
            echo "<span class=\"fa fa-star-o\"></span>";
        }
    }
}
function webtvpanel_checkPlayer()
{
    if (isset($_COOKIE["settings_array"]) && !empty($_COOKIE["settings_array"])) {
        $sessionArray = json_decode($_COOKIE["settings_array"]);
        return $sessionArray;
    }
}
function webtvpanel_baseEncode($Text = "")
{
    $returnData = "";
    if ($Text != "") {
        $returnData = base64_encode($Text);
    }
    return $returnData;
}
function webtvpanel_baseDecode($Text = "")
{
    $returnData = "";
    if ($Text != "") {
        $returnData = base64_decode($Text);
    }
    return $returnData;
}
function webtvpanel_parentcondition($Text = "")
{
    $returnData = 0;
    $parentenable = "";
    $parentpassword = "";
    if (isset($_COOKIE["settings_array"])) {
        $SessionStroedUsername = $_SESSION["webTvplayer"]["username"];
        $SettingArray = json_decode($_COOKIE["settings_array"]);
        if (isset($SettingArray->{$SessionStroedUsername}) && !empty($SettingArray->{$SessionStroedUsername})) {
            $parentenable = $SettingArray->{$SessionStroedUsername}->parentenable;
            $parentpassword = $SettingArray->{$SessionStroedUsername}->parentpassword;
        }
    }
    if ($parentenable == "on" && (webtvpanel_like_match("%adults%", $Text) == 1 || webtvpanel_like_match("%adult%", $Text) == 1 || webtvpanel_like_match("%Adults%", $Text) == 1 || webtvpanel_like_match("%XXX%", $Text) == 1 || webtvpanel_like_match("%Porn%", $Text) == 1 || webtvpanel_like_match("%xxx%", $Text) == 1 || webtvpanel_like_match("%Sexy%", $Text) == 1 || webtvpanel_like_match("%foradults%", $Text) == 1 || webtvpanel_like_match("%ADULTE%", $Text) == 1 || webtvpanel_like_match("%adulte%", $Text) == 1)) {
        $returnData = 1;
    }
    return $returnData;
}
function webtvpanel_like_match($pattern, $subject)
{
    $pattern = str_replace("%", ".*", preg_quote($pattern, "/"));
    return (bool) preg_match("/^" . $pattern . "\$/i", $subject);
}
function webtvpanel_loginprocesscallapi($XCStreamHostUrl = "", $UserName = "", $UserPassword = "", $rememberMe = "")
{
    $returnData = array();
    $ApiLinkIs = $XCStreamHostUrl . "player_api.php?username=" . $UserName . "&password=" . $UserPassword;
    $checkLogin = webtvpanel_callapirequest($ApiLinkIs);
    $CateGoriesArray = array();
    $Catechanneldata = array();
    $Result = $checkLogin;
    if ($Result["result"] == "success") {
        if (isset($Result["data"]->user_info->auth)) {
            if ($Result["data"]->user_info->auth != 0) {
                if ($Result["data"]->user_info->status == "Active") {
                    if ($rememberMe == "on") {
                        setcookie("username", $UserName, time() + 2 * 7 * 24 * 60 * 60, "/", $_SERVER["SERVER_NAME"], false);
                        setcookie("userpassword", base64_encode($UserPassword), time() + 2 * 7 * 24 * 60 * 60, "/", $_SERVER["SERVER_NAME"], false);
                    }
                    $SessionArray = array("username" => $Result["data"]->user_info->username, "password" => $Result["data"]->user_info->password, "auth" => $Result["data"]->user_info->auth, "status" => $Result["data"]->user_info->status, "exp_date" => $Result["data"]->user_info->exp_date, "active_cons" => $Result["data"]->user_info->active_cons, "is_trial" => $Result["data"]->user_info->is_trial, "max_connections" => $Result["data"]->user_info->max_connections, "created_at" => $Result["data"]->user_info->created_at, "allowed_output_formats" => $Result["data"]->user_info->allowed_output_formats, "url" => $Result["data"]->server_info->url, "port" => $Result["data"]->server_info->port, "rtmp_port" => $Result["data"]->server_info->rtmp_port, "timezone" => $Result["data"]->server_info->timezone);
                    $_SESSION["webTvplayer"] = $SessionArray;
                    if (substr($XCStreamHostUrl, -1) == "/") {
                        $bar = "";
                        $XCStreamHostUrl = substr($XCStreamHostUrl, 0, -1);
                    }
                    $_SESSION["selectedhost"] = $XCStreamHostUrl;
                    $returnData = array("result" => "success", "message" => $SessionArray);
                } else {
                    $returnData = array("result" => "error", "message" => "Status is " . $Result["data"]->user_info->status);
                }
            } else {
                $returnData = array("result" => "error", "message" => "Invalid Details");
            }
        } else {
            $returnData = array("result" => "error", "message" => "Invalid Details");
        }
    } else {
        $returnData = array("result" => "error", "message" => "Invalid Details");
    }
    return $returnData;
}

?>