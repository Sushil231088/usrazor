<?php
/**
 * Magento.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 *
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Fulltext Collection.
 *
 * @category    Mage
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Autocompleteplus_Autosuggest_Model_Resource_Fulltext_Collection extends Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
{
    protected $list_ids = array();
    protected $is_fulltext_enabled = false;

    protected $is_layered_enabled = false;

    public function __construct($resource = null, array $args = array())
    {
        $layered = Mage::getStoreConfig('autocompleteplus/config/layered');
        if (isset($layered) && $layered == '1') {
            $this->is_layered_enabled = true;
        }
        parent::__construct($resource, $args);
    }

    /**
     * Retrieve query model object.
     *
     * @return Mage_CatalogSearch_Model_Query
     */
    protected function _getQuery()
    {
        if (!$this->is_layered_enabled) {
            return Mage::helper('catalogsearch')->getQuery();
        }

        return false;
    }

    /* compatibility with GoMage extension */
    public function getSearchedEntityIds()
    {
        return $this->list_ids;
    }

    protected function getSession()
    {
        return Mage::getSingleton('core/session');
    }

    public function clearSessionData()
    {
        $this->getSession()->unsIsFullTextEnable();
        $this->getSession()->unsIspSearchAlternatives();
        $this->getSession()->unsIspSearchResultsFor();

        return $this;
    }

    public function setSessionData($responseObj, $query)
    {
  // InstantSearch+ js file will be injected to the search result page
        $this->getSession()->setIsFullTextEnable(true);
        // recording the query for the current 'core/session' to check it when injecting the magento_full_text.js
       $this->getSession()->setIspUrlEncodeQuery(urlencode($query));

        if (array_key_exists('alternatives', $responseObj) && $responseObj->alternatives) {
            $this->getSession()->setIspSearchAlternatives($responseObj->alternatives);
        } else {
            $this->getSession()->setIspSearchAlternatives(false);
        }

        if (array_key_exists('results_for', $responseObj) && $responseObj->results_for) {
            $this->getSession()->setIspSearchResultsFor($responseObj->results_for);
        } else {
            $this->getSession()->setIspSearchResultsFor(false);
        }
 
         }

    public function prepareDefaultQuery()
    {
      //adding if fulltext search disabled then write regular flow
        Mage::getSingleton('catalogsearch/fulltext')->prepareResult();

        $this->getSelect()->joinInner(
            array('search_result' => $this->getTable('catalogsearch/result')),
            $this->getConnection()->quoteInto(
                'search_result.product_id=e.entity_id AND search_result.query_id=?',
                $this->_getQuery()->getId()
            ),
            array('relevance' => 'relevance')
        );

            }

    /**
     * Add search query filter.
     *
     * @param string $query
     *
     * @return Mage_CatalogSearch_Model_Resource_Fulltext_Collection
     */
    public function addSearchFilter($query)
    {
        if (!$this->is_layered_enabled) {
            $helper = Mage::helper('autocompleteplus_autosuggest');
            $config = Mage::getModel('autocompleteplus_autosuggest/config');
            $key = $config->getUUID();
            $storeId = Mage::app()->getStore()->getStoreId();
            $server_end_point = $helper->getServerEndPoint();

            $url_domain = $server_end_point ? $server_end_point.'/ma_search' : 'http://magento.instantsearchplus.com/ma_search';
           
            $extension_version = Mage::helper('autocompleteplus_autosuggest')->getVersion();
            $site_url = $helper->getConfigDataByFullPath('web/unsecure/base_url');
            $url = $url_domain.'?q='.urlencode($query).'&p=1&products_per_page=1000&v='.$extension_version.'&store_id='.$storeId.'&UUID='.$key.'&h='.$site_url;
            $resp = $helper->sendCurl($url);
             $array_query=explode(' ',$query);
             
              $k=-1;
              $match=0;
               $write_connection = Mage::getSingleton('core/resource')->getConnection('core_write'); 
             $entities=array(); 
             $connection =  Mage::getSingleton('core/resource')->getConnection('core_read');
             $names=$connection->query("SELECT entity_id FROM `catalog_product_entity_varchar` WHERE UPPER(value) = UPPER('$query') LIMIT 1");
             while($name =$names->fetch())
             {
             $k=-3;
             $nam[]= $name['entity_id'];
             }
                     $j=0;
       for($i=0;$i<count($array_query);$i++)
  {
if(is_numeric($array_query[$i]))
{

$j++;
}

}
if($j>0)
{
$k=-2;

 $product_title=$connection->query("SELECT value,value_id FROM `catalog_product_entity_varchar`");
 
 if(count($array_query)>=9)
 {
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
   $title_id=$title['value_id'];
  
   $titles=strtolower($titles);
  $query=strtolower($query);
   $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  
  
  
  $pct= $intersect/ count($query_split) ;
  
  //$levDis = levenshtein($titles,$query);
  //echo $levDis;
 //$bigger = max(strlen($titles), strlen($query));
// $pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
   //similar_text($titles, $query, $percent);
   if($pct>=0.8 && $pct <= 1)
   {
   $compare[$title_id]=$pct;
   
   }
 }
 }
 else if(count($array_query)> 5)
 {
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
   $title_id=$title['value_id'];
  
   $titles=strtolower($titles);
  $query=strtolower($query);
   $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  
  
  
  $pct= $intersect/ count($query_split) ;
  
  //$levDis = levenshtein($titles,$query);
  //echo $levDis;
 //$bigger = max(strlen($titles), strlen($query));
// $pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
   //similar_text($titles, $query, $percent);
   if($pct>=0.5 && $pct <= 1)
   {
   $compare[$title_id]=$pct;
   
   }
 }
 }
 else
 {
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
   $title_id=$title['value_id'];
  
  $titles=strtolower($titles);
  $query=strtolower($query);
  $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  
  
  
  $pct= $intersect/ count($query_split) ;
 // echo $pct."<br>";
  
  
 // $levDis = levenshtein($titles,$query);
  //echo $levDis;
 //$bigger = max(strlen($titles), strlen($query));
 // $pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
   //similar_text($titles, $query, $percent);
   if($pct>=0.5 && $pct <= 1)
   {
   $compare[$title_id]=$pct;
   
   }
 }
 }
 
 //print_r($compare)."<br>";
 arsort($compare); 
 
 //print_r("----------------------");
 //print_r($compare)."<br>";
  //print_r($compare)."<br>";
 
 $keys=array_keys($compare);;
 $values=array_values($compare);
 //print_r($values[0]);
  //print_r($keys);
  //print_r($values[0])."<br>";
 //print_r($values[1])."<br>";
 //print_r($values[2])."<br>";
  $m=0;
 for($l=0;$l<count($keys);$l++)
 {
 
   $product_search=$connection->query("SELECT entity_id FROM `catalog_product_entity_varchar` WHERE value_id= $keys[$l]");
   while($search= $product_search->fetch())
   {
        
    $searches[]=$search['entity_id'];
   // echo $values[$l]."<br>";

 $product_match=$connection->query("SELECT percentage FROM `catalog_product_entity` WHERE entity_id= $search[entity_id] ");
 
 while($match=$product_match->fetch())
 {
 	if($values[$l] <= 1)
 	{

 	
    $update= "UPDATE `catalog_product_entity` SET `percentage`= $values[$l] WHERE entity_id='".$search['entity_id']."' ";
 //echo $update;
//$where = $write_connection ->quoteInto('entity_id =?', $search['entity_id']);
$write_connection->query($update);
	  
    }
    
 }
 
    //echo $keys[$l]."<br>";
    //echo $search['entity_id']."<br>";
   // echo "UPDATE `catalog_product_entity`SET `matching`=$keys[$l] WHERE entity_id='".$search['entity_id']."' ";
    //$connection->update("UPDATE `catalog_product_entity`SET `matching`=$keys[$l] WHERE entity_id='".$search['entity_id']."' "); 
   //$connection->update("catalog_product_entity",array("matching" => $keys[$l]),"entity_id='".$search['entity_id']."' " );
    // print_r($searches);
   // echo $this->getSelect()->where('e.entity_id = $searches[$m]'); 
    ++$m;
    }
 }

