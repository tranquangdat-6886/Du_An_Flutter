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
                    <h1>Attendance</h1>
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
                            <textarea class="form-control" rows="8" id="txtAddress" name="note" maxlength="250"
                                placeholder="Notes for the event"></textarea>

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

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> --}}
@endsection
