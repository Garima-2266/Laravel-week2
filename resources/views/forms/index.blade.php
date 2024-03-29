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
    <nav class="navbar navbar-default bg-gray-500">

        {{-- link --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="/">Home</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="text-right">
            <a href="forms/create" class="btn btn-dark mt-2">New Form</a>
        </div>
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="/forms/{{$form->id}}/show" class="text-dark">{{ $form->name }}</a></td>
                        <td>{{ $form->email }}</td>
                        <td>{{ $form->password }}</td>
                        <td>{{ $form->description }}</td>

                        <td>
                            <img src="{{ $form->getImage() }}" class="rounded-circle" width="50" height="50" />
                        </td>
                        <td>
                            <a href="forms/{{ $form->id }}/edit" class="btn bg-gray-800 text-white py-2 px-4 rounded btn-sm">Edit</a>
                            <a href="forms/{{ $form->id }}/show" class="btn btn-success text-white py-2 px-4 rounded btn-sm">Show</a>

                            <form class="inline-block" action="forms/{{ $form->id }}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-white py-2 px-4 rounded btn-sm">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
