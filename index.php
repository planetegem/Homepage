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
// LOAD XML
$xml = simplexml_load_file("inventory/inventory.xml") or die("Error: Cannot create object");

function createEntry($entry, $counter){
    $class = ($counter % 2) > 0 ? "hidden item left": "hidden item right";
    echo "<segment class='{$class}'>";
    echo "<div class='item-header-container'>";
    echo "<div class='item-header'>";
    echo "<h1>" . $entry->title . "</h1>";
    echo "<p>[added on " . $entry->date->day . "-" . $entry->date->month . "-" . $entry->date->year . "]</p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='item-body'>";
    
    // Create list of tags
    $tags = "tags: " . $entry->language . ", " . $entry->type;
    foreach($entry->tags->children() as $tag){
        $tags = $tags . ", " . $tag;
    }
    echo "<h4 class='item-tags'>{$tags}</h4>";
    
    echo "<img src='{$entry->thumbnail}' alt=''></img>";
    echo "<div class='item-description'>";
    include $entry->description;

    if ($entry->coding){
        echo "<span onClick='toggleCoding(this)'>[read more]</span>";
        echo "</div>";
        echo "<div class='coding-field'>";
        echo "<div>";
        include $entry->coding;
        echo "</div>";
        echo "</div>";
    } else {
        echo "</div>";
    }

    echo "<div class='item-links'>";
    foreach($entry->links->children() as $link){
        echo "<div class='link-container'>";
        echo <<<SVG
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.7 34">
                <polygon points="0 0 56.7 17.3 0 34 0 0"/>
            </svg>
            SVG;
        echo "<a href='{$link["target"]}'>{$link}</a>";
        if (count($entry->links->children()) === 1){
            echo <<<SVG
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.7 34">
                    <polygon points="0 0 56.7 17.3 0 34 0 0"/>
                </svg>
                SVG;
        }
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    echo "</segment>";
}

function showSelection($selection){
    $counter = 0;
    foreach($selection->children() as $entry){
        $counter++;
        createEntry($entry, $counter);
    }
}

?>

<body>
    <?php include "components/background.php"; ?>
<main>
    <?php showSelection($xml); ?>
</main>

<script src="components/base.js"></script>
</body>