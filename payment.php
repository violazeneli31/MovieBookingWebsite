<?php 
session_start(); 

if (!isset($_SESSION['uname'])) {
  header("location:index.php");
}
?>

<!doctype html>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>

<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">

<style>
.front {
    margin: 5px 4px 45px 0;
    background-color: #EDF979;
    color: #000000;
    padding: 9px 0;
    border-radius: 3px;
}
</style>
</head>
<body>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">BOOKING SUMMARY</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="tab-content">
                        <div class="row">
                            <?php
                            include_once 'Database.php'; 
                            $username = $_SESSION['uname'];

                            if (isset($_POST['submit'])) {
                                $show = $_POST['show'];
                                $result = mysqli_query($conn, "SELECT username, email, mobile, city FROM user WHERE username = '$username'");
                                $seats1 = implode(",", $_POST["seat"]);
                                $seats = explode(",", $seats1);
                                $price = 0;
                                for ($i = 1; $i <= 12; $i++) {
                                    $rows = ['I','H','G','F','E','D','C','B','A'];
                                    foreach ($rows as $r) {
                                        if (in_array($r.$i, $seats)) {
                                            $price += ($r == 'I' || $r == 'H' || $r == 'G') ? 100 : (($r == 'A') ? 300 : 150);
                                        }
                                    }
                                }

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<div class="col-lg-6">
                                            Your Username: '.$row['username'].'<br>
                                            Phone no.: '.$row['mobile'].'<br>
                                            Movie Name: '.$_POST['movie'].'<br>
                                            Seats: '.$seats1.' <br>
                                            Payment Date: '.date("D-m-y", strtotime('today')).'
                                            </div>
                                            <div class="col-lg-6">
                                            Email: '.$row['email'].'<br>
                                            City: '.$row['city'].'<br>
                                            Total Seats: '.$_POST['totalseat'].' <br>
                                            Time: '.$_POST['show'].'<br>
                                            Booking Date: '.date("D-m-y", strtotime('tomorrow')).'
                                            </div>';
                                    }
                                }
                            }
                            ?>
                            <input type="hidden" id="movie" value="<?php echo $_POST['movie']; ?>">
                            <input type="hidden" id="time" value="<?php echo $_POST['show']; ?>">
                            <input type="hidden" id="seat" value="<?php echo implode(",", $_POST["seat"]); ?>">
                            <input type="hidden" id="totalseat" value="<?php echo $_POST['totalseat']; ?>">
                            <input type="hidden" id="price" value="<?php echo $price; ?>">
                        </div>

                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <div class="form-group">
                                <label for="username"><h6>Card Owner</h6></label>
                                <input type="text" id="card_name" name="card_name" placeholder="Card Owner Name" class="form-control">
                                <div id="validatecardname"></div>
                            </div>
                            <div class="form-group">
                                <label for="cardNumber"><h6>Card number</h6></label>
                                <input type="text" id="card_number" name="card_number" placeholder="Valid card number" class="form-control">
                                <div id="validatecardnumber"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label><h6>Expiration Date</h6></label>
                                        <input type="date" id="ex_date" name="ex_date" class="form-control">
                                        <div id="validateexdate"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label><h6>CVV</h6></label>
                                        <input type="number" id="cvv" class="form-control">
                                        <div id="validatecvv"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="seatCharts-container">
                                    <div class="front">
                                        <font text-align="left">&nbsp;&nbsp;&nbsp;Amount To Pay: </font>
                                        <font text-align="right"><span style="font-weight:bold;">Lek</span> <?php echo $price; ?></font>
                                    </div>
                                </div>
                            </div>
                            <div id="msg"></div>
                            <div class="card-footer">
                                <button type="submit" id="payment" class="subscribe btn btn-primary btn-block shadow-sm">Confirm Payment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function(){
  $("#payment").click(function(){
    var movie = $("#movie").val().trim();
    var time = $("#time").val().trim();
    var seat = $("#seat").val().trim();
    var totalseat = $("#totalseat").val().trim();
    var price = $("#price").val().trim();
    var card_name = $("#card_name").val().trim();
    var card_number = $("#card_number").val().trim();
    var ex_date = $("#ex_date").val().trim();
    var cvv = $("#cvv").val().trim();

    if(card_name == ''){
        $("#validatecardname").html("<font color='red'>!Invalid card name.</font>");
        return false;
    }
    if(card_number == ''){
        $("#validatecardnumber").html("<font color='red'>!Invalid card number.</font>");
        return false;
    }
    if(ex_date == ''){
        $("#validateexdate").html("<font color='red'>!Invalid date.</font>");
        return false;
    }
    if(cvv == ''){
        $("#validatecvv").html("<font color='red'>!Invalid CVV.</font>");
        return false;
    }

    $.ajax({
      url:'payment_form.php',
      type:'post',
      data:{
        movie:movie,
        time:time,
        seat:seat,
        totalseat:totalseat,
        price:price,
        card_name:card_name,
        card_number:card_number,
        ex_date:ex_date,
        cvv:cvv
      },
      success:function(response){
        if(response == 1){
          window.location = "tickes.php";
        } else {
          $("#msg").html("<font color='red'>!Invalid UserId.</font>");
          return false;
        }
      }
    });
  });
});
</script>
</body>
</html>
