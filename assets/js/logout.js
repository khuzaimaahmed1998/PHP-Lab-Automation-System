// Function to confirm logout
function confirmLogout() {
    var result = confirm("Are you sure you want to logout?");
    if (result) {
        document.getElementById("logoutForm").submit();
    }
}
