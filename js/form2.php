<html>
<head>
  <title>Form Validation</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <style type="text/css">
  .styled {
  font-family: Arial, sans-serif;
  }
  .styled fieldset {
  border: 1px solid #ccc; padding: 10px;
  }
  .styled fieldset legend {
  font-size: 16px; font-weight: bold; color: #000; text-transform: capitalize; padding: 5px; background: #fff; display: block; margin-bottom: 0; border: 1px solid #ccc;
  }
  .styled fieldset ol, .styled fieldset ol li {
  list-style: none;
  }
  .styled fieldset li.form-row {
  margin-bottom: 3px; padding: 2px 0; width: 100%; overflow: hidden; position: relative;
  }
  .styled label {
  font-size: 12px; display: block; font-weight: bold; float: left; width: 100px; margin-left: 5px; line-height: 24px;
  }
  .styled input.text-input, .styled .text-area {
  background: #fefefe; border-top: 1px solid #909090; border-right: 1px solid #cecece; border-bottom: 1px solid #e1e1e1; border-left: 1px solid #bbb; padding: 3px; width: 220px; font-size: 12px;
  }
  .styled input.text-input.default.active, .styled .text-area.default.active {
  color: #666; font-style: italic;
  }
  .styled fieldset li.button-row {
  margin-bottom: 0; padding: 2px 5px;
  }
  form input.btn-submit {
  padding: 3px 7px; border: 1px solid #fff; background: #066CAA; font-size: 12px;
    }
    styled span.error {
  font-size: 11px; position: absolute; top: 0; right: 0; display: block; padding: 2px;
  }
  .styled fieldset li.error {
  color: #D8000C; background: #fff0f0 url(../media/images/checkers.png) repeat; border: 1px solid #f9c7c7; padding: 5px 0;
  }
  .styled fieldset li.error label {
  text-align: left;
  }
  </style>
</head>
<body>
  <div class="one_third">
 
    <h4>Get in Touch</h4>

    <p class="success-sending-message">Thank you, your message has been sent!</p>
    <p class="error-sending-message">There has been an error, please try again.</p>

    <div id="contact-form">
  <form id="form-contact" class="styled" action="/user_functions.php" method="post">
    <fieldset>
      <legend>Contact Form</legend>
      <ol>
        <li class="form-row">
          <label>Email:</label>
          <input id="input-email" type="text" class="text-input required email default" name="email" value="" title="Enter Your Email Address" />
        </li>
        <li class="form-row">
          <label>Name:</label>
          <input id="input-name" type="text" class="text-input required default" name="name" value="" title="Enter Your Full Name" />
        </li>
        <li class="form-row">
          <label>Phone:</label>
          <input id="input-phone" type="text" class="text-input" name="phone" value="" />
        </li>
        <li class="form-row">
          <label>Comments:</label>
          <textarea id="input-message" class="text-area" name="message" cols="40" rows="8"></textarea>
        </li>
        <li class="button-row text-right">
          <input class="btn-submit" type="submit" value="submit" name="submit" />
        </li>
      </ol>
    </fieldset>
  </form>
</div>
</div>
  <script type="text/javascript">
    $(".default").each(function(){
      var defaultVal = $(this).attr('title');
      $(this).focus(function(){
        if ($(this).val() == defaultVal){
          $(this).removeClass('active').val('');
        }
      });
      $(this).blur(function() {
        if ($(this).val() == ''){
          $(this).addClass('active').val(defaultVal);
        }
      })
      .blur().addClass('active');
    });
    function defaulttextRemove(){
      $('.default').each(function(){
        var defaultVal = $(this).attr('title');
        if ($(this).val() == defaultVal){
          $(this).val('');
        }
      });
    }
    $(window).load(function() {
 
    /* Ajax Contact form validation and submit */
    jQuery('form#contactForm').submit(function() {
        jQuery(this).find('.error').remove();
        var hasError = false;
        jQuery(this).find('.requiredField').each(function() {
            if(jQuery.trim(jQuery(this).val()) == '') {
                if (jQuery(this).is('textarea')){
                    jQuery(this).parent().addClass('input-error');
                } else {
                    jQuery(this).addClass('input-error');
                }
                hasError = true;
            } else if(jQuery(this).hasClass('email')) {
                var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
                    jQuery(this).addClass('input-error');
                    hasError = true;
                }
            }
        });
        if(!hasError) {
            jQuery(this).find('#born-submit').fadeOut('normal', function() {
                jQuery(this).parent().parent().find('.sending-message').show('normal');
            });
            var formInput = jQuery(this).serialize();
            var contactForm = jQuery(this);
            jQuery.ajax({
                type: "POST",
                url: jQuery(this).attr('action'),
                data: formInput,
                success: function(data){
                    contactForm.parent().fadeOut("normal", function() {
                        jQuery(this).prev().prev().show('normal'); // Show success message
                    });
                },
                error: function(data){
                    contactForm.parent().fadeOut("normal", function() {
                        jQuery(this).prev().show('normal');  // Show error message
                    });
                }
            });
        }
 
        return false;
 
    });
 
    jQuery('.requiredField').blur(function() {
        if(jQuery.trim(jQuery(this).val()) != '' && !jQuery(this).hasClass('email')) {
            if (jQuery(this).is('textarea')){
                jQuery(this).parent().removeClass('input-error');
            } else {
                jQuery(this).removeClass('input-error');
            }
        } else {
            if (jQuery(this).is('textarea')){
                jQuery(this).parent().addClass('input-error');
            } else {
                jQuery(this).addClass('input-error');
            }
        }
    });
 
    jQuery('.email').blur(function() {
        emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if(emailReg.test(jQuery.trim(jQuery(this).val())) && jQuery(this).val() != '') {
            jQuery(this).removeClass('input-error');
        } else {
            jQuery(this).addClass('input-error');
        }
    });
 
    jQuery('.requiredField, .email').focus(function(){
        if (jQuery(this).is('textarea')){
            jQuery(this).parent().removeClass('input-error');
        } else {
            jQuery(this).removeClass('input-error');
        }
    });
 
});
  </script>
</body>
</html>