<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax Crud</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="container my-3">
        <h2 class="bg-info text-light shadow">
            <marquee behavior="" direction="">Laravel-8 Ajax Crud Application</marquee>
        </h2>
        <div class="row my-5">
            <div class="col-sm-8">
                <div class="card shadow">
                    <div class="card-header bg-info d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Manage Employees</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Institute</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Udemy</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary me-3"><i
                                                class="bi bi-pencil me-2"></i>Edit</button>
                                        <button class="btn btn-sm btn-danger"><i
                                                class="bi bi-trash me-2"></i>Delete</button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card shadow">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h3 class="text-dark" id="addT">Add Employees</h3>
                        <h3 class="text-dark" id="updateT">Update Employees</h3>
                    </div>
                    <div class="card-body">
                        <form id="addEmployeeForm" class="form-horizontal">
                            <div class="mb-3">
                                <input type="hidden" name="id" id="id">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <span class="text-danger" id="nameError"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                                <span class="text-danger" id="titleError"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Institute</label>
                                <input type="text" class="form-control" name="institute" id="institute" required>
                                <span class="text-danger" id="instituteError"></span>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary me-2" onclick="addData()"
                                id="addButton"><i class="bi bi-plus-circle me-1"></i>Add</button>
                            <button type="submit" class="btn btn-sm btn-primary" onclick="updateData()"
                                id="updateButton"><i class="bi bi-upload me-1"></i>Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $('#addT').show();
        $('#addButton').show();
        $('#updateT').hide();
        $('#updateButton').hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Get All Data
        function allData() {
            $.ajax({
                type: "GET",
                url: "get-Teacher",
                dataType: "json",
                success: function(response) {
                    var data = ""
                    // console.log(data);
                    $.each(response, function(key, value) {
                        data += "<tr>"
                        data += "<td>" + value.id + "</td>"
                        data += "<td>" + value.name + "</td>"
                        data += "<td>" + value.title + "</td>"
                        data += "<td>" + value.institute + "</td>"
                        data += "<td>"
                        data += "<button class='btn btn-sm btn-primary me-2' onclick='editData("+value.id+")'>Edit</button>"
                        data += "<button class='btn btn-sm btn-danger' onclick='deleteData("+value.id+")'>Delete</button>"
                        data += "</td>"
                        data += "</tr>"
                    });
                    $('tbody').html(data);
                }
            });
        }
        allData();

        // Clear Form Data
        function clearData() {
            $('#name').val('');
            $('#title').val('');
            $('#institute').val('');
            $('#nameError').val('');
            $('#titleError').val('');
            $('#instituteError').val('');
        }

        // ===============  Insert Data  ==================
        function addData() {
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();

            $.ajax({
                type: "POST",
                url: "add-Teacher",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        swal.fire(
                            'Added!',
                            'Teacher Added Successfully!',
                            'success'
                        )
                        clearData();
                        allData();
                    }
                },
                error: function(error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.name);
                    $('#instituteError').text(error.responseJSON.errors.name);
                }
            });
        }

        // ==============  Edit Data  ==================
        function editData(id) {
            // alert(id);
            $.ajax({
                type: "GET",
                url: "edit-Teacher/" + id,
                dataType: "json",
                success: function(response) {
                    $('#addT').hide();
                    $('#addButton').hide();
                    $('#updateT').show();
                    $('#updateButton').show();

                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#title').val(response.title);
                    $('#institute').val(response.institute);
                    // console.log(response);
                }
            });
        }

        // ==============  Update Data  ==================
        function updateData() {
            var id = $('#id').val();
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();

            $.ajax({
                type: "POST",
                url: "update-Teacher/" + id,
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        swal.fire(
                            'Updated!',
                            'Teacher Updated Successfully!',
                            'success'
                        )
                    }
                    clearData();
                    allData();
                },
                error: function(error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.name);
                    $('#instituteError').text(error.responseJSON.errors.name);
                }
            });
        }

        // ==============  Delete Data  ==================
        function deleteData($id) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDetele) => {
                if (willDetele) {
                    $.ajax({
                        type: "GET",
                        url: "delete-Teacher/" + id,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'warning',
                            )
                            clearData();
                            addData();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
                else{
                    swal('Cancelled');
                }
            })
        }
    </script>
</body>

</html>
