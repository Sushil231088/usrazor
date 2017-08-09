// JavaScript Document
$(document).on('click', '.alert button', close_alert);

function close_alert() 
{
  $(".alert").hide();
}

$(document).ready(function() {
    $(".ddd").on("click", function () {

    var $button = $(this);
    var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

    if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }

    $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);

});
});
function delete_cart(id){
jConfirm('Are you sure to want to delete this item from shopping cart?', 'Confirmation Dialog', function(r) 
{
if(r == true){window.location.href='index.php?view=cart&act=delete&id='+id;}
});

}
function add_to_cart(product_id){

	var productX 		= jQuery('#image').offset().left;

	var productY 		= jQuery('#image').offset().top;

	

	var basketX 		= jQuery("#img_header_busket").offset().left;

	var basketY 		= jQuery("#img_header_busket").offset().top;

	

	var gotoX 			= basketX - productX;

	var gotoY 			= basketY - productY;	

	



	var quantity  = jQuery("#product_buy_quantity").val();

	var product_price_id  = jQuery("#product_price_id").val();

	

	//alert(quantity);

	

	var mod =quantity%1;

	

	if (quantity <= 0) 
	{
	var html_error='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><strong>Error! Product Quantity should not be negative or zero.</div>';	 
	$('#qty_msg').html(html_error);
	return false;
	}
	else if(isNaN(quantity))
	{
	var html_error='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><strong>Error! Product Quantity should not be Alphabet.</div>';	 	
	 $('#qty_msg').html(html_error);
	 return false;
	}
	else if(mod!=0)
	{
		 var html_error='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><strong>Error! Invalid Quantity.</div>';	 	
		 $('#qty_msg').html(html_error);
		 return false;
	}

		else

		{

		
var img = jQuery('#image');	
	var offset = img.offset();
	var flying_img = jQuery('#image').clone()
		
	.prependTo('#product_images')
	 .css("z-index", "10000") .css("position", "absolute").offset(img.offset())
	.animate({opacity: 0.8, marginLeft: gotoX, marginTop: gotoY, width: 20, height: 20}, 1000, function() {
		

	

		jQuery(this).remove();

		jQuery.ajax({

			url:'scripts/ajax/index.php',

			type:'post',

			dataType:'json',

			data:'method=add_to_cart&product_id='+product_id+'&quantity='+quantity+'&product_price_id='+product_price_id,

			success:function(data, textStatus, XMLHttpRequest){

			

				

					if(data.RESULT=="1"){
					
					$("#cart_top_count").html(data.CART_ITEMS);
					//$("#total_count").html(data.CART_ITEMS);
					$("#total_price").html(data.CART_TOTAL);
					
					var checkout_button='<a href="checkout.html">Checkout</a>';
					$("#check_button").html(checkout_button);
					
					var checkout_but='<a href="checkout.html" style="margin:5px 0px;"> Checkout </a>';
					$("#check_but").html(checkout_but);
					
					$("#total_top").html(data.CART_TOTAL);
					$("#cart_row").html(data.CART_BODY);
					//$("#cart_row").append(data.CART_BUTTONS);
					 var html_success='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><strong>Success! Successfully Added to cart.</div>';	 	
					$("#cart_response").html(html_success);
					$(".subtotal_menu").show();
				}
				else if(data.RESULT=="3")
				{
					 var html_success='<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><strong>Error! '+data.MSG+'.</div>';	 	
					$("#cart_response").html(html_success);
				}

					

				

			},

			error:function(XMLHttpRequest, textStatus, errorThrown){

				alert('Oops!! We are in a trouble. Definately not for you. Try refreshing the page again (ErroCode '+errorThrown+')');

			}

		})

	});

}

}
function update_cart(id){
	jConfirm('Are you Sure you want to update cart?', 'Confirmation Dialog', function(r) 
{
if(r == true){
	var product_quantity  = $('#qty_'+id).val();
	var unit_price  = $('#unit_price_'+id).val();
	var line_price  = $('#line_price_'+id).val();
	

	var mod =product_quantity%1;

	if (product_quantity <= 0) {
   		 alert('Product Quantity should not be negative or zero.');
		 
		}
		else if(isNaN(product_quantity))
		{
		 alert('Product Quantity should not be Alphabet.');
		}
		else if(product_quantity >10)
		{
		 alert('Product quantity should not greater then 10.');
		}
		else if(mod!=0)
		{
			 alert('Invalid Quantity');
		}
		else
		{
			
		window.location.href='index.php?view=cart&act=update&id='+id+'&product_quantity='+product_quantity+'&line_price='+line_price+'&unit_price='+unit_price;
		}
}
});
}


