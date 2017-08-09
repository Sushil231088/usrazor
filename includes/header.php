 <?php 
 if($this->getCurrentView()=='login' || $this->getCurrentView()=='checkout')
 {
 include('includes/google_login_class.php');
 }
 ?>
<div class="header_container"> 

 <!--Header Starts-->

 <header>

  <div class="top_bar clear"> 

   <!--Language Switcher Starts-->

   <div class="language_switch links_top">

    <ul>

    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=''){ ?>


    <li class="log-in"> <a href="account.html" title="Your account"> Welcome <?php echo $_SESSION['UserName'];?></a> </li>



      <li><a href="index.php?view=home&act=do_logout">Logout</a></li>



    <?php } else { ?>

<li> <a class="active" href="account.html" title="Your account"> Your account </a> </li>

    <li> <a href="login.html" title="Sign in"> Sign in </a> </li>

     <li> <a href="javascript:void(0)" title="Shipping to US" class="ship_to_us"> Shipping to <img src="images/iconcountria.png" alt="Shipping to US"> </a> </li>

     <?php } ?>

    </ul>

   </div>

   <div class="links_social">

    <ul>
<?php if($this->gs['facebook_link']!=''){ ?>

     <li> <a  class="face_book" href="<?=$this->gs['facebook_link'];?>" target="_blank"> </a> </li>
     <?php } ?>
<?php if($this->gs['youtube_link']!=''){ ?>

     <li> <a  class="twiter" href="<?=$this->gs['youtube_link'];?>" target="_blank"> </a> </li>
<?php } ?>

<?php if($this->gs['twitter_link']!=''){ ?>
     <li> <a  class="gplus" href="<?=$this->gs['twitter_link'];?>" target="_blank"> </a> </li>
<?php } ?>
    

    </ul>

   </div>

   <!--Language Switcher Ends--> 

   <!--Top Links Starts--> 

   

   <!--Top Links Ends--> 

  </div>

  <!--Logo Starts-->

  <div class="logo"> <a href="index.html"><img src="images/Untitled-2.png" alt="usrazor" /> </a> </div>

  <div class="logo"> <a href="index.html"><img src="images/logoweb.png" alt="usrazor"/></a> </div>

  

  <!--Logo Ends--> 

  <!--Responsive NAV-->

  <div class="responsive-nav" style="display:none;">

   <select  onchange="if(this.options[this.selectedIndex].value != ''){window.top.location.href=this.options[this.selectedIndex].value}">

    <option selected="" value="">MENU</option>


 <?php for($i=0;$i<count($this->rscategory);$i++){ ?>

   <?php	 if(count($this->rscategory[$i]['subcategory'])>0)

	{



		if($this->rscategory[$i]['category_slug']==$this->getGetVar('product_category'))

		{$class='class="active"';}

		else{$class='';}

		?>

    <option value="products/<?=$this->rscategory[$i]['category_slug'];?>.html"><?php echo $this->rscategory[$i]['category_name'];?></option>
    
    
      <?php }else{ ?>

   <option value="products/<?=$this->rscategory[$i]['category_slug'];?>.html"> <?php echo $this->rscategory[$i]['category_name'];?></option>
  

   <?php } }?>

   

   </select>

  </div>

  <!--Responsive NAV--> 

  <!--Search Starts-->

  <form class="header_search" id="search_form" method="post" action="">

   <div class="form-search">

    <input id="search" type="text" name="q" value="<?=$this->getGetVar("keyword")?>" class="input-text" autocomplete="off" placeholder="Search" onkeyup="lookup(this.value);">

    

    <button type="submit" title="Search" id="search_button"></button>

   </div>

   <div id="suggestions"></div>

  </form>

  <!--Search Ends--> 

 </header>

 <!--Header Ends--> 

</div>

