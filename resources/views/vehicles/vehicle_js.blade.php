
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    </script>
 <script>
    $(document).ready(function() {
        $(document).on('click', '.add_vehicle', function(e) {
            e.preventDefault();
            let platenumber = $('#platenumber').val();
            let type = $('#type').val();
            let driver = $('#driver').val();
            let condition = $('#condition').val();
            let description = $('#description').val();
            let status = $('#status').val();
    

            $.ajax({
                url: '/vehicles/vehicle_js/add.vehicle'
                method: 'POST',
                data: {
                    platenumber: platenumber,
                    type: type,
                    driver: driver,
                    condition: condition,
                    description: description,
                    status: status
                    },
                    success: function(res) {
                        if(res.status=='success'){
                            $('#exampleModal').modal('hide');
                            $('#addVehicleForm')[0].reset();
                            $('.table').load(location.href+'.table');
                        }
    
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span><br>');
                    });
                }
            });
        });
    });
    </script>
    