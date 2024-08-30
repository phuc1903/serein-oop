function CheckQuantity(quantity) {
    var inputElement = $(quantity);
    var inputValue = inputElement.val();

    var numericValue = inputValue.replace(/\D/g, '');

    inputElement.val(numericValue);

    var num = parseInt(numericValue);

    if(inputValue == "") {
        inputElement.val(1);
    }

    if (isNaN(num) || num <= 0) {
        inputElement.val();
        alert("Bạn chỉ được nhập số và số phải lớn hơn 0");
    }

    var defaultQuantity = parseInt(inputElement.data('default-quantity'));

    if (num > defaultQuantity) {
        inputElement.val(defaultQuantity);
    }
}


function PreQuantity(element) {
    var inputElement = $(element).closest('.choice__quantity').find('.input-quantity-cart');
    var quantity = parseInt(inputElement.val());

    var defaultQuantity = parseInt(inputElement.data('default-quantity'));

    if (quantity > defaultQuantity - 1) {
        alert("Sản phẩm đã giới hạn số lượng của kho");
        inputElement.val(defaultQuantity);
    }
    var productId = inputElement.data('id');

    var data = {
        'product_id' : productId,
        'quantity' : quantity
    }

    $.ajax({
        type: "POST",
        url: "/serein/cart/quantity/subtract",
        data: data,
        dataType: "json",
        success: function (response) {
            // inputElement.val(response.cart_quantity);
            // console.log(response);
            if(response.success) {
                $('#carts').html(response.html);
            }
        }
    });
}

function AddQuantity(element) {
    var inputElement = $(element).closest('.choice__quantity').find('.input-quantity-cart');
    var quantity = parseInt(inputElement.val());

    var defaultQuantity = parseInt(inputElement.data('default-quantity'));

    if (quantity > defaultQuantity - 1) {
        alert("Sản phẩm đã giới hạn số lượng của kho");
        inputElement.val(defaultQuantity);
    }
    var productId = inputElement.data('id');

    var data = {
        'product_id' : productId,
        'quantity' : quantity
    }

    $.ajax({
        type: "POST",
        url: "/serein/cart/quantity/add",
        data: data,
        dataType: "json",
        success: function (response) {
            // inputElement.val(response.cart_quantity);
            // console.log(response);
            if(response.success) {
                $('#carts').html(response.html);
            }
        }
    });
}

$('#btn-pay').click(function (e) { 
    e.preventDefault();
    var check = confirm('Bạn đồng ý thanh toán đơn hàng này');
    if(check) {
        $.ajax({
           type: "GET",
           url: "/serein/addOrder",
           dataType: "json",
           success: function (response) {
            //    console.log(response);
               if(response.success) {
                   window.location.href = "http://localhost/serein/order";
                   alert(response.message);
               }else {
                    alert(response.message);
               }
           }
        });
    }
});
