let quantity = document.getElementById('quantity');
let quantityValue = parseInt(quantity.value);
function change(n) {
    quantityValue += n;
    if (quantityValue < 0) {
        quantityValue = 0;
    }
    quantity.value = quantityValue;
}
