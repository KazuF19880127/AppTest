@extends('appp')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="font-size: 1.5rem;">詳細画面</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.index') }}?page={{ $page_id }}">戻る</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th style="width: 20%;">商品情報ID:</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>商品名:</th>
                <td>{{ $product->product_name }}</td>
            </tr>
            <tr>
                <th>価格:</th>
                <td>{{ $product->price }}</td>
            </tr>
            <tr>
                <th>メーカー名:</th>
                <td>
                    @foreach ($companies as $company)
                        @if ($product->company_id == $company->id)
                            {{ $company->company_name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>在庫数:</th>
                <td>{{ $product->stock }}</td>
            </tr>
            <tr>
                <th>詳細:</th>
                <td>{{ $product->comment }}</td>
            </tr>
            <tr>
                <th>商品画像:</th>
                <td>
                    <div class="form-group row">
                        <div class="col-md-12">
                            @if($product->img_path)
                                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 150px;">
                            @else
                                <p>画像なし</p>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 編集ボタン -->
    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">編集</a>
        </div>
    </div>
@endsection
