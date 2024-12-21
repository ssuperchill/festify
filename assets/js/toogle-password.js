        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'fa fa-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'fa fa-eye';
            }
        }