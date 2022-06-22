function manageWalletRequest(walletId,actionStatus,customerId) {
    let actionMessage = (actionStatus == 2 ? "confirm":"archive");
    actionMessage = capitalizeFirstLetter(actionMessage);
    Swal.fire({
        title: actionMessage,
        text: "Are you sure to "+actionMessage.toLowerCase() +" this ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes "+actionMessage,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'admin/wallet/change-status',
                data: {
                    walletId: walletId,
                    actionStatus: actionStatus,
                    customerId: customerId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        walletRequestList.draw();
                    }
                }
            });
        }
    });
}
