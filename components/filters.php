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
    <a href="https://github.com/planetegem" target="_blank">[github]</a>
    <div id="menu-button-outline" onclick="toggleMenu()">
        <button class="filter-button">apply filters</button>
    </div>
    <div id="menu-container">
        <div id="menu-outline">
            <form 
                class="menu-body" method="POST" 
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
            >
                <p>Is Planetegem too big for you?</br>Check items to create your very own safe space!</p>
                <hr>
                <p>filter on language:</p>
                <div class="subfilter">
                    <?php
                        $counter = 0;
                        foreach ($uniqueLanguages as $language){
                            $counter++;
                            echo "<div class='checkbox'>";
                            echo "<input type='checkbox' id='{$language}' name='language{$counter}' value='{$language}'";

                            if (isset($_SESSION["languages"])){
                                $test = false;
                                foreach($_SESSION["languages"] as $langFilter){
                                    if ($langFilter == $language){
                                        $test = true;
                                    }
                                }
                                if ($test){
                                    echo "checked";
                                }
                            }

                            echo ">";
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
                            echo "<input type='checkbox' id='{$type}' name='type{$counter}' value='{$type}'";

                            if (isset($_SESSION["types"])){
                                $test = false;
                                foreach($_SESSION["types"] as $typeFilter){
                                    if ($typeFilter == $type){
                                        $test = true;
                                    }
                                }
                                if ($test){
                                    echo "checked";
                                }
                            }

                            echo ">";
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
                            echo "<input type='checkbox' id='{$tag}' name='tag{$counter}' value='{$tag}'";

                            if (isset($_SESSION["tags"])){
                                $test = false;
                                foreach($_SESSION["tags"] as $tagFilter){
                                    if ($tagFilter == $tag){
                                        $test = true;
                                    }
                                }
                                if ($test){
                                    echo "checked";
                                }
                            }
                            
                            echo ">";
                            echo "<label for='" . $tag . "'>" . strtolower($tag) . "</label>";
                            echo "</div>";
                        }
                    ?>
                </div>
                <p>order by date:</p>
                <div class="subfilter">
                    <div class="checkbox">
                        <input type="radio" id="descending" name="order" value="descending" 
                            <?php if (!isset($_GET["order"]) || $_GET["order"] === "descending"){
                                echo "checked";
                            }?>
                        >
                        <label for="descending">descending</label>
                    </div>
                    <div class="checkbox">
                        <input type="radio" id="ascending" name="order" value="ascending" 
                            <?php if (isset($_GET["order"]) && $_GET["order"] === "ascending"){
                                echo "checked";
                            }?>
                        >
                        <label for="ascending">ascending</label>
                    </div>
                </div>
                <div class="submit-button">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.7 34">
                        <polygon points="0 0 56.7 17.3 0 34 0 0"/>
                    </svg>
                    <input type="submit" value="confirm filters" name="submit">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.7 34">
                        <polygon points="0 0 56.7 17.3 0 34 0 0"/>
                    </svg>
                </div> 
                <span class="close-menu" onclick="toggleMenu()">[close menu]</span>
            </form>
        </div>
    </div>
</nav>