//$idStr=$searches;

 $idStr = (count($searches) > 0) ? implode(',', $searches) : '0';
 //print_r($idStr);

    //echo $this->getSelect();
    //echo "SELECT entity_id FROM `catalog_product_entity_varchar` WHERE e.entity_id IN ('.$idStr.')";
    // $products=$connection->query("SELECT entity_id FROM `catalog_product_entity_varchar` WHERE e.entity_id IN ('.$idStr.')");
      $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
     $this->getSelect()->order(array('e.percentage DESC'));
   
}

            
            if($j==0)
             {
             if($k!=-3)
             {
             
              if(count($array_query)>=1 && count($array_query)<=6 )
              {    
            
              $k++;
                
               for($i=0;$i<count($array_query); $i++)
{
  $l=0;
  
            if(is_numeric($array_query[$i])|| $array_query[$i]==" ")
          {
          
          continue;
          }
            
            if(!is_numeric($array_query[$i]))
            {
            
            $sql=$connection->query("SELECT value, entity_id FROM `catalog_category_entity_varchar` WHERE 1 ");
            
             while ($row = $sql->fetch() ) {
            similar_text($array_query[$i],$row['value'],$percent);
          
         
          
           if($percent >= 80)
            {
       $l++;
            $parent=$connection->query("SELECT parent_id FROM `catalog_category_entity` WHERE `entity_id` = '$row[entity_id]' LIMIT 1");
            while($parents = $parent->fetch())
            {
            $pids= $parents['parent_id'];
              $category=$connection->query("SELECT product_id FROM `catalog_category_product` WHERE `category_id` ='$row[entity_id]'");  
                  
             while($ids= $category->fetch())
             {
            if($pids==2)
            {
             $product_ids[] = $ids['product_id'];
             
            } 
            if($pids!=2)
            {
            $k++;
            //unset($product_subcategory_ids);
            $product_subcategory_ids[]=$ids['product_id'];
             }
             }
             }
             
             break;
             }
           
        }
         
}
                  if($l==0)
                  {
                  $sql=$connection->query("SELECT entity_id FROM `catalog_category_entity_varchar` WHERE UPPER('$array_query[$i]') LIKE CONCAT(UPPER(SUBSTRING_INDEX(value, ' ', 1)),'%')");
         
          if(count($sql)>0)
          {
          while($rows=$sql->fetch())
          {
          
            $parent=$connection->query("SELECT parent_id FROM `catalog_category_entity` WHERE `entity_id` = '$rows[entity_id]' LIMIT 1");
            // echo $parent->fetch()['parent_id'];
           // echo "SELECT parent_id FROM `catalog_category_entity` WHERE `entity_id` = '$row[entity_id]' LIMIT 1";
            while($parents = $parent->fetch())
            {
            $pids= $parents['parent_id'];
              $category=$connection->query("SELECT product_id FROM `catalog_category_product` WHERE `category_id` ='$rows[entity_id]'");  
                  
             while($ids= $category->fetch())
             {
            if($pids==2)
            {
             $product_ids[] = $ids['product_id'];
             
            } 
            if($pids!=2)
            {
            $k++;
            $product_subcategory_ids[]=$ids['product_id'];
             }
             }
             }
          }
          }
          else
          {
          
          }
          
         //echo count($product_ids);
         // echo count($product_subcategory_ids);
               break;
                  }
}


}

if(count($product_ids)==0 && count($product_subcategory_ids)==0)
{
  // echo $query;
 $product_title=$connection->query("SELECT value,value_id FROM `catalog_product_entity_varchar`");
 
 if(count($array_query)> 5)
 {
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
   $title_id=$title['value_id'];
   
    $titles=strtolower($titles);
  $query=strtolower($query);
  
    $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  $pct= $intersect/ count($query_split) ;
 // $levDis = levenshtein($titles,$query);
  //echo $levDis;
 //$bigger = max(strlen($titles), strlen($query));
 //$pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
   //similar_text($titles, $query, $percent);
   if($pct>=0.8 && $pct <= 1)
   {
   $compare[$title_id]=$pct;
   
   }
 }
 }
 else
 {
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
  // echo $titles;
   $title_id=$title['value_id'];
  
   $titles=strtolower($titles);
  $query=strtolower($query);
    $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  $pct= $intersect/ count($query_split) ;
  //$levDis = levenshtein($titles,$query);
  //echo "LOL";
 //$bigger = max(strlen($titles), strlen($query));
 //$pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
 //echo $pct."<br>";
   //similar_text($titles, $query, $percent);
   if($pct>=0.8 && $pct <= 1)
   {
   $compare[$title_id]=$pct;
   
   }
 }
 }
 

 arsort($compare); 
 
 // print_r($compare)."<br>";
 
 $keys=array_keys($compare);;
 $values=array_values($compare);
 //print_r($values[0]);
// print_r($keys);
  //print_r($values[0])."<br>";
 //print_r($values[1])."<br>";
 //print_r($values[2])."<br>";
  $m=0;
 for($l=0;$l<count($keys);$l++)
 {
 
   $product_search=$connection->query("SELECT entity_id FROM `catalog_product_entity_varchar` WHERE value_id= $keys[$l]");
   while($search= $product_search->fetch())
   {
        
    $searches[]=$search['entity_id'];
   // echo $values[$l]."<br>";

 $product_match=$connection->query("SELECT percentage FROM `catalog_product_entity` WHERE entity_id= $search[entity_id] ");
 
 while($match=$product_match->fetch())
 {
 	if($values[$l] <= 1)
 	{

 	
   
    $update= "UPDATE `catalog_product_entity` SET `percentage`= $values[$l] WHERE entity_id='".$search['entity_id']."' ";
 //echo $update;
//$where = $write_connection ->quoteInto('entity_id =?', $search['entity_id']);
$write_connection->query($update);
	 
    }
    
 }
 
    //echo $keys[$l]."<br>";
    //echo $search['entity_id']."<br>";
   // echo "UPDATE `catalog_product_entity`SET `matching`=$keys[$l] WHERE entity_id='".$search['entity_id']."' ";
    //$connection->update("UPDATE `catalog_product_entity`SET `matching`=$keys[$l] WHERE entity_id='".$search['entity_id']."' "); 
   //$connection->update("catalog_product_entity",array("matching" => $keys[$l]),"entity_id='".$search['entity_id']."' " );
    // print_r($searches);
   // echo $this->getSelect()->where('e.entity_id = $searches[$m]'); 
    ++$m;
    }
 }

//$idStr=$searches;

 $idStr = (count($searches) > 0) ? implode(',', $searches) : '0';
// print_r($idStr);

    //echo $this->getSelect();
    //echo "SELECT entity_id FROM `catalog_product_entity_varchar` WHERE e.entity_id IN ('.$idStr.')";
    // $products=$connection->query("SELECT entity_id FROM `catalog_product_entity_varchar` WHERE e.entity_id IN ('.$idStr.')");
     $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
   $this->getSelect()->order(array('e.percentage DESC'));
  
}        


