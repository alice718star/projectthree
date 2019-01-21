<html>

<head>
    <title>The Spending Survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Custom styles here-->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php require_once('assets/partials/nav.php'); ?>
    <div class="container">
        <h1>The Spending Survey</h1>
        <h2>Knowing how you're spending year to year can fall to the wayside. Get a clear picture of your yearly expenses and how they stack up to other spenders' expenses.</h2>
        <hr>
        <br>
        <br>
        <div class="row">
            <!--then columns-->
            <div class="col-xs-1">
                
            </div>
            <div class="col-xs-5">
                <form action="assets/process.php" method="post">
        <p>Complete your demographic information below.</p>
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
        <p>Provide the approximate expenses for the selected year for each category.</p>
        <input type="number" name="rentmort"><b>  Rent or Mortgage</b>
        <br>
        <input type="number" name="food"><b>  Food</b>
        <br>
        <input type="number" name="util"><b>  Utilities</b>
        <br>
        <input type="number" name="entertainment"><b>  Entertainment</b>
        <br>
        <input type="number" name="clothes"><b>  Clothes</b>
        <br>
        <input type="number" name="transport"><b>  Transportation</b>
        <br>
        <input type="number" name="travel"><b>  Travel</b>
        <br>
        <br>
        <input type="submit" value="submit">
    </form>
            </div>
            <div class="col-xs-5">
                <img src="img/fabian-blank-78637-unsplash400pxcropped.jpg">
            </div>
        </div>
    </div>
    <hr>


    <hr>
    <?php require_once('assets/partials/footer.php'); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
