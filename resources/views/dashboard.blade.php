{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Total Clients</h2>
            <p class="text-2xl">{{ $totalClients }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Total Appointments</h2>
            <p class="text-2xl">{{ $totalAppointments }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Total Revenue</h2>
            <p class="text-2xl">{{ number_format($totalRevenue, 2) }} €</p>
        </div>
    </div>
    <h2 class="text-xl font-bold mt-8 mb-4">Popular Services</h2>
    <ul class="bg-white p-6 rounded shadow">
        @foreach ($popularServices as $service)
            <li>{{ $service->name }} ({{ $service->appointments_count }} appointments)</li>
        @endforeach
    </ul>
@endsection
