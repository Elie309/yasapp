<div class="container-main">

    <h1 class="main-title-page">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Edit Locations</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-6 md:p-10 shadow-md rounded-md w-full overflow-auto">
        <!-- Tab Navigation -->
        <div class="flex flex-wrap mb-6 border-b">
            <button class="tab-button active px-6 py-3 font-medium" data-target="countries-section">Countries</button>
            <button class="tab-button px-6 py-3 font-medium" data-target="regions-section">Regions</button>
            <button class="tab-button px-6 py-3 font-medium" data-target="subregions-section">Subregions</button>
            <button class="tab-button px-6 py-3 font-medium" data-target="cities-section">Cities</button>
        </div>

        <!-- Countries Section -->
        <div class="tab-content active" id="countries-section">
            <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\CountryCell::render') ?>
        </div>

        <!-- Regions Section -->
        <div class="tab-content hidden" id="regions-section">
            <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\RegionCell::render') ?>
        </div>

        <!-- Subregions Section -->
        <div class="tab-content hidden" id="subregions-section">
            <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\SubregionCell::render') ?>
        </div>

        <!-- Cities Section -->
        <div class="tab-content hidden" id="cities-section">
            <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\CityCell::render') ?>
        </div>
    </div>

    <style>
        .tab-button {
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            color: #718096;
        }

        .tab-button:hover {
            color: #4a5568;
        }

        .tab-button.active {
            border-bottom-color: #3182ce;
            color: #2d3748;
        }

        .tab-content {
            transition: all 0.3s ease;
        }

        .tab-content.hidden {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            // Restore last opened tab from sessionStorage
            const lastTabId = sessionStorage.getItem('yasapp_last_tab');
            if (lastTabId) {
                tabButtons.forEach(btn => {
                    btn.classList.toggle('active', btn.getAttribute('data-target') === lastTabId);
                });
                tabContents.forEach(content => {
                    content.classList.toggle('hidden', content.id !== lastTabId);
                    content.classList.toggle('active', content.id === lastTabId);
                });
            }

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                        content.classList.remove('active');
                    });

                    // Show the target tab content
                    const targetId = this.getAttribute('data-target');
                    const targetContent = document.getElementById(targetId);
                    targetContent.classList.remove('hidden');
                    targetContent.classList.add('active');

                    // Save last opened tab
                    sessionStorage.setItem('yasapp_last_tab', targetId);
                });
            });

            // Accordion functionality - location template form
            // Use event delegation for better reliability
            document.querySelectorAll('.accordion-sections').forEach(section => {
                section.addEventListener('click', function(e) {
                    const toggle = e.target.closest('.accordion-toggle');
                    if (!toggle) return;

                    const targetSelector = toggle.getAttribute('data-target');
                    const content = document.querySelector(targetSelector);
                    const icon = toggle.querySelector('.accordion-icon');
                    const isActive = content.classList.contains('active');

                    // Reset all
                    document.querySelectorAll('.accordion-content').forEach(c => {
                        c.classList.remove('active');
                        c.style.maxHeight = '0px';
                    });

                    document.querySelectorAll('.accordion-icon').forEach(i => {
                        i.textContent = '+';
                    });

                    setTimeout(() => {
                        if (!isActive) {
                            content.classList.add('active');
                            content.style.maxHeight = content.scrollHeight + 'px';
                            icon.textContent = '-';
                            // Save last opened accordion for this tab
                            const currentTab = sessionStorage.getItem('yasapp_last_tab') || 'countries-section';
                            sessionStorage.setItem('yasapp_last_accordion_' + currentTab, targetSelector);
                        } else {
                            content.classList.remove('active');
                            content.style.maxHeight = '0px';
                            icon.textContent = '+';
                            // Remove last opened accordion for this tab
                            const currentTab = sessionStorage.getItem('yasapp_last_tab') || 'countries-section';
                            sessionStorage.removeItem('yasapp_last_accordion_' + currentTab);
                        }
                    }, 100);
                });

                // Restore last opened accordion for the active tab
                const currentTab = sessionStorage.getItem('yasapp_last_tab') || 'countries-section';
                const lastAccordion = sessionStorage.getItem('yasapp_last_accordion_' + currentTab);
                if (lastAccordion) {
                    const content = document.querySelector(lastAccordion);
                    if (content) {
                        content.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + 'px';
                        const icon = content.parentElement.querySelector('.accordion-icon');
                        if (icon) icon.textContent = '-';
                    }
                }
            });
        });
    </script>
</div>