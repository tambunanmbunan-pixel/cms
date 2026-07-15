$(document).on('click', '.updateSubadminStatus', function() {
    var clickedElement = $(this);
    var subadmin_id = clickedElement.data('subadmin_id');
    var currentStatus = clickedElement.find('i').attr('data-status'); 
    var statusValue = (currentStatus === "Active") ? 0 : 1; 

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: window.location.origin + '/admin/update-subadmin-status',
        data: { 
            admin_id: subadmin_id, 
            status: statusValue 
        },
        success: function(resp) {
            if (resp.status === 'success') {
                var toggleBox = clickedElement.find('.w-11');
                
                // Menyesuaikan perpindahan warna track sakelar Tailwind v4 saat diklik
                if (statusValue === 1) {
                    toggleBox.removeClass('bg-gray-200 justify-start').addClass('bg-emerald-500 justify-end');
                    clickedElement.find('i').attr('data-status', 'Active');
                } else {
                    toggleBox.removeClass('bg-emerald-500 justify-end').addClass('bg-gray-200 justify-start');
                    clickedElement.find('i').attr('data-status', 'Inactive');
                }
                console.log('Status Oracle Berhasil Diperbarui!');
            } else {
                alert('Gagal memperbarui status.');
            }
        },
        error: function(xhr) {
            alert('Error AJAX!');
            console.log(xhr.responseText);
        }
    });
});