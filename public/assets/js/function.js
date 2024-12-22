function changeTheme() {
    const elements = document.querySelectorAll('.theme');

    elements.forEach(element => {
        if (element.classList.contains('white-theme')) {
            localStorage.setItem('theme', 'dark-theme');
            document.getElementById('themeButton').innerHTML = "🌞";
            // console.log("Check if localStorage set dark-theme yet? => ", localStorage.getItem('theme'))
        } else if (element.classList.contains('dark-theme')) {
            localStorage.setItem('theme', 'white-theme');
            document.getElementById('themeButton').innerHTML = "🌚";
            // console.log("Check if localStorage set white-theme yet? => ", localStorage.getItem('theme'))
        } else {
            localStorage.setItem('theme', 'white-theme');
            document.getElementById('themeButton').innerHTML = "🌚";
            // console.log("Check if localStorage set white-theme yet? => ", localStorage.getItem('theme'))
        }
    });

    applySavedTheme();
}

function applySavedTheme() {
    const savedTheme = localStorage.getItem('theme') || 'white-theme';
    document.querySelectorAll('.theme').forEach(element => {
        element.classList.remove('white-theme', 'dark-theme');
        element.classList.add(savedTheme);

        // console.log("in applySavedTheme, savedTheme = ", savedTheme)

        if (savedTheme === "white-theme") {
            document.getElementById('themeButton').innerHTML = "🌚";
        } else if (savedTheme === "dark-theme") {
            document.getElementById('themeButton').innerHTML = "🌞";
        }
    });
}

document.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');
    applySavedTheme();
});
