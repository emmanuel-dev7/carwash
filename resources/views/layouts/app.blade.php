<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Car Wash') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">{{ __('Car Wash') }}</a>
            <div>
                <a href="{{ route('clients.index') }}" class="mr-4">{{ __('Clients') }}</a>
                <a href="{{ route('services.index') }}" class="mr-4">{{ __('Services') }}</a>
                <a href="{{ route('appointments.index') }}" class="mr-4">{{ __('Appointments') }}</a>
                <a href="{{ route('employees.index') }}" class="mr-4">{{ __('Employees') }}</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white">{{ __('Logout') }}</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="container mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
