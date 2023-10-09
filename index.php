<?php session_start(); ?>

<?php
// Convert post data into get data
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $_SESSION["posting"] = true;

    $postedOrder = "order=" . $_POST["order"];

    // Split variables
    $postedLanguages = $postedTypes = $postedTags = array();
    $geturl = "";

    foreach($_POST as $key => $value){
        $key = preg_replace("/[0-9]+/", "", $key); // Remove counter digit from input name
        $value = str_replace(" ", "~", $value); // Clean spaces
        if ($key === "language"){
            $postedLanguages[] = $value;
        } else if ($key === "type"){
            $postedTypes[] = $value;
        } else if ($key === "tag"){
            $postedTags[] = $value;
        } else if ($key === "order"){
            $geturl = "{$key}={$value}";
        }
    }

    // Construct url with extracted variables
    if (count($postedLanguages) > 0){
        $geturl = "&{$geturl}";
        foreach($postedLanguages as $lang){
            $geturl = "+{$lang}{$geturl}";
        }
        $geturl = ltrim($geturl, "+");
        $geturl = "language={$geturl}";
    }
    if (count($postedTypes) > 0){
        $geturl = "&{$geturl}";
        foreach($postedTypes as $type){
            $geturl = "+{$type}{$geturl}";
        }
        $geturl = ltrim($geturl, "+");
        $geturl = "type={$geturl}";
    }
    if (count($postedTags) > 0){
        $geturl = "&{$geturl}";
        foreach($postedTags as $tag){
            $geturl = "+{$tag}{$geturl}";
        }
        $geturl = ltrim($geturl, "+");
        $geturl = "tag={$geturl}";
    }
    // Resend data as GET
    header("location:?" . $geturl);
}

// Make GET variables usable
if (isset($_GET["language"])){
    $getLanguages = explode(" ", $_GET["language"]);
    $getLanguages = str_replace("~", " ", $getLanguages);
    $_SESSION["languages"] = $getLanguages;
}
if (isset($_GET["type"])){
    $getTypes = explode(" ", $_GET["type"]);
    $getTypes = str_replace("~", " ", $getTypes);
    $_SESSION["types"] = $getTypes;
}
if (isset($_GET["tag"])){
    $getTags = explode(" ", $_GET["tag"]);
    $getTags = str_replace("~", " ", $getTags);
    $_SESSION["tags"] = $getTags;
}
?>

<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" lang="nl" xml:lang="nl">
<head>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
    <meta name="description" content="Online Belgian platform for multimedial creative work. Submissions welcome!">
    <meta name="keywords" content="encyclopedia Belgica, culture, vleeskanon, sci-fi belgian novel, political memory, definitions, Belgium">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="notranslate">
    <title>Planetegem - the Belgian creative repository.</title>
    <meta name="author" content="Niels Van Damme">
    <link rel="stylesheet" href="style/index.css">
</head>

<?php
// Load XML inventory
$xml = simplexml_load_file("inventory/inventory.xml") or die("Error: Cannot create object");

// Copy XML into work array
function checkFilter($item){
        if (isset($_SESSION["languages"])){
            $languageIncluded = false;
            foreach($_SESSION["languages"] as $langFilter){
                if ($langFilter == $item->language){
                    $languageIncluded = true;
                }
            }
            if (!$languageIncluded){
                return false;
            }
        }
        if (isset($_SESSION["types"])){
            $typeIncluded = false;
            foreach($_SESSION["types"] as $typeFilter){
                if ($typeFilter == $item->type){
                    $typeIncluded = true;
                }
            }
            if ($typeIncluded === false){
                return false;
            }
        }
        if (isset($_SESSION["tags"])){
            $tagsArray = array();
            foreach($item->tags->children() as $currentTag){
                $tagsArray[] = $currentTag;
            }
            $test = array_intersect($_SESSION["tags"], $tagsArray);
            if (count($test) > 0){
                return true;
            } else {
                return false;
            }
        }
        return true;
}


$loadedItems = [];
foreach($xml->children() as $entry){
    $entry->techdate = $entry->date->year . "-" . $entry->date->month . "-" . $entry->date->day;
    if(checkFilter($entry)){
        $loadedItems[] = $entry;
    }
}

// SORT ARRAY DEPENDING ON SETTINGS
function compDate($a, $b){
    if(isset($_GET["order"]) && $_GET["order"] === "ascending"){
        return strtotime($a->techdate) - strtotime($b->techdate);
    } else {
        return strtotime($b->techdate) - strtotime($a->techdate);
    }
}
usort($loadedItems, "compDate");
?>

<body>
    <?php include "components/filters.php"; ?>
    <?php include "components/background.php"; ?>
    <main>
        <?php include "components/entry.php"; ?>
    </main>
    <?php include "components/footer.php"; ?>
<script src="components/base.js"></script>
<script src="components/menu.js"></script>
</body>

<?php 
// Clean session variables
unset($_SESSION["languages"]);
unset($_SESSION["types"]);
unset($_SESSION["tags"]);
unset($_SESSION["posting"]);
?>