$('.button_file').click(function(e){
	e.preventDefault();
	var value = $(this).data('file');

	$('.input_file').filter("[data-input='" + value + "']").click();
});

$(document).ready(function(){

	var authFormats = ["png", "gif", "jpg", "jpeg", "pdf"];

	$('.input_file').on('change', function(){ //on file input change
		var value = $(this).data('input');

		if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
		{
			$('#thumb-output' + value).html(''); //clear html of output element
			var data = $(this)[0].files; //this file data
			$.each(data, function(index, file){ //loop though each file

				var extension = file.name.split('.')[1].toLowerCase();

				if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
					var fRead = new FileReader(); //new filereader
					fRead.onload = (function(file){ //trigger function on successful read
					return function(e) {
						var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
						$('#thumb-output' + value).append(img); //append image to output element
					};
					})(file);
					fRead.readAsDataURL(file); //URL representing the file's data.
				} else if (authFormats.indexOf(extension) == "-1") {
					var img = $('<img/>').addClass('thumb').attr('src', 'assets/img/format.jpg'); //create image element
					$('#thumb-output' + value).append(img);
				}else {
					var img = $('<img/>').addClass('thumb').attr('src', 'assets/img/documents.png'); //create image element
					$('#thumb-output' + value).append(img);
				}
				// RAJOUTER UN ELSEIF
				// 	SI PAS DANS LA LISTE DE FICHIER AUTORISE
				// 	METTRE UN PICTO INTERDIT
			});

		}else{
			alert("Your browser doesn't support File API!"); //if File API is absent
		}
	});
});
