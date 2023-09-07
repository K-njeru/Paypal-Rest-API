<?php 
include_once 'db_connection.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Profit Academi - Payment Successfull</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Football betting tips and trading bots - Increase your chances of winning with our expert tips and automated trading bots." name="description">
  <meta content="football betting tips, trading bots, football tips, sports betting, automated bots" name="keywords">

  <!-- Favicon -->
  <link href="img/logo.jpeg" rel="icon">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    
    .receipt {
      border: 2px solid blue;
      max-width: 400px;
      padding: 20px;
      text-align: center;
    }
    
    .download-button {
      margin-top: 20px;
    }
  </style>
</head>

<body class="App">

  <div class="receipt">
    <h1>Payment Receipt</h1>
    <div class="wrapper">
      <?php 
        $paymentid = $_GET['payid'];
        $results = mysqli_query($db_conn,"SELECT * FROM payments where id='$paymentid' ");
        $row = mysqli_fetch_array($results);
      ?>
      <div class="status">
        <h4>Payment Information</h4>
        <p>Reference Number: <?php echo $row['invoice_id']; ?></p>
        <p>Transaction ID: <?php echo $row['transaction_id']; ?></p>
        <p>Paid Amount: <?php echo $row['payment_amount']; ?></p>
        <p>Payment Status: <?php echo $row['payment_status']; ?></p>
        <h4>Product Information</h4>
        <p>Product id: <?php echo $row['product_id']; ?></p>
        <p>Product Name: <?php echo $row['product_name']; ?></p>
      </div>
    </div>
   
  </div>
  <button class="download-button" onclick="downloadReceipt()">Download Receipt</button>
  <script>
    function downloadReceipt() {
      var receiptContent = document.documentElement.innerHTML;
      var blob = new Blob([receiptContent], {type: "text/html"});
      var url = URL.createObjectURL(blob);
      var a = document.createElement('a');
      a.href = url;
      a.download = 'receipt.html';
      a.click();
      URL.revokeObjectURL(url);
    }
  </script>
</body>
</html>