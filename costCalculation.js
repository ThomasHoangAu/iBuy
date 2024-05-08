let unitPrice = document.getElementsByClassName('content-price');
let quantity = document.getElementsByClassName('quantity');
let cost = document.getElementsByClassName('content-cost');
let decrease = document.getElementsByClassName('decrease');
let increase = document.getElementsByClassName('increase');
let total = document.getElementById('total');
let gst = document.getElementById('gst');

let numberOfItems = unitPrice.length;

for (let i = 0; i < numberOfItems; i++) {
    sum(i);

    increase[i].addEventListener('click', function () {
        return change(i, 1);
    });
    decrease[i].addEventListener('click', function () {
        return change(i, -1);
    });
}

totalPriceCal();
gstCal();

// change quantity of an item
function change(m, n) {
    let quantityValue = parseInt(quantity[m].value);
    quantityValue += n;
    if (quantityValue < 1) {
        quantityValue = 1;
    }
    quantity[m].value = quantityValue;
    sum(m);
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
    }
    total.innerText = totalPrice.toFixed(2).toString();
}

//calculate gst
function gstCal() {
    gst.innerText = (parseFloat(total.innerText) * 0.1).toFixed(2).toString();
}

let gstInput = document.getElementById('gstInput');
gstInput.value = parseFloat(gst.innerText).toFixed(2);

let totalInput = document.getElementById('totalInput');
totalInput.value = parseFloat(total.innerText).toFixed(2);
