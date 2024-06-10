const driver = window.driver.js.driver;

const driverObj = driver({
    popoverClass: 'driverjs-theme'
  });
  

// order.php pada Isian Datetimepicker
driverObj.highlight({
  element: '#datetimepicker',
  popover: {
    title: 'Inputan Waktu Pengiriman',
    description: 'Pada Pengisian Pengiriman bisa anda isi dari <b>3 hari dari sekarang</b> misal : hari ini tanggal 10 maka anda dapat mengisi nya tanggal 13 ',
  },
});
