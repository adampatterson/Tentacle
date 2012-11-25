$(document).ready(function(){
	
	
    // Minimize Content Box
	// ====================================
		$(".content-box-header h3").css({ "cursor":"s-resize" }); // Give the h3 in Content Box Header a different cursor
		$(".closed-box .content-box-content").hide(); // Hide the content of the header if it has the class "closed"
		$(".closed-box .content-box-tabs").hide(); // Hide the tabs in the header if it has the class "closed"
		
		$(".content-box-header h3").click( // When the h3 is clicked...
			function () {
			  $(this).parent().next().toggle(); // Toggle the Content Box
			  $(this).parent().parent().toggleClass("closed-box"); // Toggle the class "closed-box" on the content box
			  $(this).parent().find(".content-box-tabs").toggle(); // Toggle the tabs
			}
		);

	// Admin Tabs:
	// ====================================
		$('#content-tabs a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		})

    //Close button:
	// ====================================
		$(".close").click(
			function () {
				$(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
					$(this).slideUp(400);
				});
				return false;
			}
		);

    // Alternating table rows:
	// ====================================
		$('tbody tr:even').addClass("even"); // Add class "alt-row" to even table rows

    // Check all checkboxes when the one in a table head is checked:
	// ====================================
		$('.check-all').click(
			function(){
				$(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));   
			}
		);

	/* Username Lookup */
	// ====================================

	
	/* Tags */
	// ====================================
	if ($('body').hasClass('tags')) {
		$('.tags').tagsInput();
	}
	
	/* Alert */
	// ====================================
	if ($('body').hasClass('alert-message')) {
		$(".alert-message").alert();
	}
	
	/* Modal Window */
	// ====================================
	if ($('body').hasClass('alert-message')) {
		$('#my-modal').modal()
	}



	/* Publish on */
  	// =============================

	$(".published-on").hide();

	$("#publish").change(function(){          
	    var value = $("#publish option:selected").val();

	    if( value == 'published-on') {
	        $(".published-on").show();
	    } else {
	        $(".published-on").hide();
	    }
	});
	
	$("a#edit_publish").click(function(){          
	    var value = $("#publish option:selected").val();

	    if( value == 'published-on') {
	        $(".published-on").show();
	    } else {
	        $(".published-on").hide();
	    }
	});
	
	$(".published-on").hide();
	$("#edit_publish").show();
 
    $('#edit_publish').click(function(){
	    $(".published-on").toggle();
	})

	
	//
	// File Upload
	//
	var dropbox = $('#dropbox'),
		message = $('.message', dropbox);
	
	console.log(base_url+'action/add_file/');
	
	dropbox.filedrop({
		// The name of the $_FILES entry:
		paramname:'pic',
		
		maxfiles: cms_maxfiles,
    	maxfilesize: cms_maxfilesize,
		url: base_url+'action/add_file/',

		uploadFinished:function(i,file,response){	
			$.data(file).addClass('done');
			console.log(response);
			//window.location = base_url+response;
			// response is the JSON object that post_file.php returns
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Your browser does not support HTML5 file uploads!');
					break;
				case 'TooManyFiles':
					alert('Too many files! Please select 5 at most!');
					break;
				case 'FileTooLarge':
					alert(file.name+' is too large! Please upload files up to 2mb (configurable).');
					break;
				default:
					break;
			}
		},
		
		// Called before each upload is started
		beforeEach: function(file){
			if(!file.type.match(/^image\//)){
				alert('Only images are allowed!');
				
				// Returning false will cause the
				// file to be rejected
				return false;
			}
		},
		
		uploadStarted:function(i, file, len){
			createImage(file);
		},
		
		progressUpdated: function(i, file, progress) {
			var new_progress = progress+'%';
			$.data(file).find('.progress_bar').width(new_progress);
		}
    	 
	});
	
	var template = '<div class="preview">'+
						'<span class="imageHolder">'+
							'<img />'+
							'<span class="uploaded"></span>'+
						'</span>'+
						'<div class="progressHolder">'+
							'<div class="progress_bar"></div>'+
						'</div>'+
					'</div>'; 
	
	
	function createImage(file){

		var preview = $(template), 
			image = $('img', preview);
			
		var reader = new FileReader();
		
		image.width = 100;
		image.height = 100;
		
		reader.onload = function(e){
			
			// e.target.result holds the DataURL which
			// can be used as a source of the image:
			
			image.attr('src',e.target.result);
		};
		
		// Reading the file as a DataURL. When finished,
		// this will trigger the onload function above:
		reader.readAsDataURL(file);
		
		message.hide();
		preview.appendTo(dropbox);
		
		// Associating a preview container
		// with the file, using jQuery's $.data():
		
		$.data(file,preview);
	}

	function showMessage(msg){
		message.html(msg);
	}

});