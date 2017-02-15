<!DOCTYPE html>
<html>
<head>
	<title>index.php</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet"> <!-- link to googlefonts -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/normalize.css"> <!-- nomalize css -->
	<link rel="stylesheet" type="text/css" href="css/indexstyle.css"> <!-- local css -->
	<link rel="stylesheet" type="text/css" href="css/responsivestyle.css"> <!-- responsive css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"><!-- external css animation link -->
</head>
<body>
<div class="wrapper">
	<header>
		<div class="banner">
			<h1 class="banner-item1">To -<span class="h2-first">Do -</span> <span>List</span></h1>
			<h2 class="banner-item2">Order <span class="h2-second">and</span><span class="h2-third"> Discipline</span></h2>
		</div> <!-- .banner -->
	</header>
	<main>
		<div class="list-title">
			<p>Sort tasks by:<br>
			   <a href="index.php?sort=name">Name</a><br>
			   <a href="index.php?sort=asc">Priority ascending</a><br>
			   <a href="index.php?sort=desc">Priority descending</a><br>
			   <a href="index.php?sort=done">Done</a><br>
			   <a href="index.php?sort=none">Original</a>
			</p>
		</div><!-- list-title -->
	</main>

	<?php
	include_once("includes/taskscode.php"); // includes file "taskcode.php".
	/*****************************************************************
		Makes sure that sql is correctly written and runs it throu 
		database
	*****************************************************************/

	if($stmt->prepare($query)) { 
		$stmt->execute(); 

		$stmt->bind_result($id, $taskName, $complete, $priority);

		?>
		<!--****************************************************************
						Start of table for todo: list
		*****************************************************************-->
		<div class="table-body">
			<table border="2" class="table-list">
			<caption class="animated fadeInLeft">List of things to do.</caption><br> <!-- external css animation link for caption -->
			<tr>
			    <th>Tasks</th>
			    <th>Priority</th>
			    <th>Delete</th>
			    <th>Completed</th>
		    </tr>

			<?php

			/********************************************************************
				while loop: gets every column from database and rendering it
				on webpage in table print
			********************************************************************/

			while(mysqli_stmt_fetch($stmt) ) { 
				?>
				<tr>
					<?php
					$class = "";
					if($complete == 1){ // if statement: checks if task is complete
						$class = "done";
					}
					?>
					<td class="<?php echo $class; ?>"><?php echo $taskName; ?></td>
					<td><?php echo $priority; ?></td>

					<td>

					<a href="index.php?delete=<?php echo $id; ?>& sort=<?php echo $sort; ?>" class="delete">Delete</a>

					</td>

					<td>

					<a href="index.php?complete=<?php echo $id; ?>" class="atag-done">Done</a>

					</td>
				</tr>	
			<?php

			}

			?>
			</table>
		</div>
		<!--**************************************************************************
			Form application for adding task to the TODO: list
		***************************************************************************-->
		<div class="add-task-meny">
			<form method="post" action="index.php">
				<input type="text" name="taskname" class="task-text-field"><br>
					<select name="priority" class="priority-button">
						<option value="0">No priority</option>
						<option value="1">Some priority</option>
						<option value="2">High priority</option>
						<option value="3">Absolute priority</option>
					</select><br>
				<input type="submit" name="addtask" value="Add task" class="add-task-button">
			</form>
		</div><!-- .add-task-meny-->

		<?php
		}
		?>
		<!---********************************************************************************
								FOOTER
		***********************************************************************************-->
		<footer class="footer">
			<p>&copy Design by Anders <span class="p-tag-name">Gustavsson. Last</span><span> Modified: <?php echo date("F d, Y"); ?></span></p>
		</footer><!-- .footer -->
	</div> <!-- wrapper --> <!-- .wrapper is for pushing down footer on the webpage..... After several tries i gave up on footer since i have no idea what im doing. -->
</body>
</html>
	