<div class="navigation_container"> 

 <!--Navigation Starts-->

 <nav>

  <ul class="primary_nav">

   <?php for($i=0;$i<count($this->rscategory);$i++){ ?>

   <?php	 if(count($this->rscategory[$i]['subcategory'])>0)

	{



		if($this->rscategory[$i]['category_slug']==$this->getGetVar('product_category'))

		{$class='class="active"';}

		else{$class='';}

		?>

   <li <?=$class;?>><a href="products/<?=$this->rscategory[$i]['category_slug'];?>.html"><?php echo $this->rscategory[$i]['category_name'];?></a> 

    <!--SUbmenu Starts--> 

    <!--<ul class="sub_menu">

                            <li> <a href="#">Dresses</a>

                                <ul>

                                    <li><a href="#">Skirts</a></li>

                                    <li><a href="#">Shorts</a></li>

                                    <li><a href="#">Premium Pants</a></li>

                                    <li><a href="#">Khakis</a></li>

                                    <li><a href="#">Casual Pants</a></li>

                                    <li><a href="#">Jeans</a></li>

                                    <li><a href="#">Outerwear & Blazers</a></li>

                                </ul>

                            </li>

                            <li> <a href="#">Accessories</a>

                                <ul>

                                    <li><a href="#">Sunglasses</a></li>

                                    <li><a href="#">Scarves</a></li>

                                    <li><a href="#">Hair Accessories</a></li>

                                    <li><a href="#">Hats and Gloves</a></li>

                                    <li><a href="#">Lifestyle</a></li>

                                    <li><a href="#">Jeans</a></li>

                                    <li><a href="#">Outerwear & Blazers</a></li>

                                </ul>

                            </li>

                        </ul>--> 

    <!--SUbmenu Ends--> 

   </li>

   <?php }else{ ?>

   <li <?=$class;?>><a href="products/<?=$this->rscategory[$i]['category_slug'];?>.html"><?php echo $this->rscategory[$i]['category_name'];?></a> </li>

   <?php } }?>

  

  </ul>

  

  <!--cart block-->

  <? $total_items=count($this->rs_cartmini);?>

  <div class="minicart" id="img_header_busket"> <a href="#" class="minicart_link" > <span class="item"><b id="cart_top_count">

    <?=$this->TOTAL_QTY;?>

   </b> items in your bag  /</span> $<span class="price" id="total_top">

   <?=$this->TOTAL;?>

   </span> </a>

   <div class="cart_drop"> <span class="darw"></span>

    <ul id="cart_row">

     <?php if(count($this->rs_cartmini)>0) {?>

     <?php for($i=0;$i<count($this->rs_cartmini);$i++){



	$title=$this->rs_cartmini[$i]['product_product_name'];

	$title_short=$this->utility->string_truncate($this->rs_cartmini[$i]['product_product_name'],30);

	$slug=$this->rs_cartmini[$i]['product_page_slug'];

	$url="product_detail/".$slug.".html";

	

	$records=$this->rs_cartmini;

			$a=$records[$i]["product_product_image"];

			if (strpos($a,'data') !== false) 

			{

   			 $cart_image=SERVER_ROOT.'/'.$this->get_user_config("product_image").$records[$i]["product_product_image"];

			}

			else

			{

			$cart_image="uploads/product_image/thumb".$records[$i]["product_product_image"];	

			}

	

	$remove_url='index.php?view=cart&act=delete&id='.$this->rs_cartmini[$i]['id'];

	

	?>

     <li>

      <div class="img-block"><img src="<?=$cart_image;?>" style="width:60px; height:60px;" title="<?=$title;?>" alt="<?=$title;?>" /></div>

      <div class="detail-block">

       <h4><a href="<?=$url;?>" title="<?=$title;?>">

        <?=$title_short;?>

        </a></h4>

       <p> <strong><? echo $this->rs_cartmini[$i]['quantity'] ;?></strong> x $ <? echo $this->rs_cartmini[$i]['product_price'] ;?> </p>

       <a href="<?=$url;?>" title="Details">Details</a> </div>

      <div class="edit-delete-block"> <a href="<?=$remove_url;?>" title="Remove"><img src="images/delete_item_btn.png" alt="Remove" title="Remove" /></a> </div>

     </li>

     <?php } ?>

     <?php } ?>

    </ul>

    <div class="cart_bottom">

     <div class="subtotal_menu"><small>Total:</small><big><span>$</span><span id="total_price">

      <?=$this->TOTAL;?>

      </span></big></div>

     <a href="cart.html">View cart</a>
     <span id="check_button">
     <?=$this->CHECK_BU;?>
     </span>
     </div>

   </div>

    <span id="check_but"><a href="checkout.html"> Checkout </a></span></div>

  <!--cart block end--> 

  

 </nav>

 <!--Navigation Ends--> 

</div>
<h1 class="seo_txt">Top Brand Gillette Trac II, Atra, Sensor, Mach3, Fusion Flex Ball Razor, Venus, Refill Catridges and Schick Quattro, Hydro5, FX Diamond, Silk Effects, Hydro Silk for the lowest price guaranteed with free US same day shipping </h1>
<h2 class="seo_txt">Razor Blades and Refill Cartridges Online - Buy Razor Blades Online </h2>
