
<!doctype html>

<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create New Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  

    <div class="container p-5 my-4">
       <h1>Budgets </h1>
        <span id="messageflash"></span>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewVehicle">
            Add
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addNewVehicle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form>
                    <div class="modal-content create-new-vehicle-content">
                        <div class="modal-header">
                            <h1 cldaass="modal-title fs-5" id="exampleModalLabel">Budgets</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-1">
                                <label for="content" class="form-label">Content</label>
                                <input type="number" class="form-control" id="platenumber" name="platenumber" placeholder="Plate Number" required>
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
                            <input type="text" class="form-control" id="condition" name="condition" placeholder="Condition">
                        </div>
                    
                        <div class="mb-1">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
                        </div>
                    
                        <div class="mb-1">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="accept">Accept</option>
                                <option value="decline">Decline</option>
                              
                            </select>
                        </div>
                    
                        <button type="button" id="createVehicleBtn" class="btn btn-primary">Create</button>
                      </form>
            </div>
        </div>
    </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                  <th scope="col-8">#</th>
                  <th scope="col-8">Plate Number</th>
                  <th scope="col-8">Type</th>
                  <th scope="col-8">Driver</th>
                  <th scope="col-8">Condition</th>
                  <th scope="col-8">Description</th>
                  <th scope="col-8">Status</th>
                  <th scope="col-4  ">Action</th>


                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    {{-- ajax crud --}}
    <script>
        datausers();

        function datausers() {
            $.ajax({
                type: 'get',
                url: '/vehicles',
                success: function(data) {
                    // Assuming data is an array of user objects
                    $.each(data.vehicles, function(index, vehicle) {
                        // Assuming user has properties like id, name, email, etc.
                        let row =
                            `<tr id="trId${vehicle.id}">
                            <td > ${vehicle.id }</td>
                            <td id="platenumberId${vehicle.id}"> ${vehicle.platenumber}</td>
                            <td id="typeId${vehicle.id}"> ${vehicle.type} </td>
                            <td id="driverId${vehicle.id}"> ${vehicle.driver}</td>
                            <td id="conditionId${vehicle.id}"> ${vehicle.condition} </td>
                            <td id="descriptionId${vehicle.id}"> ${vehicle.description}</td>
                            <td id="statusId${vehicle.id}"> ${vehicle.status} </td> 
                            
                            <td>
                                <a href="#" id="editUserId" data-bs-toggle="modal" data-bs-target="#vehicleEdit${vehicle.id}">Edit</a>
                               <a href="#" onclick="deleteUser(${vehicle.id});" id="deleteUserId">Delete</a>

                                
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
                                            <input type="text" value="${vehicle.description}" class="form-control" id="editcondition" aria-describedby="emailHelp"> 
                                        </div>
                                                    <div class="mb-1">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="${vehicle.pending}">Pending</option>
                                            <option value="${vehicle.accept}">Accept</option>
                                            <option value="${vehicle.decline}">Decline</option>
                                        
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

                        // Append the row to the tbody
                        $('tbody').append(row);
                    });
                }

            });
        }

        function deleteUser(userid) {
            $.ajax({
                type: 'post',
                url: '/users/deletebyid',
                data: {
                    'id': userid
                },
                success: function(data) {
                    $("#trId" + userid).remove();

                    if (data.message === 'success') {
                        $('#messageflash').text('Successfully Deleted');
                    }
                }
            });
        }

        function createVehicle(platenumber, type, driver, condition,  description, status, callback) {
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
                let platenumber = $(this).closest('.modal').find('.modal-body').find('#editplatenumber').val();
                let type = $(this).closest('.modal').find('.modal-body').find('#edittype').val();
                let driver = $(this).closest('.modal').find('.modal-body').find('#editdriver').val();
                let condition = $(this).closest('.modal').find('.modal-body').find('#editcondition').val();
                let description = $(this).closest('.modal').find('.modal-body').find('#editdescription').val();
                let status = $(this).closest('.modal').find('.modal-body').find('#edittype').val();

                $(`#${modal}`).modal('hide');


                $.ajax({
                    type: 'post',
                    url: '/users/index/editbyid',
                    data: {
                        'id': id,
                        'platenumber': platenumber,
                        'type': type,
                        'driver': driver,
                        'description': description,
                        'condition': description,
                        'status': status,
                    },
                    success: function(data) {
                        if (data.message === 'success') {

                            $("#platenumberId" + id).text(platenumber);
                            $("#typeId" + id).text(type);
                            $("#driverId" + id).text(platenumber);
                            $("#conditionId" + id).text(condition);
                            $("#description" + id).text(condition);
                            $("#statusId" + id).text(status);


                        } else {
                            console.log('error');
                        }
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
                createVehicle(platenumber, type, driver, condition,  description, status, 
                function(success) {
                    if (success === true) {
                        // Clear input fields in the modal
                        $('#platenumber').val('');
                        $('#type').val('');
                        $('#driver').val(''); 
                        $('#condition').val(''); 
                        $('#description').val(''); 
                        $('#status').val(''); 
                        $('tbody').empty();
                        datausers();
                    }
                });


            });
        });
     
    </script>
</body>
    
</html>
