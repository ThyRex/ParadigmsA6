<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
?>
<html>
<head>
</head>
<body> 


<form action="<?php print($_SERVER['SCRIPT_NAME'])?>" method="get">
	<input type="text" name="entry">
	<input type="submit" value="Submit">
</form>


<form action="<?php print($_SERVER['SCRIPT_NAME'])?>" method="get">
	<input type="submit" value="Save" name="save">
	<input type="submit" value="Clear" name="reset">
</form>

<?php
if(!isset($_SESSION['entries'])){
	$_SESSION['entries'] = array();
}
if(isset($_GET["entry"])){
	$temp = htmlentities($_GET["entry"]);
	$entries = &$_SESSION['entries'];
	$entries []= $temp;
}

if(isset($_GET["save"])){
	$fh = fopen("entries.json", 'w');
	if($fh === false)
		die("Failed to open entries.json for writing.");
	else
	{
		fwrite($fh, json_encode($_SESSION['entries']));
		fclose($fh);
	}
}

ob_start();
foreach(array_reverse($_SESSION['entries']) as $entry){
	echo $entry;
	echo "<br>";
}

if(isset($_GET["reset"])){
	unset($_SESSION['entries']);
	ob_end_clean();
}
?>

</body>
</html>
