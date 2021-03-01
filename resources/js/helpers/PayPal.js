paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '0.01'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function() {
            alert('Transaction completed by SC');
        });
    }
}).render('.paypal-buttons');
