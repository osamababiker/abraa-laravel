<div class="modal fade" id="feedback_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body m-3"  style="justify-content: center; text-align: center">
                <div class="feedback_status">
                    @if(session()->has('success'))
                        <span> <i class="fa fa-check success"></i> </span>
                    @elseif(session()->has('error')) 
                        <span> <i class="fa fa-times error"></i> </span>
                    @endif
                </div>
                <div class="feedback_title">
                    <h4> {{ session()->get('feedback_title') }} </h4>
                </div>
                <div class="feedback">
                    <p class="mb-0"> 
                        {{ session()->get('feedback') }} 
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
