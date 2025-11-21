import './bootstrap';


// Add real-time notifications here
window.Echo.private('user.' + USER_ID)
    .listen('NewFollower', (e) => {
        let countBox = document.getElementById('notificationCount');
        let current = parseInt(countBox.innerText);
        countBox.innerText = current + 1;
    });