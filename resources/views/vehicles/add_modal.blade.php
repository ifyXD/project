<!-- Add Vehicle Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a vehicle goes here -->
                <form>
                    @csrf
                    <div class="errMsgContainer">
                    </div>
                    
                    <div class="mb-3">
                        <label for="platenumber" class="form-label">Plate Number</label>
                        <input type="text" class="form-control" id="platenumber" name="platenumber"
                            placeholder="Plate Number">
                            
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Type">
                    </div>

                    <div class="mb-3">
                        <label for="driver" class="form-label">Driver</label>
                        <input type="text" class="form-control" id="driver" name="driver" placeholder="Driver">
                    </div>

                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <input type="text" class="form-control" id="condition" name="condition"
                            placeholder="Condition">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Description"></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="accept">Accept</option>
                            <option value="decline">Decline</option>
                            <option value="reserved">Reserved</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary add_vehicle">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div><!-- Add Vehicle Modal -->

