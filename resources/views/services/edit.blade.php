@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Edit Service') }}</h1>
    <form action="{{ route('services.update', $service) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="border p-2 w-full" value="{{ $service->name }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="border p-2 w-full">{{ $service->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium">{{ __('Price') }}</label>
            <input type="number" name="price" id="price" class="border p-2 w-full" value="{{ $service->price }}" step="0.01" required>
        </div>
        <div class="mb-4">
            <label for="vehicle_type" class="block text-sm font-medium">{{ __('Vehicle Type') }}</label>
            <input type="text" name="vehicle_type" id="vehicle_type" class="border p-2 w-full" value="{{ $service->vehicle_type }}">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Update') }}</button>
    </form>
@endsection
