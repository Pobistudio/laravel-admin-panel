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
                fetch(`/api/menu-permissions/${value}`)
                    .then(response => response.json())
                    .then(data => this.generateMenuPermissionsTable(data));
            },

            generateMenuPermissionsTable(item) {
                const data = item.data;
                const totalPossible = data.menus.length * data.permissions.length;
                const tableContainer = document.getElementById('menu-permissions-table');
                tableContainer.innerHTML = ''; // reset

                // Group mapping by menu_id
                const groupedByMenu = {};
                data.mapping.forEach(item => {
                    if (!groupedByMenu[item.menu_id]) {
                        groupedByMenu[item.menu_id] = {
                            menu: item.menu,
                            permissions: []
                        };
                    }
                    groupedByMenu[item.menu_id].permissions.push(item.permission_id);
                });

                // Build menu hierarchy
                const buildMenuHierarchy = () => {
                    const menuMap = {};
                    const rootMenus = [];

                    const sortedMenus = [...data.menus].sort((a, b) => a.order - b.order);

                    sortedMenus.forEach(menu => {
                        menuMap[menu.id] = {
                            ...menu,
                            children: [],
                            permissions: groupedByMenu[menu.id]?.permissions || []
                        };
                    });

                    sortedMenus.forEach(menu => {
                        if (menu.parent === 0) {
                            rootMenus.push(menuMap[menu.id]);
                        } else if (menuMap[menu.parent]) {
                            menuMap[menu.parent].children.push(menuMap[menu.id]);
                        }
                    });

                    return rootMenus;
                };

                const menuHierarchy = buildMenuHierarchy();

                // Wrapper utama
                const mainWrapper = document.createElement('div');
                mainWrapper.className = 'space-y-4';

                // Header dengan info dan actions
                const headerSection = document.createElement('div');
                headerSection.className = 'flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4';

                const infoDiv = document.createElement('div');
                infoDiv.innerHTML = `
                    <h3 class="text-lg font-semibold text-gray-800">Menu Permissions</h3>
                    <p class="text-sm text-gray-600">Manage permissions for each menu and submenu</p>
                `;

                const actionsDiv = document.createElement('div');
                actionsDiv.className = 'flex gap-2 flex-wrap';
                actionsDiv.innerHTML = `
                    <button type="button" id="expandAllBtn" class="px-3 py-1.5 text-sm bg-teal-500 text-white rounded hover:bg-teal-600 cursor-pointer transition">
                        Expand All
                    </button>
                `;

                headerSection.appendChild(infoDiv);
                headerSection.appendChild(actionsDiv);
                mainWrapper.appendChild(headerSection);

                // Table wrapper
                const tableWrapper = document.createElement('div');
                tableWrapper.className = 'overflow-x-auto rounded-lg border border-gray-200 shadow-md bg-white';

                // Table element
                const table = document.createElement('table');
                table.className = 'min-w-full divide-y divide-gray-200';

                // Table Header
                const thead = document.createElement('thead');
                thead.className = 'bg-gray-600 text-white';

                const headerRow = document.createElement('tr');

                // Menu column header (sticky)
                const menuHeader = document.createElement('th');
                menuHeader.className = 'px-6 py-4 text-left text-xs font-bold uppercase tracking-wider sticky left-0 bg-gray-600 z-20 border-r border-gray-600';
                menuHeader.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span>Menu</span>
                        <span class="text-gray-300 font-normal text-[10px]">(${data.menus.length})</span>
                    </div>
                `;
                headerRow.appendChild(menuHeader);

                // Permission column headers
                const sortedPermissions = [...data.permissions].sort((a, b) => a.name.localeCompare(b.name));

                sortedPermissions.forEach((permission) => {
                    const th = document.createElement('th');
                    th.className = 'px-4 py-4 text-center text-xs font-bold uppercase tracking-wider whitespace-nowrap min-w-[100px]';

                    // Color coding
                    const colorClass = 'text-gray-300';

                    th.innerHTML = `<span class="${colorClass}">${permission.name}</span>`;
                    headerRow.appendChild(th);
                });

                thead.appendChild(headerRow);
                table.appendChild(thead);

                // Table Body
                const tbody = document.createElement('tbody');
                tbody.className = 'bg-white divide-y divide-gray-200';

                let rowIndex = 0;

                const renderMenuRow = (menu, level = 0) => {
                    const row = document.createElement('tr');
                    row.className = `transition-colors ${rowIndex % 2 === 0 ? 'bg-white hover:bg-blue-50' : 'bg-gray-50 hover:bg-blue-50'}`;
                    row.dataset.menuId = menu.id;
                    row.dataset.level = level;

                    // Menu name cell (sticky)
                    const menuCell = document.createElement('td');
                    menuCell.className = 'px-6 py-3 text-sm sticky left-0 z-10 border-r border-gray-200';
                    menuCell.style.backgroundColor = rowIndex % 2 === 0 ? 'white' : '#f9fafb';

                    // Indentation
                    const indent = level > 0 ? `<span class="inline-block" style="width: ${level * 24}px"></span>` : '';

                    // Icon
                    let iconHtml = '';
                    if (menu.icon && menu.icon !== '#') {
                        iconHtml = `<i class="${menu.icon} text-lg mr-2 ${level > 0 ? 'text-gray-500' : 'text-blue-600'}"></i>`;
                    } else if (level > 0) {
                        iconHtml = '<span class="mr-2 text-gray-400">└─</span>';
                    }

                    // Expand/collapse button untuk parent menu yang punya children
                    let expandBtn = '';
                    if (menu.children && menu.children.length > 0) {
                        expandBtn = `
                            <button type="button" class="expand-btn mr-2 text-gray-500 hover:text-gray-700 focus:outline-none" data-menu-id="${menu.id}">
                                <i class="ri-arrow-down-s-line text-lg transition-transform"></i>
                            </button>
                        `;
                    }

                    const fontWeight = level === 0 ? 'font-semibold' : 'font-medium';
                    const textColor = level === 0 ? 'text-gray-900' : 'text-gray-700';

                    menuCell.innerHTML = `
                        <div class="flex items-center">
                            ${indent}
                            ${expandBtn}
                            ${iconHtml}
                            <span class="${fontWeight} ${textColor}">${menu.name}</span>
                        </div>
                    `;

                    row.appendChild(menuCell);

                    // Permission checkboxes
                    sortedPermissions.forEach((permission) => {
                        const cell = document.createElement('td');
                        cell.className = 'px-4 py-3 text-center';

                        const checkboxWrapper = document.createElement('div');
                        checkboxWrapper.className = 'flex items-center justify-center';

                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = `permissions[${menu.id}][]`;
                        checkbox.value = permission.id;
                        checkbox.className = 'w-5 h-5 text-blue-600 bg-gray-100 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer transition-all hover:scale-110';
                        checkbox.dataset.menuId = menu.id;
                        checkbox.dataset.permissionId = permission.id;

                        checkbox.checked = menu.permissions.includes(permission.id);

                        checkbox.addEventListener('change', function(e) {
                            if (e.target.checked) {
                                cell.classList.add('bg-green-50');
                                setTimeout(() => cell.classList.remove('bg-green-50'), 300);
                            } else {
                                cell.classList.add('bg-red-50');
                                setTimeout(() => cell.classList.remove('bg-red-50'), 300);
                            }
                            AssignMenuPage.updateAssignedCount(footerInfo, tbody, totalPossible);
                        });

                        checkboxWrapper.appendChild(checkbox);
                        cell.appendChild(checkboxWrapper);
                        row.appendChild(cell);
                    });

                    tbody.appendChild(row);
                    rowIndex++;

                    // Render children
                    if (menu.children && menu.children.length > 0) {
                        menu.children.forEach(child => {
                            renderMenuRow(child, level + 1);
                        });
                    }
                };

                menuHierarchy.forEach(menu => {
                    renderMenuRow(menu, 0);
                });

                table.appendChild(tbody);
                tableWrapper.appendChild(table);
                mainWrapper.appendChild(tableWrapper);

                // Footer info
                const footerInfo = document.createElement('div');
                footerInfo.className = 'text-sm text-gray-600 mt-3 p-3 bg-gray-50 rounded border border-gray-200';

                const totalChecked = data.mapping.length;

                footerInfo.innerHTML = `
                    <div class="flex flex-wrap gap-4 justify-between items-center">
                        <span><strong>Total Menus:</strong> ${data.menus.length}</span>
                        <span><strong>Total Permissions:</strong> ${data.permissions.length}</span>
                        <span><strong>Assigned:</strong> <span id="assignedCounter">${totalChecked} / ${totalPossible}</span></span>
                    </div>
                `;
                mainWrapper.appendChild(footerInfo);

                tableContainer.appendChild(mainWrapper);

                // Event listeners
                // Expand/collapse functionality
                document.querySelectorAll('.expand-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const menuId = this.dataset.menuId;
                        toggleChildren(menuId);
                        this.querySelector('i').classList.toggle('rotate-180');
                    });
                });

                function toggleChildren(parentMenuId) {
                    const allRows = tbody.querySelectorAll('tr');
                    let isParentFound = false;
                    let parentLevel = 0;

                    allRows.forEach(row => {
                        if (row.dataset.menuId == parentMenuId) {
                            isParentFound = true;
                            parentLevel = parseInt(row.dataset.level);
                        } else if (isParentFound) {
                            const currentLevel = parseInt(row.dataset.level);
                            if (currentLevel > parentLevel) {
                                row.classList.toggle('hidden');
                            } else {
                                isParentFound = false;
                            }
                        }
                    });
                }

                document.getElementById('expandAllBtn')?.addEventListener('click', function() {
                    const allRows = tbody.querySelectorAll('tr');
                    allRows.forEach(row => row.classList.remove('hidden'));
                    document.querySelectorAll('.expand-btn i').forEach(icon => {
                        icon.classList.remove('rotate-180');
                    });
                });
            },

            updateAssignedCount(footerInfo, tbody, totalPossible) {
                const assignCounterElement = footerInfo.querySelector('#assignedCounter');
                const checkboxes = tbody.querySelectorAll('input[type="checkbox"]');
                const checkedCount = [...checkboxes].filter(cb => cb.checked).length;
                assignCounterElement.innerHTML = `${checkedCount} / ${totalPossible}`;
            }
        };

        AssignMenuPage.init();
    }
});
