// Function to toggle the menu
function toggleMenu() {
    const menu = document.querySelector('.menu');
    const content = document.querySelector('.content');
    menu.classList.toggle('menu-open');
    content.classList.toggle('content-shift');
}

// Add event listener to the menu toggle button
document.getElementById('menu-toggle').addEventListener('click', toggleMenu);

const menuToggle = document.getElementById('menu-toggle');

document.addEventListener('click', function(event) {
    const menu = document.getElementById('menu');


    // Check if the click was outside the menu and the toggle button
    if (!menu.contains(event.target) && !menuToggle.contains(event.target)) {
        menu.classList.remove('menu-open'); // Close the menu
    }
});

function confirmInhabilitar(redirectUrl) {
    // Muestra la ventana emergente personalizada
    document.getElementById('custom-confirm').style.display = 'block';

    // Maneja el clic en el botón "Sí"
    document.getElementById('confirm-yes').onclick = function() {
        window.location.href = redirectUrl; // Redirige a la página deseada
    };

    // Maneja el clic en el botón "No"
    document.getElementById('confirm-no').onclick = function() {
        document.getElementById('custom-confirm').style.display = 'none'; // Cierra la ventana
    };
}
