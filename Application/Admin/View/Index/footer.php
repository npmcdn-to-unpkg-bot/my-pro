</div>

<!--end-main-container-part-->
<!--Footer-part-->

<div class="row-fluid">
	<div id="footer" class="span12"><?php echo $UUID;?></div>
 </div>

<!--end-Footer-part-->
 
<script src="__JS_RES__/Jquery/jquery.min.js"></script> 
<script src="__JS_RES__/Jquery/jquery.ui.custom.js"></script> 
<script src="__JS_RES__/Bootstrap/bootstrap.min.js"></script> 
<script src="__JS_RES__/Jquery/jquery.uniform.js"></script> 
<script src="__JS_RES__/Jquery/jquery.dataTables.min.js"></script> 
<script src="__JS_RES__/Matrix/matrix.js"></script> 
<script src="__JS_RES__/Matrix/matrix.tables.js"></script> 
 <switch name="PAGE_FROM">
 	<case value="Index">
	 	<script src="__JS_RES__/excanvas.min.js"></script> 
		<script src="__JS_RES__/Jquery/jquery.flot.min.js"></script> 
		<script src="__JS_RES__/Jquery/jquery.flot.resize.min.js"></script> 
		<script src="__JS_RES__/Jquery/jquery.peity.min.js"></script> 
		<script src="__JS_RES__/fullcalendar.min.js"></script> 
		<script src="__JS_RES__/Matrix/matrix.dashboard.js"></script> 
		<script src="__JS_RES__/Matrix/jquery.gritter.min.js"></script> 
		<script src="__JS_RES__/Matrix/matrix.interface.js"></script> 
		<script src="__JS_RES__/Matrix/matrix.chat.js"></script> 
		<script src="__JS_RES__/Jquery/jquery.validate.js"></script> 
		<script src="__JS_RES__/Matrix/matrix.form_validation.js"></script> 
		<script src="__JS_RES__/Jquery/Jquery.wizard.js"></script> 
		<script src="__JS_RES__/select2.min.js"></script> 
		<script src="__JS_RES__/Matrix/matrix.popover.js"></script> 
 	</case>
 	<case value="List">
 		<script src="__JS_RES__/select2.min.js"></script> 
		<script src="__JS_RES__/Matrix/matrix.interface.js"></script> 
		<script src="__JS_RES__/list-opration.js"></script> 
 	</case>
 	<case value="Add">
		<script src="__JS_RES__/Jquery/jquery.validate.js"></script> 
 		<script src="__JS_RES__/select2.min.js"></script> 
 		<script src="__JS_RES__/Matrix/matrix.form_validation.js"></script> 
 		<script src="__JS_RES__/Matrix/matrix.form_common.js"></script> 
		<script src="__JS_RES__/iconSelect.js"></script> 
 	</case>
 </switch>
 
 <if condition="$PAGE_FROM eq Index">
	 <script type="text/javascript">
	  // This function is called from the pop-up menus to transfer to
	  // a different page. Ignore if the value returned is a null string:
	  function goPage (newURL) {
	
	      // if url is empty, skip the menu dividers and reset the menu selection to default
	      if (newURL != "") {
	      
	          // if url is "-", it is this page -- reset the menu:
	          if (newURL == "-" ) {
	              resetMenu();            
	          } 
	          // else, send page to designated URL            
	          else {  
	            document.location.href = newURL;
	          }
	      }
	  }
	
	// resets the menu selection upon entry to this page:
	function resetMenu() {
	   document.gomenu.selector.selectedIndex = 2;
	}
	
	</script>
 </if>

</body>
</html>