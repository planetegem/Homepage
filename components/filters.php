<?php
// CREATE TAG, TYPE & LANGUAGE LISTS
$uniqueTags = $uniqueLanguages = [];
foreach($xml->children() as $entry){
    $uniqueLanguages[] = strval($entry->language);
    foreach($entry->tags->children() as $tag){
        $uniqueTags[] = strval($tag);
    }
}
$uniqueTags = array_unique($uniqueTags);
$uniqueLanguages = array_unique($uniqueLanguages);
?>

<span id="menu-overlay"></span>
<nav id="filter-menu">
    <a href="https://github.com/planetegem" target="_blank">[github]</a>
    <div id="menu-container-top">
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
                    
                    <span class="close-menu" onclick="toggleMenu()">[close menu without applying]</span>
                </form>
            </div>
        </div>
        <div id="menu-button-outline" onclick="toggleMenu()">
            <button class="filter-button">apply filters</button>
        </div>
    </div>
</nav>