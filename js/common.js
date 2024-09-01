<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login_form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        fetch('includes/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Show success message
                window.location.href = 'dashboard.php'; // Redirect to dashboard
            } else {
                alert(data.message); // Show error message
            }
        })
        .catch(() => {
            alert('An error occurred. Please try again.');
        });
    })
});
</script>
