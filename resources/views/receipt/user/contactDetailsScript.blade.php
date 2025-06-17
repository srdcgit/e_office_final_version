<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script>
    function get_contact_name() {
        console.log('coming to auto complete');
        let contact_value = document.querySelector('#contactDropdown input[name="name"]').value;
        if (contact_value != null && contact_value.length >= 3) {
            console.log(contact_value);
            // Hide phone dropdown when searching for names
            const phoneDropdown = document.querySelector('#phone-autoComplete-dropdown-menu');
            if (phoneDropdown) {
                phoneDropdown.style.display = 'none';
            }
            
            $.ajax({
                url: "{{ route('get.contact.names')}}",
                data: {
                    name: contact_value
                },
                type: "GET",
                success: function(response) {
                    console.log(response.data);
                    if (response.data != null) {
                        let dropdownMenu = document.querySelector('#autoComeplete-dropdown-menu');
                        dropdownMenu.innerHTML = ''; // Clear existing items
                        console.log(dropdownMenu);

                        response.data.forEach(item => {
                            console.log(item.name);
                        

                            // Create a new dropdown item for each result
                            let dropdownItem = document.createElement('a');
                            dropdownItem.classList.add('dropdown-item');
                            dropdownItem.href = '#';
                            dropdownItem.textContent = item.name + ', ' + item.email; // Display the name
                            dropdownItem.dataset.id = item.id;
                            dropdownItem.style.borderBottom = '1px solid #ddd';
                            dropdownItem.style.color = 'black';

                            dropdownItem.onclick = function(e) {
                                e.preventDefault();
                                document.querySelector('#autoComeplete-dropdown-menu').style.display = 'none';

                                console.log('Dropdown item clicked:', item);

                                $.ajax({
                                    url: "{{ route('get.contact.details.by.id')}}",
                                    data: {
                                        id: item.id
                                    },
                                    type: "get",
                                    success: function(response) {
                                        console.log(response.data);
                                        fillContactDetails(response.data);
                                    }
                                });
                            }
                            dropdownMenu.appendChild(dropdownItem);
                        });

                        // Show the dropdown menu and position it correctly
                        dropdownMenu.style.display = 'block';
                        dropdownMenu.style.width = document.querySelector('#contactDropdown').offsetWidth + 'px';
                        document.querySelector('#contactDropdown').classList.add('show');
                    } else {
                        document.querySelector('#autoComeplete-dropdown-menu').style.display = 'none';
                        document.querySelector('#contactDropdown').classList.remove('show');
                    }
                },
                error: function() {
                    console.log("error");
                }
            });
        } else {
            document.querySelector('#autoComeplete-dropdown-menu').style.display = 'none';
            document.querySelector('#contactDropdown').classList.remove('show');
        }
    }

    function get_contact_phone() {
        console.log('coming to phone auto complete');
        let phone_value = document.querySelector('#phoneDropdown input[name="phone_number"]').value;
        if (phone_value != null && phone_value.length >= 3) {
            console.log(phone_value);
            // Hide name dropdown when searching for phone numbers
            document.querySelector('#autoComeplete-dropdown-menu').style.display = 'none';
            document.querySelector('#contactDropdown').classList.remove('show');
            
            $.ajax({
                url: "{{ route('get.contact.by.phone')}}",
                data: {
                    phone: phone_value
                },
                type: "GET",
                success: function(response) {
                    console.log(response.data);
                    if (response.data != null) {
                        let dropdownMenu = document.querySelector('#phone-autoComplete-dropdown-menu');
                        dropdownMenu.innerHTML = ''; // Clear existing items
                        console.log(dropdownMenu);

                        response.data.forEach(item => {
                            console.log(item.name);

                            // Create a new dropdown item for each result
                            let dropdownItem = document.createElement('a');
                            dropdownItem.classList.add('dropdown-item');
                            dropdownItem.href = '#';
                            dropdownItem.textContent = item.name + ' - ' + item.phone_number; // Display name and phone
                            dropdownItem.dataset.id = item.id;
                            dropdownItem.style.borderBottom = '1px solid #ddd';
                            dropdownItem.style.color = 'black';

                            dropdownItem.onclick = function(e) {
                                e.preventDefault();
                                document.querySelector('#phone-autoComplete-dropdown-menu').style.display = 'none';
                                document.querySelector('#phoneDropdown').classList.remove('show');

                                console.log('Dropdown item clicked:', item);

                                $.ajax({
                                    url: "{{ route('get.contact.details.by.id')}}",
                                    data: {
                                        id: item.id
                                    },
                                    type: "get",
                                    success: function(response) {
                                        console.log(response.data);
                                        fillContactDetails(response.data);
                                    }
                                });
                            }
                            dropdownMenu.appendChild(dropdownItem);
                        });

                        // Show the dropdown menu and position it correctly
                        dropdownMenu.style.display = 'block';
                        dropdownMenu.style.width = document.querySelector('#phoneDropdown').offsetWidth + 'px';
                        document.querySelector('#phoneDropdown').classList.add('show');
                    } else {
                        document.querySelector('#phone-autoComplete-dropdown-menu').style.display = 'none';
                        document.querySelector('#phoneDropdown').classList.remove('show');
                    }
                },
                error: function() {
                    console.log("error");
                }
            });
        } else {
            document.querySelector('#phone-autoComplete-dropdown-menu').style.display = 'none';
            document.querySelector('#phoneDropdown').classList.remove('show');
        }
    }

    // Helper function to fill contact details
    function fillContactDetails(data) {
        document.querySelector('input[name="name"]').value = data.name || '';
        document.querySelector('input[name="address"]').value = data.address || '';
        document.querySelector('input[name="city"]').value = data.city || '';
        document.querySelector('input[name="phone_number"]').value = data.phone_number || '';
        document.querySelector('input[name="email"]').value = data.email || '';
        document.querySelector('input[name="pin_code"]').value = data.pin_code || '';
        document.querySelector('input[name="designation"]').value = data.designation || '';
        document.querySelector('input[name="organitation"]').value = data.organitation || '';

        // For select fields like country and state
        document.querySelector('select[name="country"]').value = data.country || '';
        document.querySelector('select[name="state"]').value = data.state || '';
        document.querySelector('select[name="ministry_department"]').value = data.ministry_department || '';
    }

    // Add click event listeners to close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const nameDropdown = document.querySelector('#autoComeplete-dropdown-menu');
        const phoneDropdown = document.querySelector('#phone-autoComplete-dropdown-menu');
        const nameInput = document.querySelector('#contactDropdown');
        const phoneInput = document.querySelector('#phoneDropdown');

        if (!nameInput.contains(event.target)) {
            nameDropdown.style.display = 'none';
            nameInput.classList.remove('show');
        }
        if (!phoneInput.contains(event.target)) {
            phoneDropdown.style.display = 'none';
            phoneInput.classList.remove('show');
        }
    });

    // Add event listener for the save contact checkbox
    document.querySelector('#flexSwitchCheckDefault').addEventListener('change', function() {
        if (this.checked) {
            let phoneNumber = document.querySelector('input[name="phone_number"]').value;
            if (phoneNumber) {
                checkPhoneNumberExists(phoneNumber);
            }
        }
    });

    // Add event listener for phone number input when save contact is checked
    document.querySelector('input[name="phone_number"]').addEventListener('input', function() {
        if (document.querySelector('#flexSwitchCheckDefault').checked) {
            checkPhoneNumberExists(this.value);
        }
    });

    function checkPhoneNumberExists(phoneNumber) {
        if (phoneNumber.length >= 3) {
            $.ajax({
                url: "{{ route('check.phone.exists')}}",
                data: {
                    phone: phoneNumber
                },
                type: "GET",
                success: function(response) {
                    if (response.exists) {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'This phone number already exists in contacts!',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        });
                        document.querySelector('#flexSwitchCheckDefault').checked = false;
                    }
                },
                error: function() {
                    console.log("error checking phone number");
                }
            });
        }
    }
</script>