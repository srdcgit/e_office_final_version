<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div
                style="background-color: rgb(5, 121, 175); width: 298px; height: 35px; border: 2px solid rgb(5, 121, 175); border-radius: 1px; padding-left: 12px; box-sizing: border-box;">
                <div class="modal-header"
                    style="padding-bottom: 0px !important;border: none ;display: flex; justify-content: space-between; align-items: center;padding-right: 9px;padding-top: 4px; height: 80%;">
                    <h5 class="modal-title" id="exampleModalLongTitle"
                        style="color: white; margin: 0; font-size: 15px;
                    margin-left:-24px;">
                        Put In File(s)
                    </h5>
                    <span class="close" style="color:white; cursor: pointer;" data-dismiss="modal" aria-label="Close"
                        aria-hidden="true">&times;</span>
                </div>
            </div>


            <p style="margin-left: 1%">Do you want to send it back?</p>
            <form action="{{ route('receipt.send.back') }}" method="post">
                @csrf
                <input type="hidden" name="receipt_id" id="receipt-id">
                <input type="hidden" name="sender_id" id="sender-id">
                <input type="hidden" name="recever_id" id="recever-id">
                <input type="hidden" name="section_id" id="section-id">
                <input type="hidden" name="department_id" id="department-id">
                <div class="submit">
                    <button class="send-back-btn" type="submit">Send
                        Back</button>
                    <button class="send-back-btn" type="submit">Cancel</button>

                    <style>
                        .submit {
                            background-color: rgb(238, 230, 220);

                        }
                    </style>

                </div>
            </form>
        </div>
    </div>
</div>
