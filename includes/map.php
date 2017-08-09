<div class="map-wrapper">
 <div class="map"> 
  <script type="text/javascript">

                var infoBoxes = [];

                var property1 = '<div class="infobox clearfix"><div class="close"><img src="assets/img/close.png" alt=""></div><div class="image"><a href="properties/property-detail" ><img src="assets/img/property/17.jpg" alt="677 Cottage Terrace" width="130px"></a><div class="contract-type">For sale</div></div><div class="info"><div class="title"><a href="properties/property-detail">677 Cottage Terrace</a></div><div class="location">Spring Valley</div><div class="property-info clearfix"><div class="area"><i class="icon icon-normal-cursor-scale-up"></i>650m<sup>2</sup></div><div class="bedrooms"><i class="icon icon-normal-bed"></i>1</div><div class="bathrooms"><i class="icon icon-normal-shower"></i>1</div></div><div class="price">59,600 €</div><div class="link"><a href="properties/property-detail">View more</a></div></div></div>';
                var property2 = '<div class="infobox clearfix"><div class="close"><img src="assets/img/close.png" alt=""></div><div class="image"><a href="properties/property-detail"><img src="assets/img/property/19.jpg" alt="643 37th Ave" width="130px"></a><div class="contract-type">For sale</div></div><div class="info"><div class="title"><a href="properties/property-detail">643 37th Ave</a></div><div class="location">Burrville</div><div class="property-info clearfix"><div class="area"><i class="icon icon-normal-cursor-scale-up"></i>800m<sup>2</sup></div><div class="bedrooms"><i class="icon icon-normal-bed"></i>2</div><div class="bathrooms"><i class="icon icon-normal-shower"></i>2</div></div><div class="price">Contact us</div><div class="link"><a href="properties/property-detail">View more</a></div></div></div>';
                var property3 = '<div class="infobox clearfix"><div class="close"><img src="assets/img/close.png" alt=""></div><div class="image"><a href="properties/property-detail" ><img src="assets/img/property/17.jpg" alt="677 Cottage Terrace" width="130px"></a>                  <div class="contract-type">For sale</div></div><div class="info"><div class="title"><a href="properties/property-detail">677 Cottage Terrace</a></div><div class="location">Spring Valley</div><div class="property-info clearfix"><div class="area"><i class="icon icon-normal-cursor-scale-up"></i>650m<sup>2</sup></div><div class="bedrooms"><i class="icon icon-normal-bed"></i>1</div><div class="bathrooms"><i class="icon icon-normal-shower"></i>1</div></div><div class="price">59,600 €</div><div class="link"><a href="properties/property-detail">View more</a></div></div></div>';

                for (var i=0;i< 15 ;i++)
                {
                    infoBoxes.push(property1);
                    infoBoxes.push(property2);
                    infoBoxes.push(property3);
                }

                jQuery(document).ready(function ($) {
                    var map = $('#map').aviators_map({
                        locations: new Array([38.951399, -76.958463], [38.942855, -76.959149], [38.935945, -76.954085], [38.924194, -76.962497], [38.929335, -76.966402], [38.950131, -76.975286], [38.941386, -76.976745], [38.912975, -76.973269], [38.927266, -76.985156], [38.936813, -76.987173], [38.941653, -76.995885], [38.929235, -76.995627], [38.922024, -77.001378], [38.920788, -77.020304], [38.926531, -77.007558], [38.939384, -77.018115], [38.939217, -77.070257], [38.931539, -77.103517], [38.942454, -77.05352], [38.930571, -77.086007], [38.947194, -77.109696], [38.949864, -77.094762], [38.940685, -77.095964], [38.932474, -77.026441], [38.932941, -77.034165], [38.932641, -77.044079], [38.932908, -77.061674], [38.931372, -77.07781], [38.926665, -77.101457], [38.929135, -77.101671], [38.919086, -77.108538], [38.910103, -77.104504], [38.920221, -77.084033], [38.915513, -77.089741], [38.918752, -77.095105], [38.912073, -77.00597], [38.90486, -77.024724], [38.918418, -77.010605], [38.928868, -77.021377], [38.920154, -77.010562], [38.915847, -77.069699], [38.926164, -77.056739], [38.925045, -77.040063], [38.922591, -77.034291]),
                        types: new Array('family-house', 'villa', 'cottage', 'single-home', 'family-house', 'cottage', 'apartment', 'building-area', 'apartment', 'family-house', 'villa', 'family-house', 'villa', 'single-home', 'cottage', 'villa', 'condo', 'apartment', 'single-home', 'cottage', 'family-house', 'villa', 'apartment', 'apartment', 'villa', 'villa', 'apartment', 'cottage', 'villa', 'family-house', 'building-area', 'family-house', 'family-house', 'cottage', 'apartment', 'cottage', 'family-house', 'villa', 'cottage', 'condo', 'building-area', 'family-house', 'single-home', 'apartment'),
                        contents: infoBoxes,
                        transparentMarkerImage: 'assets/img/marker-transparent.png',
                        transparentClusterImage: 'assets/img/markers/cluster-transparent.png',
                        zoom: 14,
                        center: {
                            latitude: 38.932307,
                            longitude: -77.034258
                        },
                        filterForm: '.map-filtering',
                        enableGeolocation: '',
                        pixelOffsetX: -75,
                        pixelOffsetY: -200
                    });
                });
            </script>
  <div class="container" style="height:0px;">
   <div class="row">
    <div class="span3">
     <div class="property-filter widget">
      <div class="content home_page_block">
       <ul class="tabs nav nav-tabs top_0">
        <li  class="active"><a href="#residential" data-toggle="tab">Residential</a></li>
        <li><a href="#commercial" data-toggle="tab">commercial</a></li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="residential" >
         <form method="get" action="" id="residential_property_search" name="residential_property_search">
          <div class="rent control-group">
           <div class="controls">
            <label class="checkbox">
           <input type="checkbox" value="Yes" name="for_rent">
             Rent </label>
           </div>
           <!-- /.controls --> 
          </div>
          <!-- /.control-group -->
          
          <div class="sale control-group">
           <div class="controls">
            <label class="checkbox">
            <input type="checkbox" value="Yes" name="for_sale">
             Sale </label>
           </div>
           <!-- /.controls --> 
          </div>
          <div class="location control-group">
           <label class="control-label"> Type </label>
           <div class="controls">
            <? $this->htmlBuilder->buildTag("select", array("class"=>"required", "values"=>$this->records_property_type),"property_type_id") ?>
           </div>
           <!-- /.controls --> 
          </div>
          <!-- /.control-group -->
          <div class="location control-group">
           <label class="control-label"> Bedrooms </label>
           <div class="controls">
            <select name="filter_location" name="bedroom" id="bedroom">
            <option value="">-</option>
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">4</option>
            </select>
           </div>
           <!-- /.controls --> 
          </div>
          
          <!-- /.control-group -->
          
          <div class="location control-group">
           <label class="control-label"> City </label>
           <div class="controls">
            <? $this->htmlBuilder->buildTag("select", array("class"=>"required", "values"=>$this->records_city),"city_id") ?>
           </div>
           <!-- /.controls --> 
          </div>
          <div class="location control-group">
           <label class="control-label"> Area </label>
           <div class="controls">
            <? $this->htmlBuilder->buildTag("input", array("type"=>"text"), "area") ?>
           </div>
           <!-- /.controls --> 
          </div>
          
          <!-- /.control-group -->
          
          <div class="sale control-group">
           <div class="controls">
            <label class="control-label"> Min Price </label>
            <div class="controls">
             <select name="filter_price_from" name="min_price" id="min_price">
             <option value="5000">5,000</option>
             <option value="10000">10,000</option>
             <option value="25000">25,000</option>
             <option value="50000">50,000</option>
             <option value="75000">75,000</option>
             <option value="100000">1lac</option>
             <option value="500000">5 lacs</option>
             <option value="1000000">10 lacs</option>
             <option value="2000000">20 lacs</option>
             <option value="3000000">30 lacs</option>
             <option value="4000000">40 lacs</option>
             <option value="5000000">50 lacs</option>
             <option value="6000000">60 lacs</option>
             <option value="7000000">70 lacs</option>
             <option value="8000000">80 lacs</option>
             <option value="9000000">90 lacs</option>
             <option value="10000000">1crore</option>
             <option value="12000000">1.2 crores</option>
             <option value="14000000">1.4 crores</option>
             <option value="16000000">1.6 crores</option>
             <option value="18000000">1.8 crores</option>
             <option value="20000000">2 crores</option>
             <option value="23000000">2.3 crores</option>
             <option value="26000000">2.6 crores</option>
             <option value="30000000">3 crores</option>
             <option value="35000000">3.5 crores</option>
             <option value="40000000">4 crores</option>
             <option value="45000000">4.5 crores</option>
             <option value="50000000">5 crores</option>
             <option value="&gt;50000000">&gt;5 crores</option>
             </select>
            </div>
           </div>
           <!-- /.controls --> 
          </div>
          <div class="sale control-group">
           <div class="controls">
            <label class="control-label"> Max Price </label>
            <div class="controls">
             <select name="filter_price_from" name="max_price" id="max_price">
             <option value="5000">5,000</option>
             <option value="10000">10,000</option>
             <option value="25000">25,000</option>
             <option value="50000">50,000</option>
             <option value="75000">75,000</option>
             <option value="100000">1lac</option>
             <option value="500000">5 lacs</option>
             <option value="1000000">10 lacs</option>
             <option value="2000000">20 lacs</option>
             <option value="3000000">30 lacs</option>
             <option value="4000000">40 lacs</option>
             <option value="5000000">50 lacs</option>
             <option value="6000000">60 lacs</option>
             <option value="7000000">70 lacs</option>
             <option value="8000000">80 lacs</option>
             <option value="9000000">90 lacs</option>
             <option value="10000000">1crore</option>
             <option value="12000000">1.2 crores</option>
             <option value="14000000">1.4 crores</option>
             <option value="16000000">1.6 crores</option>
             <option value="18000000">1.8 crores</option>
             <option value="20000000">2 crores</option>
             <option value="23000000">2.3 crores</option>
             <option value="26000000">2.6 crores</option>
             <option value="30000000">3 crores</option>
             <option value="35000000">3.5 crores</option>
             <option value="40000000">4 crores</option>
             <option value="45000000">4.5 crores</option>
             <option value="50000000">5 crores</option>
             <option value="&gt;50000000">&gt;5 crores</option>
             </select>
            </div>
           </div>
           <!-- /.controls --> 
          </div>
          
          <!-- /.control-group -->
          
          <div class="form-actions">
           <button class="btn btn-primary btn-large" type="submit">Filter now!</button>
          </div>
          <!-- /.form-actions -->
         </form>
        </div>
        
        <!-- /.tab-pane -->
        <div class="tab-pane" id="commercial">
         <form method="get" action="javascript:void(0);">
          <div class="rent control-group">
           <div class="controls">
            <label class="checkbox">
             <input type="checkbox" value="Yes" name="for_rent">
             Rent </label>
           </div>
           <!-- /.controls --> 
          </div>
          <!-- /.control-group -->
          
          <div class="sale control-group">
           <div class="controls">
            <label class="checkbox">
             <input type="checkbox" value="Yes" name="for_sale">
             Sale </label>
           </div>
           <!-- /.controls --> 
          </div>
          <div class="location control-group">
           <label class="control-label"> Type </label>
           <div class="controls">
 <? $this->htmlBuilder->buildTag("select", array("class"=>"required", "values"=>$this->records_property_type_co),"commercial_property_type_id") ?>
           </div>
           <!-- /.controls --> 
          </div>
         
          
          <div class="location control-group">
           <label class="control-label"> City </label>
           <div class="controls">
            <? $this->htmlBuilder->buildTag("select", array("class"=>"required", "values"=>$this->records_city),"commercial_city_id") ?>
           </div>
           <!-- /.controls --> 
          </div>
          <div class="location control-group">
           <label class="control-label"> Area </label>
           <div class="controls">
            <? $this->htmlBuilder->buildTag("input", array("type"=>"text"), "commercial_area") ?>
           </div>
           <!-- /.controls --> 
          </div>
          
          <!-- /.control-group -->
          
          <div class="sale control-group">
           <div class="controls">
            <label class="control-label"> Min Price </label>
            <div class="controls">
             <select name="filter_price_from" name="commercial_min_price" id="commercial_min_price">
             <option value="5000">5,000</option>
             <option value="10000">10,000</option>
             <option value="25000">25,000</option>
             <option value="50000">50,000</option>
             <option value="75000">75,000</option>
             <option value="100000">1lac</option>
             <option value="500000">5 lacs</option>
             <option value="1000000">10 lacs</option>
             <option value="2000000">20 lacs</option>
             <option value="3000000">30 lacs</option>
             <option value="4000000">40 lacs</option>
             <option value="5000000">50 lacs</option>
             <option value="6000000">60 lacs</option>
             <option value="7000000">70 lacs</option>
             <option value="8000000">80 lacs</option>
             <option value="9000000">90 lacs</option>
             <option value="10000000">1crore</option>
             <option value="12000000">1.2 crores</option>
             <option value="14000000">1.4 crores</option>
             <option value="16000000">1.6 crores</option>
             <option value="18000000">1.8 crores</option>
             <option value="20000000">2 crores</option>
             <option value="23000000">2.3 crores</option>
             <option value="26000000">2.6 crores</option>
             <option value="30000000">3 crores</option>
             <option value="35000000">3.5 crores</option>
             <option value="40000000">4 crores</option>
             <option value="45000000">4.5 crores</option>
             <option value="50000000">5 crores</option>
             <option value="&gt;50000000">&gt;5 crores</option>
             </select>
            </div>
           </div>
           <!-- /.controls --> 
          </div>
          <div class="sale control-group">
           <div class="controls">
            <label class="control-label"> Max Price </label>
            <div class="controls">
             <select name="filter_price_from" name="commercial_max_price" id="commercial_max_price">
             <option value="5000">5,000</option>
             <option value="10000">10,000</option>
             <option value="25000">25,000</option>
             <option value="50000">50,000</option>
             <option value="75000">75,000</option>
             <option value="100000">1lac</option>
             <option value="500000">5 lacs</option>
             <option value="1000000">10 lacs</option>
             <option value="2000000">20 lacs</option>
             <option value="3000000">30 lacs</option>
             <option value="4000000">40 lacs</option>
             <option value="5000000">50 lacs</option>
             <option value="6000000">60 lacs</option>
             <option value="7000000">70 lacs</option>
             <option value="8000000">80 lacs</option>
             <option value="9000000">90 lacs</option>
             <option value="10000000">1crore</option>
             <option value="12000000">1.2 crores</option>
             <option value="14000000">1.4 crores</option>
             <option value="16000000">1.6 crores</option>
             <option value="18000000">1.8 crores</option>
             <option value="20000000">2 crores</option>
             <option value="23000000">2.3 crores</option>
             <option value="26000000">2.6 crores</option>
             <option value="30000000">3 crores</option>
             <option value="35000000">3.5 crores</option>
             <option value="40000000">4 crores</option>
             <option value="45000000">4.5 crores</option>
             <option value="50000000">5 crores</option>
             <option value="&gt;50000000">&gt;5 crores</option>
             </select>
            </div>
           </div>
           <!-- /.controls --> 
          </div>
          
          <!-- /.control-group -->
          
          <div class="form-actions">
           <button class="btn btn-primary btn-large">Filter now!</button>
          </div>
          <!-- /.form-actions -->
         </form>
        </div>
        <!-- /.tab-pane --> 
       </div>
      </div>
      <!-- /.content --> 
     </div>
     <!-- /.property-filter --> </div>
   </div>
  </div>
  <div id="map" class="map-inner" style="height: 750px"></div>
  <!-- /.map-inner -->
  
  <div class="container">
   <div class="row">
    <div class="span12">
     <div class="property-filter widget filter-horizontal" style="padding: 8px; margin-top:0px;">
      <div class="content">
       <form method="get" action="javascript:void(0);" class="form-inline map-filtering">
        <div class="property-types" style="height:1px !important; overflow: hidden; ">
         <div class="property-type apartment">
          <label for="filter_type_6">
           <input type="checkbox" name="filter_type[]" title="Apartment"
                                           id="filter_type_6" class="no-ezmark" value="6">
           Apartment </label>
         </div>
         <div class="property-type building-area ">
          <label for="filter_type_42">
           <input type="checkbox" name="filter_type[]" title="Building Area"
                                           id="filter_type_42" class="no-ezmark" value="42">
           Building Area </label>
         </div>
         <div class="property-type condo ">
          <label for="filter_type_43">
           <input type="checkbox" name="filter_type[]" title="Condo"
                                           id="filter_type_43" class="no-ezmark" value="43">
           Condo </label>
         </div>
         <div class="property-type cottage ">
          <label for="filter_type_44">
           <input type="checkbox" name="filter_type[]" title="Cottage"
                                           id="filter_type_44" class="no-ezmark" value="44">
           Cottage </label>
         </div>
         <div class="property-type family-house ">
          <label for="filter_type_41">
           <input type="checkbox" name="filter_type[]" title="Family House"
                                           id="filter_type_41" class="no-ezmark" value="41">
           Family House </label>
         </div>
         <div class="property-type single-home ">
          <label for="filter_type_40">
           <input type="checkbox" name="filter_type[]" title="Single Home"
                                           id="filter_type_40" class="no-ezmark" value="40">
           Single Home </label>
         </div>
         <div class="property-type villa ">
          <label for="filter_type_45">
           <input type="checkbox" name="filter_type[]" title="Villa"
                                           id="filter_type_45" class="no-ezmark" value="45">
           Villa </label>
         </div>
        </div>
        <!-- /.property-types --> 
        
        <!-- /.general -->
       </form>
      </div>
      <!-- /.content --> 
     </div>
     <!-- /.property-filter --> </div>
    <!-- /.span12 --> 
   </div>
   <!-- /.row --> 
  </div>
 </div>
 <!-- /.map --> 
</div>
