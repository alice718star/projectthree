<html>

<head>
    <title>Spending Survey</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php require_once('assets/partials/nav.php'); ?>
    <h1>See how your annual expenses compare to others' within your demographic group and those outside your demographic group.</h1>
    <hr>
    <form action="assets/process.php" method="post">
        <p>Please complete the demographic information below.</p>
        <b>Gender:</b>
        <label>
            <input type="radio" name="gender" value="Male">Male
        </label>
        <label>
            <input type="radio" name="gender" value="Female">Female
        </label>
        <label>
            <input type="radio" name="gender" value="Self-Identify">Self-Identify
        </label>
        <br>
        <b>Spending Year:</b>
        <label>
            <input type="radio" name="year" value="2016">2016
        </label>
        <label>
            <input type="radio" name="year" value="2017">2017
        </label>
        <label>
            <input type="radio" name="year" value="2018">2018
        </label>
        <br>
        <b>Age Range:</b>
        <label>
            <input type="radio" name="age" value="18-24">18-24
        </label>
        <label>
            <input type="radio" name="age" value="25-34">25-34
        </label>
        <label>
            <input type="radio" name="age" value="35-44">35-44
        </label>
        <label>
            <input type="radio" name="age" value="45-54">45-54
        </label>
        <label>
            <input type="radio" name="age" value="55-64">55-64
        </label>
        <label>
            <input type="radio" name="age" value="65-74">65-74
        </label>
        <label>
            <input type="radio" name="age" value="75 or older">75 or older
        </label>
        <br>
        <br>
        <p>Please provide the approximate expenses for the selected year for each category.</p>
        <input type="number" name="rentmort"><b>Rent or Mortgage</b>
        <br>
        <input type="number" name="food"><b>Food</b>
        <br>
        <input type="number" name="util"><b>Utilities</b>
        <br>
        <input type="number" name="entertainment"><b>Entertainment</b>
        <br>
        <input type="number" name="clothes"><b>Clothes</b>
        <br>
        <input type="number" name="transport"><b>Transportation</b>
        <br>
        <input type="number" name="travel"><b>Travel</b>
        <br>
        <input type="submit" value="submit">
    </form>
   
    <hr>
    <?php require_once('assets/partials/footer.php'); ?>
</body>

</html>
