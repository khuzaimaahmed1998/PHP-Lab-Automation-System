// Get all elements with class "ClearAll"
const clearButtons = document.getElementsByClassName("ClearAll");

// Iterate over each clear button
for (const clearButton of clearButtons) {
    // Add event listener for click event
    clearButton.addEventListener("click", (e) => {
        // Ask for confirmation
        if (confirm("Are you sure you want to clear Records List?")) {
            // If confirmed, show success message and redirect to testing_records.php
            alert("Records List Cleared Successfully!");
            window.location.href = "../../testing_records.php";
        }
    });
}
