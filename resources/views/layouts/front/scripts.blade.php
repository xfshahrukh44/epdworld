<!-- ============================================================== -->
<!-- All SCRIPTS AND JS LINKS BELOW  -->
<!-- ============================================================== -->

<!-- Js Files Start -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


{{-- Front Scripts --}}

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

{{-- all slider js --}}



<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>


{{-- For demo purposes – can be removed on production  --}}

<script src="{{ asset('js/switchstylesheet.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script>
    $("#departments-menu-toggle").click((function() {
        var e = $(this).parent();
        e.hasClass("open") ? e.removeClass("open") : e.addClass("open")
    }));
</script>

<!-- For demo purposes – can be removed on production : End -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script> -->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" -->
    <!--    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    -->
<!--</script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" -->
    <!--    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    -->
<!--</script>-->


<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@19.1.3/dist/lazyload.min.js"></script>



<script>
    $(function() {
        var myLazyLoad = new LazyLoad({
            elements_selector: ".lazy"
        });
    });
</script>


<script>
    function editableContent() {
        $(".editable").each(function() {
            $(this).append(
                '<div class="editable-wrapper"><a href="javascript:" class="edit" title="Edit" onclick="editContent(this)"><i class="far fa-edit"></i></a><a href="javascript:" class="update" title="Update" onclick="updateContent(this)"><i class="far fa-share-square"></i></a></div>'
            )
        })
    }

    function editContent(t) {
        $(t).closest(".editable").attr("contenteditable", !0), $(t).closest(".editable-wrapper").attr("contenteditable",
            !1), $(t).closest(".editable").focus()
    }

    function updateContent(t) {
        var e = $(t).closest(".editable"),
            a = $(e).attr("data-id"),
            s = $(e).attr("data-name"),
            n = $(e).clone(!0);
        $(n).find(".editable-wrapper").remove(), sendData(a, s, $(n).html())
    }

    function sendData(t, e, a) {
        console.log(t), console.log(e), console.log(a), $.ajax({
            url: "update-content",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: t,
                keyword: e,
                htmlContent: a
            },
            success: function(t) {
                t.status ? toastr.success(t.message) : toastr.success(t.error)
            }
        })
    }
</script>

<script type="text/javascript">
    $('#newForm').on('submit', function(e) {
        $('#newsresult').html('');
        e.preventDefault();

        let email = $('#newemail').val();

        $.ajax({
            url: "newsletter-submit",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                newsletter_email: email
            },
            success: function(response) {
                if (response.status) {
                    $('#newsresult').html("<div class='alert alert-success'>" + response.message +
                        "</div>");
                } else {
                    $('#newsresult').html("<div class='alert alert-danger'>" + response.message +
                        "</div>");
                }
            },
        });
    });
</script>


<script type="text/javascript">
    $('#contactform').on('submit', function(e) {
        //alert('hogaya');
        $('#contactformsresult').html('');
        e.preventDefault();

        $.ajax({
            url: "{{ route('contactUsSubmit') }}",
            type: "POST",
            data: $("#contactform").serialize(),

            success: function(response) {
                if (response.status) {
                    document.getElementById("contactform").reset();
                    $('#contactformsresult').html("<div class='alert alert-success'>" + response
                        .message + "</div>");
                } else {
                    $('#contactformsresult').html("<div class='alert alert-danger'>" + response
                        .message + "</div>");
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

    $(document).mousemove(function() {
        if ($(".hrvbtr:hover").length != 0) {
            $('.hrvbtr').addClass('open');
        } else {
            $('.hrvbtr').removeClass('open');
        }
    });


    // $('.hrvbtr').hover(function(){
    //     $('#menu-vertical-menu').show();
    // });
</script>

<script src="{{ asset('js/jquery.repeater.min.js') }}"></script>


<script async src="{{ asset('plugins/vendors/dropify/dist/js/dropify.min.js') }}"></script>

<script>
    $(document).ready(function() {
        if ($.fn.dropify) {
            $('.dropify').dropify();
        } else {
            console.error("Dropify plugin not loaded.");
        }
    });
    ! function(e, t, r) {
        "use strict";
        r(".repeater-default").repeater(), r(".file-repeater, .contact-repeater").repeater({
            show: function() {
                r(this).slideDown()
            },
            hide: function(e) {
                confirm("Are you sure you want to remove this item?") && r(this).slideUp(e)
            }
        })
    }(window, document, jQuery);

    function getval(sel) {
        var globelsel = sel;
        let value = sel.value;

        // alert(value);

        $.ajax({
            url: "{{ route('get-attributes') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                value: value
            },
            success: function(response) {
                $(globelsel).parent().parent().find('.value').html('');
                if (response.status) {
                    var html = '';
                    for (var i = 0; i < response.message.length; i++) {
                        html += '<option value="' + response.message[i].id + '">' + response.message[i]
                            .value + '</option>';
                    }
                    $(globelsel).parent().parent().find('.value').html(html);
                } else {

                }
            },
        });
    }
</script>

@if (!Auth::guest())
    @if (Auth::user()->isAdmin())
        <script>
            editableContent();
        </script>
    @endif
@endif

@if (Session::has('message'))
    <script type="text/javascript">
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif
