
// ********* Notification MOdal ********* //

    $('.pickup-checkbox').on('change', function() {
        var $checkbox = $(this);  
        var customerId = $checkbox.data('id');
        var remark = $checkbox.data('remark');

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to mark this as ' + remark + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
        }).then((result) => {
            if (result.isConfirmed) {
            
                $.ajax({
                    url: 'update_remark.php',
                    type: 'POST',
                    data: {
                        customer_id: customerId,
                        remark: remark,
                        type: 'pickup'  
                    },
                    success: function(response) {
                        console.log('Response from update_remark.php:', response); 

                
                        if (remark === 'Claimed' || remark === 'Undelivered' || remark === 'Unclaimed' || remark === 'Pending') {
                            $checkbox.closest('.notification-item').remove(); 
                            updatePickupRemarks();  
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error); 
                    }
                });
            } else {
            
                $checkbox.prop('checked', !$checkbox.prop('checked'));
            }
        });
    });


    $('.delivery-checkbox').on('change', function() {
        var $checkbox = $(this);  
        var customerId = $checkbox.data('id');
        var remark = $checkbox.data('remark');

    
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to mark this as ' + remark + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true,
            customClass: {
                confirmButton: 'swal-confirm-btn',
                cancelButton: 'swal-cancel-btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
        
                $.ajax({
                    url: 'update_remark.php',
                    type: 'POST',
                    data: {
                        customer_id: customerId,
                        remark: remark,
                        type: 'delivery'
                    },
                    success: function(response) {
                        console.log('Response from update_remark.php:', response);

                    
                        if (remark === 'Delivered' || remark === 'Undelivered' || remark === 'Unclaimed' || remark === 'Pending') {
                            $checkbox.closest('.notification-item').remove(); 
                            updateDeliveryRemarks();  
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            } else {
            
                $checkbox.prop('checked', !$checkbox.prop('checked'));
            }
        });
    });


    function updatePickupRemarks() {
        console.log('Updating Pickup remarks...');
    }

    function updateDeliveryRemarks() {
        console.log('Updating Delivery remarks...');
    }

    // Reload the modal when it's closed
    $(document).ready(function() {
        $('#pickupModal').on('hidden.bs.modal', function () {
            location.reload();  
        });

        $('#deliveryModal').on('hidden.bs.modal', function () {
            location.reload();  
        });

        $('#rushModal').on('hidden.bs.modal', function () {
            location.reload();  
        });
    });