$(function() {
$("#submit_surbscriber").click(function() {
	

$('#submit_surbscriber').html('Sending');
var email = $("#newsletter_subscribe").val();
var atpos=email.indexOf("@");
var dotpos=email.lastIndexOf(".");
var dataString = 'method=newsletter_subscribe&email='+email;

if(email=='')
{
$('#submit_surbscriber').html('Submit');
$('.news_error').html('Email id should not be blank.');
$('.news_error').fadeOut(200).show();

}
else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
  {
$('#submit_surbscriber').html('Submit');
$('.news_error').fadeOut(200).show();
$('.news_error').html('Invalid Email Id .');
  }

else
{
$.ajax({
type: "POST",
url: "scripts/ajax/index.php",
data: dataString,
success: function(data){
			if(data=='1')
			{
				$('#submit_surbscriber').html('Submit');
				$('.news_error').html('Email id already subscribed.');
				$('.news_error').fadeOut(200).show();
				$('.news_success').fadeIn(200).hide();
			}
			else
			{
		$('#submit_surbscriber').html('Submit');
		$('.news_success').fadeIn(200).show();
		$('.news_error').fadeOut(200).hide();
			}
}
});
}
return false;
});
});


$(document).ready(function() {
   $("#search_form").submit(function() {
	   var keyword=$("#search").val();
	   if(keyword=='')
	   { 
		   $("#search").attr("placeholder","Please fill me first");
		   return false;
	   }
    window.location.href="index.php?view=search&keyword="+keyword;
	return false;
}); 
});

$(document).ready(function() {
   $("#search_button").click(function() {
	   var keyword=$("#search").val();
	   if(keyword=='')
	   {
		  $("#search").attr("placeholder","Please fill me first");
		   return false;
		   return false;
	   }
    window.location.href="index.php?view=search&keyword="+keyword;
	return false;
}); 
});



function load_products()
{
		$("#nomoredata").hide();
		var checked = $(".filter-elements input:checked").length > 0;
   			var chk_val = [];
				$(".filter-elements input:checked").each(function () {
				val_ck = $(this).val();
				chk_val.push(val_ck);
				});
				
				var cat=$("#searched_cat").val();
				var search_keyword=$("#searched_keyword").val();
				var dataString = 'method=load_searchproducts&brand_filter='+chk_val+'&cat='+cat+'&search_keyword='+search_keyword;
				
$("#loaderImg").html('<img src="images/ajax-loader.gif" id="spinner_image" />');
			$("#loaderImg").show();
				
				$.ajax({
					type: "POST",
					url: "scripts/ajax/index.php",
					data: dataString,
					dataType:'json',
					success: function(data){
					if(data.result=='1')
					{
			$("#loaderImg").hide();
					$("#product_rows").html(data.product_list);
					}
					
}
});
				
				
				
			
}




function get_state_list(country_id)
{
	$.ajax(
		{
			type: "POST",
			dataType: 'json',
			url: "scripts/ajax/index.php",
			data: "method=get_state_list&country_id="+country_id,
			success: function(data){
				$('#billing_state').find('option').remove().end();
				var newopt='<option value="">--Please Select --</option>';
				$('#billing_state').append(newopt);
				for(i=0; i<data.DATA.length; i++){
					//var newopt='<option value="'+data.DATA[i].id+'">'+data.DATA[i].city_name+'</option>';					
					if(data.DATA[i].id == $('#selected_id').val()){
						var newopt='<option value="'+data.DATA[i].id+'" selected="selected">'+data.DATA[i].name+'</option>';	
						
									
					}else{
						var newopt='<option value="'+data.DATA[i].id+'">'+data.DATA[i].name+'</option>';						
					}
					
					$.uniform.update("#billing_state");
					$('#billing_state').append(newopt);	
					
				}
			}
		}
	);	 
}


function get_state_list_chk(country_id)
{
	$.ajax(
		{
			type: "POST",
			dataType: 'json',
			url: "scripts/ajax/index.php",
			data: "method=get_state_list_chk&country_id="+country_id,
			success: function(data){
				$('#s_state').find('option').remove().end();
				var newopt='<option value="">--Please Select --</option>';
				$('#s_state').append(newopt);
				for(i=0; i<data.DATA.length; i++){
					//var newopt='<option value="'+data.DATA[i].id+'">'+data.DATA[i].city_name+'</option>';					
					if(data.DATA[i].id == $('#selected_id').val()){
						var newopt='<option value="'+data.DATA[i].id+'" selected="selected">'+data.DATA[i].name+'</option>';	
						
									
					}else{
						var newopt='<option value="'+data.DATA[i].id+'">'+data.DATA[i].name+'</option>';						
					}
					
					$.uniform.update("#s_state");
					$('#s_state').append(newopt);	
					
				}
			}
		}
	);	
}






