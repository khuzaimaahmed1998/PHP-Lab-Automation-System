Edits = document.getElementsByClassName("edit");

Array.from(Edits).forEach((element) => {
    element.addEventListener("click", (e) => {
        // Get the parent row (tr element)
        tr = e.target.parentNode.parentNode;

        // Get values from the table cells in the same row
        product_id = tr.getElementsByTagName("td")[2].innerText;
        testing_revise = tr.getElementsByTagName("td")[3].innerText;
        product_code = tr.getElementsByTagName("td")[4].innerText;
        product_name = tr.getElementsByTagName("td")[5].innerText;
        testing_result = tr.getElementsByTagName("td")[6].innerText;

        // Assign values to corresponding input fields in the edit modal
        productidEdit.value = product_id;
        testingreviseEdit.value = testing_revise;
        productcodeEdit.value = product_code;
        productnameEdit.value = product_name;
        testingresultEdit.value = testing_result;

        // Assign the id of the row to a hidden input field in the edit modal
        editidd.value = e.target.id;

        // Toggle the visibility of the edit modal
        $('#editModal').modal('toggle');
    });
});
