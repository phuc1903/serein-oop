$(document).ready(function () {
    $('.email').on('input', function () {
        checkemail();
    });

    $('.password').on('input', function () {
        checkpass();
    });

    $('.cpassword').on('input', function () {
        checkcpass();
    });

    $('.name').on('input', function () {
        checkname();
    });

    $('OTP').on('input', function() {
        checkOTP();
    })
    $('#login-btn').click(function () {
        if (!checkemail() || !checkpass()) {
            $("#message").html(`Vui lòng nhập đầy đủ thông tin`);
        } else {
            $("#message").html("");
            var data = {
                password: $("#password").val(),
                email: $("#email").val()
            };
            $.ajax({
                type: "POST",
                url: "/serein/login",
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        window.location.href = "http://localhost/serein/index";
                    } else {
                        $("#message").html(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                }
            });
        }
    });

    $('#register-btn').click(function() {
        if (!checkemail() || !checkpass() || !checkcpass || !checkname) {
            $("#message").html(`Vui lòng nhập đầy đủ thông tin`);
        } else {
            $("#message").html("");
            var data = {
                name: $("#name").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                cpassword: $("#cpassword").val()
            };
            $.ajax({
                type: "POST",
                url: "/serein/register",
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        window.location.href = "http://localhost/serein/login";
                    } else {
                        $("#message").html(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                }
            });
        }
    })

    $('#password-new').click(function() {
        if (!checkcpass() || !checkpass() || !checkOTP()) {
            $("#message").html(`Vui lòng nhập đầy đủ thông tin`);
        } else {
            $("#message").html("");
            var data = {
                password: $("#password").val(),
                cpassword: $("#cpassword").val(),
                OTP: $("#OTP").val()
            }

            $.ajax({
                type: "POST",
                url: "/serein/handlePasswordNew",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.success) {
                        window.location.href = "http://localhost/serein/index";
                    }else {
                        alert(response.message);
                    }
                },
            });
        }
    })


    function updateQuantity(action) {
        var inputQuantity = $('#quantity-input');
        var quantity = parseInt(inputQuantity.val()) || 1;
        var defaultValue = parseInt(inputQuantity.data('default-quantity'));

        var total = $('#total-price-cart');
        var totalPrices = parseInt(total.data('total-prices'));
        var discount = parseInt(total.data('discount'));

        if (action === 'add') {
            quantity += 1;
            if (quantity > defaultValue) {
                alert("Sản phẩm đã giới hạn");
                quantity = defaultValue;
            }
        } else if (action === 'pre') {
            quantity -= 1;
            if (quantity <= 0) {
                alert("Số lượng không thể dưới 1");
                quantity = 1;
            }
        }

        // Cập nhật giá trị trực tiếp trên trang
        inputQuantity.val(quantity);

        // Tính toán và cập nhật tổng tiền trực tiếp trên trang
        var updatedTotalPrice = totalPrices * discount;
        total.html(updatedTotalPrice + ' VNĐ');
    }

    // Click event for increasing quantity
    $('#add-quantity').click(function() {
        updateQuantity('add');
    });
    
    // Click event for decreasing quantity
    $('#pre-quantity').click(function() {
        updateQuantity('pre');
    });
    
    // Input event for manual quantity input
    $('#quantity-input').on('input', function() {
        var inputQuantity = $('#quantity-input');
        var defaultValue = parseInt(inputQuantity.data('default-quantity'));
        var enteredValue = parseInt(inputQuantity.val()) || 0;
    
        if (enteredValue > defaultValue) {
            alert("Vì số lượng sản phẩm chỉ có " + defaultValue + " nên không thể nhập hơn");
            inputQuantity.val(defaultValue);
        }
    });

    $('.add-cart').click(function() {
        var inputQuantity = $('#quantity-input');
        var quantity = parseInt(inputQuantity.val()) || 1;
        var productId = $(this).data('productid');
    
        var data = {
            product_id: productId,
            quantity: quantity
        };
    
        $.ajax({
            type: "POST",
            url: "/serein/addToCart",
            data: data,
            dataType: "json",
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    });

    $('.cart-delete').click(function() {
        var cartItemId = $(this).data('cart-id');
    
        var data = {
            product_id: cartItemId
        }
    
        $.ajax({
            type: "POST",
            url: "/serein/deleteToCart",
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if(response.success) {
                    alert('Xoa thanh cong');
                    $('#carts').html(response.html);
                } else {
                    alert("loi");
                }
            }
        });
    });
    

    $('#add-voucher').click(function() {
        var codeVoucher = $('#code-voucher').val();
        var data = {
            code: codeVoucher
        }

        $.ajax({
            type: "POST",
            url: "/serein/addVoucher",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.success) {
                    alert(response.message);
                }else {
                    $('.voucher-err').html(response.message);
                }
            }
        });
    })

    $('#btn-save-status').click(function () { 
        var order_id = $('#status').data('id-order');
        var statusOrder = $('#status option:selected').val();
        // console.log(order_id);
        // console.log(statusOrder);
        // alert('hello');
        var data = {
            order_id: order_id,
            status_id: statusOrder
        }
        $.ajax({
            type: "POST",
            url: "/serein/admin/orders/update/status",
            data: data,
            dataType: "JSON",
            success: function (response) {
                if(response.success) {
                    window.location.href = "http://localhost/serein/admin/orders"
                    alert(response.message);
                }else {
                    alert(response.message);
                }
            }
        });
    });


    // $("#btn-pay").click(function () { 
    //     $.ajax({
    //         type: "post",
    //         url: "/serein/orderPay",
    //         // dataType: "json",
    //         success: function (response) {
    //             if(response.success) {
    //                 alert(response.message);
    //             }else {
    //                 $('#message').html(response.message);
    //             }
    //         }
    //     });
    // });



});

