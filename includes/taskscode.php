<?php
/************************************************************
	Establish and checks if connection to database succeded
************************************************************/
$conn = new mysqli("localhost", "root", "", "dynweb_inl3");

if($conn->connect_errno) {
	echo "Connection to database failed";
	die(); // If connection fails, stop running code
}
mysqli_set_charset($conn,"utf8"); // function that makes so you can write in swedish.
$stmt = $conn->stmt_init();

/**************************************************************
	Checks if the variable "delete" is after the links
**************************************************************/
if( isset($_GET["delete"]) ) { 
	
	$taskToDelete = $_GET["delete"];
	$query = "DELETE FROM tasks WHERE id ='{$taskToDelete}'";

	if($stmt->prepare($query) ) {
		$stmt->execute();
	?>
	<p style="color: white; font-size: 20px; padding-left: 13em;"><?php echo "Task <span style='color: red; font-weigh: bold;'>deleted.</span>"; ?><p>
	<?php

	}
}
/***********************************************************
	Adds tasks both to database and webpage
***********************************************************/
if(isset($_POST["addtask"]) ) {
	$taskName = $_POST["taskname"];
	$priority = $_POST["priority"];

	$query = "INSERT INTO tasks VALUES ('', '{$taskName}', 0, '{$priority}')";

	if($stmt->prepare($query)) {
		$stmt->execute();
		header("Location: index.php?taskadded");
	}
	
}

/*********************************************************
	Checks that a task is complete and marks it done
*********************************************************/
if(isset($_GET["complete"]) ) {
	$idToComplete = $_GET["complete"];
	$query = "UPDATE tasks SET complete = 1 WHERE id = '{$idToComplete}'";

	if($stmt->prepare($query) ) {
		$stmt->execute();
?>
		<p style="color: white; font-size: 20px; text-decoration: none; padding-left: 9em;"><?php echo "Task has been marked as <span style='color: green;'>completed!</span><br>";?></p>
<?php
	}
}

/**************************************************************
	Sorts task after names in webpage with a if statement
**************************************************************/
$sort = "";
if(isset($_GET["sort"]) ) { //Avoids error message
	$sort = $_GET["sort"]; //Sorts the links by name after clicking it
}

if($sort == "name") {
	$query = "SELECT * FROM tasks ORDER BY taskName";
}
else if($sort == "asc") {
	$query = "SELECT * FROM tasks ORDER BY priority ASC";
}
else if($sort == "desc") {
	$query = "SELECT * FROM tasks ORDER BY priority DESC";
}
else if($sort == "done") {
	$query = "SELECT * FROM tasks ORDER BY complete";
}
else {
	$query = "SELECT * FROM tasks";
}
?>