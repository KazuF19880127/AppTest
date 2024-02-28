// resources/js/search.js

$(document).ready(function() {
    $('#search-form').submit(function(e) {
        e.preventDefault(); // デフォルトのフォーム送信をキャンセル
        
        var formData = $(this).serialize(); // フォームデータをシリアライズ
        
        $.ajax({
            type: 'GET',
            url: '{{ route("products.index") }}', // 商品を検索するコントローラーのルート
            data: formData, // 検索フォームのデータを送信
            success: function(data) {
                $('#product-table').html(data); // 検索結果を表示するテーブルを更新
            },
            error: function(xhr, status, error) {
                console.error(error); // エラーログをコンソールに出力
            }
        });
    });
});
