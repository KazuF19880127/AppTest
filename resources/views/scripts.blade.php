<!-- resources/views/scripts.blade.php -->

<script>
    // 検索フォームの非同期処理
    $(document).ready(function() {
        $('form#search-form').on('submit', function(e) {
            e.preventDefault(); // デフォルトのsubmitをキャンセル

            var formData = $(this).serialize(); // フォームデータを取得

            // Ajaxリクエストを送信
            $.ajax({
                url: '{{ route('products.index') }}',
                method: 'GET',
                data: formData,
                success: function(response) {
                    $('#products-table').html(response);
                    console.log('ソートが完了しました'); 
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.log('ソートできません');
                }
            });
        });
    });

    // 商品の削除処理の非同期処理
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');

        // Ajaxリクエストを送信
        $.ajax({
            url: url,
            method: 'DELETE',
            success: function(response) {
                $('#product-row-' + response.deletedProductId).remove(); // 削除された商品の行を削除
                alert('削除が完了しました');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('削除に失敗しました');
            }
        });
    });

    
</script>
