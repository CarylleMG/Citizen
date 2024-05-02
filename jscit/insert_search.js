$('#submit').click(function(e){
    e.preventDefault();

    var formData = new FormData($('#reportForm')[0]);

    var FirstName = $('#FirstName').val();
    var LastName = $('#LastName').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var whendate = $('#whendate').val();
    var place = $('#place').val();
    var susfname = $('#susfname').val();
    var suslname = $('#suslname').val();
    var detailsValue = $('#details').val();

    formData.append('submit', true);
    formData.append('FirstName', FirstName);
    formData.append('LastName', LastName);
    formData.append('email', email);
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
        contentType: false, 
        processData: false, 
        success: function(response){
            console.log(response);
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                swal({
                    title: "Warning",
                    text: res.message,
                    icon: "warning",
                    button: "OK"
                });
            }
            else if(res.status == 200){
                swal({
                    title: "Success!",
                    text: res.message,
                    icon: "success",
                    button: "OK",
                }).then(function() {
                    window.location.href = "index.php";
                });
            }
            else if(res.status == 500) {
                swal({
                    title: "Error!",
                    text: res.message,
                    icon: "error",
                    button: "OK"
                });
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
        url: 'api/validate.php',
        data: formData,
        contentType: false, 
        processData: false,
        success: function(response){
            console.log(response);
            var res = jQuery.parseJSON(response);
            if(res.status == 422) { 
                swal({
                    title: "Warning",
                    text: res.message,
                    icon: "warning",
                    button: "OK"
                });
            }
            else if(res.status == 200){ 
                
                window.location.href = "ticket.php?contact=" + encodeURIComponent(contact) + "&ticketnum=" + encodeURIComponent(ticketnum);
                
            }
            else if(res.status == 500) { 
                swal({
                    title: "Error!",
                    text: res.message,
                    icon: "error",
                    button: "OK"
                });
            }
        }, 
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
        } 
    });
});
