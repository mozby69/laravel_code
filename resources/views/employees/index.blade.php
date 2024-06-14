<!-- resources/views/employees/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

</head>
<body>
    @include('components.navbar') 


    <div class="container-fluid mt-5">
        <div class="card p-1">
            <div class="card-body">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_record">ADD RECORD</button>
                <div class="table-responsive">
                    <table id="defaultdatatable" class="table table-bordered table-hover table-striped tables">
                        <thead>
                            <tr>
                                <th>FIRSTNAME</th>
                                <th>MIDDLENAME</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->firstname }}</td>
                                    <td>{{ $employee->middlename }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_record{{ $employee->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_record{{ $employee->id }}">delete</button>
                                    </td>
                                </tr>
               
                
                </div>
            </div>
        </div>














     <!-- Edit Record Modal -->
     <div class="modal fade" id="edit_record{{ $employee->id }}" tabindex="-1" aria-labelledby="edit_recordLabel{{ $employee->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_recordLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('employees.update', $employee->id) }}" id="editForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_firstname" class="form-label">Firstname</label>
                            <input type="text" name="firstname" class="form-control" id="edit_firstname" required value="{{ isset($employee) ? $employee->firstname : '' }}" >
                        </div>
                        <div class="mb-3">
                            <label for="edit_middlename" class="form-label">Middlename</label>
                            <input type="text" name="middlename" class="form-control" id="edit_middlename" value="{{ isset($employee) ? $employee->middlename : '' }}" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    {{-- delete modal --}}
    <div class="modal fade" id="delete_record{{ $employee->id }}" tabindex="-1" aria-labelledby="delete_recordLabel{{ $employee->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_recordLabel">Delete Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" id="editForm">
                        @csrf
                        @method('DELETE')
                        <h6>Are you sure you want to delete? - {{$employee->firstname}} {{ $employee->middlename}}</h6>
                     
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endforeach
</tbody>
</table>
    
</div>



 <!-- Add Record Modal -->
 <div class="modal fade" id="add_record" tabindex="-1" aria-labelledby="add_record" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('employees.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="middlename">Middlename</label>
                        <input type="text" name="middlename" class="form-control" id="middlename">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>






<script>
    $(document).ready(function() {
        $('.edit-employee-btn').click(function() {
            let employeeId = $(this).data('employee-id');
            let fetchEmployeeRoute = "{{ route('employees.update', ':id') }}";
            fetchEmployeeRoute = fetchEmployeeRoute.replace(':id', employeeId);

            // Handle form submission (assuming you want to update via form)
            $('#editForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Send AJAX request to update employee data
                $.ajax({
                    url: fetchEmployeeRoute,
                    method: 'POST',
                    data: $(this).serialize(), // Get form data
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Handle successful update (e.g., close modal, show success message with SweetAlert)
                            $('#edit_record_' + employeeId).modal('hide');
                            Swal.fire({
                                title: 'Success!',
                                text: 'Employee updated successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error updating employee: ' + response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
