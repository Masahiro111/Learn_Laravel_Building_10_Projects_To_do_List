<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($todos) > 0)
                    @foreach ($todos as $todo)
                    <div class="card">
                        <h2>{{ $todo->title }}</h2>
                        <h3>{{ $todo->content }}</h3>
                        <span class="label label-danger">{{ $todo->due }}</span>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>