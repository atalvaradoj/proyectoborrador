// Función para inicializar el mapa de Google Maps con la ubicación de la Torre Eiffel
function initMap() {
    // Ubicación de la Torre Eiffel, París
    const ubicacion = { lat: 48.8584, lng: 2.2945 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: ubicacion,
    });

    // Marcador en la Torre Eiffel
    new google.maps.Marker({
        position: ubicacion,
        map: map,
        title: "Torre Eiffel, París",
    });
}

// Al cargar la página, solicita los testimonios desde el backend
document.addEventListener("DOMContentLoaded", () => {
    fetch("api/testimonios.php")
        .then((response) => response.json())
        .then((data) => {
            const testimoniosContainer = document.getElementById("testimonios-container");
            data.forEach((testimonio) => {
                const card = document.createElement("div");
                card.classList.add("col-md-6", "testimonio-card");
                card.innerHTML = `
            <p><strong>${testimonio.nombre}</strong></p>
            <p>${testimonio.comentario}</p>
          `;
                testimoniosContainer.appendChild(card);
            });
        })
        .catch((error) => console.error("Error al cargar testimonios:", error));
});

// Manejo del formulario de contacto
const contactForm = document.getElementById("contact-form");
contactForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const nombre = document.getElementById("nombre").value;
    const email = document.getElementById("email").value;
    const mensaje = document.getElementById("mensaje").value;
    const statusMsg = document.getElementById("status-msg");

    // Envía los datos al endpoint PHP de contacto
    fetch("api/contacto.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ nombre, email, mensaje }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.ok) {
                statusMsg.textContent = "¡Gracias por contactarnos!";
                contactForm.reset();
            } else {
                statusMsg.textContent = "Ocurrió un error. Intenta de nuevo.";
            }
        })
        .catch((error) => {
            statusMsg.textContent = "Error de conexión.";
            console.error("Error:", error);
        });
});
