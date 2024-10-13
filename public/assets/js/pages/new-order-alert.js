Echo.private('new-order')
    .listen('NewOrderReceived', (event) => {
        // Play default notification sound when new order received
        var audio = new Audio('https://notificationsounds.com/notification-sounds/bell-2-568/download/mp3');
        audio.play();
    });
