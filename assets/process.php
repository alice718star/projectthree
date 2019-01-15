<?php

//use post suberglobal to get the user input values and store as vars. the superglobal must match the method set in the form this data came from. method = "post" uses $_POST, while method = "get" uses $_GET
$g = $_POST['gender'];
$y = $_POST['year'];
$ag = $_POST['age'];
$rm = $_POST['rentmort'];
$f = $_POST['food'];
$u = $_POST['util'];
$e = $_POST['entertainment'];
$c = $_POST['clothes'];
$t = $_POST['transport'];
$tr = $_POST['travel'];

//echo $g.$y.$ag;
//create an associative array which will be injected into our json
$a = array(
"gender" => $g,
"year" => $y,
"age" => $ag,
"rentmort" => $rm,
"food" => $f,
"util" => $u,
"entertainment" => $e,
"clothes" => $c,    
"transport" => $t,
"travel" => $tr
);

            //function sum($rm, $f, $u, $e, $c, $t, $tr){
                //$total = $rm + $f + $u + //$e + $c + $t + $tr;
                //return $total;
        


//print_r($g+$y);
//$s = array

//get the data from the json file
$d = file_get_contents('data.json');

//the data comes in as a js object, so convert the data to a php array so it can me edited
$d = json_decode($d, true);

//add the assoc array $a to our data, here we add it to the beginning of the array using unshift, but we can also use push to add to the end
array_unshift($d, $a);

//print_r($d);

//after editing the data, convert it back to a js object
$d = json_encode($d);

//save the edited data back into the json file
file_put_contents('data.json', $d);

//since this page doen't contain any html, redirect the user to a new page
//header('location:../profile.php');
?>
