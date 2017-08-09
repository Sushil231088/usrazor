

function lookup(inputString) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {

$.ajax({
type: "POST",
url: "scripts/ajax/index.php",
data:'method=show_suggessions&queryString='+inputString,
dataType:'json',
success: function(data){
$('#suggestions').fadeIn(); // Show the suggestions box
$('#suggestions').html('<p id="searchresults">'+data.SUGG+'</p>'); // Fill the suggestions box
			
}
});
		
		
		
	}
}