// Testing ID Generator
function generateCode() {
    var code = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < 12; i++) {
        code += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    document.getElementById("testing_id").value = code;
}
window.onload = generateCode;

// Function to Check Product ID Length
function checkProductID() {
    var input = document.getElementById("product_id").value;
    if (input.length > 10) {
        alert("Error: Product ID cannot exceed 10 digits!");
        document.getElementById("product_id").value = "";
    }
}

// Testing Duration
document.getElementById('testing_duration_select').addEventListener('change', function() {
    var selectedOption = this.value;
    if (selectedOption === 'other') {
        document.getElementById('other_duration').style.display = 'block';
    } else {
        document.getElementById('other_duration').style.display = 'none';
    }
});

// Expiry Date
document.getElementById('expiry_date_icon').addEventListener('click', function() {
    var expiryDateInput = document.querySelector('[name="expiry_date"]');
    expiryDateInput.hidden = !expiryDateInput.hidden;
    if (!expiryDateInput.hidden) {
        expiryDateInput.focus();
    }
});

// Required fields
document.querySelector('#product_form button[type="submit"]').addEventListener('click', function(event) {
    console.log('Form submission intercepted'); // Add this line
    var form = document.getElementById('product_form');
    var requiredFields = form.querySelectorAll('[required]');
    var isValid = true;

    requiredFields.forEach(function(field) {
        if (!field.value.trim()) {
            isValid = false;
            if (!field.classList.contains('is-invalid')) {
                field.classList.add('is-invalid');
                var errorElement = document.createElement('div');
                errorElement.classList.add('invalid-feedback');
                errorElement.innerText = 'This field is required';
                field.parentNode.appendChild(errorElement);
            }
        } else {
            field.classList.remove('is-invalid');
            var errorSibling = field.parentNode.querySelector('.invalid-feedback');
            if (errorSibling) {
                errorSibling.remove();
            }
        }
    });

    if (!isValid) {
        event.preventDefault();
        alert('Please fill all required fields.');
    }
});