else if(count($array_query) > 6)
{
$k=-2;

 $product_title=$connection->query("SELECT value,value_id FROM `catalog_product_entity_varchar`");
 
 if(count($array_query)>=9)
 {
 //echo "LOL";
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
   $title_id=$title['value_id'];
  
   $titles=strtolower($titles);
  $query=strtolower($query);
  //echo "LOL";
    $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  
  $pct= $intersect/ count($query_split) ;
  //$levDis = levenshtein($titles,$query);
  //echo $levDis;
 //$bigger = max(strlen($titles), strlen($query));
 ///$pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
   //similar_text($titles, $query, $percent);
   
   if($pct>=0.8 && $pct<=1)
   {
   $compare[$title_id]=$pct;
   }
 }
 }
 
  else
 {
 while($title = $product_title->fetch())
 {
   $titles=$title['value'];
   $title_id=$title['value_id'];
  
   $titles=strtolower($titles);
  $query=strtolower($query);
    $intersect=0;
  //$titles=metaphone($titles);
  //$query=metaphone($query);
  
  $titles_split=explode(" ",$titles);
  $query_split=explode(" ",$query);
  
  for($i=0;$i<count($titles_split);$i++)
  {
  for($j=0;$j<count($query_split);$j++)
  {
   similar_text($query_split[$j],$titles_split[$i],$percent);
   if($percent>=80)
   {
      $intersect++;
   }
  }
  }
  
  $pct= $intersect/ count($query_split) ;
  //$levDis = levenshtein($titles,$query);
  //0. $levDis;
 //$bigger = max(strlen($titles), strlen($query));
 //$pct = ($bigger - $levDis) / $bigger;
 //echo $pct."   ";
   //similar_text($titles, $query, $percent);
   
   if($pct>=0.8 && $pct<=1)
   {
   $compare[$title_id]=$pct;
   }
 }
 }
 arsort($compare); 
 //print_r($compare)."<br>";
 
 $keys=array_keys($compare);
 $values=array_keys($compare);
  //print_r($keys);
  $m=0;
 for($l=0;$l<count($keys);$l++)
 {
 
   $product_search=$connection->query("SELECT entity_id FROM `catalog_product_entity_varchar` WHERE value_id= $keys[$l]");
    //$update= "UPDATE `catalog_product_entity` SET `percentage`= $values[$l] WHERE entity_id='".$search['entity_id']."' ";
 //echo $update;
//$where = $write_connection ->quoteInto('entity_id =?', $search['entity_id']);
//$write_connection->query($update);
     while($search= $product_search->fetch())
   {
        
    $searches[]=$search['entity_id'];
   // echo $values[$l]."<br>";

 $product_match=$connection->query("SELECT percentage FROM `catalog_product_entity` WHERE entity_id= $search[entity_id] ");
 
 while($match=$product_match->fetch())
 {
 	if($values[$l] <= 1)
 	{

 	
   
    $update= "UPDATE `catalog_product_entity` SET `percentage`= $values[$l] WHERE entity_id='".$search['entity_id']."' ";
 //echo $update;
//$where = $write_connection ->quoteInto('entity_id =?', $search['entity_id']);
$write_connection->query($update);
	 
    }
    
 }

 }

 $idStr = (count($searches) > 0) ? implode(',', $searches) : '0';
   $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
  $this->getSelect()->order(array('e.percentage DESC'));
  
}
}
}



 
 
