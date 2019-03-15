@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-header">Add new User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store') }}" id="userForm">
                        @csrf
                         <div class="form-group row">
                             <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-danger form-control">
                                    Add User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('scripts')
    <script>
        (function() {
            document.querySelector('#userForm').addEventListener('submit', function (e) {
                e.preventDefault()
                axios.post(this.action, {
                    'name': document.querySelector('#name').value,
                    'email': document.querySelector('#email').value,
                    'password': document.querySelector('#password').value,
                    'password_confirmation': document.querySelector('#password-confirm').value
                })
                .then((response) => {
                    clearErrors()
                    this.reset()
                    this.insertAdjacentHTML('afterend', '<div class="alert alert-success" id="success">User created successfully!</div>')
                    document.getElementById('success').scrollIntoView()
                })
                .catch((error) => {
                    const errors = error.response.data.errors
                    const firstItem = Object.keys(errors)[0]
                    const firstItemDOM = document.getElementById(firstItem)
                    const firstErrorMessage = errors[firstItem][0]
                    // scroll to the error message
                    firstItemDOM.scrollIntoView()
                    clearErrors()
                    // show the error message
                    firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div>`)
                    // highlight the form control with the error
                    firstItemDOM.classList.add('border', 'border-danger')
                });
            });
            function clearErrors() {
                // remove all error messages
                const errorMessages = document.querySelectorAll('.text-danger')
                errorMessages.forEach((element) => element.textContent = '')
                // remove all form controls with highlighted error text box
                const formControls = document.querySelectorAll('.form-control')
                formControls.forEach((element) => element.classList.remove('border', 'border-danger'))
            }
        })();
    </script>
@stop