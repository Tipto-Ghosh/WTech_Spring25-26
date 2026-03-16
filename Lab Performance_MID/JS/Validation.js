console.log("JS file connected.");

function updateTotal(){
    
    let quantityInput = document.getElementById("quantity");
    let totalPriceInput = document.getElementById("totalPrice");
    let errorMsg = document.getElementById("errorMsg");

    let quantity = parseInt(quantityInput.value) || 0;
    console.log(quantity);

    
}