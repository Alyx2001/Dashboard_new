
// ********* Notification MOdal ********* //

// Update Pickup Remarks
$('.pickup-checkbox').on('change', function() {
    var $checkbox = $(this);  
    var customerId = $checkbox.data('id');
    var remark = $checkbox.data('remark');

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

            if (remark === 'Claimed') {
                $checkbox.closest('.notification-item').remove(); 
                updatePickupRemarks();  
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error); 
        }
    });
});

// Update Delivery Remarks
$('.delivery-checkbox').on('change', function() {
    var $checkbox = $(this);  
    var customerId = $checkbox.data('id');
    var remark = $checkbox.data('remark');

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

            if (remark === 'Delivered') {
                $checkbox.closest('.notification-item').remove(); 
                updateDeliveryRemarks();  
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
});

// Function to update Pickup remarks in the UI
function updatePickupRemarks() {
    console.log('Updating Pickup remarks...');
}

// Function to update Delivery remarks in the UI
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
