

<footer class="bg-light py-3" style="margin-bottom: 100px; margin-top: 20px;">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Twins Cafe. All Rights Reserved by 
            <a href="#" target="_blank" class="text-primary">Shafir Jackson</a>.
        </p>
    </div>
</footer>


<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Toggle sidebar on mobile
    const menuButton = document.getElementById('menuButton');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('closeBtn');

    menuButton.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.remove('show');
    });

        // Request notification permission
    if (Notification.permission === 'default') {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                console.log('Notification permission granted.');
            }
        });
    }

    function checkForUpdates() {
    fetch('/api/check-updates')
        .then(response => response.json())
        .then(data => {
            if (data.hasUpdate) {
                showSystemNotification("New Order", "A new order has arrived or there’s an update.");
            }
        })
        .catch(error => console.error('Error checking updates:', error));
        }

            function showSystemNotification(title, message) {
                // Check if notifications are permitted
                if (Notification.permission === 'granted') {
                    const notification = new Notification(title, {
                        body: message,
                        icon: '../image/notification.png', // Optional: set an icon for the notification
                    });

                    // Optional: click event to bring focus to the admin panel
                    notification.onclick = () => {
                        window.focus(); // Brings the admin panel tab to focus
                    };
                }
            }

            // Poll for updates every minute
            setInterval(checkForUpdates, 60000);
`

</script>

</body>
</html>
