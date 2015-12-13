 function toggle_visibility(id) {
	var e = document.getElementById(id);
	if(e.style.display == 'block')
		e.style.display = 'none';
	 else
		e.style.display = 'block';
}
 //Date picker modal
 $(function()
 {
	 $( "#datepicker" ).datepicker({
		 changeMonth: true,
		 changeYear: true,
		 dateFormat:'dd-mm-yy',
	 });
 });