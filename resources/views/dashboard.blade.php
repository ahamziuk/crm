@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Панель керування CRM</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Замовлення</h2>
                <p><a href="{{ route('orders.index') }}" class="text-blue-500 underline">Переглянути замовлення</a></p>
            </div>
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Клієнти</h2>
                <p><a href="{{ route('clients.index') }}" class="text-blue-500 underline">Переглянути клієнтів</a></p>
            </div>
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Товари</h2>
                <p><a href="{{ route('products.index') }}" class="text-blue-500 underline">Переглянути товари</a></p>
            </div>
        </div>
    </div>
@endsection
