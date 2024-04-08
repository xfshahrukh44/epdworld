<!-- ============================================================== -->
<!-- All SCRIPTS AND JS LINKS BELOW  -->
<!-- ============================================================== -->

<!-- Js Files Start -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Front Scripts -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-hover-dropdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/echo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.easing.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/electro.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>


<!-- For demo purposes – can be removed on production -->

<script src="{{ asset('js/switchstylesheet.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#departments-menu-toggle').click(function(){
        var parentli  = $(this).parent();
        if(parentli.hasClass('open')){
            parentli.removeClass('open')
        }
        else{
            parentli.addClass('open')

        }
    })
// (function($) {
//     $(document).ready(function() {
//         $(".changecolor").switchstylesheet({
//             seperator: "color"
//         });
//         $('.show-theme-options').click(function() {
//             $(this).parent().toggleClass('open');
//             return false;
//         });

//         $('#home-pages').on('change', function() {
//             $.ajax({
//                 url: $('#home-pages option:selected').val(),
//                 success: function(res) {
//                     location.href = $('#home-pages option:selected').val();
//                 }
//             });
//         });

//         $('#demo-pages').on('change', function() {
//             $.ajax({
//                 url: $('#demo-pages option:selected').val(),
//                 success: function(res) {
//                     location.href = $('#demo-pages option:selected').val();
//                 }
//             });
//         });

//         $('#header-style').on('change', function() {
//             $.ajax({
//                 url: $('#header-style option:selected').val(),
//                 success: function(res) {
//                     location.href = $('#header-style option:selected').val();
//                 }
//             });
//         });

//         $('#shop-style').on('change', function() {
//             $.ajax({
//                 url: $('#shop-style option:selected').val(),
//                 success: function(res) {
//                     location.href = $('#shop-style option:selected').val();
//                 }
//             });
//         });

//         $('#product-category-col').on('change', function() {
//             $.ajax({
//                 url: $('#product-category-col option:selected').val(),
//                 success: function(res) {
//                     location.href = $('#product-category-col option:selected').val();
//                 }
//             });
//         });

//         $('#single-products').on('change', function() {
//             $.ajax({
//                 url: $('#single-products option:selected').val(),
//                 success: function(res) {
//                     location.href = $('#single-products option:selected').val();
//                 }
//             });
//         });

//         $('.style-toggle').on('click', function() {
//             $(this).parent('.config').toggleClass('open');
//         });
//     });
// })(jQuery);
</script>

<!-- For demo purposes – can be removed on production : End -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"-->
<!--    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">-->
<!--</script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"-->
<!--    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">-->
<!--</script>-->


<script>

	function editableContent(){
		$('.editable').each(function(){
			$(this).append('<div class="editable-wrapper"><a href="javascript:" class="edit" title="Edit" onclick="editContent(this)"><i class="far fa-edit"></i></a><a href="javascript:" class="update" title="Update" onclick="updateContent(this)"><i class="far fa-share-square"></i></a></div>');
		});
	}

	function editContent(a){
		$(a).closest('.editable').attr('contenteditable', true);;
		$(a).closest('.editable-wrapper').attr('contenteditable', false);
		$(a).closest('.editable').focus();
	}

	function updateContent(a){
		var editableDiv = $(a).closest('.editable');
		var id = $(editableDiv).attr('data-id');
		var keyword = $(editableDiv).attr('data-name');
		var htmlcontent = $(editableDiv).clone(true);
		$(htmlcontent).find('.editable-wrapper').remove();
		sendData(id, keyword, $(htmlcontent).html());
	}

	function sendData(id, keyword, htmlContent){
		console.log(id);
		console.log(keyword);
		console.log(htmlContent);
		$.ajax({
	        url: "update-content",
	        type: "POST",
	        data: {
	            "_token": "{{ csrf_token() }}",
	            id: id,
	            keyword: keyword,
	            htmlContent:htmlContent,
	        },
	        success: function(response) {
	            if (response.status) {
	            	toastr.success(response.message);
	            } else {
	                toastr.success(response.error);
	            }
	        },
	    });
	}

</script>

<script type="text/javascript">

$('#newForm').on('submit',function(e){
  $('#newsresult').html('');
    e.preventDefault();

    let email = $('#newemail').val();

    $.ajax({
      url: "newsletter-submit",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        newsletter_email:email
      },
      success:function(response){
        if(response.status){
          $('#newsresult').html("<div class='alert alert-success'>" + response.message + "</div>");
        }
        else{
          $('#newsresult').html("<div class='alert alert-danger'>" + response.message + "</div>");
        }
      },
     });
    });
  </script>


<script type="text/javascript">

$('#contactform').on('submit',function(e){
  //alert('hogaya');
  $('#contactformsresult').html('');
    e.preventDefault();

    $.ajax({
      url: "{{ route('contactUsSubmit')}}",
      type:"POST",
      data: $("#contactform").serialize(),

      success:function(response){
        if(response.status){
          document.getElementById("contactform").reset();
          $('#contactformsresult').html("<div class='alert alert-success'>" + response.message + "</div>");
        }
        else{
          $('#contactformsresult').html("<div class='alert alert-danger'>" + response.message + "</div>");
        }
      },
     });
    });

    // $(document).ready(function() {
    //     $('#menu-vertical-menu').hide();
    // });

    // $('#departments-menu-toggle').hover(function(){
    //     // alert('here');
    //     $('#menu-vertical-menu').show();
    // });
    
     $(document).mousemove(function(){
         if($(".hrvbtr:hover").length != 0){
            $('.hrvbtr').addClass('open');
        } else{
            $('.hrvbtr').removeClass('open');
        }
    });
    
    
    // $('.hrvbtr').hover(function(){
    //     $('#menu-vertical-menu').show();
    // });

</script>

  <script src="{{asset('js/jquery.repeater.min.js')}}"></script>
  <script src="{{asset('plugins/vendors/dropify/dist/js/dropify.min.js')}}"></script>
  <script>
      $(function() {
          $('.dropify').dropify();
      });
      !function(e,t,r){"use strict";r(".repeater-default").repeater(),r(".file-repeater, .contact-repeater").repeater({show:function(){r(this).slideDown()},hide:function(e){confirm("Are you sure you want to remove this item?")&&r(this).slideUp(e)}})}(window,document,jQuery);
      
      function getval(sel)
        {
            var globelsel = sel;
            let value = sel.value;

            // alert(value);
            
            $.ajax({
            url: "{{ route('get-attributes')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    value:value
                },
                success:function(response){
                    $(globelsel).parent().parent().find('.value').html('');
                    if(response.status){
                        var html = '';
                        for(var i = 0; i < response.message.length; i++){
                            html += '<option value="'+response.message[i].id+'">'+response.message[i].value+'</option>';
                        }
                        $(globelsel).parent().parent().find('.value').html(html);
                    }
                    else{

                    }
                },
                });
        }
  </script>

@if (!Auth::guest())
@if(Auth::user()->isAdmin())
<script>editableContent();</script>
@endif
@endif

@if(Session::has('message'))
<script type="text/javascript">
    toastr.success("{{ Session::get('message') }}");
</script>
@endif
