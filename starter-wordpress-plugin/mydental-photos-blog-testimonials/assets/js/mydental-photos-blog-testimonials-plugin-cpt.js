jQuery(document).ready(function ($) {

  jQuery(document).on('click', function(event) {
    if (jQuery(event.target).hasClass('consult_popup')) {
        // If the click was not inside .content, remove the open_popup class
        jQuery('.consult_popup').removeClass('open_popup');
    }
  });

  $(document).on("mouseenter", ".section-character .svg-opacity", function(event) {
    var title = $(this).attr("title");
    var mouseX = (event.pageX - jQuery('.outfit.mydental-photos-blog-testimonials-main').offset().left) + 10;
    var mouseY = (event.pageY - jQuery('.outfit.mydental-photos-blog-testimonials-main').offset().top) + 10;

    var currentText = $(".tooltip").text().trim();

    if (currentText !== title) {
        $(".tooltip").html(title).css({top: mouseY, left: mouseX}).fadeIn();
    }
     if(title == "" || title == undefined){
      $(".tooltip").fadeOut();
    }  
  });

  $(document).on("mouseleave", ".section-character svg", function() {
    $(".tooltip").fadeOut();
  })


  // EVERY NEXT BUTTON
  $(document).on("click", ".mydental-photos-blog-testimonials-main .next-btn", function() {
    var currentSection = $(this).closest("section");
    currentSection.hide();
    currentSection.next("section").show();

    if($(this).data('character') != undefined){
      if(currentSection.next("section").hasClass('section-character')){
        jQuery('.consult_section.character-'+$(this).data('character')).show()

        if($(this).data('character') == 'female'){
          jQuery('.consult_section.character-male').remove()
        }
        if($(this).data('character') == 'male'){
          jQuery('.consult_section.character-female').remove()
        }
      }
    }
  });

  jQuery(document).on('click', '.mydental-photos-blog-testimonials-main button.back-button', function(){
    
    jQuery('.outfit.mydental-photos-blog-testimonials-main section.'+jQuery(this).data('id')+'').show()
    jQuery('.outfit.mydental-photos-blog-testimonials-main section:not(.'+ jQuery(this).data('id') +')').hide()
    if(jQuery(this).data('id') == "section-choose"){
      jQuery('.choose_option_wrapper .choose_box').removeClass('next-btn');
      jQuery('.consult_section').remove()
      $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        dataType: "json",
        data: {
            action: 'load_choose_character',
        },
        beforeSend : function(){
        },
        success: function(response) {
          // console.log(response)
          if(response.data.html){
            jQuery('.choose_option_wrapper .choose_box').addClass('next-btn')
            jQuery('section.section-character').append(response.data.html)

            setTimeout(() => {
              load_data_popup()
            }, 100);
          }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
        }
    });
    }
  })

  // GO TO FINAL FORM
  $(document).on ('click', '.final_submission', function(){

    if(jQuery('form.vc_data_form').serialize() != ''){

      // jQuery('input[name="vc_data_form_data"]').val(jQuery('form.vc_data_form').serialize())

      var currentSection = $(this).closest("section");
      currentSection.hide();
      currentSection.next("section").show();

      jQuery('body').removeClass('overflow_hidden')

    }else{

    }
    
  });

  // Choose Screen JS for Mobile Design
  $(document).on("click", ".consult_continue_btn a", function() {
    $(".consult_left_column").hide();
    $(".consult_right_column").show();
  });

  // Open and Close popup On click JS

  // Popup One
  $(document).on("click", ".open_popup_btn .popup_one", function() {
    $(".overlay.popup_one").addClass("open_popup");
    $("body").addClass("overflow_hidden");
  });


  // CHARTER CLICK OPEN POPUP
  $(document).on("click", ".consult_section .svg-opacity", function() {

    if( jQuery(this).data('id') != "face"){

      jQuery('.llvc__form-popup').hide();
      jQuery('.llvc__form-popup#'+ jQuery(this).data('id') +'_popup').show();
  
      jQuery(".overlay.popup_one").addClass("open_popup");
      jQuery("body").addClass("overflow_hidden");
    }
  });

  
  $(document).on("click", ".close_pop_one", function() {
    $(".overlay").removeClass("open_popup");
    $("body").removeClass("overflow_hidden");
  });


  // Popup Two
  
  $(document).on("click", ".open_popup_btn .popup_two", function() {
    $(".overlay.popup_two").addClass("open_popup");
    $("body").addClass("overflow_hidden");
  });

  $(document).on("click", ".close_pop_two", function() {
    $(".overlay").removeClass("open_popup");
    $("body").removeClass("overflow_hidden");
  });


  // Popup Three
  $(document).on("click", ".open_popup_btn .popup_three", function() {
    $(".overlay.popup_three").addClass("open_popup");
    $("body").addClass("overflow_hidden");
  });

  $(document).on("click", ".close_pop_three", function() {
    $(".overlay").removeClass("open_popup");
    $("body").removeClass("overflow_hidden");
  });


  // Toggle Class On Switch For Front And Back Side
  $(document).on("click", ".consult_swicth_btn .switch", function() {
    $(".consult_right_column_content").toggleClass("show_back_side");
  });

  // Add Class On Click For Face Click For Man Closeup SVG
  $(document).on("click", ".consult_svg svg path.face_svg_path", function() {
    $(".consult_right_column_content").addClass("show_man_closeup_side");
    $(".consult_svg svg.front_side_svg").hide();
    $(".consult_svg svg.man_closeup_svg").show();
  });
  // // On Hover Change Body Part Color JS || $('.consult_svg svg path').hover(function () {
  // $('.consult_svg svg path').hover(function () {
  //   var id = $(this).attr('data-id');
  //   $('svg [data-id=' + id + ']').addClass('hover');
  // }, function () {
  //   var id = $(this).attr('data-id');
  //   $('svg [data-id=' + id + ']').removeClass('hover');
  // });
  $(document).on('mouseenter', '.consult_svg svg path', function () {
    var id = $(this).attr('data-id');
    $('svg [data-id=' + id + ']').addClass('hover');
  }).on('mouseleave', '.consult_svg svg path', function () {
    var id = $(this).attr('data-id');
    $('svg [data-id=' + id + ']').removeClass('hover');
  });

  // Return To Full Body JS
  $(document).on("click", ".consult_svg svg path.face_svg_path", function() {
    $(".consult_side_btn").hide();
    $(".consult_finish_btn.return_body_btn").show();
    $(".consult_finish_btn.return_body_btn").css("display", "flex");
  });

  $(document).on("click", ".consult_finish_btn.return_body_btn", function() {

    if(jQuery('#username-female').length > 0){jQuery('#username-female').prop('checked', false) }  // femlae
    if(jQuery('#username-male').length > 0){ jQuery('#username-male').prop('checked', false) } // male

    $(".consult_finish_btn.return_body_btn").hide();
    $(".consult_side_btn").show();
    $(".consult_right_column_content").removeClass("show_man_closeup_side");
    $(".consult_svg svg.man_closeup_svg").hide();
    $(".consult_svg svg.front_side_svg").show();
  });

  
  $(document).on("click", ".consult_svg svg path.female_back_face_svg_path, .consult_svg svg path.male_back_face_svg_path", function() {
    $(".consult_svg svg.man_closeup_svg").hide();
    $(".consult_right_column_content").addClass("show_man_closeup_side");
    $(".consult_right_column_content").removeClass("show_back_side ");
    $(".consult_svg svg.front_side_svg").hide();
    $(".consult_svg svg.man_closeup_svg").show();
    $(".consult_side_btn").hide();
    $(".consult_finish_btn.return_body_btn").show();
    $(".consult_finish_btn.return_body_btn").css("display", "flex");
  }); 

  function load_data_popup(){

    menbodydata = vcmshortcode.menbodydata
    // Iterate over the menbodydata object
    Object.keys(menbodydata).forEach(function(serviceId, index) {
      // Create a new .llvc__form-popup element with the corresponding serviceId || ${index !== 0 ? 'display: none;' : ''}
      let popupHtml = `<div class="llvc__form-popup" id="${serviceId}" style="display: none;">
                          <div class="consult_topic_heading"><h3>${menbodydata[serviceId][0].popup__title}</h3></div>
                          <div class="consult_topic_para"><p>Please select all of the following that apply</p></div>
                          <div class="consult_topic_detail">
                              <div class="consult_list_form">`;

      // Iterate over the checkboxes for the current serviceId
      menbodydata[serviceId].forEach(function(checkbox) {
          if(checkbox.popup__title == undefined){
              // Append HTML for each checkbox
          popupHtml += `<div class="consult_form_field">
                          <input type="checkbox" id="${checkbox.name}" name="${checkbox.name}" value="${checkbox.label}">
                          <label for="${checkbox.name}">${checkbox.label}</label>
                      </div>`;    
          }
          
      });

      // Close the remaining HTML tags for the .llvc__form-popup element
      popupHtml += `</div>
                      <div class="add_consultation_btn">
                          <a href="javascript:void(0)" class="popup_no_select_data">add to consultation<img src="http://mydentaltouchsocial.com/wp-content/uploads/2024/02/icon-add-circular-button-1.png" alt="consult-icon"></a>
                      </div>
                  </div>
              </div>`;

      // Append the generated HTML to a container element (e.g., body)
      jQuery('.consult_popup_content form#man').append(popupHtml);
    });

    womenbodydata = vcmshortcode.womenbodydata
    // Iterate over the menbodydata object
    Object.keys(womenbodydata).forEach(function(serviceId, index) {

      // Create a new .llvc__form-popup element with the corresponding serviceId || ${index !== 0 ? 'display: none;' : ''}
      let popupHtml = `<div class="llvc__form-popup" id="${serviceId}" style="display: none;">
                          <div class="consult_topic_heading"><h3>${womenbodydata[serviceId][0].popup__title}</h3></div>
                          <div class="consult_topic_para"><p>Please select all of the following that apply</p></div>
                          <div class="consult_topic_detail">
                              <div class="consult_list_form">`;

      // Iterate over the checkboxes for the current serviceId
      womenbodydata[serviceId].forEach(function(checkbox) {
          if(checkbox.popup__title == undefined){
              // Append HTML for each checkbox
          popupHtml += `<div class="consult_form_field">
                          <input type="checkbox" id="${checkbox.name}" name="${checkbox.name}" value="${checkbox.label}">
                          <label for="${checkbox.name}">${checkbox.label}</label>
                      </div>`;    
          }
          
      });

      // Close the remaining HTML tags for the .llvc__form-popup element
      popupHtml += `</div>
                      <div class="add_consultation_btn">
                          <a href="javascript:void(0)" class="popup_no_select_data">add to consultation<img src="http://mydentaltouchsocial.com/wp-content/uploads/2024/02/icon-add-circular-button-1.png" alt="consult-icon"></a>
                      </div>
                  </div>
              </div>`;

      // Append the generated HTML to a container element (e.g., body)
      jQuery('.consult_popup_content form#female').append(popupHtml);
    });

  }
  load_data_popup()

  $('.consult_form').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true,
            digits: true, // only allow digits
            minlength: 10, // specify minimum length of phone number
            maxlength: 15 // specify maximum length of phone number
        },
        email: {
            required: true,
            email: true // validate email format
        },
        birthday: {
          required: true,
          date: true,
          max: function() {
              // Get today's date
              var today = new Date();
              // Set time to the end of the day
              today.setHours(23,59,59,999);
              // Return today's date
              return today.toISOString().split('T')[0];
          }
        }
    },
    messages: {
      name: "Please enter your name",
      phone: {
          required: "Please enter your phone number",
          digits: "Please enter only digits",
          minlength: "Please enter at least 10 digits",
          maxlength: "Please enter at most 15 digits"
      },
      email: "Please enter a valid email address",
      birthday: {
          required: "Please enter your date of birth",
          date: "Please enter a valid date of birth",
          max: "Please enter a date in the past"
      }
  },
    submitHandler: function(form) {
        // If the form is valid, proceed with AJAX submission
        var formData = $(form).serialize(); // Serialize form data
        var vc_data_form = $('.vc_data_form').serialize(); // Serialize form data
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'submit_consult_form',
                formData: formData,
                vc_data_form: vc_data_form
            },
            beforeSend : function(){
              jQuery('.consult_form input[type="submit"]').prop("disabled", true);
              jQuery('.consult_form input[type="submit"]').val("Submitting Application...");
            },
            success: function(response) {
              jQuery('.consult_form input[type="submit"]').val("Submit");
              jQuery('.consult_form input[type="submit"]').prop("disabled", false);
              // console.log(response)
              if(response.status == "success"){
                jQuery(form)[0].reset()
                window.location.href = window.location.origin + window.location.pathname + '?application=' + response.application + '&' + response.than_you_data + '&username=' + response.data.name
              }else{
                alert(response.message)
              }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
      
    }
});

  $(document).on("click", '.popup_no_select_data' ,  function () {

    let checkedValue = false;

    if(jQuery(this).hasClass('consult_finish_btn') && jQuery(this).hasClass('go_form')){
        jQuery('.consult_popup.overlay.popup_one form').find('input').each(function () {
          if(this.checked){
            checkedValue  = true ;
          }
        })
    }else{
      jQuery(this).parent().prev().find('input').each(function () {
        if(this.checked){
          checkedValue  = true ;
        }
      })
    }

    $(".overlay").removeClass("open_popup");
    $("body").removeClass("overflow_hidden");

    if(checkedValue){  
      $(".overlay.popup_two").addClass("open_popup");
    }else{
      $(".overlay.popup_three").addClass("open_popup");
    }

    $("body").addClass("overflow_hidden");

  });

  // consult_finish_btn final_submission
  $(document).on("change", '.section-character .consult_popup_content input[type="checkbox"]', function() {
    formData = jQuery('.vc_data_form').serialize();
    if(formData != ""){
      jQuery('.consult_finish_btn.go_form').addClass('final_submission')
      jQuery('.consult_finish_btn.go_form').removeClass('popup_no_select_data')
    }else{
      jQuery('.consult_finish_btn.go_form').addClass('popup_no_select_data')
      jQuery('.consult_finish_btn.go_form').removeClass('final_submission')
    }

  })

  if(jQuery('.outfit.mydental-photos-blog-testimonials-main section.section-thank-you .filter-btn').length > 0){
    // Than you page
    jQuery('.outfit.mydental-photos-blog-testimonials-main section.section-thank-you .filter-btn').change(function() {
      jQuery('.outfit.mydental-photos-blog-testimonials-main section.section-thank-you .filter-label').removeClass('active');
      jQuery(this).parent().addClass('active');
      var selectedFilter = jQuery(this).val();
      jQuery('.treatment-section').removeClass('active');
      if (selectedFilter === 'all') {
          jQuery('.treatment-section').addClass('active');
      } else {
          jQuery('#' + selectedFilter).addClass('active');
      }
    });
    jQuery('.outfit.mydental-photos-blog-testimonials-main section.section-thank-you .filter-btn[value="all"]').trigger('change');
  }

});