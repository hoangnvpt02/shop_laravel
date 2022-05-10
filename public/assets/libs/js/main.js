$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function updateRow(id, url) {
    if (confirm('Bạn có chắc chắn xác nhận đơn hàng ?')) {
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: {id},
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xác nhận đơn hàng không thành công vui lòng thử lại');
                }
            }
        })
    }
}

function removeRow(id, url) {
    if (confirm('Xóa mà không khôi phục. Bạn có chắc chắn ?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: {id},
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

// Upload File
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            if (results.error === false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a>');
                $('#thumb').val(results.url);
            } else {
                alert('Upload File lỗi');
            }
        }
    });
});

