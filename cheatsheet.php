<html>
<head>
	<title>PHP and JSON Demo</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>

	<!--Required and includes inject partials into the webpage -->
	<?php require_once('assets/partials/nav.php'); ?>

	<h1>Cheat Sheet</h1>
	<hr>
	<h2>Variables</h2>
	<?php

		//variables and datatypes
		$n = 2;
		$m = $n + 2;
		$s = "Hello World!";
		$b = TRUE;
		$a = array(1,2,3);

		//use echo to display expressions as html
		echo "echos display simple datatypes in HTML <br>";
		echo "math works like js: 2 + 2 = $m<br>";

		echo "<hr>";
		echo "note the difference using a variable with double quote: $m<br>";
		echo 'and single quotes: $m<br>';
		echo "Concatinate Strings with a \".\" like so: ". $s;

		echo "<hr>";
		echo "Note how booleans display true: $b<br />";
		echo "and false: ".!$b;
		echo "<hr>";
		echo "try to echo an array: $a<br />";
		echo "To display an array use print_r<br />";

		//use print_a to display arrays
		print_r($a);
		echo "<br>or call a value by its index: ".$a['1']."<br>";
		echo "<hr>";

	?>

	<h2>Objects</h2>
	<?php

		//building an object function
		class User {
			function save_user() {
				echo 'hi '.$this->name." | ".$this->password."<br>";
			}
		}

		//adding to object
		$object1 = new User;
		$object1->name = "Sam";
		$object1->password = "12345";
		$object1->gender = "female";

		//calling object values
		print_r($object1);
		echo '<br>';
		echo $object1->name;
		echo '<br>';
		echo $object1->gender;
		echo '<br>';
		$object1->save_user();
		echo '<br>';
	
	$obj = (object) [
    'k1' => 'foo',
    'k2' => 42,
  ];
	print_r($obj);

	?>
	<hr>
	<h2>Comparisons, Logicals, Conditionals, and Functions</h2>
	<?php

		//functions
		function dolunch(){
			echo "lets eat!";
		}

		$hour = 13;

		//comparisons, logicals and conditionals
		if ($hour >= 12 && $hour <= 13) {
			dolunch();
		};

	?>
	<hr>
	<h2>Loops</h2>
	<?php

		//loops
		for ($monkeys = 5 ; $monkeys > 0 ; --$monkeys) {
			echo $monkeys." little monkeys jumping on the bed<br>
			One fell off and bumped her head<br>
			Momma called the doctor and the doctor said<br>
			No more monkeys jumping on the bed<br><br>";
		}

		//use for each to loop through an array
		$arr = array(
			"p1" => "Moe",
			"p2" => "Larry",
			"p3" => "Curly"
		);
	
		$arr["p4"] = "Jerry";

		//creates a ul
		echo "<ul>";

		//loop through the data to creates the li's
		foreach($arr as $k => $v){
				echo "<li><b>$k:</b> $v</l1>";
			}
	
	

		//then close the list
		echo "</ul>";

	?>
	<hr>
	<?php require_once('assets/partials/footer.php'); ?>
</body>
</html>