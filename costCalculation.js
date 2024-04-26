let unitPrice = document.getElementsByClassName('content-price');
let quantity = document.getElementsByClassName('quantity');
let cost = document.getElementsByClassName('content-cost');
let decrease = document.getElementsByClassName('decrease');
let increase = document.getElementsByClassName('increase');
let total = document.getElementById('total');
let numberOfItems = unitPrice.length;
let totalPrice = 0;

for (let i = 0; i < numberOfItems; i++) {
    sum(i);
    totalPriceCal();
    increase[i].addEventListener('click', function () {
        return change(i, 1);
    });
    decrease[i].addEventListener('click', function () {
        return change(i, -1);
    });
}

// change quantity of an item
function change(m, n) {
    let quantityValue = parseInt(quantity[m].value);
    quantityValue += n;
    if (quantityValue < 0) {
        quantityValue = 0;
    }
    quantity[m].value = quantityValue;
    sum(m);
    totalPriceCal();
}

// calculate sumary price of an item
function sum(x) {
    let unitPriceValue = parseFloat(unitPrice[x].innerText);
    let quantityValue = parseInt(quantity[x].value);
    let costValue = unitPriceValue * quantityValue;
    cost[x].innerText = costValue.toFixed(2).toString();
}

// calculate total price of items
function totalPriceCal() {
    let totalPrice = 0;
    for (let i = 0; i < numberOfItems; i++) {
        totalPrice = totalPrice + parseFloat(cost[i].innerText);
        total.innerText = totalPrice.toFixed(2).toString();
    }
}
