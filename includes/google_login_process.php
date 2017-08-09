<?
			if(isset($authUrl))
		    { 
   			 $g_content = "<a href='$authUrl'><img src=\"layout/images/google_icon.png\"></a>";
			 
			   $g_content = "<button class=\"btn-social btn-google\" onclick=\"window.location.href='$authUrl'\"  type=\"button\" id=\"google-login-button\">Sign in with Google</button>";
  			}
			
			if($g_content['email']!="<")
			{
				
				if($g_content['email']=='')
				{
				$this->redirect("index.php?view=login");
						
				}
				else
				{
					$this->redirect("index.php?view=do_login&act=google_register&email=".urlencode($g_content['email'])."&name=".urlencode($g_content['name'])."&picture=".urlencode($g_content['picture'])."");
					
				}
			
			
			}
			else
			{
			print_r($g_content);
			}
				
			
			
			
			
?>