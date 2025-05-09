document.addEventListener('DOMContentLoaded', () => {
    // Validación de formularios
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
      form.addEventListener("submit", (e) => {
        const inputs = form.querySelectorAll("input[type='text'], input[type='password']");
        let valid = true;
  
        inputs.forEach(input => {
          if (input.value.trim() === "") {
            input.style.border = "2px solid red";
            valid = false;
          } else {
            input.style.border = "1px solid #ccc";
          }
        });
  
        if (!valid) {
          e.preventDefault();
          alert("Por favor, completa todos los campos.");
        }
      });
    });
  
    // Confirmar eliminaciones (ya está en PHP, pero lo reforzamos)
    const deleteForms = document.querySelectorAll("form[action='delete_user.php']");
    deleteForms.forEach(form => {
      form.addEventListener("submit", (e) => {
        if (!confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
          e.preventDefault();
        }
      });
    });
  });
  