function checkname() {
    if($('#name') == "") {
        $('#namel_err').html('Không được để trống');
    }
}

function checkuser() {
    var pattern = /^[A-Za-z0-9]+$/;
    var user = $('#username').val();
    var validuser = pattern.test(user);
    if ($('#username').val().length < 4) {
        $('#username_err').html('username length is too short');
        return false;
    } else if (!validuser) {
        $('#username_err').html('username should be a-z ,A-Z only');
        return false;
    } else {
        $('#username_err').html('');
        return true;
    }
}

function checkOTP() {
    var OTP = $('#OTP').val();
    var numericRegex = /^[0-9]+$/;

    if (!numericRegex.test(OTP) || OTP.length !== 6) {
        $('#otp_err').html('Mã OTP phải là 6 chữ số và chỉ chứa số.');
        return false;
    } else {
        $('#otp_err').html('');
        return true;
    }
}
function checkemail() {
    var pattern1 = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var email = $('#email').val();
    var validemail = pattern1.test(email);
    if (email == "") {
        $('#email_err').html('Không được để trống');
        return false;
    } else {
        if (!validemail) {
            $('#email_err').html('Không phải định dạng email');
            return false;
        } else {
            $('#email_err').html('');
            return true;
        }
    }
}
function checkpass() {
    var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var pass = $('#password').val();
    var validpass = pattern2.test(pass);

    if (pass == "") {
        $('#password_err').html('Mật khẩu không được bỏ trống');
        return false;
    } else if (!validpass) {
        $('#password_err').html('Mật khẩu phải trên 8 kí tự và tối đa 20 kí tự, ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt:');
        return false;

    } else {
        $('#password_err').html("");
        return true;
    }
}
function checkcpass() {
    var pass = $('#password').val();
    var cpass = $('#cpassword').val();
    if (cpass == "") {
        $('#cpassword_err').html('Xác nhận mật khẩu không được để trống');
        return false;
    } else if (pass !== cpass) {
        $('#cpassword_err').html('Xác nhận mật khẩu không khớp');
        return false;
    } else {
        $('#cpassword_err').html('');
        return true;
    }
}


function password_show_hide() {
    console.log('ok');
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}
