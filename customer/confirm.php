<?php
    session_start();

    if(!isset($_SESSION['customer_email']))
    {
        echo "<script>window.open(../checkout.php, '_self')</script>";
    }
    else
    {
        include("includes/db.php");
        include("functions/functions.php");
        if(isset($_GET['order_id']))
        {
            $order_id = $_GET['order_id'];
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>M-Dev-Store</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/style_cart.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div id="top">
            <div class="container">
                <div class="col-md-6 offer">
                    <a href="#" class="btn btn-success btn-sm">
                        <?php
                            if(!isset($_SESSION['customer_email']))
                            {
                                echo "Welcome: Guest";
                            }
                            else
                            {
                                echo "Welcome " . $_SESSION['customer_email'] . "";
                            }
                        ?>
                    </a>
                    <a href="../checkout.php"> <?php items(); ?> Items in your card | Total price: <?php total_price(); ?> </a>
                </div>
                <div class="col-md-6">
                    <ul class="menu">
                        <li>
                            <a href="../customer/my_account.php">My Account</a>
                        </li>
                        <li>
                            <a href="../cart.php">Go To Cart</a>
                        </li>
                        <li>
                            <a href="../checkout.php">
                            <?php
                                if(!isset($_SESSION['customer_email']))
                                {
                                    echo "<a href='../checkout.php'> Login </a>";
                                }
                                else
                                {
                                    echo "<a href='../logout.php'> Logout </a>";
                                }
                            ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> <!-- top end -->

        <div id="navbar" class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header"> <!-- navbar-header begin -->
                    <a href="../index.php" class="navbar-brand home">
                        <img src="images/ecom-store-logo.png" alt="M-dev-Store Logo" class="hidden-xs">
                        <img src="images/ecom-store-logo-mobile.png" alt="M-dev-Store Logo Mobile" class="visible-xs">
                    </a>
                    <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle Navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle Search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div> <!-- navbar-header end -->

                <div class="navbar-collapse collapse" id="navigation"> <!-- navbar-collapse begin -->
                    <div class="padding-nav">
                        <ul class="nav navbar-nav left">
                            <li class="<?php if($active == "Home") echo "active"; ?>">
                                <a href="../index.php">Home</a>
                            </li>
                            <li class="<?php if($active == "Shop") echo "active"; ?>">
                                <a href="../shop.php">Shop</a>
                            </li>
                            <li class="<?php if($active == "Account") echo "active"; ?>">
                                <a href="my_account.php">My Account</a>
                            </li>
                            <li class="<?php if($active == "Cart") echo "active"; ?>">
                                <a href="../cart.php">Shopping Cart</a>
                            </li>
                            <li class="<?php if($active == "Contact") echo "active"; ?>">
                                <a href="../contact.php">Contact Us</a>
                            </li>
                        </ul>
                    </div> <!-- padding-nav end -->
                    <a href="../cart.php" class="btn navbar-btn btn-primary right">
                        <i class="fa fa-shopping-cart"></i>
                        <span><?php items(); ?> Items in Your Cart</span>
                    </a>
                    <div class="navbar-collapse collapse right">
                        <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search">
                            <span class="sr-only">Toggle Search</span>
                            <i class="fa fa-search"></i>
                        </button> <!-- btn btn-primary navbar-btn end -->
                    </div> <!-- navbar-collapse collapse right end -->
                    <div class="collapse clearfix" id="search">
                        <form method="get" action="results.php" class="navbar-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="user_query" required>
                                <span class="input-group-btn">
                                    <button type="submit" name="search" value="Search" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div> <!-- input-group end -->
                        </form>
                    </div> <!-- collapse clearfix end -->
                </div>  <!-- navbar-header end -->
            </div> <!-- container end -->
        </div> <!-- navbar navbar-default end -->

        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="../index.php"> Home </a></li>
                        <li><a href="confirm.php"> Confirm </a></li>
                    </ul>
                </div> <!-- col-md-12 end -->
                <div class="col-md-3">
                    <?php include("sidebar.php"); ?>
                </div> <!-- col-md-3 end -->
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h2 align="center"> Please confirm your payment </h2>
                            <br>
                            <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label> Invoice No: </label>
                                    <input type="text" class="form-control" name="invoice_no" required>
                                </div>
                                <div class="form-group" method="post" enctype="multipart/form-data">
                                    <label> Amount Sent: </label>
                                    <input type="text" class="form-control" name="amount_sent" required>
                                </div>
                                <div class="form-group">
                                    <label> Select Payment Mode: </label>
                                    <select name="payment_mode" class="form-control">
                                        <option> Select Payment Mode </option>
                                        <option> Back Code </option>
                                        <option> Paypall </option>
                                        <option> Payoneer </option>
                                        <option> Western Union </option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Transaction / Reference ID: </label>
                                    <input type="text" class="form-control" name="ref_no" required>
                                </div>
                                <div class="form-group">
                                    <label> Paypall / Payonner / Western Union </label>
                                    <input type="text" class="form-control" name="code" required>
                                </div>
                                <div class="form-group">
                                    <label> Payment Date: </label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <br>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-lg" name="confirm_payment">
                                        <i class="fa fa-user-md"></i> Confirm Payment
                                    </button>
                                </div>
                            </form>
                            <?php
                                if(isset($_POST['confirm_payment']))
                                {
                                    $update_id = $_GET['update_id'];
                                    $invoice_no = $_POST['invoice_no'];
                                    $amount = $_POST['amount_sent'];
                                    $payment_mode = $_POST['payment_mode'];
                                    $ref_no = $_POST['ref_no'];
                                    $code = $_POST['code'];
                                    $payment_date = $_POST['date'];
                                    $complete = "Complete";
                                    $insert_payment = "insert into payments (invoice_no, amount, payment_mode, ref_no, code, payment_date)                                                                            values('$invoice_no', '$amount', '$payment_mode', '$ref_no', '$code', '$payment_date')";
                                    $run_payment = mysqli_query($conn, $insert_payment);
                                    $update_customer_order = "update customer_orders set order_status='$complete' where order_id='$update_id'";
                                    $run_customer_order = mysqli_query($conn, $update_customer_order);
                                    $update_pending_order = "update pending_orders set order_status='$complete' where order_id='$update_id'";
                                    $run_pending_order = mysqli_query($conn, $update_pending_order);
                                    if($run_pending_order)
                                    {
                                        echo "<script>alert('Thank You for purchasing, your orders will be completed within 24 hours work!')</script>";
                                        echo "<script>window.open('my_account.php?my_orders', '_self')</script>";
                                    }
                                }
                            ?>
                        </div>
                    </div> <!-- box end -->
                </div> <!-- col-md-9 end -->
            </div> <!-- container end -->
        </div> <!-- content end -->
        <?php
            include("footer.php");
        ?>
    </body>
</html>

<?php } ?>
