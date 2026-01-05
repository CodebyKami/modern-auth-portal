<script>
(function() {
    var uniqueId = <?php echo wp_json_encode($unique_id); ?>;
    var MAP_AJAX_URL = <?php echo wp_json_encode($ajax_url); ?>;
    
    function initAuth() {
        var loginForm = document.getElementById('mapLoginForm_' + uniqueId);
        var regForm = document.getElementById('mapRegForm_' + uniqueId);
        
        // Toggle between login and register forms
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('toggle-register-link') && e.target.getAttribute('data-unique') === uniqueId) {
                e.preventDefault();
                document.getElementById('loginFormContainer_' + uniqueId).style.display = 'none';
                document.getElementById('registerFormContainer_' + uniqueId).style.display = 'block';
            }
            if (e.target.classList.contains('toggle-login-link') && e.target.getAttribute('data-unique') === uniqueId) {
                e.preventDefault();
                document.getElementById('registerFormContainer_' + uniqueId).style.display = 'none';
                document.getElementById('loginFormContainer_' + uniqueId).style.display = 'block';
            }
        });
        
        // Login form submission
        if (loginForm && !loginForm.dataset.init) {
            loginForm.dataset.init = 'true';
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = this.querySelector('.map-btn');
                var msg = document.getElementById('mapLoginMsg_' + uniqueId);
                var originalText = btn.textContent;
                btn.disabled = true;
                btn.textContent = <?php echo wp_json_encode(__('SIGNING IN...', 'modern-auth-portal')); ?>;
                
                var formData = new FormData(this);
                formData.append('action', 'map_login');
                
                fetch(MAP_AJAX_URL, { 
                    method: 'POST', 
                    body: formData,
                    credentials: 'same-origin'
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.success) {
                        msg.innerHTML = '<div class="map-notice map-success">' + data.data.message + '</div>';
                        setTimeout(function() {
                            window.location.href = data.data.redirect;
                        }, 1000);
                    } else {
                        msg.innerHTML = '<div class="map-notice map-error">' + data.data.message + '</div>';
                        btn.disabled = false;
                        btn.textContent = originalText;
                    }
                })
                .catch(function(error) {
                    msg.innerHTML = '<div class="map-notice map-error">' + <?php echo wp_json_encode(__('An error occurred. Please try again.', 'modern-auth-portal')); ?> + '</div>';
                    btn.disabled = false;
                    btn.textContent = originalText;
                });
            });
        }
        
        // Registration form submission
        if (regForm && !regForm.dataset.init) {
            regForm.dataset.init = 'true';
            regForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = this.querySelector('.map-btn');
                var msg = document.getElementById('mapRegMsg_' + uniqueId);
                var originalText = btn.textContent;
                btn.disabled = true;
                btn.textContent = <?php echo wp_json_encode(__('CREATING...', 'modern-auth-portal')); ?>;
                
                var formData = new FormData(this);
                formData.append('action', 'map_register');
                
                fetch(MAP_AJAX_URL, { 
                    method: 'POST', 
                    body: formData,
                    credentials: 'same-origin'
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.success) {
                        msg.innerHTML = '<div class="map-notice map-success">' + data.data.message + '</div>';
                        regForm.reset();
                        setTimeout(function() {
                            document.getElementById('registerFormContainer_' + uniqueId).style.display = 'none';
                            document.getElementById('loginFormContainer_' + uniqueId).style.display = 'block';
                        }, 2000);
                    } else {
                        msg.innerHTML = '<div class="map-notice map-error">' + data.data.message + '</div>';
                    }
                    btn.disabled = false;
                    btn.textContent = originalText;
                })
                .catch(function(error) {
                    msg.innerHTML = '<div class="map-notice map-error">' + <?php echo wp_json_encode(__('An error occurred. Please try again.', 'modern-auth-portal')); ?> + '</div>';
                    btn.disabled = false;
                    btn.textContent = originalText;
                });
            });
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAuth);
    } else {
        initAuth();
    }
})();
</script>
