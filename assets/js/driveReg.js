const driver = window.driver.js.driver;



const driverObj = driver({
  popoverClass: 'driverjs-theme'
});

// Register.php pada Isian Username
driverObj.highlight({
  element: '#username',
  popover: {
    title: 'Inputan Username',
    description: 'Pada Pengisian Username bisa anda buat username yg Pendek saja',
  },
});




