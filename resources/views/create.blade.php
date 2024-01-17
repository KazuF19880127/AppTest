@extends('appp')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-size: 1.5rem;">商品登録画面</h2>
                <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div style="text-align: left;">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                    
                        <input type="text" name="product_name" class="form-control" placeholder="商品名">
                        @if($errors->has('product_name'))
                            <p class="text-danger">{{ $errors->first('product_name') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                      
                        <input type="text" name="price" class="form-control" placeholder="価格">
                        @if($errors->has('price'))
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                        <label for="company_id">メーカー名</label>
                        <select name="company_id" class="form-select">
                            <option>分類を選択してください</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('company_id'))
                            <p class="text-danger">{{ $errors->first('company_id') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    
                    <div class="col-md-10">
                        <input id="stock" type="number" class="form-control" name="stock" placeholder="在庫数" value="{{ old('stock', $product->stock ?? '') }}">
                        @if($errors->has('stock'))
                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                    
                        <textarea class="form-control" style="height:100px" name="comment" placeholder="詳細"></textarea>
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                        <label for="img_path">商品画像</label>
                        <input type="file" class="form-control" id="img_path" name="img_path">
                        @if($errors->has('img_path'))
                            <p class="text-danger">{{ $errors->first('img_path') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-2 mt-2">
                    <button type="submit" class="btn btn-primary w-100">登録</button>
                </div>
            </div>
        </form>
    </div>
@endsection
