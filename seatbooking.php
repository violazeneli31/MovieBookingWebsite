<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="description" content="Movie Booking">
    <meta name="keywords" content="Movie, Booking, Cinema, Seats">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo "Movie - ".$_GET['movie'].", Time - ".$_GET['time'];?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" rel="stylesheet">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- Custom Style for Seats -->
    <style>
        input.larger[type="checkbox"] {
            width: 28px;
            height: 28px;
            border: 3px solid #0d6efd;
            border-radius: 6px;
            background-color: white;
            position: relative;
            appearance: none;
            outline: none;
            margin: 5px;
        }
        input.larger[type="checkbox"]:checked::before {
            content: '\2713';
            position: absolute;
            top: 0;
            left: 6px;
            font-size: 20px;
            color: #0d6efd;
            font-weight: bold;
        }
        input.larger[type="checkbox"]:disabled {
            background-color: #ccc;
            border: 2px solid #999;
            cursor: not-allowed;
        }
        .seatCharts-container table {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
        }
        .seat_type {
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
        }
        .seat_type.silver { color: silver; }
        .seat_type.gold { color: goldenrod; }
        .seat_type.platinum { color: #c0c0ff; }
    </style>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.larger').click(function(){
                var text= "";
                $('.larger:checked').each(function(){
                    text+=$(this).val()+ ',';
                });
                text=text.substring(0,text.length-1);
                $('#selectedtext').val(text);

                var count = $("[type='checkbox']:checked").length;
                $('#count').val(count);

                if(count == 8){
                    document.getElementById('notvalid').innerHTML="Maximum seat select is 8";
                    return false;
                }
            });
        });
    </script>
</head>
<body>
<div>
    <div class="seat_heading">
        <h3><center>BOOK YOUR SEAT NOW</center></h3>
    </div>

    <?php
        include_once 'Database.php';
        $movie = $_GET['movie'];
        $bookedSeats = [];
        $result = mysqli_query($conn, "SELECT seat FROM customers WHERE movie = '$movie'");
        while ($row = mysqli_fetch_assoc($result)) {
            $seats = explode(",", $row['seat']);
            foreach ($seats as $s) {
                $bookedSeats[] = trim($s);
            }
        }
    ?>

    <form method="post">
        <center><input type="submit" name="submit" class="btn btn-primary" value="Check Available Seats"></center>
    </form>
    <hr>

    <form action="payment.php" method="post">
        <div class="container">
            <?php if(isset($_POST['submit'])): ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="seatCharts-container">
                        <div class="front">SCREEN</div>
                        <center><p id="notvalid" style="color: red; font-size: 20px;"></p></center>

                        <div class="seat_type silver">Silver : 100</div>
                        <?php
                        $silverRows = ['I','H','G'];
                        foreach ($silverRows as $row) {
                            echo "<table><tr><td class='line'>$row</td>";
                            for ($i = 1; $i <= 12; $i++) {
                                $seat = $row . $i;
                                $disabled = in_array($seat, $bookedSeats) ? "disabled" : "";
                                echo "<td><input type='checkbox' class='larger' name='seat[]' value='$seat' $disabled></td>";
                            }
                            echo "</tr></table>";
                        }
                        ?>

                        <div class="seat_type gold">Gold : 150</div>
                        <?php
                        $goldRows = ['F','E','D'];
                        foreach ($goldRows as $row) {
                            echo "<table><tr><td class='line'>$row</td>";
                            for ($i = 1; $i <= 12; $i++) {
                                $seat = $row . $i;
                                $disabled = in_array($seat, $bookedSeats) ? "disabled" : "";
                                echo "<td><input type='checkbox' class='larger' name='seat[]' value='$seat' $disabled></td>";
                            }
                            echo "</tr></table>";
                        }
                        ?>

                        <div class="seat_type platinum">Platinum : 300</div>
                        <?php
                        $platinumRows = ['C','B','A'];
                        foreach ($platinumRows as $row) {
                            echo "<table><tr><td class='line'>$row</td>";
                            for ($i = 1; $i <= 12; $i++) {
                                $seat = $row . $i;
                                $disabled = in_array($seat, $bookedSeats) ? "disabled" : "";
                                echo "<td><input type='checkbox' class='larger' name='seat[]' value='$seat' $disabled></td>";
                            }
                            echo "</tr></table>";
                        }
                        ?>

                    </div>
                </div>

                <div class="col-lg-6">
                    <table>
                        <tr><td>Movie:</td><td><?php echo $movie; ?></td></tr>
                        <tr><td>Time:</td><td><?php echo $_GET['time']; ?></td></tr>
                        <tr><td>Seats:</td><td><input type="text" id="selectedtext" name="seats" readonly></td></tr>
                        <tr><td>Total Seats:</td><td><input type="text" id="count" name="totalseat" readonly></td></tr>
                    </table>

                    <input type="hidden" name="movie" value="<?php echo $movie; ?>">
                    <input type="hidden" name="show" value="<?php echo $_GET['time']; ?>">

                    <?php if (!isset($_SESSION['uname'])): ?>
                        <a class="btn btn-primary" href="login_form.php">Login to Pay</a>
                    <?php else: ?>
                        <input type="submit" value="Payment Now" name="submit" class="btn btn-primary">
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- JS Plugins -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