if($k==-3)
{
 $idStr = $nam[0];
  $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
 //echo $idStr;
}
 if($k==0)
       {
  $idStr = (count($product_ids) > 0) ? implode(',', $product_ids) : '0';
   $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
  }
  if($k>0)
  {
  $idStr = (count($product_subcategory_ids) > 0) ? implode(',', $product_subcategory_ids) : '0';
   $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
  }
                         

          
           
            
           /* $response_json = json_decode($resp);
            $enabledFulltext = array_key_exists('fulltext_disabled', $response_json) ? !$response_json->fulltext_disabled : false;

            if ($enabledFulltext) {
                $enabledFulltext = ((array_key_exists('id_list', $response_json)) &&
                    (array_key_exists('total_results', $response_json))) ? true : false;
            }


            $this->clearSessionData();

            if (!$enabledFulltext) {
                Mage::getSingleton('core/session')->setIsFullTextEnable(false);

                $this->prepareDefaultQuery();
            } */

            /*if ($enabledFulltext) {
                $this->is_fulltext_enabled = true;
                $this->setSessionData($response_json, $query);

                if ($response_json->total_results) {
                    $id_list = $response_json->id_list;
                    $product_ids = array();
                    //validate received ids
                    foreach ($id_list as $id) {
                        if ($id != null && is_numeric($id)) {
                            $product_ids[] = $id;
                        }
                    }
                    $this->list_ids = $product_ids;
                   // print_r($product_ids);
                    $idStr = (count($product_ids) > 0) ? implode(',', $product_ids) : '0';
                   // echo $idStr;
                } else {
                    $idStr = '0';
                }

                /*if (array_key_exists('server_endpoint', $response_json)) {
                    if ($server_end_point != $response_json->server_endpoint) {
                        $helper->setServerEndPoint($response_json->server_endpoint);
                    }
                }

                 $this->getSelect()->where('e.entity_id IN ('.$idStr.')');
            }*/
        }
}
        return $this;
    }

    /**
     * Set Order field.
     *
     * @param string $attribute
     * @param string $dir
     *
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    public function setOrder($attribute, $dir = parent::SORT_ORDER_ASC)
    {
        if (!$this->is_layered_enabled) {
            if ($this->is_fulltext_enabled && $attribute == 'relevance') {
                $dir = parent::SORT_ORDER_ASC;
                $id_str = (count($this->list_ids) > 0) ? implode(',', $this->list_ids) : '0';
                if (!empty($id_str)) {
                    $sort = "FIELD(e.entity_id, {$id_str}) {$dir}";
                    $this->getSelect()->order(new Zend_Db_Expr($sort));
                }
            } else {
                return parent::setOrder($attribute, $dir);
            }
        }

        return $this;
    }

    /**
     * Stub method for campatibility with other search engines.
     *
     * @return Mage_CatalogSearch_Model_Resource_Fulltext_Collection
     */
    public function setGeneralDefaultQuery()
    {
        return $this;
    }
}
