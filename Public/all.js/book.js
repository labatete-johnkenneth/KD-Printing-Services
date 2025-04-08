document.getElementById('addBook').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);  // FormData handles file uploads automatically
    document.getElementById('loading').style.display = 'block';  // Show loading indicator
    fetch('books.php?action=create', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.msg) {
            alert(data.msg);
            if (data.isSuccess) {
                window.location.href = "dashboard.html";  // Redirect if successful
            }
        } else {
            console.error('Invalid response:', data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the book.');
    });
});
    
