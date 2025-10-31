<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{ __('Edit Quick Links') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxEditForm" class="modal-form" action="{{ route('user.footer.update_quick_link') }}"
                    method="post">
                    @csrf
                    <input type="hidden" id="in_id" name="link_id">

                    <div class="form-group">
                        <label for="">{{ __('Title') }} <span class="text-danger">{{ '*' }}</span></label>
                        <input type="text" id="in_title" class="form-control" name="title"
                            placeholder="{{ __('Enter Title') }}">
                        <p id="eerrtitle" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('URL') }} <span class="text-danger">{{ '*' }}</span> </label>
                        <input type="url" id="in_url" class="form-control" name="url"
                            placeholder="{{ __('Enter url') }}">
                        <p id="eerrurl" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Serial Number') }} <span class="text-danger">{{ '*' }}</span> </label>
                        <input type="number" id="in_serial_number" class="form-control" name="serial_number"
                            placeholder="{{ __('Enter serial number') }}">
                        <p id="eerrserial_number" class="mt-1 mb-0 text-danger em"></p>
                        <p class="text-warning mt-2">
                            <small>
                                {{ __('The higher the serial number will be shown') }}
                            </small>
                        </p>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Close') }}
                </button>
                <button id="updateBtn" type="button" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            </div>
        </div>
    </div>
</div>
