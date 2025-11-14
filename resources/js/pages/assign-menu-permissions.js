document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('form-assign-menu-permissions');

    if (form) {

        const AssignMenuPage = {
            elements: {
                roleSelect: null,
                form: null,
            },

            init() {
                this.cacheElements();
                this.bindEvents();
            },

            cacheElements() {
                this.elements.roleSelect = document.querySelector('[data-name="role"]');
                this.elements.form = document.querySelector('form');
            },

            bindEvents() {
                if (this.elements.roleSelect) {
                    this.elements.roleSelect.addEventListener('selectChange', (e) => {
                        this.onRoleChange(e.detail.value, e.detail.name);
                    });
                }
            },

            onRoleChange(value, name) {
                console.log('Role changed:', value, name);

                // Your logic here
                // fetch(`/api/permissions/${value}`)
                //     .then(response => response.json())
                //     .then(data => console.log(data));
            }
        };

        AssignMenuPage.init();
    }
});
