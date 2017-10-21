#!/usr/bin/php
<?PHP

function printLine($string) { echo $string.PHP_EOL; }

function printHelp () {

    printLine (" ");
    printLine ("This is a bookmarking script. It takes exactly one argument: an URL. It then fetches title and other information from it.");
    printLine (" ");
}

function getFirstElement ($input, $tag) {

    $start = strpos($input, "<$tag");
    $start = strpos($input, ">", $start) + 1; // Needs to be reset after, because of classes or styles given to the tag
    $end = strpos($input, "</$tag>", $start);
    return (strip_tags(substr($input, $start, $end - $start)));

}

if (count($argv) == 1 || count($argv) > 2) { printHelp(); }
else {

    $url = $argv[1];

    printLine (" ");

    printLine ("Fetching from $url");
    if ($contents = file_get_contents($url)) printLine ("Fetched source");
    else die ("Failed fetching from source".PHP_EOL);

    $title = getFirstElement ($contents, "h1");

    $description = "";
    if (strpos($contents, '"description"') > 1) {

        $descriptionStart = strpos($contents, '"description"');
$descriptionContentStart = strpos($contents, "content=", $descriptionStart) + 9;
$descriptionContentEnd   = strpos($contents, '"', $descriptionContentStart);

$description = substr($contents, $descriptionContentStart, $descriptionContentEnd - $descriptionContentStart);

    }

printLine ("Title      : $title");
printLine ("Description: $description");
printLine (" ");

    exec ('/home/jrenslin/Sync/Programming/bash/bookmarks/bookmark-plugin.sh '.escapeshellarg($url)." ".escapeshellarg($title)." ".escapeshellarg($description)." ".escapeshellarg("")." ");

}
?>