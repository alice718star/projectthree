<html>

<head>
    <title>Survey Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Custom styles here-->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /*custom page css here*/
        nav {
            padding: 10px;
        }

        .ckey {
            width: 70px;
            height: 30px;
        }

        h1 {
            text-align: center;
            padding-top: 30px;
        }

    </style>
</head>

<body>
    <?php require_once('assets/partials/nav.php'); ?>
    <h1>2017 Survey Data</h1>
    <hr>

    <div class="row">
        <div id="graph" class="col m-auto text-center">
            <!-- this canvas will contain the line graph. -->
            <canvas id="piegraph" width="325" height="375"></canvas>
        </div>
        <div id="tablecontainer" class="col">
            <!-- This form will contain a table full of inputs -->
            <form id="dataform">
                <table class="table datatable"></table>
            </form>
        </div>
    </div>

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
            if ($o['year']=="2017"){
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

    <script>
        // Step 1: This function contains an ajax call to get the data in a json file
        function getdata() {
            $.ajax({
                url: 'assets/s17.json',
                type: 'get',
                dataType: 'JSON',
                cache: false,
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    // Step 2: when the data is grabbed, do the following to build the graph and table...
                    console.log(data);
                    // Step 3: set the data to var 'd'
                    d = data;
                    // Step 4: init 2 empty arrays for the values and the x axis labels 
                    values = [];
                    xaxisplots = [];
                    arcdata = [];
                    totalsum = 0;
                    // 360 colors to use
                    colors = ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC', '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399', '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933', '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF', "#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177", "#0d5ac1", "#f205e6", "#1c0365", "#14a9ad", "#4ca2f9", "#a4e43f", "#d298e2", "#6119d0", "#d2737d", "#c0a43c", "#f2510e", "#651be6", "#79806e", "#61da5e", "#cd2f00", "#9348af", "#01ac53", "#c5a4fb", "#996635", "#b11573", "#4bb473", "#75d89e", "#2f3f94", "#2f7b99", "#da967d", "#34891f", "#b0d87b", "#ca4751", "#7e50a8", "#c4d647", "#e0eeb8", "#11dec1", "#289812", "#566ca0", "#ffdbe1", "#2f1179", "#935b6d", "#916988", "#513d98", "#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d", "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977", "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b", "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf", "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234", "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158", "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647", "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3", "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec", "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647", "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3", "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec", "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7", "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8", "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16", "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce", "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997", "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be", "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba", "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043", "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56", "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f", "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49", "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9", "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4", "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06", "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a", "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065", "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35", "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44", "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67", "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff", "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6", "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca", '#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC', '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399'];
                    //used twice per data element to get the start and end angle
                    function degreesToRadians(degrees) {
                        return (degrees * Math.PI) / 180;
                    };
                    //used with the above function to get the start angle only
                    function sumTo(a, i) {
                        var sum = 0;
                        for (var j = 0; j < i; j++) {
                            sum += a[j];
                        };
                        return sum;
                    };
                    // Step 5: empty the table to redraw it
                    $(".datatable").empty();
                    // Step 6: build the table headers
                    $(".datatable").append(`
						<tr>
							<th>Key</th>
							<th>Category</th>
							<th>Total Amount of all entries</th>
							<th>% of all categories</th>
						</tr>
					`);
                    // Step 7: loop through data which are multi-dimensional objects containing x axis labels and values
                    for (i in d) {
                        console.log(i);
                        // Step 8: push values and x axis labels into their own empty arrays
                        values.push(d[i]);
                        xaxisplots.push(i);
                        totalsum += Number(d[i]);
                        // Step 9: build the rest of the table generating a row that contains labels (rent etc). these inputs have values containing the  labels, values of a radio button. Lastly create a delete button that has a value set to the index of the key of the object to delete.
                        $(".datatable").append(`
							<tr id="d${i}" class="datarow">
								<td>${i}</td>
								<td>$<span class = "digitstwo">${d[i]}</span></td>
								<td><p class="pcnt">%</p></td>
							</tr>
						`);
                    };

                    $.fn.digitstwo = function() {
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
                    $(".digitstwo").digitstwo();

                    for (i in values) {
                        arcdata.push((values[i] / totalsum) * 360);
                        $('.pcnt:eq(' + i + ')').prepend(Math.round((values[i] / totalsum) * 100));
                    };


                    //used twice per data element to get the start and end angle
                    function degreesToRadians(degrees) {
                        return (degrees * Math.PI) / 180;
                    }
                    //used with the above function to get the start angle only
                    function sumTo(a, i) {
                        var sum = 0;
                        for (var j = 0; j < i; j++) {
                            sum += a[j];
                        }
                        console.log(sum);
                        return sum;
                    }
                    //draw a slice, which is called repeatedly in the loop below
                    function drawSegment(canvas, ctx, i) {
                        var centerX = Math.floor(canvas.width / 2);
                        var centerY = Math.floor(canvas.height / 2);
                        radius = Math.floor(canvas.width / 2);
                        var startingAngle = degreesToRadians(sumTo(arcdata, i));
                        var arcSize = degreesToRadians(arcdata[i]);
                        var endingAngle = startingAngle + arcSize;
                        console.log(startingAngle, arcSize, endingAngle);
                        ctx.beginPath();
                        ctx.moveTo(centerX, centerY);
                        ctx.arc(centerX, centerY, radius,
                            startingAngle, endingAngle, false);
                        ctx.closePath();
                        ctx.fillStyle = colors[i];
                        ctx.fill();
                        //drawSegmentLabel(canvas, ctx, i);
                    }
                    //grab the canvas
                    canvas = document.getElementById("piegraph");
                    var ctx = canvas.getContext("2d");
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    //loop to draw each pie slice
                    for (var i = 0; i < arcdata.length; i++) {
                        drawSegment(canvas, ctx, i);
                        $('.datarow:eq(' + i + ')').prepend(`<td><div class="ckey" style="background:${colors[i]};"></div></td>`);
                    };
                }
            });
        };
        //Step 32: run the graph builder on page load
        getdata();
        // Step 33: function to create a new table row with unique key to use in json.
        $(document).on('click', '.addAnotherBtn', function() {
            newid = $(this).parents('tr').prev().attr('id');
            newid = newid.replace('d', '');
            newid = Number(newid);
            ++newid;
            var addAnother = $(this).parents('tr').before(`<tr id="d${newid}">
						<td>
							<div class="ckey" style="background:${colors[newid]};"></div>
						</td>
						<td>
							<input type="text" name="x${newid}">
						</td>
						<td>
							<input type="text" name="v${newid}">
						</td>
						<td>
							<p class="pcnt">%</p>
						</td>
						<td>
							<input type="radio" name="delete" value="${newid}">
						</td>
					</tr>`);
            return false;
        });
        // Step 34: when inputs change trigger form submission
        $(document).on('change', 'input', function() {
            console.log(this.value);
            $("#dataform").submit();
        });
        // Step 35: when form submitted, send data to php and run the graph builder again
        $("#dataform").submit(function(e) {
            formData = new FormData($(this)[0]);
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            $.ajax({
                url: "assets/datahandler/graph.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    console.log('got here');
                    getdata();
                }
            });
            e.preventDefault();
        });
        //look at graph.php to continue...

    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
