<?php
    if(!isset($_SESSION['admin_email']))
    {
        echo "<script>window.open('login.php', '_self')</script>";
    }
    else
    {
?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / Insert Product Category
            </li>
        </ol>
    </div> <!-- col-lg-12 end -->
</div> <!-- row 1 end -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-tag fa-fw"></i> Insert Product Category
                </h3>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> Product Category Title </label>
                        <div class="col-md-6">
                            <input name="p_cat_title" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> Product Category Description </label>
                        <div class="col-md-6">
                            <textarea name="p_cat_desc" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> </label>
                        <div class="col-md-6">
                            <input value="Submit" name="submit" type="submit" class="form-control btn btn-primary">
                        </div>
                    </div>
                </form>
            </div> <!-- panel-body end -->
        </div> <!-- panel panel-default end -->
    </div> <!-- col-lg-12 end -->
</div> <!-- row 2 end -->

<?php
    if(isset($_POST['submit']))
    {
        $p_cat_title = $_POST['p_cat_title'];
        $p_cat_desc = $_POST['p_cat_desc'];
        $insert_p_cat = "insert into product_categories (p_category_title, p_category_desc) values ('$p_cat_title', '$p_cat_desc')";
        $run_p_cat = mysqli_query($conn, $insert_p_cat);
        if($run_p_cat)
        {
            echo "<script>alert('Your new product category has been inserted.')</script>";
            echo "<script>window.open('index.php?view_p_cats', '_self')</script>";
        }
    }
?>

<?php } ?>
