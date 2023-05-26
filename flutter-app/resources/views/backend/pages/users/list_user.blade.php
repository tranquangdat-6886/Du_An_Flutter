@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-users')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account Manager</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layouts</a></li>
                        <li class="breadcrumb-item active">AccountManager</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-lg-8 col-6 align-self-center">
                                    <h1 class="card-title">List User</h1>
                                </div>
                                <div class="col-lg-4 col-6">

                                    <button type="button" id="btnAdd" data-toggle="modal" data-target="#addAcount"
                                        class="btn btn-success float-lg-right"><i class="fas fa-plus"></i> Add
                                        New</button>
                                </div>
                            </div>

                            {{-- Bắt đầu mở modal để tạo mới event  --}}
                            <div class="modal fade" id="addAcount" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <form action="{{ route('users.store') }}" method="post">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h2 class="modal-title fs-5" id="staticBackdropLabel"> <i
                                                        class="fa fa-info me-1"></i> Add New User</h2>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6 d-none d-lg-block">
                                                        <img src="{{ asset('backend/dist/img/envent.jpg') }}"
                                                            alt="AdminLTE Logo" class="brand-image img-fluid "
                                                            style="opacity: .8">
                                                    </div>
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <label for="">Full Name: </label>
                                                                <input type="text" class=" form-control "
                                                                    name="name" id="name"
                                                                    placeholder="Please Enter Full Name">


                                                                <label for="">UserName: </label>
                                                                <input type="text" class=" form-control "
                                                                    name="username" id="userName"
                                                                    placeholder="Please Register UserName">
                                                                <div class="password-wrapper">
                                                                    <label for="password">Password:</label>
                                                                    <div class="input-wrapper">
                                                                        <input type="password" class="form-control"
                                                                            name="password" id="password"
                                                                            placeholder="Please enter password">
                                                                        <span class="toggle-password">
                                                                            <i class="far fa-eye"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <label for="password">ROLE:</label>
                                                                <div class=" text-lg-center">

                                                                    <select class="custom-select  w-25  mb-3"
                                                                        name="role">
                                                                        <option selected>---Please Enter Role---
                                                                        </option>
                                                                        <option value="1">ADMIN</option>
                                                                        <option value="2">STAFF</option>
                                                                        <option value="3">CHECKER</option>
                                                                    </select>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                {{-- Phần Css cho modal để full màn hình --}}
                                <style>
                                    .modal-fullscreen {
                                        max-width: 100%;
                                        height: 100%;
                                        margin: 0;
                                        padding: 0;
                                    }

                                    .modal-dialog {
                                        padding: 50px;

                                    }

                                    .modal-fullscreen .modal-content {
                                        height: 100%;
                                        border-radius: 10px;
                                        max-width: 100%;

                                    }

                                    /* .modal-fullscreen .modal-dialog {
                                    height: 100%;
                                    margin: 0;
                                    max-width: 100%;
                                } */
                                </style>
                                {{-- kết thúc phần css --}}
                            </div>
                            {{-- Kết thúc phần modal tạo event --}}
                        </div>
                        <div class="card-body ">


                            <div class="table-responsive ">
                                <table class="table table-bordered table-hover text-center " id="myTable">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>Name</th>
                                            <th>UserName</th>
                                            <th>Role</th>
                                            <th>Settings</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        @foreach ($user as $user)
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>
                                                    <?php
                                                    if ($user->role == 1) {
                                                        echo 'Admin';
                                                    } elseif ($user->role == 2) {
                                                        echo 'Staff';
                                                    } else {
                                                        echo 'Checker';
                                                    }
                                                    
                                                    ?>
                                                </td>
                                                <td>
                                                    <span class="d-lg-flex">
                                                        @if (isset($user->id))
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#edituser"
                                                                data-user-id="{{ $user->id }}"
                                                                class="btn btn-success float-lg-right buttonedituser"><i
                                                                    class="fas fa-edit"></i> Edit</button>
                                                        @endif
                                                        <form
                                                            action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="submit"
                                                                class="text-white fw-bold btn btn-danger"
                                                                value="Delete">
                                                        </form>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>

                            {{-- bắt đầu modal edit event  --}}
                            <div class="modal fade" id="edituser" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    @if (isset($user->id))
                                        <form action="{{ route('users.update', ['user' => $user->id]) }}"
                                            method="post" id="userForm">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h2 class="modal-title fs-5" id="staticBackdropLabel"> <i
                                                            class="fa fa-info me-1"></i> Edit User</h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 d-none d-lg-block">
                                                            <img src="{{ asset('backend/dist/img/envent.jpg') }}"
                                                                alt="AdminLTE Logo" class="brand-image img-fluid "
                                                                style="opacity: .8">
                                                        </div>
                                                        <div class="col-lg-6">

                                                            <div class="row">
                                                                <div class="col-lg-12">


                                                                    <label for="">Full Name: </label>
                                                                    <input type="text" class=" form-control "
                                                                        name="name" id="fullname"
                                                                        placeholder="Please Enter Full Name">

                                                                    <label for=""> Username: </label>
                                                                    <input type="text" class=" form-control "
                                                                        name="username" id="username"
                                                                        placeholder="Please Register UserName">

                                                                    <div class="password-wrapper">
                                                                        <label for="password">Password:</label>
                                                                        <div class="input-wrapper">
                                                                            <input type="password"
                                                                                class="form-control" name="password"
                                                                                id="password"
                                                                                placeholder="Please enter password">
                                                                            <span class="toggle-password">
                                                                                <i class="far fa-eye"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <label for="password">ROLE:</label>
                                                                    <div class=" text-lg-center">

                                                                        <select class="custom-select  w-25  mb-3"
                                                                            name="role">
                                                                            <option selected>---Please Enter Role---
                                                                            </option>
                                                                            <option value="1">ADMIN</option>
                                                                            <option value="2">STAFF</option>
                                                                            <option value="3">CHECKER</option>
                                                                        </select>

                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>

                                            </div>
                                        </form>
                                    @endif
                                </div>

                            </div>
                            {{-- Bắt đầu xử lý ajax khi click vào edit --}}
                            <script>
                                $(document).ready(function() {
                                    $('.buttonedituser').click(function() {
                                        var userId = $(this).data(
                                            'user-id'); // Lấy ID từ biến PHP và gán cho biến JavaScript
                                        console.log(userId);
                                        //đoạn này dùng để lấy giá trị của id của button được chọn nhằm mục đích lấy được id của stockindetail để update
                                        var actionURL = "{{ route('users.update', ['user' => ':userId']) }}";
                                        actionURL = actionURL.replace(':userId', userId);
                                        $('#userForm').attr('action', actionURL);

                                        // $('#stockinForm').submit();
                                        $.ajax({
                                            url: '/users/edituser/' + userId,
                                            type: 'GET',

                                            success: function(response) {
                                                // Xử lý dữ liệu trả về từ controller
                                                console.log(response);

                                                $('#fullname').val(response.name);
                                                $('#username').val(response.username);
                                                // $('#note').val(response.note);
                                            },
                                            error: function(xhr, status, error) {
                                                // Xử lý lỗi (nếu có)
                                                console.log(error);
                                            }

                                        });
                                    });
                                });
                            </script>
                            {{-- Kết thúc ajax xử lý edit --}}

                            {{-- Kết thúc modal edit event --}}
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> --}}
@endsection
