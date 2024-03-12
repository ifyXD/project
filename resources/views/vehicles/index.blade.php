@extends('layouts.app')
@section('content')
    {{-- <div class="container p-5 my-4">
        <div class="header-wrapper">
            <div class="header-title">
                <span>DTO PROJECT</span>
                <h2>CENTRAL MINDANAO UNIVERSITY</h2>
            </div>
        </div>
    </div> --}}
    <!-- Button trigger modal -->
    <div class="card-header bg-success text-white">
        <h3 class="mb-0">Create a Vehicle</h3>     
           <button type="button" class="btn btn-success mt-3 bg-dark" data-bs-toggle="modal" data-bs-target="#addNewVehicle">
            Add
        </button>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="addNewVehicle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form>
                <div class="modal-content create-new-vehicle-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create new Vehicles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-1">
                            <label for="platenumber" class="form-label">Plate Number</label>
                            <input type="text" class="form-control" id="platenumber" name="platenumber"
                                placeholder="Plate Number" required>
                        </div>

                        <div class="mb-1">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Type">
                        </div>

                        <div class="mb-1">
                            <label for="driver" class="form-label">Driver</label>
                            <input type="text" class="form-control" id="driver" name="driver" placeholder="Driver">
                        </div>

                        <div class="mb-1">
                            <label for="condition" class="form-label">Condition</label>
                            <input type="text" class="form-control" id="condition" name="condition"
                                placeholder="Condition">
                        </div>

                        <div class="mb-1">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
                        </div>

                        <div class="mb-1">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="accept">Active</option>


                            </select>
                        </div>

                        <button type="button" id="createVehicleBtn" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <table class="table table-bordered display" id="myTable">
        <thead>
            <tr>
                <th scope="col-8">#</th>
                <th scope="col-8">Plate Number</th>
                <th scope="col-8">Type</th>
                <th scope="col-8">Driver</th>
                <th scope="col-8">Condition</th>
                <th scope="col-8">Description</th>
                <th scope="col-8">Status</th>
                <th scope="col-4  ">Created</th>
                <th scope="col-4  ">Update</th>
                <th scope="col-4  ">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection
