document.addEventListener("DOMContentLoaded", function() {
    let deleteIcons = document.querySelectorAll(".delete-icons");

    deleteIcons.forEach(icon => {
        icon.addEventListener("click", function() {
            // Get user_id from the attribute
            let user_id = this.getAttribute("data-user-id");

            // Confirm deletion
            if (confirm("Are you sure you want to delete this user?")) {
                // AJAX request to delete the user
                fetch("includes/delete_user.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: new URLSearchParams({
                        'user_id': user_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('tr').remove();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user.');
                });
            }
        });
    });
});
