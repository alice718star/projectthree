<html>

<head>
    <title>Survey Data</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php require_once('assets/partials/nav.php'); ?>
    <h1>Survey Data</h1>
    <hr>

    <table>
        <tr>
            <th>ID</th>
            <th>Gender</th>
            <th>Year</th>
            <th>Age</th>
            <th>Rent/Mortgage</th>
            <th>Food</th>
            <th>Utilities</th>
            <th>Entertainment</th>
            <th>Clothes</th>
            <th>Transportation</th>
            <th>Travel</th>
            <th>Total</th>
        </tr>

        <?php
		//while in the table, get the json data
		$d = file_get_contents('assets/data.json');
		//convert the data to a php array so we can work with it
		$d = json_decode($d, true);
		
		//loop through the data to create dynamic html
		foreach($d as $k => $o){
			//for each object in our data, create a table row with table cells. in each table cell, concatenate values from the object we are looping through
			echo '<tr>
					<td>'.++$k.'</td>
					<td>'.$o['gender'].'</td>
					<td>'.$o['year'].'</td>
                    <td>'.$o['age'].'</td>
                    <td>$<span class="digits">'.$o['rentmort'].'</span></td>
                    <td>$<span class="digits">'.$o['food'].'</span></td>
                    <td>$<span class="digits">'.$o['util'].'</span></td>
                    <td>$<span class="digits">'.$o['entertainment'].'</span></td>
                    <td>$<span class="digits">'.$o['clothes'].'</span></td>
                    <td>$<span class="digits">'.$o['transport'].'</span></td>
                    <td>$<span class="digits">'.$o['travel'].'</span></td>
                    <td>$<span class="digits">'.$o['total'].'</span></td>
				</tr>';
        }
        
        ?>

    </table>
    <hr>
    <?php require_once('assets/partials/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script>
        $.fn.digits = function() {
            return this.each(function() {
                if ($(this).text().indexOf(".") != -1) {
                    var parts = $(this).text().split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    parts[1] = parts[1].substring(0, 2);
                    $(this).text(parts.join("."));
                } else {
                    $(this).text($(this).text().replace(/(\d)(?=([^.]{3})+($|[.]))/g, "$1,"));
                }
            })
        }
        $(".digits").digits();

    </script>

</body>

</html>