@push('scripts')
    {{-- ajax crud --}}
    <script>
        datausers();

        function formatDate(dateString) {
            var date = new Date(dateString);
            var monthNames = [
                "Jan", "Feb", "Mar",
                "Apr", "May", "Jun", "Jul",
                "Aug", "Sep", "Oct",
                "Nov", "Dec"
            ];
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            return monthNames[monthIndex] + ' ' + day + ', ' + year;
        }

        function datausers() {

            $('#myTable').DataTable().destroy();
            $('tbody').empty();
            $.ajax({
                type: 'get',
                url: '/vehiclesdata',
                success: function(data) {
                    // Assuming data is an array of user objects
                    $.each(data.vehicles, function(index, vehicle) {
                        var key = index + 1;
                        var ifdel = vehicle.isdel === 'deleted' ? 'is-deleted' : '';

                        var action = vehicle.isdel === 'active' ? `<a href="#" id="editUserId" data-bs-toggle="modal" data-bs-target="#vehicleEdit${vehicle.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg></a>
                        <a href="#" onclick="confirmDelete(${vehicle.id});" id="deleteUserId">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </a>` :
                            `<span class="text-danger">Deleted</span>`;
                        // Assuming user has properties like id, name, email, etc.
                        let row =
                            `<tr class="${ifdel}" id="trId${vehicle.id}">
                                    <td > ${key }</td>
                                    <td id="platenumberId${vehicle.id}"> ${vehicle.platenumber}</td>
                                    <td id="typeId${vehicle.id}"> ${vehicle.type} </td>
                                    <td id="driverId${vehicle.id}"> ${vehicle.driver}</td>
                                    <td id="conditionId${vehicle.id}"> ${vehicle.condition} </td>
                                    <td id="descriptionId${vehicle.id}"> ${vehicle.description}</td>
                                    <td id="statusId${vehicle.id}"> ${vehicle.status} </td> 
                                    <td id="createdAtId${vehicle.id}">${formatDate(vehicle.created_at)}</td>
                                    <td id="updatedAtId${vehicle.id}">${formatDate(vehicle.updated_at)}</td>
                                    
                                    <td> 
                                        ${action}
                                        
                                        <div class="modal fade" id="vehicleEdit${vehicle.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>


                                            <div class="modal-body"> 
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                                    <input type="text" value="${vehicle.platenumber}" class="form-control" id="editplatenumber" aria-describedby="emailHelp"> 
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                                    <input type="text" value="${vehicle.type}" class="form-control" id="edittype" aria-describedby="emailHelp"> 
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                                    <input type="text" value="${vehicle.driver}" class="form-control" id="editdriver" aria-describedby="emailHelp"> 
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                                    <input type="text" value="${vehicle.condition}" class="form-control" id="editcondition" aria-describedby="emailHelp"> 
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                                    <input type="text" value="${vehicle.description}" class="form-control" id="editdescription" aria-describedby="emailHelp"> 
                                                </div>
                                                            <div class="mb-1">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="editstatus" name="status">
                                                    <option ${vehicle.status === 'pending'? 'selected': ''} value="pending">Pending</option>
                                                    <option ${vehicle.status === 'accept'? 'selected': ''} value="accept">Accept</option>
                                                    <option ${vehicle.status === 'decline'? 'selected': ''} value="decline">Decline</option>
                                                
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="vehicleEdit" data-id="${vehicle.id}" 
                                                data-modalParent="vehicleEdit${vehicle.id}">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div> 
                                    </td>
                                </tr>`;

                        // Append the row to the 


                        $('tbody').append(row);
                    });
                    $('#myTable').DataTable();
                     
                   
                }

            });
        } 

        function deleteUser(userid) {
            $.ajax({
                type: 'post',
                url: '/vehicle/deletebyid',
                data: {
                    'id': userid
                },
                success: function(data) {

                    datausers();
                },
                error: function(xhr, status, error) {


                    console.log(xhr);

                }


            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Call your delete function here
                    deleteUser(id);
                    Swal.fire("Deleted!", "Successfully deleted.", "success");
                }
            });
        }

        function createVehicle(platenumber, type, driver, condition, description, status, callback) {
            $.ajax({
                type: 'post',
                url: '/addnewvehicle',
                data: {
                    'platenumber': platenumber,
                    'type': type,
                    'driver': driver,
                    'condition': condition,
                    'description': description,
                    'status': status,

                },
                success: function(data) {
                    if (data.message === 'success') {
                        $('#messageflash').text('Vehicle added successfully');
                        callback(true); // Invoke the callback with true indicating success
                    }
                },
                error: function(xhr, status, error) {


                    console.log(xhr);
                    // Error handling
                    var errorMessage = xhr.responseJSON.message;
                    if (errorMessage) {
                        $('#messageflash').text('Erroryawa: ' + errorMessage);
                    } else {
                        $('#messageflash').text('An error occurred while adding the user');
                    }
                    callback(false); // Invoke the callback with false indicating failure
                }
            });
        }
    </script>

    {{-- jquery code --}}
    <script>
        $(document).ready(function() {

            $('body').on('click', '#vehicleEdit', function() {
                let modal = $(this).attr('data-modalParent');

                let id = $(this).attr('data-id');
                let platenumber = $(this).closest('.modal').find('.modal-body').find('#editplatenumber')
                    .val();
                let type = $(this).closest('.modal').find('.modal-body').find('#edittype').val();
                let driver = $(this).closest('.modal').find('.modal-body').find('#editdriver').val();
                let condition = $(this).closest('.modal').find('.modal-body').find('#editcondition').val();
                let description = $(this).closest('.modal').find('.modal-body').find('#editdescription')
                    .val();
                let status = $(this).closest('.modal').find('.modal-body').find('#editstatus').val();

                $(`#${modal}`).modal('hide');


                $.ajax({
                    type: 'post',
                    url: '/user/editbyid',
                    data: {
                        'id': id,
                        'platenumber': platenumber,
                        'driver': driver,
                        'description': description,
                        'condition': condition,
                        'type': type,
                        'status': status,
                    },
                    success: function(data) {
                        Swal.fire("Success!", "Vehicle updated successfully.", "success");
                        datausers();
                    },
                    error: function(xhr, status, error) {


                        console.log(xhr);

                    }
                });


            });

            $('#createVehicleBtn').on('click', function() {
                $(`#addNewVehicle`).modal('hide');
                let platenumber = $(this).closest('.create-new-vehicle-content').find('#platenumber').val();
                let type = $(this).closest('.create-new-vehicle-content').find('#type').val();
                let driver = $(this).closest('.create-new-vehicle-content').find('#driver').val();
                let condition = $(this).closest('.create-new-vehicle-content').find('#condition').val();
                let description = $(this).closest('.create-new-vehicle-content').find('#description').val();
                let status = $(this).closest('.create-new-vehicle-content').find('#status').val();
                createVehicle(platenumber, type, driver, condition, description, status,
                    function(success) {
                        if (success === true) {
                            Swal.fire("Success!", "Vehicle added successfully.", "success");
                            // Clear input fields in the modal
                            $('#platenumber').val('');
                            $('#type').val('');
                            $('#driver').val('');
                            $('#condition').val('');
                            $('#description').val('');
                            $('#status').val('');

                            datausers();
                        }
                    });


            });
        });

        function changeColor(color) {
            document.getElementById('status').style.color = color; // Change select box color
            var options = document.getElementById('status').options;
            for (var i = 0; i < options.length; i++) {
                options[i].style.color = color; // Change option colors
            }
        }

        // Example AJAX request
        function updateColor() {
            var color = 'blue'; // Change to the desired color
            changeColor(color);
        }

        // Call the updateColor function when needed (e.g., after an AJAX request)
        updateColor();
    </script>
@endpush
