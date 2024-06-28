const driver = window.driver.js.driver;

const driverObj = driver({
    popoverClass: 'driverjs-theme'
  });
  

// order.php pada Isian Datetimepicker
driverObj.highlight({
  element: '#bayar',
  popover: {
    title: 'Pembayaran',
    description: 'Anda dapat melakukan Pembayaran pada Navigation Tab Pembayaran dan Silahkan Lakukan Pengisiannya',
  },
});
