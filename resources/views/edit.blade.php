@extends('appp')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size: 1.5rem;">編集画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('products.show', $product->id) }}">戻る</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row mt-3">
        <!-- 商品情報IDの表示 -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="product_name">商品情報ID:</label>
                <input type="text" class="form-control" value="{{ $product->id }}" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 商品名フォームフィールド -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="product_name">商品名:</label>
                <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" placeholder="商品名">
                @if($errors->has('product_name'))
                    <p class="text-danger">{{ $errors->first('product_name') }}</p>
                @endif
            </div>
        </div>

        <!-- 価格フォームフィールド -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="price">価格:</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}" placeholder="価格">
                @if($errors->has('price'))
                    <p class="text-danger">{{ $errors->first('price') }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- メーカー名フォームフィールド -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="company_id">メーカー名:</label>
                <select name="company_id" class="form-select">
                    <option>分類を選択してください</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('company_id'))
                    <p class="text-danger">{{ $errors->first('company_id') }}</p>
                @endif
            </div>
        </div>

        <!-- 在庫数フォームフィールド -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="stock">在庫数:</label>
                <input id="stock" type="number" class="form-control" name="stock" value="{{ $product->stock }}">
                @if($errors->has('stock'))
                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- 詳細フォームフィールド -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment">詳細:</label>
                <textarea class="form-control" name="comment" rows="4" placeholder="詳細">{{ $product->comment }}</textarea>
            </div>
        </div>
    </div>

    <!-- 商品画像フォームフィールド -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="img_path">商品画像:</label>
                <input type="file" class="form-control" id="img_path" name="img_path">
                @if($errors->has('img_path'))
                    <p class="text-danger">{{ $errors->first('img_path') }}</p>
                @endif
            </div>
        </div>
        <!-- 現在の商品画像表示 -->
        <div class="col-md-6">
            <label for="img_path">現在の商品画像:</label>
            @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="img-thumbnail" style="max-width: 150px;">
            @else
                <p>画像なし</p>
            @endif
        </div>
    </div>

    <!-- 更新ボタン -->
    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">更新</button>
        </div>
    </div>

</form>
@endsection
