console.log("JS file connected.")

document.addEventListener("DOMContentLoaded", function () {
    
    let quantity = document.getElementById("quantity");
    let totalPrice = document.getElementById("totalPrice");
    let errorMsg = document.getElementById("errorMsg");

    quantity.addEventListener("input", function () {
        calculate_price(quantity, totalPrice, errorMsg);
    });

});

function calculate_price(quantity , totalPrice , errorMsg) {
    let unit_price = 1000;
    let days = 30;

    let q = parseInt(quantity.value);
    if (isNaN(q)) {
        q = 0;
    }

    // handle -ve
    if (q < 0) {
        errorMsg.textContent = "Quantity cannot be negative!";
        quantity.value = 0;
        q = 0;
    } 
    else {
        errorMsg.textContent = "";
    }

    // calculate total
    let total = unit_price * q * days;
    totalPrice.value = total;

    if (total > 1000) {
        alert("Eligible for a gift coupon");
    }

}