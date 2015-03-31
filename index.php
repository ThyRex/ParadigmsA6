
<html>
<head>
<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
?>
</head>
<body> 


<form action="<?php print($_SERVER['SCRIPT_NAME'])?>" method="get">
	<input type="text" name="entry">
	<input type="submit" value="Submit">
</form>

<form action="<?php print($_SERVER['SCRIPT_NAME'])?>" method="get">
	<input type="submit" value="Save">
</form>

<?php

if(!isset($_SESSION['entries'])){
	$_SESSION['entries'] = array();
}
if(isset($_GET["entry"])){
	$temp = htmlentities($_GET["entry"]);
}

if(isset($temp) && !empty($temp)){
	$entries = &$_SESSION['entries'];
	$entries []= $temp;
}

foreach(array_reverse($_SESSION['entries']) as $entry){
	echo $entry;
	echo "<br>";
}

// Saving data from form in text file in JSON format
// From: http://coursesweb.net/php-mysql/

// check if all form data are submited, else output error message
if(isset($_GET["entry"])) {

    // adds form data into an array
   $fh = fopen("entries.json", 'w');
	if($fh === false)
		die("Failed to open entries.json for writing.");
	else{
		fwrite($fh, json_encode($entries));
		fclose($fh);
	}
}




?>

</body>
</html>
