<?php 
session_start();
include "connect_to_mysql.php";
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
	header("location: shoppingcart.php"); 
    exit();
}
?>
<?php 
$alltotal = 0;
foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
		}
		$pricetotal = $price * $each_item['quantity'];
		$alltotal += $pricetotal;
		// Dynamic table row assembly
		$productInfo .= '<tr>
			<td class="ring-in"><a class="at-in"><img src="images/' . $item_id . '.png" class="img-responsive" alt=""></a>
			<div class="sed">
				<h5>' . $product_name. '</h5>
			</div>
			<div class="clearfix"> </div></td>
			<td class="check">' . $each_item['quantity'] . '</td>		
			<td>$' . $price . '</td>
			<td>$' . $pricetotal . '</td>
		  </tr>';
		$i++; 
} 
//empty the cart
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
//output the total cost of the cart
if (isset($_POST['state'])) {
	$state = $_POST['state'];
	$sql = mysql_query("SELECT * FROM state_tax WHERE state_name='$state' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
			 $taxrate = $row["taxrate"];
       } 
	}
	$totalcost = $alltotal + $taxrate * $alltotal;
	$totalcostOutput = '<h3>Your total after-tax cost for this cart is $'.$totalcost.'</h3>';	
}
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
<div class="container">
	<div class="check-out">
		<h1>Check out</h1>
    	    <table >
		  <tr>
			<th width="45%"><div align="center">Item</div></th>
			<th width="19%">Qty</th>		
			<th width="19%">Prices</th>
			<th width="17%">Subtotal</th>
		  </tr>
          <?php echo $productInfo; ?>
	</table>
	<a href="shoppingcart.php?cmd=emptycart" class=" to-buy">Empty cart</a>
    <br/><br/>  
	<div class="clearfix"> </div>
    <!--<div class="col-md-4 world">
					<ul >
						<li>
						<select class="in-drop1">
							  <option>English</option>
							  <option>Japanese</option>
							  <option>California</option>
							</select></li>
						
					</ul>
				</div>-->
    <form action="shoppingcart.php" method="post">
    	SHIPPING INFORMATION<br/><br/>
        Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input><br/>
        State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="state" id="state"><br/>
        Phone Number&nbsp;<input type="text"><br/> <br/>
        <a class="cart item_add"><input type="submit" style = "background-color: transparent; border: 0; name="button" id="button" value="Caculate total cost" /></a>
    </form> 
    <?php echo $totalcostOutput; ?>         
   	</div>
</div>
<!--//content-->
<!--footer-->
<?php include_once("template_footer.php");?>
<!--//footer-->           
</body>
</html>