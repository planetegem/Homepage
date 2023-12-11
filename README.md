GOAL: 
Create a homepage with a double function: a platform to view content as a source of entertainment, and at the same time a portfolio for me as coder. Content can easily be added. Users can apply custom filters to content to generate an inventory. Inventory needs to contain not only full projects, but also smaller updates. Everything is very pretty and shiny.

REQUIREMENTS:
- inventory.xml keeps track of details of entries (type of entry, title, date, tags, etc)
- seperate html file contains the project description (the allow for custom formatting)
- extra info about coding is originally hidden, but can be unfolded (also in a seperate html file)
- xml is read in php
    -> list is compiled with all tags (to create filter menu)
    -> items from xml are filtered and sorted
    -> php echoes items to html
    -> filters can be applied: 
        -> applying filters generates a POST request with filter info
        -> POST request is translated into custom key pairs
        -> user is redirected to page with GET request
        -> GET request is used to interpret filters

  ![Alt text](https://github.com/planetegem/MazeBase/blob/master/build/assets/brain.png?raw=true "Title")
