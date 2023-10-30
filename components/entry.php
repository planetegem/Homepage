<?php
function createEntry($entry, $counter){
    $class = ($counter % 2) > 0 ? "hidden item left": "hidden item right";
    if (!$entry->thumbnail){
        $class = $class . " update";
    } else {
        $class = $class . " image";
    }
    echo "<segment class='{$class}'>";
    echo "<div class='item-header-container'>";
    echo "<div class='item-header'>";
    echo "<h1>" . $entry->title . "</h1>";
    if (!$entry->update){
        echo "<p>[added on " . $entry->date->day . "-" . $entry->date->month . "-" . $entry->date->year . "]</p>";
    } else {
        echo "<p>[updated on " . $entry->update->day . "-" . $entry->update->month . "-" . $entry->update->year . "]</p>";
    }
    echo "</div>";
    echo "</div>";
    
    echo "<div class='body-outline'>";
    echo "<div class='item-body'>";
    
    // Create list of tags
    $tags = "tags: " . $entry->language;
    foreach($entry->tags->children() as $tag){
        $tags = $tags . ", " . $tag;
    }
    echo "<h4 class='item-tags'>{$tags}</h4>";
    if ($entry->thumbnail){
        echo "<img src='{$entry->thumbnail}' alt=''></img>";
    }
    include $entry->description;

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
    echo "</div>";
    echo "</segment>";
}
function showSelection($selection){
    $counter = 0;
    foreach($selection as $entry){
        $counter++;
        createEntry($entry, $counter);
    }
}
showSelection($loadedItems);