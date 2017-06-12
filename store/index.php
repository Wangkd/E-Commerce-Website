<?php 
//connect to the server and dynamic rendering the page
include "connect_to_mysql.php";
$sql1 = mysql_query("SELECT * FROM products WHERE category='Nike'");
$productCount1 = mysql_num_rows($sql1); // count the output amount
if ($productCount1 > 0) {
	while($row = mysql_fetch_array($sql1)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
	  $nikelist .='<div class="col-md-3 col-md2">
                  <div class="col-md1 simpleCart_shelfItem">
                      <a href="product.php?id='. $id .'">
                          <img class="img-responsive" src="images/'. $id .'.png" alt="" />
                      </a>
                      <h3><a href="product.php?id=' . $id . '">' .$product_name.'</a></h3>
                      <div class="price">
                          <h5 class="item_price">$'.$price.'</h5>
                          <a href="product.php?id='. $id .'" class="item_add">Detail</a>
                          <div class="clearfix"> </div>
                      </div>
                  </div>
              </div>';
    }
}
$sql2 = mysql_query("SELECT * FROM products WHERE category='UA'");
$productCount2 = mysql_num_rows($sql2); // count the output amount
if ($productCount2 > 0) {
	while($row = mysql_fetch_array($sql2)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
	  $UAlist .='<div class="col-md-3 col-md2">
                  <div class="col-md1 simpleCart_shelfItem">
                      <a href="product.php?id='. $id .'">
                          <img class="img-responsive" src="images/'. $id .'.png" alt="" />
                      </a>
                      <h3><a href="product.php?id='. $id .'">' .$product_name.'</a></h3>
                      <div class="price">
                          <h5 class="item_price">$'.$price.'</h5>
                          <a href="product.php?id='. $id .'" class="item_add">Detail</a>
                          <div class="clearfix"> </div>
                      </div>
                  </div>
              </div>';
    }
}
$sql3 = mysql_query("SELECT * FROM products WHERE category='Reebok'");
$productCount3 = mysql_num_rows($sql3); // count the output amount
if ($productCount3> 0) {
	while($row = mysql_fetch_array($sql3)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
	  $Reeboklist .='<div class="col-md-3 col-md2">
                  <div class="col-md1 simpleCart_shelfItem">
                      <a href="product.php?id='. $id .'">
                          <img class="img-responsive" src="images/'. $id .'.png" alt="" />
                      </a>
                      <h3><a href="product.php?id='. $id .'">' .$product_name.'</a></h3>
                      <div class="price">
                          <h5 class="item_price">$'.$price.'</h5>
                          <a href="product.php?id='. $id .'" class="item_add">Detail</a>
                          <div class="clearfix"> </div>
                      </div>
                  </div>
              </div>';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<!--header-->
<?php include_once("template_header.php");?>
<!--//header-->
<div class="content">
<!--Nike content-->
  <div class="container">
      <div class="content-top">
      		<a id="nikeahchor" name="nikeahchor"></a>
          <h1>Nike</h1>
          <div class="content-top1">
              <?php echo $nikelist; ?>               
         </div>
     </div>
  </div>
<!--//Nike content-->
  <div class="container">
      <div class="content-top">
      	   <a name="UAahchor" id="UAahchor"></a>
          <h1>Under Armour</h1>
          <div class="content-top1">
         	 <?php echo $UAlist; ?>  
			 
         </div>
     </div>
  </div>
</div>
  <div class="container">
      <div class="content-top">
      		<a id="reebokahchor" name="reebokahchor"></a>
          <h1>Reebok</h1>
          <div class="content-top1">         
              <?php echo $Reeboklist; ?> 
              <div class="clearfix"></div>              
         </div>
     </div>
  </div>
<!--footer-->
<?php include_once("template_footer.php");?>
<!--//footer-->           
</body>
</html>