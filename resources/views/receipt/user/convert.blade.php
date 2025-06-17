@extends('layouts.fileLayout')
@section('file_title', 'Receipt Inbox')

@section('file_content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    .container {
        max-width: 900px;
        margin: 20px auto;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .section {
        margin-bottom: 20px;
    }

    .section .details-container {
        display: flex;
        justify-content: space-between;
        /* Adjust spacing between the divs */
        gap: 20px;
        /* Optional: Adds space between the two divs */
    }

    .section .details-container>div {
        flex: 1;
        /* Ensures both divs take up equal space */
    }

    .section h3 {
        background-color: #999;
        margin: 0 0 10px;
        font-size: 16px;
        color: Black;
        padding-left: 1%;
    }

    .details,
    .issues-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    .details td {
        padding: 8px;
        font-size: 14px;
    }

    .details td.label {
        font-weight: bold;
        color: #555;
        width: 30%;
    }

    .receipt {
        padding: 10px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .issues-table th,
    .issues-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    .issues-table th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    .convert-btn {
        display: block;
        width: 100px;
        margin: 10px auto;
        padding: 10px;
        background-color: #007bff;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .convert-btn:hover {
        background-color: #0056b3;
    }

    .upload-container {
        display: flex;
        align-items: center;
        gap: 15px;
        font-family: Arial, sans-serif;
    }

    .upload-btn {
        position: relative;
        display: inline-block;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: bold;
        color: white;
        background: linear-gradient(45deg, #4caf50, #303CD5);
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .upload-btn:hover {
        background: linear-gradient(45deg, #388e3c, #66bb6a);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
    }

    .upload-btn:active {
        transform: scale(0.98);
    }

    #file-name {
        font-size: 14px;
        color: #555;
        font-style: italic;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
        /* Adjust this width as needed */
    }
</style>
<div class="container">
    <div class="header">Receipt Inbox</div>

    <!-- Receipt Details Section -->
    <div class="section" id="first-section">
        <h3>Receipt Details</h3>
        <div class="details-container">
            <div class="details-container-table">
                <table class="details">
                    <tr>
                        <td class="label">Comp. No. :</td>
                        <td>{{$receipt->computer_number??"N/A"}}</td>
                    </tr>
                    <tr>
                        <td class="label">Creation Date :</td>
                        <td>{{ $receipt->created_at->format('m/d/Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Letter Date :</td>
                        <td>{{date('m/d/Y h:i A',strtotime($receipt->dairy_date))}}</td>
                    </tr>
                    <tr>
                        <td class="label">Subject :</td>
                        <td>{{$receipt->subject}}</td>
                    </tr>
                </table>
            </div>
            <div class="details-container-table">
                <table class="details">
                    <tr>
                        <td class="label">Comp. No. :</td>
                        <td>{{$receipt->computer_number??"N/A"}}</td>
                    </tr>
                    <tr>
                        <td class="label">Creation Date :</td>
                        <td>{{ $receipt->created_at->format('m/d/Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Letter Date :</td>
                        <td>{{date('m/d/Y h:i A',strtotime($receipt->dairy_date))}}</td>
                    </tr>
                    <tr>
                        <td class="label">Subject :</td>
                        <td>{{$receipt->subject}}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <!-- Receipt Section -->
    <div class="section">
        <h3>Receipt</h3>
        <div class="upload-container">
            <label for="upload" class="upload-btn">Upload PDF</label>
            <input type="file" id="upload" accept=".pdf" style="display: none;" />
            <input type="hidden" id="receipt-id" value="{{$receipt->id}}">
            <span id="file-name">No file selected</span>
        </div>
    </div>

    <!-- Issues Section -->
    <div class="section">
        <h3>Issues</h3>
        <table class="issues-table">
            <thead>
                <tr>
                    <th>Issue No.</th>
                    <th>Subject</th>
                    <th>Issued By</th>
                    <th>Issued On</th>
                    <th>PDF</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">No Record Found</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Convert Button -->
    <a class="convert-btn" onclick="convertReceipt()">Convert</a>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    function convertReceipt() {
        var id = document.getElementById('receipt-id').value;
        var upload_file = document.getElementById('upload').files[0];
        console.log(upload_file);
        var formData = new FormData();
        formData.append('id', id);
        formData.append('upload_file', upload_file);

        $.ajax({
            url: "{{ route('convert.physical.details')}}",
            method: "POST",
            data: formData,
            contentType: false, // Prevent jQuery from setting the content type
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token for Laravel
            },
            success: function(response) {
                window.location.href = "{{ route('receipt.index') }}";
            },
            error: function(xhr, status, error) {
                console.error("Error:", xhr.responseText); // Log the error response
                alert("An error occurred while converting the receipt: " + error);
            }

        });
    }

    document.getElementById('upload').addEventListener('change', function() {
        const fileInput = this;
        const fileNameDisplay = document.getElementById('file-name');

        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = 'No file selected';
        }
    });
</script>
@endsection