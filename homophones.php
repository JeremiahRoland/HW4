<!--            Author:         Super Friends
		Date:		October 11, 2017
		File:		homophones.php
		Purpose: 	Assignment 4
-->
<html>
<head>
	<title>Homophones</title>
	<link rel ="stylesheet" type="text/css" href="HW4_CSS.css"> 
</head>
<body>
	<h1>Homophones</h1> 
	<h2>Below are the homophones of all the misspelled words</h2> 
        <p><a href="javascript:history.back()">Return to Previous Page</a></p>
<?php
$fileClear = fopen("homophones.txt", "w");
fclose($fileClear);
$lines = file("engmix.txt", FILE_IGNORE_NEW_LINES);
$fakes = file("fake_words.txt", FILE_IGNORE_NEW_LINES);
print("<p><strong> FORMAT NOTE </strong> :  Word: Number of Homophones: Homophone 1, Homophone 2, ... </p>");


//Generate doundex and metaphone values for the dictionary file
for ($i = 0; $i < count($lines); $i++) {
    $linesSoundex[$lines[$i]] = soundex($lines[$i]);
    $linesMetaphone[$lines[$i]] = metaphone($lines[$i]);
}

//Generate soundex and metaphone values for the misspelled words
for ($i = 0; $i < count($fakes); $i++) {
    $fakesSoundex[$fakes[$i]] = soundex($fakes[$i]);
    $fakesMetaphone[$fakes[$i]] = metaphone($fakes[$i]);
}
//Find all matching soundex values between the misspelled words and the dictionary
//Create a 2d associative array containing with the misspelled word as the key, and the matching dictionary words as the values
foreach ($fakesSoundex as $key => $value) {
    $foundSoundex[$key] = array_keys($linesSoundex, $value);
}

foreach ($fakesMetaphone as $key => $value) {
    $foundMetaphone[$key] = array_keys($linesMetaphone, $value);
}

ob_start();
foreach ($foundMetaphone as $a => $b) {
    echo "<strong> $a </strong>" . ": " . count($b) . ": " ;
    foreach ($b as $c => $d) {
        echo $d . ": ";
    }
    echo PHP_EOL;
}
$outputMetaphone = ob_get_clean();
$metaphoneArray = explode("\n", $outputMetaphone);
//file_put_contents("homophones.txt", $outputMetaphone);


ob_start();
foreach ($foundSoundex as $a => $b) {
    echo "<strong> $a </strong>" . ": " . count($b) . ": " ;
    foreach ($b as $c => $d) {
        echo $d . ": ";
    }
    echo PHP_EOL;
    print("<p></p>"); 
}
$outputSoundex = ob_get_clean();
$soundexArray = explode("\n", $outputSoundex);


$file = fopen("homophones.txt", "a");

for($i=0; $i < count($soundexArray); $i++) {
    fwrite($file, $soundexArray[$i]."\r\n");
    fwrite($file, $metaphoneArray[$i]."\r\n");
    echo $soundexArray[$i] . "<br>";
    echo $metaphoneArray[$i] . "<br>";
}
fclose($file);
?>
</body>
</html>
