<section class="banner-wrapper_fullwidth">
              <div class="banner-block_fullwidth">
               <section class="content-wrapper">
              <div class="content-container container">
               <div class="heading-block1 top_banners">
                  <ul class="pagination1">
                    <li class="grid"><a href="#" title="Grid"></a></li>
                  </ul>
                </div>
                 <div class="korai_categories"> 
                 <ul  id="banner" class="product-grid1"> 
                 
                 <?php 
				 
				 for($i=0;$i<count($this->home_banner);$i++){ 
	   			 ?>
                 
                 <li>
				<div class="pro-img1">
	               <a href="<?php echo $this->home_banner[$i]['banner_link']; ?>">
                   <img src="<?php echo SERVER_ROOT.$this->get_user_config("banner_image").$this->home_banner[$i]['banner_image'];?>" style="width:225px;"/>
                   </a>
                    
                	<a href="<?php echo $this->home_banner[$i]['banner_link']; ?>">
                    <div class="category_title"><?php echo $this->home_banner[$i]['banner_text']; ?></div>
                    </a>
                    
                	</div>
                 
                 </li>
                 
                  <?php 
				 } 
	   			 ?>
                 
                
                  
                 
                 
                  
                  </ul>
                 </div>
                 </div></section>
                
              </div>
            </section>