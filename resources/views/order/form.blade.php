
<form id="form-order" method="POST" action="{{ url('/order') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $OrderForm->input('product_id') }}">

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label for="delivery-date" class="form-label">配送日</label>
                <select name="delivery_date" class="form-select" id="delivery-date">
                    <option value>選択してください</option>
                    @foreach($OrderForm->default("delivery_dates") as $delivery_date)
                    <option value="{{ $delivery_date['value'] }}" 
                            @if($OrderForm->input('delivery_date') === $delivery_date['value']) selected @endif>
                        {{ $delivery_date['display'] }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="postcode" class="form-label">郵便番号</label>
                <input type="text" name="postcode" placeholder="0000000" class="form-control" id="postcode" value="{{ $OrderForm->input("postcode") }}">
            </div>

            <div class="mb-3">
                <label for="prefecture" class="form-label">都道府県</label>
                <input type="text" name="prefecture" class="form-control" id="prefecture" value="{{ $OrderForm->input("prefecture") }}">
            </div>

            <div class="mb-3">
                <label for="municipality" class="form-label">市区町村</label>
                <input type="text" name="municipality" class="form-control" id="municipality" value="{{ $OrderForm->input("municipality") }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">番地</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ $OrderForm->input("address") }}">
            </div>

            <div class="mb-3">
                <label for="building" class="form-label">建物名・部屋番号</label>
                <input type="text" name="building" class="form-control" id="building" value="{{ $OrderForm->input("building") }}">
            </div>

        </div>
    </div>
    <div class="form-bottom">
        <button type="button" class="btn" id="btn-order">購入</button>
    </div>
</form>