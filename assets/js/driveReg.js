// Initialize driver.js
const driver = window.driver.js.driver;

const driverObj = driver({
  popoverClass: 'driverjs-theme'
});

// Function to check if the highlight has been shown before
function showHighlightOnce() {
  // Check localStorage for the 'highlightShown' flag
  const highlightShown = localStorage.getItem('highlightShown');

  if (!highlightShown) {
    // Highlight the element
    driverObj.highlight({
      element: '#username',
      popover: {
        title: 'Inputan Username',
        description: 'Pada Pengisian Username bisa anda buat username yg Pendek saja',
      },
    });

    // Set the flag in localStorage to prevent future highlights
    localStorage.setItem('highlightShown', 'true');
  }
}

// Call the function
showHighlightOnce();
