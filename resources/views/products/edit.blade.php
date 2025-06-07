@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати товар</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Кількість на складі</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
