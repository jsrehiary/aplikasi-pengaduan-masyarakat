@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
@endsection

@section('content')
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-50">
            <div class="col bg-subtle-secondary p-3 rounded shadow">
                <h2 class="text-center mb-3">Login</h2>
                <form method="POST" action="{{ route('login.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="formUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="formUsername" name="username">
                        <div class="mb-3">
                            <label for="formPass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="formPass" name="password">
                        </div>
                        <button type="submit" class="w-100 btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>

    <script>
        @if (Session::has('success'))
            Swal.fire('Success', '{{ Session::get('success') }}', 'success');
        @endif

        @if (Session::has('failed'))
            Swal.fire('Error', '{{ Session::get('failed') }}', 'error');
        @endif
    </script>
@endsection
