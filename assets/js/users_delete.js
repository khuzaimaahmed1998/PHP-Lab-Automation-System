// Get all elements with class "delete"
Deletes = document.getElementsByClassName("delete");

// Loop through each element
Array.from(Deletes).forEach((element) => {
    // Add event listener for click event
    element.addEventListener("click", (e) => {
        // Confirm deletion with user
        if (confirm("Are you sure you want to delete this user?")) {
            // Get the ID of the user to be deleted
            sno = e.target.id; 
            // Construct delete URL
            let deleteURL = `/php%20lab%20automation/user_management.php?deletevalue=${sno}`;
            console.log("Delete URL:", deleteURL);
            // Redirect to delete URL
            window.location = deleteURL;
        } else {
            // Log cancellation of deletion
            console.log("Deleting Record Canceled!")
        }
    });
});
