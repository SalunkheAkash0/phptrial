<?php include 'database.php'; ?>
<?php 

if(isset($_POST["submit1"])){
	//Get post variables
	$question_number = $_POST["question_number"];
	$question_text = $_POST["question_text"];
	//Choices in array because user can enter any amount of choices
	$choices = array();
	//Start array from 1 as we want to enter index of array as choice number in choices table
	$choices[1] = $_POST["choice1"];
	$choices[2] = $_POST["choice2"];
	$choices[3] = $_POST["choice3"];
	$choices[4] = $_POST["choice4"];
	$choices[5] = $_POST["choice5"];
	$correct_choice = $_POST['correct_choice'];

	//Inserting in question table

	$query = "INSERT INTO `questions` (question_number,text) VALUES ('$question_number','$question_text');";
	//run query
	$insert_row = $mysqli->query($query) or die($mysqli->error . __LINE__);

	//Validate insert
	if($insert_row){

		//inserting in choices table

		foreach ($choices as $choice => $value) {
			if($value != ''){
				if($correct_choice == $choice)
				{
					$is_correct = 1;
				}
				else
				{
					$is_correct = 0;
				}
				//Choice Query
				$query = "INSERT INTO choices(question_number,is_correct,text) VALUES ('$question_number','$is_correct','$value');";
				//run query
				$insert_row = $mysqli->query($query) or die($mysqli->error);
				//Validate insert
				if($insert_row)
				{
					continue;
				}
				else
				{
					die('Error : ' . $mysqli->error);
				}
			}
		}

		$msg = 'Question has been added';

	}


}



 ?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Quizzer</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<header>
	<div class="container">
		<h1>PHP QUIZZER</h1>
	</div>
</header>
<main>
	<div class="container">
		<h2>Add A Question</h2>
		<?php 
			if(isset($msg)){
				echo "<p>".$msg ."</p>";
			}
		 ?>
		<form method="post" action="add.php">
			<p>
				<label>Question Number: </label>
				<input type="Number" name="question_number">
			</p>
			<p>
				<label>Question Text: </label>
				<input type="text" name="question_text">
			</p>
			<p>
				<label>Choice #1: </label>
				<input type="text" name="choice1">
			</p>
			<p>
				<label>Choice #2: </label>
				<input type="text" name="choice2">
			</p>
			<p>
				<label>Choice #3: </label>
				<input type="text" name="choice3">
			</p>
			<p>
				<label>Choice #4: </label>
				<input type="text" name="choice4">
			</p>
			<p>
				<label>Choice #5: </label>
				<input type="text" name="choice5">
			</p>
			<p>
				<label>Correct Choice Number: </label>
				<input type="Number" name="correct_choice">
			</p>
			<p>
				<input type="submit" name="submit1" value="Submit">
			</p>

		</form>
	</div>
</main>

<footer>
	<div class="container">
		Copyright &copy; 2018, PHP Quizzer
	</div>
</footer>

</body>
</html>