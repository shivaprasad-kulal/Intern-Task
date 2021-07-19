<?php

include 'database/config.php';
$id = $_GET['id'];
if(!empty($id)) {
$sql = "SELECT * FROM user WHERE id = $id";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);
$f_name = $result['name'];

$transfer_sql = "SELECT * FROM transfer_history WHERE from_name = '$f_name' ";
$transfer_query = mysqli_query($con,$transfer_sql);
$transfer_num = mysqli_num_rows($transfer_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Sparks Foundation - Money Transfer</title>
    <link rel="stylesheet" href="css/transfer.css">
    <link rel="icon" href="image/bank-icon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
  <center>
    <?php
      include 'include/header.php';
    ?>
    <section id="main">
      <div class="title">
        <h3 style=" color:#b30059;">The Sparks Foundation</h3>
        <h4>Welcome to <?php echo $f_name?></h4>
      </div>


      <div class="table-responsive-sm">
        <table class="table_b">
          <tr>
            <td><b>Name </b>:</td>
            <td><?php echo $result['name']?></td>
          </tr>

          <tr>
            <td><b>Account No </b>:</td>
            <td><?php echo $result['account_no']?></td>
          </tr>

          <tr>
            <td><b>Email </b>:</td>
            <td><?php echo $result['email']?></td>
          </tr>

          <tr>
            <td><b>Total Amount </b>:</td>
            <td><?php echo $result['amount']?></td>
          </tr>
        </table>
        <div class="btn">
          <a href="transfer_to.php?id=<?php echo $result['id']?>" class="btn btn-success" name="transfer_to">Transfer To</a>
          <a href="user.php" class="btn btn-info" name="back">Back</a>
        </div>
      </div>
      <div class="table-responsive-sm">
        <div class="title_h">
          <p>Hi <?php echo $f_name?>. Your Transaction History</p>
        </div>
      </div>
    <div class="table-responsive-sm">
      <table class="table_h">
        <tr>
          <th style="background:#b3ffd9;color: black;">Transfer_Id</th>
          <th style="background:#b3ffd9;color: black;">From</th>
          <th style="background:#b3ffd9;color: black;">To</th>
          <th style="background:#b3ffd9;color: black;">Amount</th>
          <th style="background:#b3ffd9;color: black;">Date and Time</th>
        </tr>
        <?php
          if($transfer_num <= 0) {
            echo "<td colspan=5 style='color:red; font-weight: 1000;'>This is your first Translation. So No history</td>";
          }else{
            while($transfer_result = mysqli_fetch_array($transfer_query)) {
        ?>
        <tr>
          <td><?php echo $transfer_result['id']?></td>
          <td><?php echo $transfer_result['from_name']?></td>
          <td><?php echo $transfer_result['to_name']?></td>
          <td><?php echo $transfer_result['amount']?></td>
          <td><?php echo $transfer_result['date']?></td>
        </tr>
        <?php }} ?>
      </table> 
    </div>     
    </section>

</center>
</body>
</html>
<?php ?>
<style>
  .title_h {
    margin-top: 20px;
    width: 600px;
  }
  .title_h p{
    color: black;
    font-family: calibri;
    font-size: 18px;
    background: rgba(23, 191, 23, 0.823);
    border-radius:10px;
  }
  .table_h {
    width: 600px;
    border: 1px solid green;
    border-radius: 10px;
    text-align: center;
  }
  .table_h th{
    background: green;
    color: white;
  }
  .table_h th,td{
    padding: 10px;

  }
</style>
<?php
}else{
  header("Location: index.php");
}
?>