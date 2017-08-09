// JavaScript Document
$(document).ready(function() 
{
 $("#payment-address-new").click(function(){ if($("#payment-new-ship").is(':hidden')){$("#payment-new-ship").slideDown();}else{$("#payment-new").hide()}}) 
  $("#payment-address-existing").click(function(){ if($("#payment-new-ship").is(':visible')){$("#payment-new-ship").slideUp();}}) 
 
 $(".step-title").click(function() {
    var step_name=$(this).attr("data-block");
	var toggler_val=$("#"+step_name+"_input").val();
	//alert(step_name);
	if(toggler_val=="ok")
	{
		if($("#"+step_name).is(":visible"))
		{
			$("#"+step_name).slideUp();
			$(this).find("i").removeClass('fa-minus-circle').addClass('fa-plus-circle');
			var curr_li=$("#"+step_name).closest('li');
			var next_li=curr_li.next('li');
			var next_li_id=next_li.attr('id');
			var next_step_input=$("#"+next_li_id+" .step-title").attr("data-block");
			var next_step_val=$("#"+next_step_input+"_input").val('ok');
			
			curr_li.removeClass('section');
			curr_li.removeClass('allow');
			curr_li.removeClass('active');
			curr_li.addClass('sct');
			
			next_li.removeClass('sct');
			next_li.addClass('section');
			next_li.addClass('allow');
			next_li.addClass('active');
			
			if($("#"+next_step_input+"_input").val()=='ok')
			{
			next_li.find("i").removeClass('fa-plus-circle').addClass('fa-minus-circle');
			$("#"+next_step_input).slideDown();
			}
		}
		else
		{
			
			$(this).find("i").removeClass('fa-plus-circle').addClass('fa-minus-circle');
			var curr_li=$("#"+step_name).closest('li');
			
			$("#checkoutSteps li").re
			$("#checkoutSteps li").removeClass('section');
			$("#checkoutSteps li").removeClass('allow');
			$("#checkoutSteps li").removeClass('active');
			$("#checkoutSteps li").addClass('sct');
			$("#checkoutSteps li .checkout-content").hide();
			curr_li.removeClass('sct');
			curr_li.addClass('section');
			curr_li.addClass('allow');
			curr_li.addClass('active');
			
			$("#"+step_name).slideDown();
			
		}
		
	}
});
$("#button-step2").click(function() {
  
   
	$("#payment-address").removeClass("section"); 
	$("#payment-address").removeClass("allow");
	$("#payment-address").removeClass("active");
	$("#payment-address").addClass("sct");
	
	$("#shipping-address").removeClass("sct");
	$("#shipping-address").addClass("section"); 
	$("#shipping-address").addClass("allow");
	$("#shipping-address").addClass("active");
	 
	if(($('#step3').is(":hidden")));
	{
		$('#step2').slideUp();
		$('#step3').slideDown();
		$("#step2_icon").removeClass('fa-minus-circle').addClass('fa-plus-circle');
	
	}
	
	
});
	errors=[];
$("#button-payment-address").click(function() {

				$("#shipping_address input.req").each(function () 
				{	
					if($(this).val()=="") {
						$(this).css("border","1px  solid #ff0000"); 
						errors.push('1');
						}  
				});
	
			if (errors.length >0) 
			{
			return false; 
			}
			else
			{
			$("#shipping_address input").css("border","");
				
				$('#step3').slideUp();
				$('#step4').slideDown();
				$("#shipping-address").addClass("sct");
				$("#shipping-address").removeClass("section"); 
				$("#shipping-address").removeClass("allow");
				$("#shipping-address").removeClass("active");
				
				$("#payment-method").addClass("section"); 
				$("#payment-method").addClass("allow");
				$("#payment-method").addClass("active");
				$("#payment-method").removeClass("sct");
			}
			var tax=0;
			var grand_total=0;
			var state_val=$("#s_state").val();
			var subtot=$("#sub_total").val();
			
			if(state_val==3624)
			{
				tax=(subtot*8)/100;
				
				tax= tax.toFixed(2);
				
				grand_total=parseFloat($("#sub_total").val())+parseFloat(tax);
				
				
				$("#grandt").html(grand_total);
				$("#total_price_new").val(grand_total);
				$("#tax").val(tax);
				$("#tax_cali").html(tax);
				$("#note").html('Including Tax For California (8%)');
				
			}
			else
			{
				$("#grandt").html($("#sub_total").val());
				$("#tax").val(0);
				$("#total_price_new").val(subtot);
			}

	
});
$("#button-payment-method").click(function() {

				var method_val=$('input[name=payment_type]:radio:checked').val();
				
				
				$('#step4').slideUp();
				$('#step5').slideDown();
				$("#confirm").addClass("sct");
				$("#confirm").removeClass("section"); 
				$("#confirm").removeClass("allow");
				$("#confirm").removeClass("active");
				
				$("#payment-method").removeClass("section"); 
				$("#payment-method").removeClass("allow");
				$("#payment-method").removeClass("active");
				$("#payment-method").addClass("sct");
				if(method_val=='cheque')
				{
					$("#check_money").show();
				}
				else
				{
					$("#check_money").hide();
				}


			
});			
			
		

});
$(document).ready(function() {
	$('#shipping').click(function() {
       if($('#shipping').is(":checked"))
			 {
				 copyaddress();
			 }
			 else
			 {
				 copyaddress();
			 }  
    });

 });
$(document).ready(function() {
 $("#fgpass").click(function() {
  $("#loginform").hide('slow'); 
  $("#fgpass_form").show('slow'); 
  return false; 
});

$("#bklogin").click(function() {
 
  $("#fgpass_form").hide('slow');
   $("#loginform").show('slow'); 
   return false; 
});
});

function copyaddress()

{

	var chk=$('#shipping').is(":checked");
	if($('#shipping').is(":checked")){
	var b_firstname=$('#b_firstname').val();
	var b_address1=$('#b_address1').val();
	var b_address2=$('#b_address2').val();
	var b_city=$('#b_city').val();
	var b_state=$('#b_state').val();
	var b_zipcode=$('#b_zipcode').val();
	var b_phone1=$('#b_phone1').val();
	var b_email=$('#b_email').val();
	$('#s_firstname').val(b_firstname);
	$('#s_address1').val(b_address1);
	$('#s_address2').val(b_address2);
	$('#s_city').val(b_city);
	$('#s_state').val(b_state);
	$.uniform.update("#s_state");
	$('#s_zipcode').val(b_zipcode);
	$('#s_phone1').val(b_phone1);
	$('#s_email').val(b_email);
	}
	else{
		
		$('#s_firstname').val('');
		$('#s_address1').val('');
		$('#s_address2').val('');
		$('#s_city').val('');
		$('#s_state').val('');
		$('#s_zipcode').val('');
		$('#s_phone1').val('');
		$('#s_email').val('');

	}
	
}