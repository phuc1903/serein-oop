$('.saveInfo').click(function() {

    var img = $('#avatar').attr('src');
    var data = {
        name: $('#name').val(),
        avatar: img.replace("/serein/", ""),
        email: $('#email').val(),
        phone: $('#phone').val(),
        address: $('#address').val(),
        sex: $('#sex').val(),
    }

    $.ajax({
        type: "POST",
        url: "/serein/user/info/save",
        data: data,
        dataType: "json",
        success: function (response) {
            // console.log(response);
            if(response.success) {
                alert(response.message);
            }else {
                $('#message_err').text(response.message);
            }
        }
    });
})

$('#ressetPass-btn').click(function (e) { 
    e.preventDefault();
    var email = $('#email').val();

    var data = {
        email: email
    }

    $.ajax({
        type: "POST",
        url: "/serein/handleressetPassword",
        data: data,
        dataType: "json",
        success: function (response) {
            if (response.success) {
                window.location.href = "http://localhost/serein/passwordNew";
                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error: " + status, error);
            alert("An error occurred while sending the email. Please try again later.");
        }
    });
    
});