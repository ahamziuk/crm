@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати товар</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Кількість на складі</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Зберегти</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
