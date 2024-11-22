<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true" wire:ignore>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modal2Label">

                </h5>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>آیا از <span class="text-primary">ویرایش </span> نظر این کاربر اطمینان دارید؟</p>
                <form id="modalForm" wire:submit.prevent="">
                    <div class="mb-3">
                        <textarea name="replyToUser" wire:model.defer="replyToUser" class="form-control" style="height: fit-content" id="message-text" rows="6" placeholder="اگر پاسخی دارید آن را بنویسید"></textarea>
                    </div>
                    <div class="modal-footer p-0 pt-1">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                        <button type="submit" class="btn btn-primary modal-ok-buttom" id="modalSubmit">تائید</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
