<!DOCTYPE html>
<!--	Author: 	Super Friends
		Date:		September 28, 2017
		File:		levenshtein.php
		Purpose: 	Assignment 4
-->
<html>
<head>
	<title>Levenshtein Page</title> 
	<link rel ="stylesheet" type="text/css" href="HW4_CSS.css"> 
</head>
<body>
	<h1>Levenshtein Fucntions</h1> 
	<p><a href="javascript:history.back()">Return to Previous Page</a></p>
	<?php
	set_time_limit(120); 
		//read in the fake words from the fake_words file and store them in an array 
		$fakeWords = file("fake_words.txt", FILE_IGNORE_NEW_LINES); 
		
		//read in the dictionary file 
		$lines = file("engmix.txt", FILE_IGNORE_NEW_LINES); 
		//create an array to hold the shortest levenshtein distance 
		$shortestLeven = array(); 
		
		//create the headers for a table
		//in php, use embedded for loops to iterate over each array (fakewords and lines) 
		//look at inner and outer loop comments for further instruction on those 
		//once the shortest levenshtein has been calculated for the current fakeWord, print the info to a table and add it to the shortestLeven array
		//NOTE: since the fakewords array is already sorted, the table will be sorted aswell (alphabetically) 
		 
		 ?> 
		<table> 
			<table border = "2">
			<tr> <th>Fake Word</th> <th>Dictionary Word</th> <th>Levenshtein Distance</th> </tr>
		<?php 
		for($i = 0; $i < count($fakeWords); $i++)
		{
			$levenNum = 0; 
			$levenWord = "";
			for($j = 0; $j < count($lines); $j++)
			{
				$myLeven = levenshtein($fakeWords[$i], $lines[$j]);
				//the first time the inner loop is called, the levenNum is set to the first leven value from the lines array 
				if($levenNum == 0)
				{
					$levenNum = $myLeven;
					$levenWord = $lines[$j]; 
				}
				//after the first time the inner loop is called, myLeven is compared to the current levenNum
				//if myLeven is less than the levenNum, then levenNum is updated
				//levenNum acts as the lowest leven value for the current fakeWord 
				//set the levenWord to be the word with the shortest leven distance 
				elseif($myLeven < $levenNum)
				{
					$levenNum = $myLeven; 
					$levenWord = $lines[$j]; 
				}
				
			}
			$shortestLeven[] = $fakeWords[$i] . ":" . $levenWord . ":" . $levenNum; 
			
			?> 
			<tr> 
				<th><?php echo $fakeWords[$i] ?></th> <th><?php echo $levenWord ?></th> <th><?php echo $levenNum ?></th>
			</tr>
		<?php 
		}
		//sort the array just for the sake of consistency 
		sort($shortestLeven); 
		//print the array to a file 
		$levenWriter = fopen("leven_words.txt", "w") or die('Cannot open file: '.$levenWriter);
		for($o = 0; $o < count($shortestLeven); $o++)
		{		
			fwrite($levenWriter, $shortestLeven[$o]."\r\n"); 
		} 
		fclose($levenWriter);
			
			
	?>
</body>
</html> 
