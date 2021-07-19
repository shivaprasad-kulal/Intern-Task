<?php
session_start();
include 'database/config.php';


$sql = "SELECT * FROM transfer_history";
$query = mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Sparks Foundation - Transfer History</title>
    <link rel="stylesheet" href="css/user.css">
    <link rel="icon" href="image/bank-icon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
  <?php include 'include/header.php';?>
  <center>
    <div class="title">
            <h3 style="color:#b30059">The Sparks Foundation</h3>
            <h4>Basic Banking System</h4>
    </div>
    <div class="table-responsive-sm">
      <table class="table_b" style=" border: 1px solid red; width: 800px; border-radius: 10px;" >
        <tr>
          <th style="background:#ffff66;color: black;">Id</th>
          <th style="background:#ffff66;color: black;">From</th>
          <th style="background:#ffff66;color: black;">To</th>
          <th style="background:#ffff66;color: black;" >Amount</th>
          <th style="background:#ffff66;color: black;">Date / Time</th>
        </tr>
        <?php
        while($result = mysqli_fetch_array($query)){?>
        <tr>
          <td><?php echo $result['id']?></td>
          <td><?php echo $result['from_name']?></td>
          <td><?php echo $result['to_name']?></td>
          <td><?php echo $result['amount']?></td>
          <td><?php echo $result['date']?></td>
        </tr>
        <?php }?>
      </table>
        </div>
  </center>
</body>
</html>
<?php ?>
<style>*{
    margin: 0px;
    padding: 0px;
}
.table_b{
    border: 1px solid green;
    width: 800px;
    border-radius: 10px;
}
.table_b th,td{
    text-align: center;
    padding: 10px;
}
.table_b th{
    background: rgba(23, 191, 23, 0.823);
    color: white;
}
.title{
    margin-top: 60px;
  }
  .title h3 {
    color: red;
  }</style>