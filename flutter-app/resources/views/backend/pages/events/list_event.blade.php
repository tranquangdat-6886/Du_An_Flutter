@extends('backend.layouts.master')
@section('main-content')
@section('title', 'LIST-Events')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Event Manager</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layouts</a></li>
                        <li class="breadcrumb-item active">EventManager</li>
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
                                    <h1 class="card-title">List Event</h1>
                                </div>
                                <div class="col-lg-4 col-6">

                                    <button type="button" id="btnAdd" data-toggle="modal" data-target="#addevent"
                                        class="btn btn-success float-lg-right"><i class="fas fa-plus"></i> Add New</button>
                                </div>
                            </div>

                            {{-- Bắt đầu mở modal để tạo mới event  --}}
                            <div class="modal fade" id="addevent" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <form action="{{ route('events.store') }}" method="post">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h2 class="modal-title fs-5" id="staticBackdropLabel"> <i
                                                        class="fa fa-info me-1"></i> Add New Event</h2>
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
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <label for="">Event Name: </label>
                                                                        <input type="text" class=" form-control "
                                                                            name="name" id="customerName"
                                                                            placeholder="Please Enter Event Name">
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <label for="">EventDate: </label>
                                                                        <input type="date" class=" form-control "
                                                                            name="eventdate" id="customerPhone">
                                                                    </div>
                                                                </div>
                                                                <label for="">Note: </label>
                                                                <textarea class="form-control" rows="3" id="txtAddress" name="note" maxlength="250"
                                                                    placeholder="Notes for the event"></textarea>
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
                                            <th>Event Name</th>
                                            <th>Even Date</th>
                                            <th>Event Creator</th>
                                            <th>Settings</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        @foreach ($event as $event)
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td>{{ $event->name }}</td>
                                                <td>{{ $event->eventDate }}</td>
                                                <td>Trần Thanh Đàn </td>
                                                <td>
                                                    <span class="d-lg-flex">
                                                      @if(isset($event->EVE_ID))
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#editevent" data-event-id="{{ $event->EVE_ID }}"
                                                            class="btn btn-success float-lg-right buttoneditevent"><i
                                                                class="fas fa-edit"></i> Edit</button>
                                                     @endif
                                                        <form action="{{route('events.destroy',['event'=>$event->EVE_ID])}}" method="POST">
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
                            <div class="modal fade" id="editevent" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                  @if(isset($event->EVE_ID))
                                    <form action="{{ route('events.update', ['event' => $event->EVE_ID]) }}" method="post">
                                      @method('PUT')
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h2 class="modal-title fs-5" id="staticBackdropLabel"> <i
                                                        class="fa fa-info me-1"></i> Edit Event</h2>
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
                                                            
                                                                <div class="row">
                                                                   <div class="col-lg-6">
                                                                    <label for="">Event Name: </label>
                                                                    <input type="text" class=" form-control "
                                                                        name="name" id="nameEvent"
                                                                        placeholder="Please Enter Event Name">
                                                                   </div>
                                                                    <div class="col-lg-6">
                                                                        <label for=""> EventDate: </label>
                                                                        <input type="date" class=" form-control "
                                                                            name="eventDate"  id="eventDate">
                                                                    </div>
                                                                </div>
                                                                <label for="">Note: </label>
                                                                <textarea class="form-control" rows="3" id="note" name="note" maxlength="250"
                                                                    placeholder="Notes for the event"></textarea>
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
                                    $('.buttoneditevent').click(function() {
                                        var eveId = $(this).data(
                                            'event-id'); // Lấy ID từ biến PHP và gán cho biến JavaScript
                                        console.log(eveId);
                                        //đoạn này dùng để lấy giá trị của id của button được chọn nhằm mục đích lấy được id của stockindetail để update
                                        var actionURL = "{{ route('events.update', ['event' => ':eveId']) }}";
                                        actionURL = actionURL.replace(':eveId', eveId);
                                        $('#stockinForm').attr('action', actionURL);
        
                                        // $('#stockinForm').submit();
                                        $.ajax({
                                            url: '/events/edit/' +
                                            eveId, // Đường dẫn tới phương thức xử lý yêu cầu Ajax để lấy thông tin sản phẩm
                                            type: 'GET',
        
                                            success: function(response) {
                                                // Xử lý dữ liệu trả về từ controller
                                                console.log(response);
        
                                                $('#nameEvent').val(response.eventName);
                                                $('#eventDate').val(response.eventDate);
                                                $('#note').val(response.note);
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
