<!DOCTYPE html>
<!--	Author: 	Jeremiah Roland
		Date:		September 25, 2017
		File:		Start.html
		Purpose: 	Assignment 4
-->
<html>
<head>
	<title>Letter Frequency</title>
	<link rel ="stylesheet" type="text/css" href="HW4_CSS.css"> 
</head>
<body>
	<h1>This is the Letter Frequency Page</h1> 
	<h2>Here are the letter frequencies in the engmix.txt file</h2> 
	
	<?php
		//read in the engmix file line by line and store it in lines 
		//create alphabetHolder to hold the alphabet, and create an associative array to hold each value 
		$lines = file("engmix.txt", FILE_IGNORE_NEW_LINES);
		$alphabetHolder = "abcdefghijklmnopqrstuvwxyz"; 
		$alphabet = array(); 
		for($i = 0; $i < strlen($alphabetHolder); $i++)
		{
			$key = $alphabetHolder[$i];
			$alphabet["$key"] = 0; 
		}
		$letterCount = 0; 
		for($u = 0; $u < count($lines); $u++)
		{
			$letterCount += strlen($lines[$u]); 
		}
		
		//count how many times each letter occurs in lines 
		//Calculate the length of the original string (lines[o]) and the length of the string
		//without the specified character
		//the difference is the number of matches 
		
		//outer loop for alphabet 
		for($j = 0; $j < strlen($alphabetHolder); $j++)
		{
			$myKey = $alphabetHolder[$j]; 
			//inner loop for lines 
			for($o = 0; $o < count($lines); $o++)
			{
				//1st part: length of the original string 
				//2nd part: length of the string without the specified character 
					//replaces each occurence of the specified character with a blank space 
					//split the original string into an array, one character for each itme
					//pass it ito str_replace, replacing each occurence of the items in the 
					//search array with a blank string 
				$count = strlen($lines[$o]) - strlen(str_replace(str_split("$myKey"), "", $lines[$o])); 
				$alphabet["$myKey"] = $alphabet["$myKey"] + $count; 
			}
		}
		//print("<pre>"); 
		//print_r($alphabet); 
		//print("</pre>");
		
		$clearFile = fopen("letter_frequency.txt", "w") or die ("Cannot open file: ".$clearFile);
		fwrite($clearFile, "");
		fclose($clearFile); 
		?> 
		<table> 
			<table border = "2">
			<tr> <th>Letter</th> <th>Frequency</th> <th>Percentage</th> </tr>
	<?php
		//print the frequencies and percentages to the screen and write them to a file 
		//format: letter: freq. : %
		for($p = 0; $p < strlen($alphabetHolder); $p++)
		{
			$letter = $alphabetHolder[$p];
			$freq = $alphabet["$alphabetHolder[$p]"]; 
			$percentage = round($freq/$letterCount, 3); 
		
			
	?> 
				<tr> 
					<th><?php echo $letter ?></th> <th><?php echo $freq ?></th> <th><?php echo $percentage ?></th>
				</tr>
	<?php
			
			//print("<p>$letter : $freq : $percentage </p>");
			$writeFile = fopen("letter_frequency.txt", "a") or die('Cannot open file: '.$writeFile);
			fwrite($writeFile, $letter);
			fwrite($writeFile, ":" );
			fwrite($writeFile, $freq);
			fwrite($writeFile, ":");
			fwrite($writeFile, $percentage."\r\n");
			fclose($writeFile);
		}
		
	?>
</body>
</html> 
