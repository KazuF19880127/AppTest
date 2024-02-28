@section('scripts')
<script>
$(document).ready(function() {
    // ソート可能なテーブルのヘッダーをクリックしたときの処理
    $('.sortable-table th.sortable').off('click').on('click', function() {
        var column = $(this).index(); // クリックされた列のインデックスを取得
        var sortOrder = $(this).data('sort-order') || 'asc'; // ソート順を取得（デフォルトは昇順）
       
        // ソート順を切り替える
        sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
        $(this).data('sort-order', sortOrder);
    
        // すべての列からソートのクラスを削除し、クリックされた列にソートのクラスを追加
        $('.sortable-table th').removeClass('sorted');
        $(this).addClass('sorted');
      
        // ソートの方向に応じて矢印を表示
        $('.sortable-table th i').removeClass().addClass('fa fa-sort');
        $(this).find('i').removeClass().addClass(sortOrder === 'asc' ? 'fa fa-sort-up' : 'fa fa-sort-down');
  
        //Ajaxリクエストを作成して、ソートされたデータを取得
        $.ajax({
            url: '{{ route("products.index") }}',
            type: 'GET',
            data: {
                column: column,
                sort_order: sortOrder
            },
            success: function(response) {
                // 成功時の処理: 商品リストを更新
                console.log(response)
                $('.table tbody').html(response);
            },
            error: function(xhr, status, error) {
                // エラー時の処理
                console.error('Request failed. Status: ' + status + ', Error: ' + error);
            }
        });
    });
});
</script>
@endsection
