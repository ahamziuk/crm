@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати замовлення #{{ $order->id }}</h1>

    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="client_id" class="form-label">Клієнт</label>
            <select name="client_id" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $order->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} ({{ $client->phone }})
                    </option>
                @endforeach
            </select>
        </div>

        <h4>Товари</h4>
        <div id="products-wrapper">
            @foreach($order->items as $index => $item)
            <div class="row mb-2 product-row">
                <div class="col">
                    <select name="products[{{ $index }}][id]" class="form-control" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->price }} грн)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="number" name="products[{{ $index }}][qty]" class="form-control" value="{{ $item->qty }}" required min="1">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger remove-row">✖</button>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-product" class="btn btn-secondary mb-3">+ Додати товар</button>

        <div class="mb-3">
            <label for="note" class="form-label">Нотатка</label>
            <textarea name="note" class="form-control">{{ $order->note }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let i = {{ $order->items->count() }};
    document.getElementById('add-product').onclick = function () {
        const wrapper = document.getElementById('products-wrapper');
        const row = document.querySelector('.product-row').cloneNode(true);
        row.querySelectorAll('select, input').forEach(el => {
            const name = el.name.replace(/\d+/, i);
            el.name = name;
        });
        wrapper.appendChild(row);
        i++;
    };

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const rows = document.querySelectorAll('.product-row');
            if (rows.length > 1) {
                e.target.closest('.product-row').remove();
            }
        }
    });
});
</script>
@endsection
