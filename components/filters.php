<?php
// CREATE TAG, TYPE & LANGUAGE LISTS
$uniqueTags = $uniqueTypes = $uniqueLanguages = [];
foreach($xml->children() as $entry){
    $uniqueLanguages[] = strval($entry->language);
    $uniqueTypes[] = strval($entry->type);
    foreach($entry->tags->children() as $tag){
        $uniqueTags[] = strval($tag);
    }
}
$uniqueTags = array_unique($uniqueTags);
$uniqueLanguages = array_unique($uniqueLanguages);
$uniqueTypes = array_unique($uniqueTypes);
?>

<nav id="filter-menu">
    <div class="menu-buttons">
        <div id="menu-button-outline" onclick="toggleMenu()">
            <button class="filter-button">apply filters</button>
        </div>
    </div>
    <div id="menu-container">
        <div id="menu-outline">
            <form class="menu-body">
                <p>Is Planetegem too big for you?</br>Check items to create your very own safe space!</p>
                <hr>
                <p>filter on language:</p>
                <div class="subfilter">
                    <?php
                        $counter = 0;
                        foreach ($uniqueLanguages as $language){
                            $counter++;
                            echo "<div class='checkbox'>";
                            echo "<input type='checkbox' id='{$language}' name='language{$counter}' value='{$language}'>";
                            echo "<label for='{$language}'>" . strtolower($language) . "</label>";
                            echo "</div>";
                        }
                    ?>
                </div>
                <p>filter on type:</p>
                <div class="subfilter">
                    <?php
                        $counter = 0;
                        foreach ($uniqueTypes as $type){
                            $counter++;
                            echo "<div class='checkbox'>";
                            echo "<input type='checkbox' id='{$type}' name='language{$counter}' value='{$type}'>";
                            echo "<label for='{$type}'>" . strtolower($type) . "</label>";
                            echo "</div>";
                        }
                    ?>
                </div>
                <p>filter on tag:</p>
                <div class="subfilter">
                    <?php
                    $counter = 0;
                    foreach ($uniqueTags as $tag){
                        $counter++;
                        echo "<div class='checkbox'>";
                        echo "<input type='checkbox' id='{$tag}' name='tag{$counter}' value='{$tag}'>";
                        echo "<label for='" . $tag . "'>" . strtolower($tag) . "</label>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <p>order by date:</p>
                <div class="subfilter">
                    <div class="checkbox">
                        <input type="radio" id="descending" name="order" value="descending">
                        <label for="descending">descending</label>
                    </div>
                    <div class="checkbox">
                        <input type="radio" id="ascending" name="order" value="ascending" >
                        <label for="ascending">ascending</label>
                    </div>
                </div>   
                <span class="close-menu" onclick="toggleMenu()">[close menu]</span>
            </form>
        </div>
    </div>
</nav>