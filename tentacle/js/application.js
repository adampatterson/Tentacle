$(document).ready(function(){

  if ($('body').hasClass('login')){
    setFocus();
  }

  template();

  if ($('body').hasClass('content_add_post') || $('body').hasClass('content_update_post')){
    publishedOn();
  }

  if ($('body').hasClass('dashboard')) {
    dashboardFeed();
    sparkline();
  }

  if ($('body').hasClass('admin')) {
    $('#username').keyup(usernameCheck);

    $('#useremail').keyup(useremailCheck);

    $('#permalink').keyup(permalinkCheck);
  }

  if ($('body').hasClass('content_order_page')) {
    $('#nestableMenu').nestable({
      group: 1
    })
        .on( 'change', update_output) ;
  }

});


function update_output(e)
{
  var list   = e.length ? e : $(e.target),
      output = list.data('output');
  if (window.JSON) {

    $data = list.nestable('serialize')

    $.post('<?= BASE_URL ?>/ajax/sortable',
        { data: $data },
        function(result){
          console.log(result);
        }
    );
  } else {
    output.val('JSON browser support required for this demo.');
  }
};

function setFocus() {
  document.getElementById("username").focus();
}

function template(){
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
}


function publishedOn() {
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
}

function sparkline() {

    var settings = {
        width: 150,                 // Width of the chart - Defaults to 'auto' - May be any valid css width - 1.5em, 20px, etc (using a number without a unit specifier won't do what you want) - This option does nothing for bar and tristate chars (see barWidth)
        height: 35,                 // Height of the chart - Defaults to 'auto' (line height of the containing tag)
        lineColor: '#2FABE9',       // Used by line and discrete charts to specify the colour of the line drawn as a CSS values string
        fillColor: '#f2f7f9',       // Specify the colour used to fill the area under the graph as a CSS value. Set to false to disable fill
        spotColor: '#467e8c',       // The CSS colour of the final value marker. Set to false or an empty string to hide it
        maxSpotColor: '#b9e672',    // The CSS colour of the marker displayed for the maximum value. Set to false or an empty string to hide it
        minSpotColor: '#FA5833',    // The CSS colour of the marker displayed for the mimum value. Set to false or an empty string to hide it
        spotRadius: 2,              // Radius of all spot markers, In pixels (default: 1.5) - Integer
        lineWidth: 1                // In pixels (default: 1) - Integer
    };

    $('.page_view').sparkline(page_views, settings);
    $('.page_view').next('.number').text(page_view_total);


    $('.unique_page_view').sparkline(unique_views, settings);
    $('.unique_page_view').next('.number').text(unique_view_total);
}


function dashboardFeed()
{
    var surl =  "http://tentaclecms.com/api/feed/json/";

    $.ajax({
        url: surl,

        dataType: "jsonp",
        jsonp : "callback",
        jsonpCallback: "jsonpcallback",
        success: function jsoncallback(json) {

            $.each(json, function(i, item){
                $(".feed").append('<li><h3><a href="' + item.url + '">' + item.title + '</a></h3><p>' + item.content +' <a href="' + item.url + '"> Read more  »</a></p></li>');
            });

        },
        error: function(e) {

            $(".feed").append('<li><h3>' + e.message + '</h3></li>');

        }
    });
}


function usernameCheck() {
    var username = $('#username').val();
    if(username == "" || username.length < 4)
    {
        $('.tick').hide();
    }
    else
    {
        jQuery.ajax({
            type: "POST",
            url: base_url + "ajax/unique_user",
            data: 'username='+ username,
            cache: false,
            success: function(response){
                if(response == '1')
                {
                    $('#username').css('border', '1px #C33 solid');
                    $('.user_tick').hide();
                    $('.user_cross').fadeIn();
                    $("#save").attr("disabled", "disabled");
                }
                else
                {
                    $('#username').css('border', '1px #090 solid');
                    $('.user_cross').hide();
                    $('.user_tick').fadeIn();
                    $("#save").removeAttr("disabled");
                }
            }
        });
    }
}

function useremailCheck() {
    var username = $('#useremail').val();
    if(username == "" || username.length < 4)
    {
        $('.email_tick').hide();
    }
    else
    {
        jQuery.ajax({
            type: "POST",
            url: base_url + "ajax/unique_user",
            data: 'username='+ username,
            cache: false,
            success: function(response){
                if(response == '1')
                {
                    $('#useremail').css('border', '1px #C33 solid');
                    $('.email_tick').hide();
                    $('.email_cross').fadeIn();
                    $("#save").attr("disabled", "disabled");
                }
                else
                {
                    $('#useremail').css('border', '1px #090 solid');
                    $('.email_cross').hide();
                    $('.email_tick').fadeIn();
                    $("#save").removeAttr("disabled");
                }
            }
        });
    }
}


function permalinkCheck() {
    $slug = $('#permalink').val();

    if( $slug != "" )
    {
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + "ajax/unique_uri/" + page_post,
            data: 'uri='+ uri+'&slug='+ $slug,
            cache: false,
            success: function( response ){

                //console.info( response );

                $('#permalink_landing').html( response.suggested );
                $('#new_uri').val( response.suggested );
            }
        });
    }
}
