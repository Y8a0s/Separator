<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="replyModalLabel">پاسخ به</h2>
                <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submitReply">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="parent_id" wire:model.defer="parent_id" class="form-control" id="recipient-name">

                        <label for="message-text" class="col-form-label">پیام شما:</label>
                        <textarea name="reply" wire:model.defer="reply" class="form-control @error('reply') is-invalid @enderror" id="message-text"></textarea>
                        @error('reply')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="submit" class="btn btn-primary" id="modalSubmit" disabled>ثبت</button>
                </div>
            </form>
        </div>
    </div>
</div>