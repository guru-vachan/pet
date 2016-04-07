/*!
 * Start Bootstrap - Agnecy Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

$(function() {

	$("#contactForm").submit(function(event){
		event.preventDefault(); // prevent default submit behaviour
		// get values from FORM
		var name = $("#contactForm #name").val();
		var email = $("#contactForm #email").val();
		var phone = $("#contactForm  #phone").val();
		var message = $("#contactForm #message").val();
		var firstName = name; // For Success/Failure Message
		// Check for white space in name for Success/Fail message
		if (firstName.indexOf(' ') >= 0) {
			firstName = name.split(' ').slice(0, -1).join(' ');
		}
		if(phone.length != 10){
			$('#consuccess').html("<div class='alert alert-success'>");
			$('#consuccess > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
				.append("</button>");
			$('#consuccess > .alert-success')
				.append("<strong>Please enter a valid 10 digit mobile number. </strong>");
			$('#consuccess > .alert-success')
				.append('</div>');
			event.preventDefault();
		}
		$.ajax({
			url: "do/contact_us.php",
			type: "POST",
			data: {
				name: name,
				phone: phone,
				email: email,
				message: message
			},
			cache: false,
			success: function() {
				// Success message
				$('#consuccess').html("<div class='alert alert-success'>");
				$('#consuccess > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
					.append("</button>");
				$('#consuccess > .alert-success')
					.append("<strong>Your message has been sent. </strong>");
				$('#consuccess > .alert-success')
					.append('</div>');

				//clear all fields
				$('#contactForm').trigger("reset");
			},
			error: function() {
				// Fail message
				$('#consuccess').html("<div class='alert alert-danger'>");
				$('#consuccess > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
					.append("</button>");
				$('#consuccess > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that our mail server is not responding. Please try again later!");
				$('#consuccess > .alert-danger').append('</div>');
				//clear all fields
				$('#contactForm').trigger("reset");
			},
		})
	});


	/*When clicking on Full hide fail/success boxes */
	$('#contactForm #name').focus(function() {
		$('#consuccess').html('');
	});
	
	var url = [location.protocol, '//', location.host, location.pathname].join('');
	
	$('.breed_type').change(function(e){
		e.preventDefault();
		$breed_query = "breed_type=";
		$('.breed_type').each(function(){
			if($(this).is(':checked')){
				$breed_query += $(this).val()+',';
			}
		});
		$breed_query = $breed_query.substring(0, $breed_query.length - 1);
		window.location = url +'?'+ $breed_query;
	});
	
	$('.prod_type').change(function(e){
		e.preventDefault();
		$prod_query = "prod_type=";
		$('.prod_type').each(function(){
			if($(this).is(':checked')){
				$prod_query += $(this).val()+',';
			}
		});
		$prod_query = $prod_query.substring(0, $prod_query.length - 1);
		window.location = url +'?'+ $prod_query;
	});
});
