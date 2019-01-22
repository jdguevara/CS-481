<!-- confirmed event modal -->
<div id="confirmed-event-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {!! $messages['confirmed_event_title'] or '<h3>An organization has adopted this meal!</h3>'  !!}
            </div>
            <div class="modal-body">
                <div class="container-fluid volunteer-inputs">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Date</span>
                            <input id="confirmed-event-date" name="event_date" type="text"  
                                    class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Organization</span>
                            <input id="confirmed-title" name="title" type="text"
                                    class="form-control" placeholder="Title" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Description</span>
                            <input id="confirmed-description" name="description" type="text" class="form-control"
                                    placeholder="Description" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>