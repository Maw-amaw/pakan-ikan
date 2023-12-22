@if($latestData)
    <script>
        // Ambil data suhu dari PHP
        var temperature = <?php echo $latestData->temperature; ?>;

        // Logika notifikasi
        if (temperature < 15) {
            // Menampilkan notifikasi push
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    showNotification();
                } else if (Notification.permission !== 'denied') {
                    Notification.requestPermission().then(function (permission) {
                        if (permission === 'granted') {
                            showNotification();
                        }
                    });
                }
            }
        }

        function showNotification() {
            var notificationOptions = {
                body: 'Suhu ikan terlalu rendah (' + temperature + ' Celsius). Segera lakukan tindakan untuk meningkatkan suhu ikan.',
                icon: './assets/img/pakanin.png' // Ganti dengan URL gambar ikon notifikasi Anda
            };

            var notification = new Notification('Peringatan Suhu', notificationOptions);
        }
    </script>
@endif
