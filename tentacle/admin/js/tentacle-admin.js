$(document).ready(function(){

    //Minimize Content Box
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
		
	//Admin Tabs:
	// ====================================
		$(function () {
			$('.tabs').tabs()
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


	/* jQuery validation settings */
	// validate signup form on keyup and submit
	// ====================================
	$("form#validation").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				email: true
			},
			agree: "required"
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
			agree: "Please accept our policy"
		}
	});
	
	/* User Edit page */
	// ====================================
	$("form#edit").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: false,
				minlength: 5
			},
			confirm_password: {
				required: false,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				email: true
			}
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
			agree: "Please accept our policy"
		}
	});
	
	/*  Tags in input fields */
		$('.tags').tagsInput();
	
	
	/* Dropdown for topbar nav */
	// ====================================
	     $('#topbar').dropdown()


	/* Modal Window */
	// ====================================
	$('#my-modal').modal()


  /* Disable certain links in docs */
  // =============================
	  $('').click(function(e) {
	    e.preventDefault();
	  });
	
	/* Tooltips */
  	// =============================
        $("a[rel=twipsy]").twipsy({
          live: true
        })

	/* Popover */
  	// =============================
        $("a[rel=popover]")
          .popover({
            offset: 10
          })
          .click(function(e) {
            e.preventDefault()
          })

});