<?php // *le PHP open tag

// Start by including the lib
require_once "lib/disillusion.php";

// A simple value
// --------------

// our tested value
$value = 2;

// We expect our value to equal 1
expectation(1);

// Is that so ?
reality($value);

// Will display

// > Reality defined at line 16 doesn't match expectation from line 13

// However, reality that match expectation won't display anything:
expectation(true) && reality(true);
expectation(new stdClass) && reality(new stdClass);
expectation([1,2,3]) && reality([1,2,3]);

// oh, and I forgot to mention you can chain __expecation__ and __reality__ calls

// Expectations are stackable
// --------------------------

// Which means you can do more than one expectation before validating them with reality.

expectation(1);
expectation(2);
expectation(3);
reality(3);
reality(2);
reality(1);
reality(0);

// Will display

// > Nothing is expected at line 40

// because we stacked too few expectations 

// Works with functions
// --------------------

expectation(function () {
    return "foo";
});

reality(function () {
    return "bar";
});

// Will display

// > Reality defined at line 55 doesn't match expectation from line 51

// Works with multiple value
// -------------------------

expectation(1,2,3);

reality(1,3,2);

// The above example will display

// > Reality defined at line 68 doesn't match expectation from line 67

// because __order counts__.