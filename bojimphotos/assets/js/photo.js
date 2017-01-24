$('.button_file').click(function(e){
	e.preventDefault();
	var value = $(this).data('file');

	$('.input_file').filter("[data-input='" + value + "']").click();
});
