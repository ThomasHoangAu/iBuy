let quantity = document.getElementById('quantity');
let quantityValue = parseInt(quantity.value);
function change(n) {
    quantityValue += n;
    if (quantityValue < 1) {
        quantityValue = 1;
    }
    quantity.value = quantityValue;
}
