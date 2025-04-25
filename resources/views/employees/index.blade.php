@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Employees') }}</h1>
    <a href="{{ route('employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">{{ __('Add Employee') }}</a>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-4 text-left">{{ __('Name') }}</th>
                <th class="p-4 text-left">{{ __('Role') }}</th>
                <th class="p-4 text-left">{{ __('Hours Worked') }}</th>
                <th class="p-4 text-left">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td class="p-4">{{ $employee->name }}</td>
                    <td class="p-4">{{ $employee->role }}</td>
                    <td class="p-4">{{ $employee->hours_worked }}</td>
                    <td class="p-4">
                        <a href="{{ route('employees.edit', $employee) }}" class="text-blue-600">{{ __('Edit') }}</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
