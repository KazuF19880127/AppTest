// resources/js/delete.js

$(document).ready(function() {
    $('.delete-btn').click(function(e) {
        e.preventDefault(); // デフォルトのリンククリックをキャンセル
        
        var deleteUrl = $(this).attr('href'); // 削除リンクのURLを取得
        
        $.ajax({
            type: 'DELETE',
            url: deleteUrl, // 商品を削除するルート
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    // 削除が成功した場合は、該当の行をテーブルから削除
                    $('#product-row-' + data.product_id).remove();
                } else {
                    console.error('削除に失敗しました');
                }
            },
            error: function(xhr, status, error) {
                console.error(error); // エラーログをコンソールに出力
            }
        });
    });
});
