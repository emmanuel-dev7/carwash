@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Test Email') }}</h1>
    <form action="{{ route('test-email.send') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="client_id" class="block text-sm font-medium">{{ __('Select Client') }}</label>
            <select name="client_id" id="client_id" class="border p-2 w-full" required>
                <option value="">{{ __('Choose a client') }}</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Send Test Email') }}</button>
    </form>
@endsection
