(function() {
    'use strict';

    function initIconPreview() {
        const nameInputListener = document.getElementById('name');
        const typeInputListener = document.querySelector('[data-name="type"]');

        if (nameInputListener) {
            nameInputListener.addEventListener('input', previewIcon);
        }

        if (typeInputListener) {
            typeInputListener.addEventListener('selectChange', function(e) {
                previewIcon();
            });
        }

        function previewIcon() {
            const name = document.getElementById('name');
            const type = document.getElementById('type');
            const sectionPreviewicon = document.getElementById('preview_icon');

            if (!name || !type || !sectionPreviewicon) {
                return;
            }

            sectionPreviewicon.innerHTML = '';

            if (name.value.length > 0 && type.value.length > 0) {
                const wrapper = document.createElement('div');
                wrapper.className = 'mt-2';

                const label = document.createElement('p');
                label.className = 'text-sm text-gray-600 mb-1';
                label.textContent = 'Preview:';

                const icon = document.createElement('i');
                const iconClass = 'ri-' + name.value.replace(/[^a-zA-Z0-9-_]/g, '') + '-' + type.value.replace(/[^a-zA-Z0-9-_]/g, '');
                icon.className = iconClass + ' text-2xl';

                wrapper.appendChild(label);
                wrapper.appendChild(icon);
                sectionPreviewicon.appendChild(wrapper);
            }
        }

        previewIcon();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initIconPreview);
    } else {
        initIconPreview();
    }
})();
