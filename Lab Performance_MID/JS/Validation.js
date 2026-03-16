console.log("JS file connected.");

function updateTotal(){
    
    let quantityInput = document.getElementById("quantity");
    let totalPriceInput = document.getElementById("totalPrice");
    let errorMsg = document.getElementById("errorMsg");

    let quantity = parseInt(quantityInput.value) || 0;
    console.log(quantity);

    if (quantity < 0) {
        errorMsg.innerHTML = "Quantity can't be negative";
        errorMsg.style.color = "red";

        quantityInput.value = 0;
        totalPriceInput.value = 0;
        return;
    } else {
        errorMsg.innerHTML = "";
    }

    let unit_price = 1000;
    let days = 30;
    
    let total = quantity * unit_price * days;
    totalPriceInput.value = total;

    if (total > 1000) {
        alert("Eligible for a gift coupon");
    }
}