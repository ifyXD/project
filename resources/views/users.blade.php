@extends('layouts.app')
@section('content')
  
    <div class="card-header bg-success text-white">
        <h3 class="mb-0">Create a Vehicle</h3>     
           <button type="button" class="btn btn-success mt-3 bg-dark" data-bs-toggle="modal" data-bs-target="#addnewuser">
            Add
        </button>
    </div>
    
    
    <div class="container mt-5">
        <span id="messageflash"></span>
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form>
                    <div class="modal-content create-new-user-content">
                        <div class="modal-header">
                            <h1 cldaass="modal-title fs-5" id="exampleModalLabel">Create User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="newUserName"
                                    aria-describedby="emailHelp">
                                <span class="text-danger errorname"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="newUserEmail"
                                    aria-describedby="emailHelp">
                                <span class="text-danger erroremail"></span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="newUserPassword">
                                <span class="text-danger errorpassword"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="createUserBtn" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="userstable">

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                url: '/datausers',
                success: function(data) {
                    // Assuming data is an array of user objects
                    $.each(data.users, function(index, user) {
                        // Assuming user has properties like id, name, email, etc.
                        let row =
                            `<tr id="trId${user.id}">
                            <td > ${user.id }</td>
                            <td id="nameId${user.id}"> ${user.name}</td>
                            <td id="emailId${user.id}"> ${user.email} </td>
                            <td>
                                <a href="#" id="editUserId" data-bs-toggle="modal" data-bs-target="#userEdit${user.id}">Edit</a>
                                
                                <div class="modal fade" id="userEdit${user.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>


                                    <div class="modal-body"> 
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" value="${user.name}" class="form-control" id="editname" aria-describedby="emailHelp"> 
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email</label>
                                            <input type="email" value="${user.email}" id="editemail" class="form-control"  aria-describedby="emailHelp"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="userEdit" data-id="${user.id}" 
                                        data-modalParent="userEdit${user.id}">Save</button>
                                    </div>
                                    </div>
                                </div>
                                </div> 
                            </td>
                            <td ><a href="#" onclick="deleteUser(${user.id});" id="deleteUserId">Delete</a></td>
                        </tr>`;

                        // Append the row to the tbody
                        $('#userstable').append(row);
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
                        // $('#messageflash').text('Successfully Deleted');
                        toastr["error"]("Successfully Deleted'!")
                    }
                }
            });
        }

        function createUser(name, email, password, callback) {
            $.ajax({
                type: 'post',
                url: '/users/addnewuser',
                data: {
                    'name': name,
                    'email': email,
                    'password': password,
                },
                success: function(data) {
                    if (data.message === 'success') {
                        // $('#messageflash').text('User added successfully');
                        toastr["success"]("User added successfully")
                        callback(true); // Invoke the callback with true indicating success
                    }
                },
                error: function(xhr, status, error) {



                    $('.errorname').text(xhr.responseJSON.errors.name);
                    $('.erroremail').text(xhr.responseJSON.errors.email);
                    $('.errorpassword').text(xhr.responseJSON.errors.password);

                    // Error handling
                    var errorMessage = xhr.responseJSON.message;
                    if (errorMessage) {
                        $('#messageflash').text('Error: ' + errorMessage);

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
            $('body').on('click', '#userEdit', function() {
                let modal = $(this).attr('data-modalParent');

                let id = $(this).attr('data-id');
                let name = $(this).closest('.modal').find('.modal-body').find('#editname').val();
                let email = $(this).closest('.modal').find('.modal-body').find('#editemail').val();

                $(`#${modal}`).modal('hide');


                $.ajax({
                    type: 'post',
                    url: '/users/editbyid',
                    data: {
                        'id': id,
                        'name': name,
                        'email': email,
                    },
                    success: function(data) {
                        if (data.message === 'success') {

                            $("#nameId" + id).text(name);
                            $("#emailId" + id).text(email);

                            toastr["info"]("Successfully Updated'!")

                        } else {
                            console.log('error');
                        }
                    }
                });


            });

            $('#createUserBtn').on('click', function() {

                let name = $(this).closest('.create-new-user-content').find('#newUserName').val();
                let email = $(this).closest('.create-new-user-content').find('#newUserEmail').val();
                let password = $(this).closest('.create-new-user-content').find('#newUserPassword').val();

                createUser(name, email, password, function(success) {
                    if (success === true) {
                        $(`#addNewUser`).modal('hide');
                        // Clear input fields in the modal
                        $('#newUserName').val('');
                        $('#newUserEmail').val('');
                        $('#newUserPassword').val('');
                        $('tbody').empty();

                        $('.errorname').text('');
                        $('.erroremail').text('');
                        $('.errorpassword').text('');
                        datausers();
                    }
                });


            });
        });
    </script>



