/**
 * Created by eugene on 2/12/16.
 */
jQuery(document).ready(function(){


    var opts = {
        lines: 13 // The number of lines to draw
        , length: 28 // The length of each line
        , width: 14 // The line thickness
        , radius: 42 // The radius of the inner circle
        , scale: 1 // Scales overall size of the spinner
        , corners: 1 // Corner roundness (0..1)
        , color: '#000' // #rgb or #rrggbb or array of colors
        , opacity: 0.25 // Opacity of the lines
        , rotate: 0 // The rotation offset
        , direction: 1 // 1: clockwise, -1: counterclockwise
        , speed: 1 // Rounds per second
        , trail: 60 // Afterglow percentage
        , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
        , zIndex: 2e9 // The z-index (defaults to 2000000000)
        , className: 'spinner' // The CSS class to assign to the spinner
        , top: '90%' // Top position relative to parent
        , left: '50%' // Left position relative to parent
        , shadow: false // Whether to render a shadow
        , hwaccel: false // Whether to use hardware acceleration
        , position: 'absolute' // Element positioning
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //Search by ajax request
    $("#search-button").on('click',function(e){
        e.preventDefault();
        e.stopPropagation();
        var report_search_target = jQuery("#reports-search-result");
        var book_search_spinner = new Spinner(opts).spin();
        book_search_target.append(book_search_spinner.el);
        var book_search_form =jQuery("#search-form").serialize();
        jQuery.ajax({
            method: "POST",
            data: book_search_form,
            url: "/booksearch",
            success: function(data) {
                // console.log(data);
                book_search_spinner.stop();
                jQuery("#book-search-result").html(data);
            },
            error: function (request, status, error) {
                console.log(error);
                console.log(status);
                console.log(request.responseText);
                book_search_spinner.stop();
            }
        });
    });

 $('a[class="send-inv"]').each(function() {
     $(this).on('click', function (e) {
         e.preventDefault();
         e.stopPropagation();
         var $patient_id=$(this).data("patientid");
         jQuery.ajax({
             method: "POST",
             data: {patient_id:$patient_id},
             url: "/invitation",
             success: function(data) {
                 alert(data);
             },
             error: function (request, status, error) {
                 console.log(error);
                 console.log(status);
                 console.log(request.responseText);
                 book_search_spinner.stop();
             }
         });
     });
 });

 $('a[class="view-rep"]').each(function() {
   $(this).on('click', function (e) {
       e.preventDefault();
       e.stopPropagation();
       console.log("click");
       var $patient_id=$(this).data("patientid");
       var reports_search_target = jQuery("#reports-search-result");
       var reports_search_spinner = new Spinner(opts).spin();
       reports_search_target.append(reports_search_spinner.el);
       jQuery.ajax({
           method: "POST",
           data: {patient_id:$patient_id},
           url: "/reports",
           success: function(data) {
               // console.log(data);
               reports_search_spinner.stop();
               jQuery("#reports-search-result").html(data);
           },
           error: function (request, status, error) {
               console.log(error);
               console.log(status);
               console.log(request.responseText);
               reports_search_spinner.stop();
           }
       });
     });
  });


});