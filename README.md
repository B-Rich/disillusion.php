# Disillusion.php

_The lightest PHP testing framework on earth and beyond_

```PHP
<?php 
require_once "disillusion.php";

expectation("something") && reality($something);
```

## Concept

Expectation and reality are the core concept in any testing framework regardless its philosophy. With Disillusion.php, I made the choice to keep these aspects and these only. Which mean you only have 2 functions at your disposal:

+ expectation($anything)
+ reality($anything)

You may call them, stack them, pass them function; whatever floats your boat. Give it a try by cloning the project and run the demo.php script.