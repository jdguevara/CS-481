<form id="event-form" method="POST" action="">
    {{ csrf_field() }}
    <div class="modal fade" id="event-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="event-summary" style="margin-top: 15px;"></h3>
                </div>
                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">
                    <div id="inputs" class="container-fluid volunteer-inputs">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Organization Name</span>
                                <input type="text" id="organization-name" name="organization_name" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Meal Description</span>
                                <input type="text" id="meal-description" name="meal_description" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Date</span>
                                <input type="text" id="event-date-time" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Email</span>
                                <input type="text" id="email" name="email" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Phone</span>
                                <input type="text" id="phone" name="phone" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Notes</span>
                                <input type="text"id="notes" name="notes" class="form-control"  @if(!$editMode) disabled @endif/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Paper Goods</span>
                                <input type="text" id="paper-goods" name="paper_goods" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>
                        <input type="string" id="event-date-time" name="event_date_time" class="hidden" hidden>
                        <input type="number" id="form-status" name="form_status" hidden>
                        <input type="text" id="open-event-id" name="open_event_id" hidden>
                        <input type="text" id="confirmed-event-id" name="confirmed_event_id" hidden>
                        <input type="number" id="volunteer-id" name="volunteer_id" hidden>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="input-group pull-right">
                        @if($editMode)
                        <button id="approve" type="button" class="btn btn-success" onClick="submitAdminReviewVolunteerForm('update');">
                            Update Volunteer
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitAdminReviewVolunteerForm('cancel');">
                            Cancel Volunteer
                        </button> 
                        @else
                        <button id="approve" type="button" class="btn btn-success" onClick="submitAdminReviewVolunteerForm('approve');">
                            Approve Volunteer
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitAdminReviewVolunteerForm('deny');">
                            Deny Volunteer
                        </button>        
                        @endif
                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>