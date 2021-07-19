<?php
session_start();
error_reporting(1);
include 'database/config.php';
$id = $_GET['id'];
if(!empty($id)) {
$sql = "SELECT * FROM user WHERE id = $id";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);
$net_amount = $result['amount'];
$f_id = $result['id'];
$f_name = $result['name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Transfer process - The Sparks Foundation</title>
    <link rel="icon" href="image/bank-icon.jpg">
    <link rel="stylesheet" href="css/transfer_to.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
<?php
 if(isset($_POST['transfer'])) {

    if(isset($_POST['select'])) {
        $to_name = $_POST['select'];
    }
    if(isset($_POST['amount'])) {
        $amount = $_POST['amount'];
    }

    $check_to = "SELECT * FROM user WHERE id = '$to_name'";
    $check_query = mysqli_query($con,$check_to);
    $check = mysqli_fetch_array($check_query);
    $name_to = $check['name'];
    $to_date = date("Y-m-d H:i:s");

    if(empty($to_name)) { ?>
        <script type="text/javascript">
            alert("Please Select the Receiver Name");
        </script>
    <?php
    }elseif(empty($amount)) { ?>
        <script type="text/javascript">
            alert("Amount is Empty. Please fill the amount");
        </script>
    <?php
    }elseif($amount > $net_amount) { ?>
        <script type="text/javascript">
            alert("Insufficient Funds");
        </script>
    <?php
    }elseif($amount <= 0) { ?>
        <script type="text/javascript">
            alert("Negative Value is not accepted");
        </script>
    <?php
    }else {
    
        $inser_sql ="INSERT INTO transfer_history(from_name, to_name, amount, date) VALUES ('$f_name','$name_to','$amount','$to_date')";
        $inser_sql_query = mysqli_query($con,$inser_sql);

        // To amount update...
        $update = "UPDATE user SET amount = amount + $amount WHERE id = '$to_name'";
        $upload_query = mysqli_query($con,$update);

        // From amount update...
        $update_f = "UPDATE user SET amount = amount - $amount WHERE id = '$f_id'";
        $upload_query_f = mysqli_query($con,$update_f);



		?>
        <script type="text/javascript">
            alert("Transferred successfully");
            window.location.href='transfer_h.php';
        </script>
       <?php
    }

}?>
    <center>
        <section id="main">
        <div class="title">
            <h3 style=" color:#b30059;">The Sparks Foundation</h3>
            <h4>Basic Banking System</h4>
        </div>
        <form method="POST" onSubmit="return check()" enctype="multipart/form-data">
            <div class="table-responsive-sm">
                <div class="box">
                    
                
                    <div class="box-r">
                        <label class="col-md-4 control-group">From :</label>
                        <label class="col-md-4 control-group" name="from_name" ><?php echo $result['name']?>
                        </label>
                    </div>
                    <br>
                    <!------------------------------------->
                
                    <div class="box-r">
                        <label class="col-md-4 control-group">To :</label>
                        <label class="col-md-4 control-group">
                            <select name="select" id="to_name" class="col-md-18 control-group">
                                <option value="">Select Reciever</option>
                                <?php
                                    $send = "SELECT * FROM user WHERE id <> $id";
                                    $send_query = mysqli_query($con,$send);
                                    while($send_result = mysqli_fetch_array($send_query)) {
                                ?>
                                <option value="<?php echo $send_result['id']?>">
                                    <?php echo $send_result['name']?> - Balance : <?php echo $send_result['amount']?>
                                </option>
                                <?php }?>
                            </select>
                        </label>
                    </div>
                    <br>
                    <!------------------------------------->
                    <div class="box-r">
                        <label class="col-md-4 control-group">Amount :</label>
                        <label class="col-md-4 control-group">
                            <input type="text" name="amount">
                        </label>
                    </div>
                    <br>
                    
                    <input type="submit" name="transfer" value="Money Transfer" class="btn btn-success"/>
                </div>
            </div>
            <br>
            <a onclick="back()" class="btn btn-danger">Home</a>
                <script type="text/javascript">
                    function back()
                        {
                            if(confirm("Are you sure do you want leave in this Page ?")){
                                window.location.href='user.php';
                            }
                        }
                </script>
        </form>
        </section>
    </center>
</body>
</html>
<?php ?>
<style>
  .title{
    margin-top: 60px;
  }
  .title h3 {
    color: red;
  }
  .box {
      border: 1px solid black;
      border-radius: 10px;
      width: 450px;
      padding: 20px;
      text-align: justify;
  }

</style>
<?php 

}else{
    header("Location: index.php");
}
?>