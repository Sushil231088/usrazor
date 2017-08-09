<div class="footer_container"> 

    <!--Footer Starts-->

    <footer>

      <ul class="footer_links">

        <li> <span>Products</span>

          <ul>

          	<?php for($i=0;$i<count($this->rscategory);$i++){ ?>

    	  	<?php if(count($this->rscategory[$i]['subcategory'])>0)
		 	{
			if($this->rscategory[$i]['category_slug']==$this->getGetVar('product_category'))
	
			{$class='class="active"';}
	
			else{$class='';}

			?>

   <li <?=$class;?>><a href="products/<?=$this->rscategory[$i]['category_slug'];?>.html"><?php echo $this->rscategory[$i]['category_name'];?></a> 

   </li>

   <?php } else { ?>

   <li <?=$class;?>><a href="products/<?=$this->rscategory[$i]['category_slug'];?>.html"><?php echo $this->rscategory[$i]['category_name'];?></a> </li>

   <?php } }?>

          </ul>

        </li>

        <li  class="seperator"> <span>Manufacturer</span>

          <ul>

            <?php for($i=0;$i<count($this->brand);$i++){?>

            <li><a href="manufacturer/<?=$this->brand[$i]['id'];?>.html"><?=$this->brand[$i]['manufacturer_name'];?></a></li>

           <?php }?>

          </ul>

        </li>

        <li> <span>Informational Links</span>

          <ul>

               <?php for($i=0;$i<count($this->company_info_pages);$i++){ 

				$title=$this->company_info_pages[$i]['page_title'];

				$id=$this->company_info_pages[$i]['id'];

				$slug=$this->company_info_pages[$i]['slug'];

				$page_name=strtolower($title);

				$page_name=str_replace(" ","-",$page_name);

				if($this->company_info_pages[$i]['page_url']=="")

				{$pageurl=$slug.".html";}

				else{$pageurl=$this->company_info_pages[$i]['page_url'];}

				?>

				<li><a href="<?=$pageurl;?>"><?=$title;?></a></li>

				<?php } ?>

          </ul>

        </li>

        <li> <span>My Account</span>

          <ul>

            <li><a href="account.html">My Account Information</a></li>

            <li><a href="change_password.html">My Password</a></li>

            <li><a href="account.html">My Order History</a></li>

           

          </ul>

        </li>

      </ul>

      <div class="footer_customblock">

        <div class="shipping_info">

          <big>FREE SHIPPING</big><br>

          <small>IN USA ONLY</small> </div>

        <div class="contact_info"> <span class="share_but"> Share Us :</span> <div class="addthis_sharing_toolbox"></div></div>
        
        <img src="images/paymenticons.gif" alt="usrazor payment">

      </div>

      <address>

      Copyright © 2012 Usrazor. All Rights Reserved. <div class="deve_by"> <a href="http://www.thedezine.in" target="_blank" class="dev_text">Design & Developed By <strong>The Dezine</strong></a> </div>

      </address>

    </footer>

    <!--Footer Ends--> 

  </div>
  
  <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53f1982f4b19f7f2"></script>
  
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67504758-1', 'auto');
  ga('send', 'pageview');

</script>