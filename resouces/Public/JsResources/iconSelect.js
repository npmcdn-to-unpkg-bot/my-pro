/**
 * 
 */
$("#myIcons li").click(function(){
	$("#selectedI").attr("class" , "fa "+$(this).text());
	$("#icon").attr("value" ,$(this).text());
});