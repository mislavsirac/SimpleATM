<?php
  session_start();
  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
  }

  include("sqlcon.php");
  include("functions.php");
  $id = $_SESSION['ID'];

  $qry = mysqli_query($conn,"select * from users where ID='$id'"); // select query
  $data = mysqli_fetch_array($qry); // fetch data

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $balance = $data['balance'];
    $deposit = $_POST['amount'];
    $balance += $deposit;
    $edit = mysqli_query($conn,"update users set balance = '$balance' where id = '$id'");

    if($edit){
        mysqli_close($conn); // Close connection
          header("Location: home.php");
        exit;
    }else{
        echo "Molimo unesti validne informacije.";
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
            <tr class="index_table_login_tr_2" style="background-color: #ebebeb;padding-bottom:50px; font-size: 40px;">
                <td align="center">
                  Firstname: <?php echo $data['firstname']; ?> <br>
                  Lastname: <?php echo $data['lastname']; ?> <br>
                  Balance: <?php echo $data['balance']; ?> <br>
                    <form class="index_login_form" method="post" style="margin-top:50px;">

                        <div class="form-group"><input id="amount" class="form-control" type="text" name="amount" placeholder="Enter the amount to deposit" /></div>
                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Deposit</button></div></form>
                        <div style="width: 30%;" class="form-group"><button class="btn btn-primary btn-block" onclick="window.location.href='home.php'">Back</button></div>
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
          target: document.getElementById("amount"),
          max: 20, // MAX 20 DIGITS
          decimal: true, // DECIMALS ALLOWED
          onselect : () => { // CALL THIS AFTER SELECTING NUMBER
            alert("Amount set");
          },
          oncancel : () => { // CALL THIS AFTER CANCELING
            alert("Amount canceled");
          }
        });



      });
</script>

</html>
