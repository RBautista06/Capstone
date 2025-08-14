
document.addEventListener('DOMContentLoaded', function() {
    const backButton = document.getElementById('backButton');
    const forwardButton = document.getElementById('forwardButton');

    backButton.addEventListener('click', function() {
        window.location.href = 'createfrontdesk.php';
    });

    forwardButton.addEventListener('click', function() {
        window.location.href = 'createowner.php';
    });
});