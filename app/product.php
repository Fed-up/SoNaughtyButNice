<?php 
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
			 $category_id = $row["category_id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $product_name; ?></title>
    <!-- Bootstrap CSS -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="../../css/magnific-popup.css"> 
    <!-- Mobile viewport optimized -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
	<link rel="stylesheet" type="text/css" href="../css/admin_menu.css" />
    <link rel="stylesheet" type="text/css" href="../css/admin_content.css" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <!--<link rel="stylesheet" type="text/css" href="style/style.css" /> -->
     <link rel="stylesheet" type="text/css" href="../css/recipe_style.css" />
     <link rel="stylesheet" type="text/css" href="../css/menu.css" />
     <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body> 
    <?php include('../template/shopping_bottom_header.php'); ?>
    <div style="margin-top:20px;" class="contentbox">
        <article class="recipe-text">
            <!--<div align="center" style="min-height:400px;" id="mainWrapper">-->
            	<div style="float:left">
                
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<div class="thumbnail">
							<div class="html-code grid-of-images">
								<div class="popup-gallery">
									<a style="padding:0px; margin:0px;" href="inventory_images/<?php echo $id; ?>.jpg" title="<?php echo $product_name; ?>">
									<img class="img-responsive" src="inventory_images/<?php echo $id; ?>.jpg" alt="One day i will take you somewhere"/>
									</a>
								</div>
							</div>
						</div>
					</div>
                </div> <br/><br/><br/><br/><br/>
                <div> 
                  
                	<h3><?php echo $product_name; ?></h3>
                    <br/>
                  	<p class="indent_text">Price:<?php echo "$".$price; ?></p><br />
                    <br /><br/>
           			<p class="indent_text"><?php echo $details; ?></p>
            		<br /><br/>
                    </p>
				</div>
                <div style="margin-left:-20px;" class="col-8">
                      <form id="form1" name="form1" method="post" action="cart.php">
                        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
                        <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
                      </form>
                      
                      <form action="../index.php" method="post">
                      	<input type="submit" name="button" id="button" value="Head Home" />
                      </form>
                  	</div><br/><br/><br/><br/>
         	<!--</div>-->
            <br/><br/><br/><br/>
        </article>
	</div>
    
    
    
    <!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="../../includes/js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Custom JS -->
	<script src="../../js/script.js"></script>
    
		<!-- Magnific Popup core JS file -->
    <script type="text/javascript" src="../../js/jquery.magnific-popup.js"></script> 
    <script type="text/javascript">
      $(document).ready(function() {

        $('.image-popup-vertical-fit').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-img-mobile',
          image: {
            verticalFit: true
          }
          
        });

        $('.image-popup-fit-width').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          image: {
            verticalFit: false
          }
        });

        $('.image-popup-no-margins').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          closeBtnInside: false,
          fixedContentPos: true,
          mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
          image: {
            verticalFit: true
          },
          zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
          }
        });

      });
	</script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
          delegate: 'a',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '.<?php echo '<small>Made with love by Sarah Chan</small>'; ?>.';
            }
          }
        });
      });
    </script>

</body>
</html>