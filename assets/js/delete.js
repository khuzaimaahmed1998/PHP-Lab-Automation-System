// Get all elements with class "delete"
const deletes = document.getElementsByClassName("delete");

// Convert HTMLCollection to array and add event listener to each element
Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
        // Ask for confirmation before deleting
        if (confirm("Are you sure you want to delete this record?")) {
            // Extract sno (record ID) from the clicked element's ID attribute
            const sno = e.target.id; 
            // Construct the delete URL
            const deleteURL = `/php%20lab%20automation/testing_records.php?deletevalue=${sno}`;
            console.log("Delete URL:", deleteURL);
            // Redirect to the delete URL
            window.location = deleteURL;
        } else {
            console.log("Deleting Record Canceled!");
        }
    });
});
