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
	$('.tags').tagsInput();

	
	/* Alert */
	// ====================================
	$(".alert-message").alert()
	
	
	/* Modal Window */
	// ====================================
	$('#my-modal').modal()


	/* Disable certain links in docs */
	// =============================
	  $('').click(function(e) {
	    e.preventDefault();
	  });
	

	/* Popover */
  	// =============================
        $("a[rel=popover]")
          .popover({
            offset: 10
          })
          .click(function(e) {
            e.preventDefault()
          })

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

	$('textarea.editor').wysihtml5({ 
		imagesUrl: 'sample_images.json',
		imageUpload: function(el) {
      var checkComplete, form;
      form = $(el).find('.image-upload-form');
      checkComplete = function() {
        var iframeContents, response, url;
        iframeContents = el.find('iframe').contents().find('body').text();
        if (iframeContents === "") {
          return setTimeout(checkComplete, 2000);
        } else {
          response = $.parseJSON(iframeContents);
          url = response[0].url;
          self.editor.composer.commands.exec("insertImage", url);
          $('div.progress.upload').remove();
          $('.bootstrap-wysihtml5-insert-image-modal').modal('hide');
          return form.find('.progress').hide();
        }
      };
      return form.on('change', function() {
        form.attr('target', 'upload-iframe').attr('action', '/assets');
        form.find('.progress').show();
        form.submit();
        return checkComplete();
      });
    }
	});


});