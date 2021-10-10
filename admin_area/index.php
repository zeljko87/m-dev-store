<?php
    session_start();
    include("includes/db.php");
    if(!isset($_SESSION['admin_email']))
    {
        echo "<script>window.open('login.php', '_self')</script>";
    }
    else
    {
        $admin_session = $_SESSION['admin_email'];
        $get_admin = "select * from admins where admin_email='$admin_session'";
        $run_admin = mysqli_query($conn, $get_admin);
        $row_admin = mysqli_fetch_array($run_admin);
        $admin_id = $row_admin['admin_id'];
        $admin_name = $row_admin['admin_name'];
        $admin_email = $row_admin['admin_email'];
        $admin_image = $row_admin['admin_image'];
        $admin_country = $row_admin['admin_country'];
        $admin_about = $row_admin['admin_about'];
        $admin_contact = $row_admin['admin_contact'];
        $admin_job = $row_admin['admin_job'];

        $get_products = "select * from products";
        $run_products = mysqli_query($conn, $get_products);
        $count_products = mysqli_num_rows($run_products);
        $get_customers = "select * from customers";
        $run_customers = mysqli_query($conn, $get_customers);
        $count_customers = mysqli_num_rows($run_customers);
        $get_p_categories = "select * from product_categories";
        $run_p_categories = mysqli_query($conn, $get_p_categories);
        $count_p_categories = mysqli_num_rows($run_p_categories);
        $get_pending_orders = "select * from pending_orders";
        $run_pending_orders = mysqli_query($conn, $get_pending_orders);
        $count_pending_orders = mysqli_num_rows($run_pending_orders);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device=width, initial-scale=1">
        <title>M-Dev Store</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php
                include("includes/sidebar.php");
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <?php
                        if(isset($_GET['dashboard']))
                        {
                            include("dashboard.php");
                        }
                        if(isset($_GET['insert_product']))
                        {
                            include("insert_product.php");
                        }
                        if(isset($_GET['view_products']))
                        {
                            include("view_products.php");
                        }
                        if(isset($_GET['delete_product']))
                        {
                            include("delete_product.php");
                        }
                        if(isset($_GET['edit_product']))
                        {
                            include("edit_product.php");
                        }
                        if(isset($_GET['insert_p_cat']))
                        {
                            include("insert_p_cat.php");
                        }
                        if(isset($_GET['view_p_cats']))
                        {
                            include("view_p_cats.php");
                        }
                        if(isset($_GET['edit_p_cat']))
                        {
                            include("edit_p_cat.php");
                        }
                        if(isset($_GET['delete_p_cat']))
                        {
                            include("delete_p_cat.php");
                        }
                    ?>
                </div>
            </div>
        </div> <!-- end wrapper -->
    </body>
</html>

<?php } ?>
