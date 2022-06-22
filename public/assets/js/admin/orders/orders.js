function confirmOrder(orderId) {
    Swal.fire({
        title: "Confirm ?",
        text: "Are you sure to confirm this order?",
        input: 'text',
        inputValue: 'Order is being confirmed',
        confirmButtonText: "Yes Confirm",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'You need to write some remark !'
            }
        }
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'orders/confirm',
                data: {
                    orderId: orderId,
                    remark:result.value,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        orderList.draw();
                    }
                }
            });
        }
    });
}

function processOrder(orderId) {
    Swal.fire({
        title: "Process ?",
        text: "Are you sure to mark processing this order?",
        input: 'text',
        inputValue: 'Order is being processed',
        confirmButtonText: "Yes Confirm",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'You need to write some remark !'
            }
        }
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'orders/mark-processeing',
                data: {
                    orderId: orderId,
                    remark:result.value,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        orderList.draw();
                    }
                }
            });
        }
    });
}

function shippOrder(orderId) {
    Swal.fire({
        title: "Ship ?",
        text: "Are you sure to mark shipping this order?",
        input: 'text',
        inputValue: 'Order is being shipped',
        confirmButtonText: "Yes Confirm",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'You need to write some remark !'
            }
        }
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'orders/mark-shipped',
                data: {
                    orderId: orderId,
                    remark:result.value,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        orderList.draw();
                    }
                }
            });
        }
    });
}

function deliverOrder(orderId) {
    Swal.fire({
        title: "Deliver ?",
        text: "Are you sure to mark delivered this order?",
        input: 'text',
        inputValue: 'Order is being delivered',
        confirmButtonText: "Yes Confirm",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'You need to write some remark !'
            }
        }
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'orders/mark-delivered',
                data: {
                    orderId: orderId,
                    remark:result.value,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        orderList.draw();
                    }
                }
            });
        }
    });
}


function cancelOrder(orderId) {
    Swal.fire({
        title: "Cancel !",
        text: "Are you sure to cancel this order ?",
        input: 'text',
        inputValue: 'Order canceled due to invalid action',
        confirmButtonText: "Yes Cancel it",
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return 'You need to write some remark !'
            }
        }
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'orders/cancel',
                data: {
                    orderId: orderId,
                    remark:result.value,
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Success!', response.message, 'success');
                        orderList.draw();
                    }
                }
            });
        }
    });
}
