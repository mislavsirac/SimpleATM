<?php
session_start();

    include("sqlcon.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $cardnumber = $_POST['cardnumber'];
        $pin = $_POST['pin'];

        if(!empty($cardnumber) && !empty($pin)){
            $query = "select * from users where cardnumber = '$cardnumber' limit 1";

            $result = mysqli_query($conn, $query);

            if($result){
              $_SESSION['loggedin'] = TRUE;
                if($result && mysqli_num_rows($result) > 0){
                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['pin'] === $pin){
                        $_SESSION['ID'] = $user_data['ID'];
                            header("Location:home.php");
                        }
            }
         }else{
            echo "Wrong Card Number or PIN";
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            ATM
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/numpad-dark.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">

        <script src="assets\js\numpad.js"></script>
    </head>
    <body class="index_body">
        <table class="index_table_login">
            <tr class="index_table_login_tr_1" style="height:10px;">
                <td style="border-bottom: 3px solid #145da0;background-color: #161a1d;">
                    <table>
                        <tr>
                            <td style="background-color: #161a1d;width:50%;padding-left:10%">
                                <span style="color:white;">ATM v.0.1</span>

                            </td>
                            <td  style="background-color: #161a1d;">
                                <span style="color:white;">TEST SITE</span>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr class="index_table_login_tr_2" style="background-color: #ebebeb;padding-bottom:50px;">
                <td align="center">
									<img src="assets\img\logo.png"></img>
                    <form class="index_login_form" method="post">

                        <div class="form-group"><input id="cardnumber" class="form-control" type="text" name="cardnumber" placeholder="Card Number" /></div>
                        <div class="form-group"><input id="pin" class="form-control" id="password_field" type="password" name="pin" placeholder="PIN" /></div>
                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Login</button></div></form>
                </td>
            </tr>
            <tr class="index_table_login_tr_3" style="background-color: #161a1d;height:10px;">
                <td align="center" style="color:white">
                    &copy; 2022</span> | <a href="https://github.com/mislavsirac">Mislav Širac</a>
                </td>
            </tr>
        </table>
    </body>

    <script>
      window.addEventListener("load", () => {
        numpad.attach({
          target: document.getElementById("cardnumber"),
          max: 16, // MAX 10 DIGITS
          decimal: false, // NO DECIMALS ALLOWED
          onselect : () => { // CALL THIS AFTER SELECTING NUMBER
            alert("Card number set");
          },
          oncancel : () => { // CALL THIS AFTER CANCELING
            alert("Card number canceled");
          }
        });

        numpad.attach({
          target: document.getElementById("pin"),
          max: 4, // MAX 10 DIGITS
          decimal: false, // NO DECIMALS ALLOWED
          onselect : () => { // CALL THIS AFTER SELECTING NUMBER
            alert("PIN set");
          },
          oncancel : () => { // CALL THIS AFTER CANCELING
            alert("PIN canceled");
          }
        });

      });
</script>

</html>
