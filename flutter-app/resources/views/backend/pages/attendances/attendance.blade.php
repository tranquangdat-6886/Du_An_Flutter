@extends('backend.layouts.master')
@section('main-content')
@section('title', 'Attendance')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sự Kiện {{ $event->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layouts</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
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
                                    <h1 class="card-title">Attendance</h1>
                                </div>
                                <div class="col-lg-4 col-6">

                                    <button type="button" id="btnAdd" data-toggle="modal" data-target="#addAcount"
                                        class="btn btn-success float-lg-right"><i class="fas fa-plus"></i> Xuất
                                        Excel</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body ">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-hover text-center " id="myTable">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>Student Code</th>
                                            <th>LastName</th>
                                            <th>FirstName</th>
                                            <th>Major Code</th>
                                            <th>Class Code</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        {{-- @if ($attendance !== null && is_array($attendance)) --}}
                                        @foreach ($attendance as $attendance)
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td>{{ $attendance->student->code }}</td>
                                                <td>{{ $attendance->student->lastName }}</td>
                                                <td>{{ $attendance->student->firstName }}</td>
                                                <td>{{ $attendance->student->majorCode }}</td>
                                                <td>{{ $attendance->student->classCode }}</td>

                                            </tr>
                                        @endforeach
                                        {{-- @endif --}}
                                    </tbody>

                                </table>

                            </div>

                        </div>
                        {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div> --}}

                    </div>
                    </form>

                </div>

            </div>
            {{-- Bắt đầu xử lý ajax khi click vào edit --}}

            {{-- Kết thúc ajax xử lý edit --}}

            {{-- Kết thúc modal edit event --}}
        </div>
</div>
</section>
@endsection
