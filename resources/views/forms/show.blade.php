<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </x-slot>

    {{-- navbar --}}
    <nav class="navbar navbar-default bg-gray-800">

        {{-- link --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="/">Home</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 mt-4">
                <div class="card p-4">
                    <p>Name: <b>{{ $form->name }}</b></p>
                    <p>Email: <b>{{ $form->email }}</b></p>
                    <p>Password: <b>{{ $form->password }}</b></p>
                    <p>Description: <b>{{ $form->description }}</b></p>
                    <img src="{{asset('storage/'. $form->image)}}" class="rounded" width="10%"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
