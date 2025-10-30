    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('direccionForm');
        const inputs = {
            calle: document.getElementById('calle'),
            numero_casa: document.getElementById('numero_casa'),
            codigo_postal: document.getElementById('codigo_postal'),
            indicaciones: document.getElementById('indicaciones')
        };

        const regex = {
            soloLetras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
            soloNumeros: /^[0-9\-]*$/
        };

        // Validación en tiempo real para calle
        inputs.calle.addEventListener('input', function() {
            let original = this.value;
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            if (original !== this.value) {
                const calleError = document.getElementById('calle-error');
                calleError.textContent = 'Solo se permiten letras y espacios';
                calleError.style.display = 'block';
                this.classList.add('error');
            } else {
                const calleError = document.getElementById('calle-error');
                calleError.style.display = 'none';
                this.classList.remove('error');
            }
        });

        // Validación en tiempo real para número de casa (solo números)
        inputs.numero_casa.addEventListener('input', function() {
            let original = this.value;
            // Solo permite números
            this.value = this.value.replace(/\D/g, '');
            if (original !== this.value) {
                const numeroError = document.getElementById('numero-error');
                numeroError.textContent = 'Solo se permiten números';
                numeroError.style.display = 'block';
                this.classList.add('error');
            } else {
                const numeroError = document.getElementById('numero-error');
                numeroError.style.display = 'none';
                this.classList.remove('error');
            }
        });

        // Validación en tiempo real para código postal
        const cpError = document.getElementById('cp-error');
        inputs.codigo_postal.addEventListener('input', function() {
            let original = this.value;
            // Solo permite números y máximo 5 caracteres
            this.value = this.value.replace(/\D/g, '').slice(0, 5);

            if (original !== this.value) {
                cpError.textContent = 'Solo se permiten 5 caracteres numéricos';
                cpError.style.display = 'block';
                this.classList.add('error');
            } else {
                cpError.style.display = 'none';
                this.classList.remove('error');
            }
        });

        function validateField(field, regex, errorId) {
            const errorElement = document.getElementById(errorId);
            const value = field.value.trim();

            if (value && !regex.test(value)) {
                field.classList.add('error');
                errorElement.style.display = 'block';
                return false;
            } else {
                field.classList.remove('error');
                errorElement.style.display = 'none';
                return true;
            }
        }

        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validar campos obligatorios
            if (!inputs.calle.value.trim()) {
                inputs.calle.classList.add('error');
                isValid = false;
            }
            if (!inputs.indicaciones.value.trim()) {
                inputs.indicaciones.classList.add('error');
                isValid = false;
            }

            // Validar formato de campos
            if (!validateField(inputs.calle, regex.soloLetras, 'calle-error')) isValid = false;
            if (!validateField(inputs.numero_casa, regex.soloNumeros, 'numero-error')) isValid = false;

            // Validar código postal (exactamente 5 dígitos)
            if (inputs.codigo_postal.value.length !== 5) {
                inputs.codigo_postal.classList.add('error');
                cpError.textContent = 'Solo se permiten 5 caracteres numéricos';
                cpError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert('Por favor complete correctamente todos los campos obligatorios.');
            }
        });
    });