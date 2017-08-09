<?
			if(isset($authUrl))
		    { 
   			$g_content = "<a href=\"$authUrl\"><img src=\"images/google_icon.png\"></a>";
			}
			
			if($g_content['email']!="<")
			{
				
				if($g_content['email']=='')
				{
				$this->redirect("index.php?view=login");
						
				}
				else
				{
					$this->redirect("index.php?view=do_login&act=google_register&email=".urlencode($g_content['email'])."&name=".urlencode($g_content['name'])."");
				}
			
			
			}
			else
			{
			print_r($g_content);
			}
				
			
			
			
			
?>