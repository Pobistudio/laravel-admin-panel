document.addEventListener('DOMContentLoaded', function() {
    const selectComponents = document.querySelectorAll('[data-select-component]');

    selectComponents.forEach(function(component) {
        initSelectComponent(component);
    });
});

function initSelectComponent(component) {
    // Get data from attributes
    const name = component.dataset.name;
    const multiple = component.dataset.multiple === 'true';
    const placeholder = component.dataset.placeholder;
    const showiconfromvalue = component.dataset.showiconfromvalue === 'true';
    const options = JSON.parse(component.dataset.options);
    let selected = JSON.parse(component.dataset.selected);

    // Ensure selected is array for multiple, string for single
    if (multiple && !Array.isArray(selected)) {
        selected = selected ? [selected] : [];
    } else if (!multiple && Array.isArray(selected)) {
        selected = selected[0] || '';
    }

    let filter = '';
    let isOpen = false;

    // Get elements
    const trigger = component.querySelector('.select-trigger');
    const arrow = component.querySelector('.select-arrow');
    const labelEl = component.querySelector('.select-label');
    const badgesContainer = component.querySelector('.select-badges');
    const dropdown = component.querySelector('.select-dropdown');
    const filterInput = component.querySelector('.select-filter');
    const optionsList = component.querySelector('.select-options');
    const hiddenInputsContainer = component.querySelector('.hidden-inputs');

    // Make trigger focusable
    trigger.setAttribute('tabindex', '0');
    trigger.setAttribute('role', 'combobox');
    trigger.setAttribute('aria-expanded', 'false');
    trigger.setAttribute('aria-haspopup', 'listbox');

    // Functions
    function getSelectedLabel() {
        if (multiple) {
            if (!Array.isArray(selected) || selected.length === 0) {
                return placeholder;
            }
            return selected.length + ' item terpilih';
        } else {
            const option = options.find(o => o.value == selected);
            return option ? option.label : placeholder;
        }
    }

    function getSelectedValue() {
        if (multiple || !selected) return null;
        return selected;
    }

    function getSelectedItems() {
        if (!multiple || !Array.isArray(selected)) return [];
        return selected.map(val => {
            const option = options.find(o => o.value == val);
            return option ? { value: val, label: option.label } : null;
        }).filter(item => item !== null);
    }

    function toggleOption(value) {
        if (multiple) {
            if (!Array.isArray(selected)) {
                selected = [];
            }
            const index = selected.indexOf(value);
            if (index > -1) {
                selected.splice(index, 1);
            } else {
                selected.push(value);
            }
        } else {
            selected = value;
            closeDropdown();
        }
        filter = '';
        filterInput.value = '';
        render();
    }

    function removeItem(value) {
        if (multiple && Array.isArray(selected)) {
            const index = selected.indexOf(value);
            if (index > -1) {
                selected.splice(index, 1);
            }
            render();
        }
    }

    function isSelected(value) {
        if (multiple) {
            return Array.isArray(selected) && selected.includes(value);
        }
        return selected == value;
    }

    function openDropdown() {
        isOpen = true;
        dropdown.classList.remove('hidden');
        arrow.classList.add('rotate-180');
        trigger.setAttribute('aria-expanded', 'true');

        // Focus pada filter input setelah dropdown terbuka
        setTimeout(() => {
            filterInput.focus();
        }, 50);
    }

    function closeDropdown() {
        isOpen = false;
        dropdown.classList.add('hidden');
        arrow.classList.remove('rotate-180');
        trigger.setAttribute('aria-expanded', 'false');
        filter = '';
        filterInput.value = '';
        renderOptions();
    }

    function toggleDropdown() {
        if (isOpen) {
            closeDropdown();
        } else {
            openDropdown();
        }
    }

    function renderLabel() {
        if (!multiple || getSelectedItems().length === 0) {
            labelEl.classList.remove('hidden');
            badgesContainer.classList.add('hidden');

            // Clear previous content
            labelEl.innerHTML = '';

            // Add icon if available and enabled (dari value)
            if (showiconfromvalue && !multiple && selected) {
                const iconEl = document.createElement('i');
                iconEl.className = selected + ' mr-2';
                labelEl.appendChild(iconEl);
            }

            // Add text
            const textNode = document.createTextNode(getSelectedLabel());
            labelEl.appendChild(textNode);
        } else {
            labelEl.classList.add('hidden');
            badgesContainer.classList.remove('hidden');
            renderBadges();
        }
    }

    function renderBadges() {
        const items = getSelectedItems();
        badgesContainer.innerHTML = '';

        items.forEach(item => {
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center gap-1 px-2.5 py-1 bg-slate-500 text-white text-sm font-medium rounded-md border border-blue-200';

            const label = document.createElement('span');
            label.className = 'max-w-[150px] truncate flex items-center gap-1';

            // Add icon if available (dari value)
            if (showiconfromvalue && item.value) {
                const iconEl = document.createElement('i');
                iconEl.className = item.value;
                label.appendChild(iconEl);
            }

            const textNode = document.createTextNode(item.label);
            label.appendChild(textNode);

            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'hover:bg-white hover:text-slate-500 rounded-full p-0.5 transition-colors cursor-pointer';
            button.innerHTML = '<svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>';

            button.addEventListener('click', function(e) {
                e.stopPropagation();
                removeItem(item.value);
            });

            badge.appendChild(label);
            badge.appendChild(button);
            badgesContainer.appendChild(badge);
        });
    }

    function renderOptions() {
        const filteredOptions = options.filter(o =>
            o.label.toLowerCase().includes(filter.toLowerCase())
        );

        optionsList.innerHTML = '';

        filteredOptions.forEach(option => {
            const li = document.createElement('li');
            li.className = 'px-4 py-2 cursor-pointer hover:bg-gray-100 flex items-center justify-between transition-colors';
            li.setAttribute('role', 'option');
            li.setAttribute('aria-selected', isSelected(option.value));

            if (isSelected(option.value)) {
                li.classList.add('bg-blue-50', 'text-blue-700');
            }

            const contentWrapper = document.createElement('div');
            contentWrapper.className = 'flex items-center gap-2';

            // Add icon if available and enabled (dari value)
            if (showiconfromvalue && option.value) {
                const iconEl = document.createElement('i');
                iconEl.className = option.value;
                contentWrapper.appendChild(iconEl);
            }

            const span = document.createElement('span');
            span.textContent = option.label;
            contentWrapper.appendChild(span);

            li.appendChild(contentWrapper);

            if (multiple && isSelected(option.value)) {
                const checkmark = document.createElement('svg');
                checkmark.className = 'w-5 h-5 text-blue-700';
                checkmark.setAttribute('fill', 'currentColor');
                checkmark.setAttribute('viewBox', '0 0 20 20');
                checkmark.innerHTML = '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>';
                li.appendChild(checkmark);
            }

            li.addEventListener('click', function() {
                toggleOption(option.value);
            });

            optionsList.appendChild(li);
        });
    }

    function renderHiddenInputs() {
        hiddenInputsContainer.innerHTML = '';

        if (multiple) {
            if (Array.isArray(selected)) {
                selected.forEach((val, index) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name + '[]';
                    input.value = val;
                    hiddenInputsContainer.appendChild(input);
                });
            }
        } else {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.id = name;
            input.name = name;
            input.value = selected;
            hiddenInputsContainer.appendChild(input);
        }
    }

    function render() {
        renderLabel();
        renderOptions();
        renderHiddenInputs();

        const event = new CustomEvent('selectChange', {
            detail: {
                name: name,
                value: selected,
                multiple: multiple
            },
            bubbles: true
        });
        component.dispatchEvent(event);
    }

    // Event listeners
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleDropdown();
    });

    // Keyboard navigation untuk trigger
    trigger.addEventListener('keydown', function(e) {
        switch(e.key) {
            case 'Enter':
            case ' ':
            case 'ArrowDown':
            case 'ArrowUp':
                e.preventDefault();
                if (!isOpen) {
                    openDropdown();
                }
                break;
            case 'Escape':
                if (isOpen) {
                    e.preventDefault();
                    closeDropdown();
                    trigger.focus();
                }
                break;
        }
    });

    filterInput.addEventListener('input', function(e) {
        filter = e.target.value;
        renderOptions();
        if (!isOpen) {
            openDropdown();
        }
    });

    // Keyboard navigation untuk filter input
    filterInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            e.preventDefault();
            closeDropdown();
            trigger.focus();
        } else if (e.key === 'Tab') {
            closeDropdown();
        }
    });

    // Prevent click inside dropdown from closing it
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Click outside to close
    document.addEventListener('click', function(e) {
        if (!component.contains(e.target)) {
            closeDropdown();
        }
    });

    // Initial render
    render();
}
