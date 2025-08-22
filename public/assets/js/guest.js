        // Add smooth form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const inputs = document.querySelectorAll('.form-input');

            // Add focus animations
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });


            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            loginForm.addEventListener('submit', function(e) {
                // Disable the button
                loginButton.disabled = true;

                // Hide button text and show spinner
                buttonText.style.display = 'none';
                loadingSpinner.style.display = 'flex';

                // Optional: Add some delay to see the effect (remove in production)
                // setTimeout(() => {
                //     this.submit();
                // }, 1000);
            });

            // Re-enable button if form submission fails (page doesn't redirect)
            window.addEventListener('pageshow', function(e) {
                if (e.persisted) {
                    loginButton.disabled = false;
                    buttonText.style.display = 'inline';
                    loadingSpinner.style.display = 'none';
                }
            });

        });
