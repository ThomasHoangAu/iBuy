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

// Change quantity of an item and get total cost of the cart
function change(m, n) {
    let quantityValue = parseInt(quantity[m].value);
    quantityValue += n;
    if (quantityValue < 1) {
        quantityValue = 1;
    }
    quantity[m].value = quantityValue;
    sum(m);
}

// Calculate sumary price of an item
function sum(x) {
    let unitPriceValue = parseFloat(unitPrice[x].innerText);
    let quantityValue = parseInt(quantity[x].value);
    let costValue = unitPriceValue * quantityValue;
    cost[x].innerText = costValue.toFixed(2).toString();
}

// Calculate total price of items
function totalPriceCal() {
    let totalPrice = 0;
    for (let i = 0; i < numberOfItems; i++) {
        totalPrice = totalPrice + parseFloat(cost[i].innerText);
    }
    total.innerText = totalPrice.toFixed(2).toString();
}

// Calculate gst
function gstCal() {
    gst.innerText = (parseFloat(total.innerText) * 0.1).toFixed(2).toString();
}

// Pass total and gst values to hidden inputs
let gstInput = document.getElementById('gstInput');
gstInput.value = parseFloat(gst.innerText).toFixed(2);

let totalInput = document.getElementById('totalInput');
totalInput.value = parseFloat(total.innerText).toFixed(2);

// Paypal button
function initPayPalButton() {
    paypal
        .Buttons({
            style: {
                shape: 'rect',
                layout: 'vertical',
                label: 'paypal',
                height: 40,
            },

            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [
                        {
                            amount: {
                                currency_code: 'AUD',
                                value: parseFloat(total.innerText).toFixed(2),
                            },
                        },
                    ],
                });
            },

            onApprove: function (data, actions) {
                orderData = '';
                return actions.order.capture().then(function (orderData) {
                    // Full available details
                    console.log(
                        'Capture result',
                        orderData,
                        JSON.stringify(orderData, null, 2)
                    );

                    // Show a success message within this page, for example:
                    const element = document.getElementById(
                        'paypal-button-container'
                    );
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            },

            onError: function (err) {
                console.log(err);
            },
        })
        .render('#paypal-button-container');
}
initPayPalButton();
