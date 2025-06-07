@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Створити замовлення</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Клієнт</label>
            <select name="client_id" class="form-select" required>
                <option value="">Оберіть клієнта</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->full_name }} | {{ $client->phone }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="products" class="form-label">Товари</label>
            <div id="product-list">
                @foreach ($products as $product)
                    <div class="d-flex mb-2">
                        <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}">
                        <label class="me-2">{{ $product->name }} ({{ $product->price }} грн)</label>
                        <input type="number" name="products[{{ $loop->index }}][qty]" class="form-control w-25" value="1" min="1">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="city_ref" class="form-label">Місто (Нова Пошта)</label>
            <select name="city_ref" id="city_ref" class="form-select" required>
                <option value="">Оберіть місто</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="warehouse_ref" class="form-label">Відділення (Нова Пошта)</label>
            <select name="warehouse_ref" id="warehouse_ref" class="form-select" required>
                <option value="">Оберіть відділення</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Примітка</label>
            <textarea name="note" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Створити</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const citySelect = document.getElementById('city_ref');
    const warehouseSelect = document.getElementById('warehouse_ref');

    // Підвантаження міст
    fetch('/novaposhta/cities')
        .then(res => res.json())
        .then(data => {
            citySelect.innerHTML = '<option value="">Оберіть місто</option>';
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.Ref;
                option.text = city.Description;
                citySelect.appendChild(option);
            });
        });

    // Зміна міста — завантажити відділення
    citySelect.addEventListener('change', function () {
        const ref = this.value;
        warehouseSelect.innerHTML = '<option>Завантаження...</option>';
        fetch(`/novaposhta/warehouses/${ref}`)
            .then(res => res.json())
            .then(data => {
                warehouseSelect.innerHTML = '<option value="">Оберіть відділення</option>';
                data.forEach(wh => {
                    const option = document.createElement('option');
                    option.value = wh.Ref;
                    option.text = wh.Description;
                    warehouseSelect.appendChild(option);
                });
            });
    });
});
</script>
@endsection
