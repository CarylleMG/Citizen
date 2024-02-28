$('#submit').click(function(e){
    e.preventDefault();

    var formData = new FormData($('#reportForm')[0]);

    var FirstName = $('#FirstName').val();
    var LastName = $('#LastName').val();
    var phone = $('#phone').val();
    var whendate = $('#whendate').val();
    var place = $('#place').val();
    var susfname = $('#susfname').val();
    var suslname = $('#suslname').val();
    var detailsValue = $('#details').val();

    formData.append('submit', true);
    formData.append('FirstName', FirstName);
    formData.append('LastName', LastName);
    formData.append('phone', phone);
    formData.append('whendate', whendate);
    formData.append('place', place);
    formData.append('susfname', susfname);
    formData.append('suslname', suslname);
    formData.append('details', detailsValue);
    
    // Append image file to FormData object
    var inputFile = document.querySelector('input[type="file"]');
    var imageFile = inputFile.files[0];
    formData.append('picture', imageFile);

    $.ajax({
        type: 'POST',
        url: 'api/upload.php',
        data: formData,
        contentType: false, // Don't set content type
        processData: false, // Don't process data
        success: function(response){
            console.log(response);
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);
            }
            else if(res.status == 200){
                $('#errorMessageUpdate').addClass('d-none');
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);
            }
            else if(res.status == 500) {
                alert(res.message);
            }
        }, 
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
        }
    });
});

$('#search').click(function(e){
    e.preventDefault();

    var formData = new FormData($('#searchForm')[0]);

    var ticketnum = $('#ticketnum').val();
    var contact = $('#contact').val();

    formData.append('search', true);
    formData.append('ticketnum', ticketnum);
    formData.append('contact', contact);
    

    $.ajax({
        type: 'POST',
        url: 'api/upload.php',
        data: formData,
        contentType: false, // Don't set content type
        processData: false, // Don't process data
        success: function(response){
            console.log(response);
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);
            }
            else if(res.status == 200){
                $('#errorMessageUpdate').addClass('d-none');
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);
            }
            else if(res.status == 500) {
                alert(res.message);
            }
        }, 
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
        }
    });
});
