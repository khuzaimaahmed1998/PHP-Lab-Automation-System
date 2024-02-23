// Get all elements with class "edit"
Edits = document.getElementsByClassName("edit");

// Loop through each element
Array.from(Edits).forEach((element) => {
    // Add event listener for click event
    element.addEventListener("click", (e) => {
        // Get the parent node of the parent node of the clicked element
        tr = e.target.parentNode.parentNode;

        // Get values from table cells within the row
        first_name = tr.getElementsByTagName("td")[1].innerText;
        last_name = tr.getElementsByTagName("td")[2].innerText;
        email = tr.getElementsByTagName("td")[3].innerText;
        contact = tr.getElementsByTagName("td")[4].innerText;
        role = tr.getElementsByTagName("td")[5].innerText;

        // Set values to corresponding input fields in edit form
        firstnameEdit.value = first_name;
        lastnameEdit.value = last_name;
        emailEdit.value = email;
        contactEdit.value = contact;
        roleEdit.value = role;

        // Set value of hidden input field for edit ID
        editidd.value = e.target.id;

        // Toggle the visibility of the edit modal using jQuery
        $('#editModal').modal('toggle');
    });
});
