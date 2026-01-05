<script>
(function() {
    var uniqueId = <?php echo wp_json_encode($unique_id); ?>;
    var MAP_AJAX_URL = <?php echo wp_json_encode($ajax_url); ?>;
    
    function initProfile() {
        var form = document.getElementById('mapProfileForm_' + uniqueId);
        var avatarInput = document.getElementById('avatar_' + uniqueId);
        var avatarPreview = document.getElementById('avatarPreview_' + uniqueId);
        
        // Avatar preview
        if (avatarInput) {
            avatarInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        avatarPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }
        
        // Form submission
        if (form && !form.dataset.init) {
            form.dataset.init = 'true';
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = this.querySelector('.map-btn');
                var msg = document.getElementById('mapProfileMsg_' + uniqueId);
                var originalText = btn.textContent;
                btn.disabled = true;
                btn.textContent = <?php echo wp_json_encode(__('UPDATING...', 'modern-auth-portal')); ?>;
                
                var formData = new FormData(this);
                formData.append('action', 'map_update_profile');
                
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
        document.addEventListener('DOMContentLoaded', initProfile);
    } else {
        initProfile();
    }
})();
</script>
