<!-- BEGIN Create Matrix Modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMatrixModalLabel">Create New Commission Matrix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('commissionmatrix.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="agent_type" class="form-label">Agent Type</label>
                        <input type="text" class="form-control" id="agent_type" name="agent_type" placeholder="Enter Agent Type" required>
                    </div>
                    <div class="col-md-6">
                        <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                        <input type="number" class="form-control" id="agent_tier_level" name="agent_tier_level" placeholder="Enter Agent Tier Level">
                    </div>
                    <div class="col-md-6">
                        <label for="agent_id" class="form-label">Agent</label>
                        <select class="form-select" id="agent_id" name="agent_id" required>
                            <option value="" selected disabled>Select an Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->first_name }} {{ $agent->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <label for="state_id" class="form-label">State</label>
                        <input type="number" class="form-control" id="state_id" name="state_id" placeholder="Enter State ID">
                    </div>
                    <div class="col-md-4">
                        <label for="lga_id" class="form-label">LGA</label>
                        <input type="number" class="form-control" id="lga_id" name="lga_id" placeholder="Enter LGA ID">
                    </div>
                    <div class="col-md-4">
                        <label for="biller_id" class="form-label">Biller</label>
                        <input type="number" class="form-control" id="biller_id" name="biller_id" placeholder="Enter Biller" required>
                    </div>
                    <div class="col-md-4">
                        <label for="transaction_type" class="form-label">Transaction Type</label>
                        <input type="number" class="form-control" id="transaction_type" name="transaction_type" placeholder="Enter Transaction Type">
                    </div>
                    <div class="col-md-4">
                        <label for="customer_segment_id" class="form-label">Customer Segment</label>
                        <input type="number" class="form-control" id="customer_segment_id" name="customer_segment_id" placeholder="Enter Customer Segment" required>
                    </div>
                    <div class="col-md-4">
                        <label for="special_promotion_id" class="form-label">Special Promotion</label>
                        <input type="number" class="form-control" id="special_promotion_id" name="special_promotion_id" placeholder="Enter Special Promotion" required>
                    </div>
                    <div class="col-md-4">
                        <label for="min_trans_amount" class="form-label">Min Transaction Amount</label>
                        <input type="number" class="form-control" id="min_trans_amount" name="min_trans_amount" placeholder="Enter Min Transaction Amount" required>
                    </div>
                    <div class="col-md-4">
                        <label for="max_trans_amount" class="form-label">Max Transaction Amount</label>
                        <input type="number" class="form-control" id="max_trans_amount" name="max_trans_amount" placeholder="Enter Max Transaction Amount">
                    </div>
                    <div class="col-md-4">
                        <label for="commission_rate" class="form-label">Commission Rate</label>
                        <input type="number" step="0.01" class="form-control" id="commission_rate" name="commission_rate" placeholder="Enter Commission Rate" required>
                    </div>
                    <div class="col-md-4">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time">
                    </div>
                    <div class="col-md-4">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time">
                    </div>
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Commission Matrix</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- END Create Matrix Modal -->
