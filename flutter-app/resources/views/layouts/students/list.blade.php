@extends('layouts.index')

@section('list-student')
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th>Last Name</th>
                <th>First name</th>
                <th>DOB</th>
                <th>Major Code</th>
                <th>Class Code</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            // Gọi API để lấy dữ liệu từ controller
            $.ajax({
                url: '/students',
                method: 'GET',
                success: function(response) {
                    var data = response;

                    // Đổ dữ liệu vào bảng HTML
                    var tableBody = $('#data-table tbody');
                    $.each(data, function(index, item) {
                        var row = '<tr>' +
                            '<td>' + item.STU_ID + '</td>' +
                            '<td>' + item.code + '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection