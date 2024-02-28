<!-- resources/views/index.blade.php -->

@extends('appp')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-size: 1.5rem;">商品マスター</h2>
                @auth
                    <a class="btn btn-success" href="{{ route('products.create') }}">新規登録</a>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth
            </div>
            
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <form action="{{ route('products.index') }}" method="GET">
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="product_name">商品名検索:</label>
                    <input type="text" class="form-control" name="product_name" value="{{ request('product_name') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="company_id">メーカー名検索:</label>
                    <select class="form-control" name="company_id">
                        <option value="">選択してください</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="min_price">価格(下限):</label>
                    <input type="text" class="form-control" name="min_price" value="{{ request('min_price') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="max_price">価格(上限):</label>
                    <input type="text" class="form-control" name="max_price" value="{{ request('max_price') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="min_stock">在庫数(下限):</label>
                    <input type="text" class="form-control" name="min_stock" value="{{ request('min_stock') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="max_stock">在庫数(上限):</label>
                    <input type="text" class="form-control" name="max_stock" value="{{ request('max_stock') }}">
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">検索</button>
    </form>

    <table class="table table-bordered mt-4 text-center">
        <thead>
            <tr>
                <th scope="col">@sortablelink('id', 'No')</th>
                <th>商品画像</th>
                <th scope="col">@sortablelink('product_name', '商品名')</th>
                <th scope="col">@sortablelink('price', '価格')</th>
                <th scope="col">@sortablelink('company_id', 'メーカー名')</th>
                <th scope="col">@sortablelink('stock','在庫数')</th>
                <th>詳細確認</th>
                <th>削除注意</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr id="product-row-{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td>
                        <div class="col-md-10">
                            @if($product->img_path)
                                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 50px;">
                            @else
                                <p>画像なし</p>
                            @endif
                        </div>
                    </td>
                    <td scope="row">{{ $product->product_name }}</td>
                    <td>{{ $product->price }}円</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}?page_id={{ $page_id }}" class="btn btn-primary">詳細</a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn" onclick="return confirm('削除しますか？');">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $products->links('pagination::bootstrap-5') !!}
@endsection
