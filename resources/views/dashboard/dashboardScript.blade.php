<script>
    const myReciptButton = document.querySelector('#recipts');
    const myeFileButton = document.querySelector('#efile');
    const noticeButton = document.querySelector('#notice_board');
    const myDocButton = document.querySelector('#my_doc');
    // dashboard teams sarch
    const searchIcon = document.getElementById('team-search');
    const searchInput = document.getElementById('searchInput');
    const closeSearch = document.getElementById('closeSearch');

    window.addEventListener('load', function() {
        efileAjax('file_inbox');
        getTodo();
        getNotes();
        get_notices();
        get_team(null);
        // myReciptButton.className = 'inactive';
        // myeFileButton.className = 'active';
    });
    //change status
    $(document).on('click', '#online', function() {
        changeStaus(1);
    });
    $(document).on('click', '#busy', function() {
        changeStaus(2);
    });
    $(document).on('click', '#meeting', function() {
        changeStaus(5);
    });
    $(document).on('click', '#tea_break', function() {
        changeStaus(3);
    });
    $(document).on('click', '#lunch_break', function() {
        changeStaus(4);
    });

    //reload icons
    $(document).on('click', '.reload-icon', function() {
        efileAjax('file_inbox');
    });
    $(document).on('click', '#todo_reload', function() {
        getTodo();
    });
    $(document).on('click', '#notes-reload', function() {
        getNotes();
    });
    $(document).on('click', '#reload-noticeboard', function() {
        get_notices();
    });
    $(document).on('click', '#team_reload', function() {
        searchInput.style.display = "none";
        searchIcon.style.display = "inline-block";
        closeSearch.style.display = "none";
        get_team(null);
    })

    function changeStaus(status_value) {
        $.ajax({
            url: "{{ route('change.user.status') }}",
            type: "POST",
            data: {
                status_type: status_value,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.code == 200) {
                    Swal.fire({
                        toast: true, // Enables toast mode
                        position: 'top-end', // Position it in the upper-right corner
                        icon: 'success', // You can change the icon to 'error', 'warning', etc.
                        title: response.message,
                        showConfirmButton: false, // No confirmation button needed for a toast
                        timer: 3000, // Auto-close after 3 seconds
                        timerProgressBar: true, // Show a progress bar to indicate time remaining
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer) // Pause timer when hovered
                            toast.addEventListener('mouseleave', Swal.resumeTimer) // Resume timer when unhovered
                        },
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown' // Add animation class
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp' // Add hide animation
                        }
                    });
                    get_team(null);
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        },
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });
                }
            }
        });
    }
    myReciptButton.addEventListener('click', () => {
        myReciptButton.className = 'active';
        myeFileButton.className = 'inactive';

        efileAjax('recipt_inbox');
    });

    myeFileButton.addEventListener('click', () => {
        myReciptButton.className = 'inactive';
        myeFileButton.className = 'active';

        efileAjax('file_inbox');
    });

    //for maximize view of the eFile card
    $(document).on('click', '#eFile-lg-modal', function() {
        if (myeFileButton.className == 'active') {
            console.log(myeFileButton.className);
            $.ajax({
                url: "{{url('get-files')}}",
                type: "GET",
                data: {
                    type: "file_inbox",
                },
                success: function(response) {
                    console.log(response.data);
                    var filesTableElement = document.getElementById('eFile-lg-table');
                    filesTableElement.innerHTML = '';
                    var fileInboxHTML = ` <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">File</th>
                                                    <th scope="col">Send Date</th>
                                                    <th scope="col">Due Date</th>
                                                    <th scope="col">Send To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        `;
                    if (response.data != null) {
                        for (const index of response.data) {
                            let url = `{{ url('file-notes') }}/1`;

                            fileInboxHTML += ` <tr>
                                                    <td>${index.id}</td>
                                                    <td>${index.files.file_name}</td>
                                                    <td>${index.send_date}</td>
                                                    <td>${index.duedate}</td>
                                                    <td>${index.user.name}</td>
                                                </tr>`;
                            // Append the new content for each item
                            fileInboxHTML += `</tbody>`;
                            // Set the innerHTML of the table
                            filesTableElement.innerHTML = fileInboxHTML;
                        }
                    }
                }
            });
        } else {
            $.ajax({
                url: "{{url('get-files')}}",
                type: "GET",
                data: {
                    type: "recipt_inbox",
                },
                success: function(response) {
                    console.log(response.data);
                    var receiptsTableElement = document.getElementById('eFile-lg-table');
                    receiptsTableElement.innerHTML = '';
                    var receiptInboxHTML = `<thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Received File</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Dairy Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                    if (response.data != null) {
                        for (const index of response.data) {
                            let url = `{{ url('file-notes') }}/1`;

                            receiptInboxHTML += ` <tr>
                                                <td>${index.id}</td>
                                                    <td>${index.receipts.subject}</td>
                                                    <td>${index.receipts.receipt_file}</td>
                                                    <td>${index.receipts.dairy_date}</td>
                                                </tr>`;
                            // Append the new content for each item
                            receiptInboxHTML += `</tbody>`;
                            // Set the innerHTML of the table
                            receiptsTableElement.innerHTML = receiptInboxHTML;
                        }
                    }
                }
            });
        }
    });
    //end

    //for maximize view of the Notice Board card
    $(document).on('click', '#notice-lg-modal', function() {
        if (noticeButton.className == 'active') {
            $.ajax({
                url: "{{url('get-notices')}}",
                type: "GET",
                success: function(response) {
                    console.log(response.data);
                    var noticeTableElement = document.getElementById('notice-lg-table');
                    noticeTableElement.innerHTML = '';
                    var noticeHTML = ` <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        `;
                    if (response.data != null) {
                        for (const index of response.data) {
                            var notice_documents = index.notice_documents;
                            if (notice_documents.length > 0 && index.file_type != 0) {
                                noticeHTML += ` <tr>
                                                    <td>${index.id}</td>
                                                    <td>${index.title}</td>
                                                    <td><a class="file_description" href="public/${index.file_path}" target="_blank"">${index.description}</a></td>
                                                    <td>${index.date}</td>
                                                </tr>`;
                                // Append the new content for each item
                                noticeHTML += `</tbody>`;
                            } else {
                                noticeHTML += ` <tr>
                                                    <td>${index.id}</td>
                                                    <td>${index.title}</td>
                                                    <td><a class="file_description notice_description" data-id="${index.id}" data-toggle="modal" data-target="#noticeViewModal" href="#">${index.description}</a></td>
                                                    <td>${index.date}</td>
                                                </tr>`;
                                // Append the new content for each item
                                noticeHTML += `</tbody>`;
                            }

                            // Set the innerHTML of the table
                            noticeTableElement.innerHTML = noticeHTML;
                        }
                    }
                }
            });
        } else {
            $.ajax({
                url: "{{url('get-documents')}}",
                type: "GET",
                success: function(response) {
                    console.log(response.data);
                    var documentsTableElement = document.getElementById('notice-lg-table');
                    documentsTableElement.innerHTML = '';
                    var documentInboxHTML = `<thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Document Name</th>
                                                    <th scope="col">Created By</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                    if (response.data != null) {
                        for (const index of response.data) {
                            let url = `{{ url('file-notes') }}/1`;

                            documentInboxHTML += ` <tr>
                                                <td>${index.id}</td>
                                                    <td>${index.document_name}</td>
                                                    <td>${index.username}</td>
                                                    <td>${index.description}</td>
                                                </tr>`;
                            // Append the new content for each item
                            documentInboxHTML += `</tbody>`;
                            // Set the innerHTML of the table
                            documentsTableElement.innerHTML = documentInboxHTML;
                        }
                    }
                }
            });
        }
    });
    //end

    //for maximize view of the notes card
    $(document).on('click', '#notes-lg-modal', function() {
        $.ajax({
            url: "{{url('get-pnotes')}}",
            type: "GET",
            success: function(response) {
                console.log(response.data);
                var notesTableElement = document.getElementById('notes-lg-table');
                notesTableElement.innerHTML = '';
                var notesInboxHTML = ` <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        `;
                if (response.data != null) {
                    for (const index of response.data) {
                        let url = `{{ url('file-notes') }}/1`;

                        notesInboxHTML += ` <tr>
                                                    <td>${index.id}</td>
                                                    <td>${index.title}</td>
                                                    <td>${index.description}</td>
                                                </tr>`;
                        // Append the new content for each item
                        notesInboxHTML += `</tbody>`;
                        // Set the innerHTML of the table
                        notesTableElement.innerHTML = notesInboxHTML;
                    }
                } else {
                    var fileInboxHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    todosTableElement.innerHTML = fileInboxHTML;
                }
            }
        });
    });
    //end

    //for maximize view of the Todo List card
    $(document).on('click', '#todos-lg-modal', function() {
        // if (myeFileButton.className == 'active') {
        console.log(myeFileButton.className);
        $.ajax({
            url: "{{url('get-todo-details')}}",
            type: "GET",
            success: function(response) {
                console.log(response.data);
                var todosTableElement = document.getElementById('todos-lg-table');
                todosTableElement.innerHTML = '';
                var todoDetailsHTML = ` <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        `;
                if (response.data != null) {
                    for (const index of response.data) {
                        todoDetailsHTML += ` <tr>
                                                <td>${index.id}</td>
                                                <td>${index.title}</td>
                                                <td>${index.date}</td>
                                                <td>${index.description}</td>   
                                             </tr>`;
                        // Append the new content for each item
                        todoDetailsHTML += `</tbody>`;
                        // Set the innerHTML of the table
                        todosTableElement.innerHTML = todoDetailsHTML;
                    }
                } else {
                    var todoDetailsHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    todosTableElement.innerHTML = todoDetailsHTML;
                }
            }
        });
    });
    //end
    noticeButton.addEventListener('click', () => {
        noticeButton.className = 'active';
        myDocButton.className = 'inactive';

        get_notices();
    });

    myDocButton.addEventListener('click', () => {
        noticeButton.className = 'inactive';
        myDocButton.className = 'active';

        get_documents();
    });

    function efileAjax(inbox_type) {
        $.ajax({
            url: "{{url('get-files')}}",
            type: "GET",
            data: {
                type: inbox_type,
            },
            success: function(response) {
                // Get the target element
                var fileDetailsElement = document.getElementById('file_details');

                // Clear the previous content to avoid repetition
                fileDetailsElement.innerHTML = '';

                if (response.data != null) {
                    let file_index = response.data;

                    if (inbox_type == "recipt_inbox") {
                        for (const index of file_index) {
                            let url = `{{ url('file-notes') }}/1`;

                            var fileInboxHTML =
                                `<li>
                                    <p class="card-text">${index.receipts.subject}</p>
                                    <a class="file_description" href="${url}">${index.receipts.receipt_file}</a>
                                    <a class="file_description_date" href="#">ON ${index.receipts.dairy_date}</a>
                                </li>`;

                            // Append the new content for each item
                            fileDetailsElement.innerHTML += fileInboxHTML;
                        }
                    } else {
                        for (const index of file_index) {
                            var fileName = index.files.file_name;
                            var userName = index.user.name;
                            var remarks = index.remarks;
                            var dueDate = index.duedate;
                            var url = '';

                            // Adjust the formatting if the item is unread
                            if (index.read_status == 0) {
                                fileName = `<strong>${fileName}</strong>`;
                                userName = `<strong>${userName}</strong>`;
                                dueDate = `<strong>${dueDate}</strong>`;
                                remarks = `<strong>${remarks}</strong>`;
                            }

                            // Determine the correct URL based on the status
                            if (index.status == 1) {
                                url = `{{url('file.inbox.notes')}}/${index.file_id}/${index.id}`;
                            } else if (index.status == 0 || index.status == 2 || index.status == 3) {
                                url = `{{url('file_view')}}/${index.file_id}/${index.id}`;
                            }

                            var fileInboxHTML =
                                `<li>
                                    <p class="card-text">${fileName}</p>
                                    <a class="file_description" href="${url}">${userName}, ${remarks}</a>
                                    <a class="file_description_date" href="#">ON ${dueDate}</a>
                                </li>`;
                            // Append the new content for each item
                            fileDetailsElement.innerHTML += fileInboxHTML;
                        }
                    }
                } else {
                    var fileInboxHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    fileDetailsElement.innerHTML = fileInboxHTML;
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }

    function get_documents(inbox_type) {
        $.ajax({
            url: "{{url('get-documents')}}",
            type: "GET",
            success: function(response) {
                // Get the target element
                var document_details = document.getElementById('notice_board_details');

                // Clear the previous content to avoid repetition
                document_details.innerHTML = '';

                if (response.data != null) {
                    let data = response.data;
                    for (const index of data) {
                        console.log(index.file_path);
                        var fileInboxHTML =
                            `<li>
                                    <p class="card-text-notes">${index.document_name}</p>
                                    <a class="file_description" href="public/${index.documentpath}">${index.description}</a>
                                    <a class="document_description_date" href="public/${index.documentpath}">By ${index.username}</a>
                                </li>`;

                        // Append the new content for each item
                        document_details.innerHTML += fileInboxHTML;
                    }

                } else {
                    var fileInboxHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    document_details.innerHTML = fileInboxHTML;
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }

    function get_notices() {
        $.ajax({
            url: "{{url('get-notices')}}",
            type: "GET",
            success: function(response) {
                // Get the target element
                var document_details = document.getElementById('notice_board_details');

                // Clear the previous content to avoid repetition
                document_details.innerHTML = '';

                if (response.data != null) {
                    let data = response.data;
                    for (const index of data) {
                        console.log(index);
                        var noticeHTML = "";
                        var notice_documents = index.notice_documents;
                        if (notice_documents.length > 0 && index.file_type != 0) {
                            noticeHTML =
                                `<li>
                                    <p class="card-text-notes">${index.title}</p>
                                    <a class="file_description" href="public/${index.file_path}" target="_blank">${index.description}</a>
                                    <a class="document_description_date" href="#">On ${index.date}</a>
                                </li>`;
                        } else {
                            noticeHTML =
                                `<li>
                                    <p class="card-text-notes">${index.title}</p>
                                    <a class="file_description notice_description" data-id="${index.id}" data-toggle="modal" data-target="#noticeViewModal" href="#">${index.description}</a>
                                    <a class="document_description_date" href="#">On ${index.date}</a>
                                </li>`;
                        }
                        // Append the new content for each item
                        document_details.innerHTML += noticeHTML;
                    }

                } else {
                    var noticeHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    document_details.innerHTML = noticeHTML;
                }
            },
            error: function() {
                console.log("error");
            }
        })
    }

    function getTodo() {
        var fileDetailsElement = document.getElementById('todo_details');
        fileDetailsElement.innerHTML = '';

        $.ajax({
            url: "{{url('get-todo-details')}}",
            type: "GET",
            success: function(response) {
                var todos = response.data;
                if (todos != null) {
                    for (const index of todos) {
                        var fileInboxHTML =
                            `<li style="display: flex; justify-content: space-between; align-items: center; position: relative; padding-left: 20px;">
                                <div style="width: 75%;">
                                    <p class="card-text"  style="font-weight:500">${index.title}</p>
                                    <p class="file_description_date" style="font-weight:400;">on ${index.date}</p>
                                </div>
                                <div class="icons" style="flex: none; gap: 10px;">
                                    <i id="edit${index.id}" class="fas fa-edit edit-icon edit_modal" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModalCenter1" title="Edit" data-id ="` + index.id + `"></i>
                                    <i id="delete${index.id}" onclick="delete_todo(${index.id})" class="fas fa-trash-alt delete-icon" style=" cursor: pointer;" title="Delete"></i>
                                    <i id="done${index.id}" onclick="done_todo(${index.id})" class="fas fa-check done-icon "  style=" cursor: pointer;" title="Done"></i>
                                </div>                
                                <span style="position: absolute; left: 0;"> <i class="fas fa-file-alt"></i></span>     
                            </li>`;

                        // Append the new content for each item
                        fileDetailsElement.innerHTML += fileInboxHTML;
                    }
                } else {
                    var fileInboxHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    fileDetailsElement.innerHTML = fileInboxHTML;
                }
            },
            error: function() {
                console.error("Something thing error happended ");
            }
        });
    }

    function get_team(text) {
        var tamsDetailsElement = document.getElementById('teams-details');
        tamsDetailsElement.innerHTML = '';
        $.ajax({
            url: "{{url('get-teams')}}",
            type: "GET",
            data: {
                search_text: text
            },
            success: function(response) {
                var teams = response.data;
                if (teams != null) {
                    for (const index of teams) {
                        console.log(index.avatar);
                        var userAvatarPath = "{{ asset('assets/images/user/') }}"; // Base path to user avatars
                        var teamsInboxHTML = `
    <li data-toggle="tooltip" data-placement="left" title="${index.status_name}">
        <div class="row">
            <div class="col-2">
                <div class="profile ${index.status == 1 ? "active" : ""}">
                    <img
                        src="${index.avatar != null ? userAvatarPath + '/' + index.avatar : 'https://via.placeholder.com/100'}"
                        alt="user"
                        class="rounded-circle mb-2" />
                </div>
            </div>
            <div class="col-10">
                <div class="team-details"><p class="team-name">${index.name}</p><p class="status">(${index.status_name})</p></div>
                <p style="font-size: smaller;">${index.department_name}</p>
            </div>
        </div>
    </li>`;

                        // Append the new content for each item
                        tamsDetailsElement.innerHTML += teamsInboxHTML;
                    }
                } else {
                    var fileInboxHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    fileDetailsElement.innerHTML = fileInboxHTML;
                }
            },
            error: function() {
                console.log("Error");

            }
        });
    }

    $(document).on('click', '.edit_modal', function() {
        var itemId = $(this).data('id');
        getTodoItemById(itemId).then(function(data) {
            if (data) {
                $('#todo_id').val(data.id);
                $('#todo_title').val(data.title);
                $('#todo_date').val(data.date);
                $('#todo_description').val(data.description);
            } else {
                console.log('Failed to retrieve data');
            }
        });
    });

    $(document).on('click', '.notice_description', function() {
        var noticeId = $(this).data('id');
        getNoticeItemById(noticeId).then(function(data) {
            if (data) {
                console.log(data.title);
                $('#notice_title').text(data.title);
                $('#notice_description').text(data.description);
            } else {
                console.log('Failed to retrieve data');
            }
        })
    });

    $(document).on('click', '.notes_edit_modal', function() {
        var itemId = $(this).data('id');
        getNotesById(itemId).then(function(data) {
            if (data) {
                $('#notes_id').val(data.id);
                $('#notes_title').val(data.title);
                $('#notes_description').val(data.description);
            } else {
                console.log('Failed to retrieve data');
            }
        });
    });

    function getNoticeItemById(id) {
        return $.ajax({
            url: "{{url('get-notice-details')}}/" + id,
            type: 'GET'
        }).then(function(response) {
            return response.data;
        }).catch(function(error) {
            console.error('AJAX request failed:', error);
            return null; // Return null in case of failure
        });
    }

    function getTodoItemById(id) {
        return $.ajax({ // Return the promise from $.ajax
                url: "{{url('get-todo-details')}}/" + id,
                type: "GET"
            })
            .then(function(response) {
                return response.data; // Resolve with the data from the response
            })
            .catch(function(error) {
                console.error('AJAX request failed:', error);
                return null; // Return null in case of failure
            });
    }



    function getNotesById(id) {
        return $.ajax({ // Return the promise from $.ajax
                url: "{{url('get-notes-details')}}/" + id,
                type: "GET"
            })
            .then(function(response) {
                return response.data; // Resolve with the data from the response
            })
            .catch(function(error) {
                console.error('AJAX request failed:', error);
                return null; // Return null in case of failure
            });
    }

    function delete_todo(id) {
        $.ajax({
            url: "{{url('delete-todo-details')}}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.code == 200) {
                    getTodo();
                } else {
                    getTodo();
                }
            }
        });
    }

    function done_todo(id) {
        $.ajax({
            url: "{{url('done-todo')}}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.code == 200) {
                    getTodo();
                } else {
                    getTodo();
                }
            }
        });
    }

    function getNotes() {
        var fileDetailsElement = document.getElementById('notes_details');
        fileDetailsElement.innerHTML = '';

        $.ajax({
            url: "{{url('get-pnotes')}}",
            type: "GET",
            success: function(response) {
                var notes = response.data;
                if (notes != null) {
                    for (const index of notes) {
                        var fileInboxHTML =
                            `<li>
                      <div class="notes-title" style="display:flex">
                        <p class="card-notes-text">${index.title}</p>
                        <div class="notes-icon" style="flex: none; gap: 10px; margin-top:2px">
                          <i id="edit${index.id}" class="fas fa-edit edit-icon notes_edit_modal" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModalCenter3" title="Edit" data-id ="` + index.id + `"></i>
                          <i id="delete${index.id}" onclick="delete_notes(${index.id})" class="fas fa-trash-alt delete-icon" style=" cursor: pointer;" title="Delete"></i>
                          <i id="done${index.id}" onclick="done_todo(${index.id})" class="fas fa-share done-icon "  style=" cursor: pointer;" title="Done"></i>
                        </div>  
                      </div>
                      <div class="notes-description">
                          <a class="file_description" href="#">${index.description}</a>
                      </div>
                  </li>`;
                        // <span style="position: absolute; left: 0;"> <i class="fas fa-file-alt"></i></span>     

                        // Append the new content for each item
                        fileDetailsElement.innerHTML += fileInboxHTML;
                    }
                } else {
                    var fileInboxHTML =
                        `<div class="file_card">
                            <ul class="file_card-content">
                            <li class="file_no-data">No Data Found!</li>
                            </ul>
                        </div>`;
                    // Display the "No Data Found" message
                    fileDetailsElement.innerHTML = fileInboxHTML;
                }
            },
            error: function() {
                console.error("An error has occurred.");
            }
        });
    }

    function delete_notes(id) {
        $.ajax({
            url: "{{url('delete-notes-details')}}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.code == 200) {
                    getNotes();
                } else {
                    getNotes();
                }
            }
        });
    }



    // Show the search bar when the search icon is clicked
    searchIcon.addEventListener('click', () => {
        searchInput.value = "";
        searchInput.style.display = "inline-block";
        searchIcon.style.display = "none";
        closeSearch.style.display = "inline-block";
    });

    closeSearch.addEventListener('click', () => {
        searchInput.style.display = "none";
        searchIcon.style.display = "inline-block";
        closeSearch.style.display = "none";
    });

    searchInput.addEventListener('keydown', function(event) {
        if (event.key == 'Enter' || event.keyCode == 13) {
            console.log(searchInput.value);
            get_team(searchInput.value);
            searchInput.value = "";
            searchInput.style.display = "none";
            searchIcon.style.display = "inline-block";
            closeSearch.style.display = "none";
        }
    })


    // Hide the search bar when the close icon is clicked
    closeSearch.addEventListener('click', () => {
        searchInput.classList.remove('visible');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>