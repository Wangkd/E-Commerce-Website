<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	include "connect_to_mysql.php";
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$sql = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
       } 
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysql_close();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Products</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<!--header-->
<?php include_once("template_header.php");?>
<!--//header-->
<!--content-->
<div class="single">
	<div class="container">
		<div class="col-md-12">
			<div class="col-md-5 grid">		
				<div class="thumb-image"> <img src="images/<?php echo $id; ?>.png"> </div>
			</div>	
		<div class="col-md-7 single-top-in">
			<div class="single-para simpleCart_shelfItem">
				<h1><?php echo $product_name; ?></h1>
				<p><?php echo $details; ?></p>
				<label  class="add-to item_price">$<?php echo $price; ?></label>
              	<form id="form1" name="form1" method="post" action="shoppingcart.php">
        			<input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        			<a class="cart item_add"><input type="submit" style = "background-color: transparent; border: 0; name="button" id="button" value="Add to Cart" /></a>
      			</form>
			</div>
		</div>
		<div class="clearfix"> </div>
		<div class="content-top1">
			<div class="clearfix"> </div>
		</div>		
		</div>
			<div class="clearfix"> </div>
	</div>
</div>
<!--//content-->
<!--footer-->
<?php include_once("template_footer.php");?>
<!--//footer-->           
</body>
</html>