    {{ csrf_field() }}
    @can('update_art', \Kajifat\SampleProducts\Product::class)
        <div class="form-group{{ $errors->has('art') ? ' has-error' : '' }}">
            <label for="art" class="col-md-4 control-label">Product art</label>

            <div class="col-md-6">
                <input id="art" type="text" class="form-control" name="art" value="{{old('art', isset($product->art)? $product->art : '')}}">

                @if ($errors->has('art'))
                    <span class="help-block">
                        <strong>{{ $errors->first('art') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endcan
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Product name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{old('name', isset($product->name)? $product->name : '')}}">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                {{$submitButtonText}}
            </button>
        </div>
    </div>
