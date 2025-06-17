<!-- Modal -->
<div class="modal fade" id="put_in_file_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div style="width: 70%;" class="modal-dialog" role="document">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <div style="width: 150%;" class="modal-content">
            <div class="modal-header" style="height:34px; background-color: rgb(15, 129, 196);">
                <h5 class="modal-title" id="exampleModalLongTitle"
                    style="
                            color: white;
                            font-size: 12px;
                            background-color: rgb(15, 129, 196);
                            border-radius: 4px;
                            height: 9px;
                        ">
                    Put In Files(s)
                </h5>
                <span class="close" style="color:white; cursor: pointer;" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <div>
                    <button id="create-putin-file" data-url="{{ route('file.create') }}"
                        style=" background-color: rgb(15, 129, 196);
                    color: white;
                    border: 2px solid rgb(15, 129, 196);
                    border-radius: 8px;
                    height:31px;
                    padding: 0px 10px;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;">
                        <span><i class="fa-solid fa-plus" style="color: white; font-size: 10px;"></i></span> Create File

                    </button>

                    <a href="{{ route('file.create') }}" id="create-putin-file" 
                        style=" background-color: rgb(15, 129, 196);
                    color: white;
                    border: 2px solid rgb(15, 129, 196);
                    border-radius: 8px;
                    height:31px;
                    padding: 0px 10px;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;">
                        <span><i class="fa-solid fa-plus" style="color: white; font-size: 10px;"></i></span> Create File

                    </a>
                </div>
                <table id="modal-file-datatable" class="put-file-table"
                    style="width: 100%; border-collapse: collapse; font-size: 12px">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="padding: 8px; text-align: center; font-size: 12px"> </th>
                            <th style="padding: 8px; text-align: center; font-size: 12px">Nature</th>
                            <th style="padding: 8px; text-align: center; font-size: 12px">Comp. No.</th>
                            <th style="padding: 8px; text-align: center; font-size: 12px">File No.</th>
                            <th style="padding: 8px; text-align: center; font-size: 12px">Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $key => $file)
                            <tr>
                                <td style="text-align: center; padding: 8px; font-size: 12px;">
                                    <input type="radio" name="selectFileRow" value="{{ $file->id }}">
                                </td>
                                <td style="padding: 8px; font-size: 12px;">P</td>
                                <td style="padding: 8px; font-size: 12px;">{{ $file->fileno }}</td>
                                <td style="padding: 8px; font-size: 12px;">{{ $file->fileno }}</td>
                                <td style="padding: 8px; font-size: 12px;">{{ $file->file_name }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <style>
                    #attach-btn {
                        background-color: gray !important;
                        border-color: gray !important;
                        color: white;
                    }


                    #attach-btn:hover {
                        background-color: rgb(19, 116, 172) !important;
                        border-color: rgb(19, 116, 172) !important;
                        color: white;
                        transition: background-color 0.3s ease;
                    }
                </style>

                <button id="attach-btn" type="button" class="btn btn-primary" style="font-size: 12px">Attach</button>


            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('#modal-file-datatable').DataTable();
    });
    document.addEventListener('contextmenu', function(e) {
        var link = e.target.classList.contains('custom-link');

        document.addEventListener('click', function(event) {
            if (event.target && event.target.id == 'create-putin-file') {
                window.location.href = event.target.dataset.url;
            }
            if (event.target && event.target.id == 'attach-btn') {
                console.log("Comming to the target");
                const receiptId = e.target.getAttribute('data-id');
                // const receiptId = $('#put-in-file-btn').data('id');
                
                console.log(receiptId);
                const selectedOption = document.querySelector('input[name="selectFileRow"]:checked')
                    .value;
                console.log(selectedOption);
                $.ajax({
                    url: "{{ route('add.receipt.to.file') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        file_id: selectedOption,
                        receipt_id: receiptId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.code == 200) {
                            Swal.fire({
                                toast: true, // Enables toast mode
                                position: 'top-end', // Position it in the upper-right corner
                                icon: 'success', // You can change the icon to 'error', 'warning', etc.
                                title: "The Receipt has been put in a file",
                                showConfirmButton: false, // No confirmation button needed for a toast
                                timer: 3000, // Auto-close after 3 seconds
                                timerProgressBar: true, // Show a progress bar to indicate time remaining
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer
                                    ) // Pause timer when hovered
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer
                                    ) // Resume timer when unhovered
                                },
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown' // Add animation class
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp' // Add hide animation
                                },
                                customClass: {
                                    popup: 'custom-toast' // Add a custom class to the toast
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.log("Error:", error);
                    }
                })
            }
        });
    });
</script>
