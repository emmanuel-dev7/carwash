@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Add Client') }}</h1>
    <form action="{{ route('clients.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium">{{ __('Phone') }}</label>
            <input type="text" name="phone" id="phone" class="border p-2 w-full">
        </div>
        <div class="mb-4">
            <label for="loyalty_points" class="block text-sm font-medium">{{ __('Loyalty Points') }}</label>
            <input type="number" name="loyalty_points" id="loyalty_points" class="border p-2 w-full" value="0">
        </div>
        <div class="mb-4">
            <label for="discount_percentage" class="block text-sm font-medium">{{ __('Discount Percentage') }}</label>
            <input type="number" name="discount_percentage" id="discount_percentage" class="border p-2 w-full" value="0" step="0.01">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Save') }}</button>
    </form>
@endsection
