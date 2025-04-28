<div class="container-main max-w-6xl mx-auto">

    <h2 class="main-title-page text-2xl font-bold">Dashboard</h2>


    <!-- Stats Summary Cards -->
    <?php if ($role === 'admin') : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <?php else : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <?php endif; ?>


            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                <div class="flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-500 text-sm">Total Requests</h4>
                        <div class="stat-value text-lg font-bold text-gray-800" id="stat-total-requests">
                            <?= isset($data['total_requests']) ? $data['total_requests'] : '--' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-500 text-sm">Total Properties</h4>
                        <div class="stat-value text-lg font-bold text-gray-800" id="stat-total-properties">
                            <?= isset($data['total_properties']) ? $data['total_properties'] : '--' ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($role === 'admin') : ?>
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center">
                        <div class="rounded-full bg-purple-100 p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-gray-500 text-sm">Total Employees</h4>
                            <div class="stat-value text-lg font-bold text-gray-800" id="stat-total-employees">
                                <?= isset($data['total_employees']) ? $data['total_employees'] : '--' ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                <div class="flex flex-col items-center">
                    <div class="flex flex-row w-full">
                        <div class="rounded-full bg-red-100 p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-gray-500 text-sm">Pending Requests</h4>
                            <div class="stat-value text-lg font-bold text-gray-800" id="stat-pending-requests">
                                <?= isset($data['pending_requests']) ? $data['pending_requests'] : '--' ?>
                            </div>
                        </div>
                    </div>
                    <!-- pending_percentage -->
                    <div class="stat-percentage text-xs text-gray-500 ml-4">
                        <?= isset($data['pending_percentage']) ? $data['pending_percentage'] . '%' : '--' ?>
                        of total requests
                    </div>
                </div>
            </div>
            </div>

            <!-- Dashboard Navigation Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="dashboardTabs" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-blue-600 rounded-t-lg active text-blue-600" id="all-tab" data-target="all-content" type="button" role="tab" aria-selected="true">
                            All Analytics
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="requests-tab" data-target="request-charts" type="button" role="tab" aria-selected="false">
                            Requests
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="properties-tab" data-target="property-charts" type="button" role="tab" aria-selected="false">
                            Properties
                        </button>
                    </li>
                    <?php if ($role === 'admin') : ?>
                        <li role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="employees-tab" data-target="employee-charts" type="button" role="tab" aria-selected="false">
                                Employees
                            </button>
                        </li>
                    <?php endif; ?>
            </div>

            <div class="relative mb-8 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
                <div id="dashboard-loader"
                    class="absolute w-full h-full bg-white z-50 flex items-start mt-10 justify-center">
                    <div class="flex flex-col items-center">
                        <div class="loader-red"></div>
                        <p class="mt-4 text-gray-700 font-medium">Loading dashboard data...</p>
                    </div>
                </div>

                <div class="p-6 md:p-8 lg:p-10">
                    <!-- Request Analytics Section -->
                    <div class="section-container mb-10">
                        <div class="section-header flex justify-between items-center border-b border-gray-200 pb-3 cursor-pointer" data-target="request-charts">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Request Analytics
                            </h3>
                            <div class="toggle-icon transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <div id="request-charts" class="section-content grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Requests by Status</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                                </div>
                                <canvas id="requestsByStatusChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Requests by Priority</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                                </div>
                                <canvas id="requestsByPriorityChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Requests by City</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                                </div>
                                <canvas id="requestsByCityChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Requests Over Time</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                                </div>
                                <canvas id="requestsOverTimeChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Avg. Request Budget</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                                </div>
                                <canvas id="averageRequestBudgetByPriorityChart" class="hidden"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Property Analytics Section -->
                    <div class="section-container mb-10">
                        <div class="section-header flex justify-between items-center border-b border-gray-200 pb-3 cursor-pointer" data-target="property-charts">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Property Analytics
                            </h3>
                            <div class="toggle-icon transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <div id="property-charts" class="section-content grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Property Status Distribution</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-green-500"></div>
                                </div>
                                <canvas id="propertyStatusDistributionChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Properties by City</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-green-500"></div>
                                </div>
                                <canvas id="propertyListingsByCityChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Property Type Breakdown</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-green-500"></div>
                                </div>
                                <canvas id="propertyTypeBreakdownChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Sale vs Rent Properties</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-green-500"></div>
                                </div>
                                <canvas id="saleVsRentPropertiesChart" class="hidden"></canvas>
                            </div>
                            <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <h4 class="text-center font-medium text-gray-700 mb-4">Avg. Property Price by City</h4>
                                <div class="chart-loader flex justify-center items-center py-16">
                                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-green-500"></div>
                                </div>
                                <canvas id="averagePropertyPriceByCityChart" class="hidden"></canvas>
                            </div>

                        </div>
                    </div>

                    <!-- ONLY ADMIN -->
                    <?php if ($role === 'admin') : ?>
                        <!-- Employee Analytics Section -->
                        <div class="section-container">
                            <div class="section-header flex justify-between items-center border-b border-gray-200 pb-3 cursor-pointer" data-target="employee-charts">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Employee Analytics
                                </h3>
                                <div class="toggle-icon transition-transform duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <div id="employee-charts" class="section-content grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                                <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                    <h4 class="text-center font-medium text-gray-700 mb-4">Employee Role Distribution</h4>
                                    <div class="chart-loader flex justify-center items-center py-16">
                                        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-purple-500"></div>
                                    </div>
                                    <canvas id="employeeRoleDistributionChart" class="hidden"></canvas>
                                </div>
                                <div class="chart-container bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                    <h4 class="text-center font-medium text-gray-700 mb-4">Employee Count Over Time</h4>
                                    <div class="chart-loader flex justify-center items-center py-16">
                                        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-purple-500"></div>
                                    </div>
                                    <canvas id="employeeCountOverTimeChart" class="hidden"></canvas>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>

            <!-- Last Updated Timestamp -->
            <div class="text-right text-sm text-gray-500 mb-8">
                <p>Last updated: <span id="last-updated-time">--</span></p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Initialize tab navigation
                initializeTabNavigation();

                // Initialize the dropdown toggles
                initializeSectionToggles();

                // Show main loader
                const dashboardLoader = document.getElementById('dashboard-loader');

                // Set current time for last updated
                document.getElementById('last-updated-time').textContent = new Date().toLocaleString();

                // Initialize charts
                initializeCharts()
                    .then(() => {
                        // Hide main loader when all charts are loaded
                        dashboardLoader.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error initializing charts:', error);
                        dashboardLoader.classList.add('hidden');
                        alert('There was an error loading the dashboard data. Please try refreshing the page.');
                    });
            });

            function initializeTabNavigation() {
                const tabButtons = document.querySelectorAll('#dashboardTabs button');

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Deactivate all tabs
                        tabButtons.forEach(btn => {
                            btn.classList.remove('border-blue-600', 'text-blue-600', 'active');
                            btn.classList.add('border-transparent');
                        });

                        // Activate clicked tab
                        button.classList.remove('border-transparent');
                        button.classList.add('border-blue-600', 'text-blue-600', 'active');

                        const targetId = button.getAttribute('data-target');

                        // Handle "All" tab separately
                        if (targetId === 'all-content') {
                            document.querySelectorAll('.section-content').forEach(section => {
                                section.classList.remove('hidden');
                            });

                            document.querySelectorAll('.toggle-icon').forEach(icon => {
                                icon.style.transform = 'rotate(180deg)';
                            });
                        } else {
                            // Hide all sections first
                            document.querySelectorAll('.section-content').forEach(section => {
                                section.classList.add('hidden');
                            });

                            document.querySelectorAll('.toggle-icon').forEach(icon => {
                                icon.style.transform = 'rotate(0deg)';
                            });

                            // Show only the targeted section
                            const targetSection = document.getElementById(targetId);
                            if (targetSection) {
                                targetSection.classList.remove('hidden');

                                // Rotate the icon for this section
                                const sectionHeader = document.querySelector(`[data-target="${targetId}"]`);
                                if (sectionHeader) {
                                    const icon = sectionHeader.querySelector('.toggle-icon');
                                    if (icon) icon.style.transform = 'rotate(180deg)';
                                }
                            }
                        }
                    });
                });
            }


            function initializeSectionToggles() {
                const sectionHeaders = document.querySelectorAll('.section-header');

                sectionHeaders.forEach(header => {
                    const targetId = header.getAttribute('data-target');
                    const contentSection = document.getElementById(targetId);
                    const toggleIcon = header.querySelector('.toggle-icon');

                    header.addEventListener('click', () => {
                        // Toggle content visibility
                        contentSection.classList.toggle('hidden');

                        // Rotate icon
                        if (contentSection.classList.contains('hidden')) {
                            toggleIcon.style.transform = 'rotate(0deg)';
                        } else {
                            toggleIcon.style.transform = 'rotate(180deg)';
                        }
                    });
                });
            }

            async function fetchData(url) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return await response.json();
                } catch (error) {
                    console.error(`Error fetching data from ${url}:`, error);
                    throw error;
                }
            }

            // Chart colors
            const backgroundColors = [
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)',
                'rgba(199, 199, 199, 0.5)',
                'rgba(83, 102, 255, 0.5)',
                'rgba(40, 159, 64, 0.5)',
                'rgba(210, 105, 30, 0.5)'
            ];

            const borderColors = [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(199, 199, 199, 1)',
                'rgba(83, 102, 255, 1)',
                'rgba(40, 159, 64, 1)',
                'rgba(210, 105, 30, 1)'
            ];

            async function renderChart(url, chartId, type, labelsKey, dataKey, chartTitle = '') {
                const canvas = document.getElementById(chartId);
                const container = canvas.parentNode;
                const loader = container.querySelector('.chart-loader');

                try {
                    const data = await fetchData(url);

                    // Hide loader and show canvas
                    loader.classList.add('hidden');
                    canvas.classList.remove('hidden');

                    if (!data || data.length === 0) {
                        const noDataMsg = document.createElement('div');
                        noDataMsg.className = 'text-center text-red-500 mt-4';
                        noDataMsg.textContent = 'No data available';
                        container.appendChild(noDataMsg);
                        return;
                    }

                    const labels = data.map(item => item[labelsKey]);
                    const values = data.map(item => item[dataKey]);

                    // Determine colors based on chart type
                    let backgroundColor, borderColor;

                    if (type === 'pie' || type === 'doughnut') {
                        backgroundColor = backgroundColors.slice(0, labels.length);
                        borderColor = borderColors.slice(0, labels.length);
                    } else {
                        backgroundColor = backgroundColors[0];
                        borderColor = borderColors[0];
                    }

                    new Chart(canvas, {
                        type: type,
                        data: {
                            labels: labels,
                            datasets: [{
                                label: chartTitle,
                                data: values,
                                backgroundColor: backgroundColor,
                                borderColor: borderColor,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        boxWidth: 12,
                                        padding: 10,
                                        font: {
                                            size: 11
                                        }
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                    padding: 10,
                                    titleFont: {
                                        size: 13
                                    },
                                    bodyFont: {
                                        size: 12
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    // Handle error
                    loader.classList.add('hidden');
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'text-center text-red-500 mt-4';
                    errorMsg.textContent = `Error loading chart: ${error.message}`;
                    container.appendChild(errorMsg);
                }
            }

            async function initializeCharts() {
                const chartConfigs = [
                    // Requests charts
                    {
                        url: '/charts/requests/status',
                        id: 'requestsByStatusChart',
                        type: 'bar',
                        labelsKey: 'request_state',
                        dataKey: 'total',
                        title: 'Status Count'
                    },
                    {
                        url: '/charts/requests/priority',
                        id: 'requestsByPriorityChart',
                        type: 'pie',
                        labelsKey: 'request_priority',
                        dataKey: 'total',
                        title: 'Priority Distribution'
                    },
                    {
                        url: '/charts/requests/city',
                        id: 'requestsByCityChart',
                        type: 'bar',
                        labelsKey: 'city_name',
                        dataKey: 'total_requests',
                        title: 'Requests per City'
                    },
                    {
                        url: '/charts/requests/overtime',
                        id: 'requestsOverTimeChart',
                        type: 'line',
                        labelsKey: 'date',
                        dataKey: 'total_requests',
                        title: 'Daily Requests'
                    },
                    {
                        url: '/charts/requests/average-budget',
                        id: 'averageRequestBudgetByPriorityChart',
                        type: 'bar',
                        labelsKey: 'request_priority',
                        dataKey: 'avg_budget',
                        title: 'Avg Budget by Priority'
                    },

                    // Properties charts
                    {
                        url: '/charts/listings/status',
                        id: 'propertyStatusDistributionChart',
                        type: 'pie',
                        labelsKey: 'property_status_name',
                        dataKey: 'total',
                        title: 'Status Distribution'
                    },
                    {
                        url: '/charts/listings/city',
                        id: 'propertyListingsByCityChart',
                        type: 'bar',
                        labelsKey: 'city_name',
                        dataKey: 'total_properties',
                        title: 'Properties per City'
                    },
                    {
                        url: '/charts/listings/type',
                        id: 'propertyTypeBreakdownChart',
                        type: 'bar',
                        labelsKey: 'type',
                        dataKey: 'count',
                        title: 'Property Types'
                    },
                    {
                        url: '/charts/listings/sale-vs-rent',
                        id: 'saleVsRentPropertiesChart',
                        type: 'pie',
                        labelsKey: 'type',
                        dataKey: 'count',
                        title: 'Sale vs Rent'
                    },
                    {
                        url: '/charts/listings/average-price',
                        id: 'averagePropertyPriceByCityChart',
                        type: 'bar',
                        labelsKey: 'city_name',
                        dataKey: 'avg_price',
                        title: 'Avg Price per City'
                    },
                ];

                <?php if ($role === 'admin') : ?>
                    // Employee charts
                    $chartsAdmin = [{
                            url: '/charts/employees/role-distribution',
                            id: 'employeeRoleDistributionChart',
                            type: 'pie',
                            labelsKey: 'employee_role',
                            dataKey: 'total',
                            title: 'Role Distribution'
                        },
                        {
                            url: '/charts/employees/count-overtime',
                            id: 'employeeCountOverTimeChart',
                            type: 'line',
                            labelsKey: 'date',
                            dataKey: 'total_employees',
                            title: 'Employee Count Trend'
                        }
                    ]

                    chartConfigs.push(...$chartsAdmin);
                <?php endif; ?>

                const chartPromises = chartConfigs.map(config =>
                    renderChart(config.url, config.id, config.type, config.labelsKey, config.dataKey, config.title)
                );

                return Promise.all(chartPromises);
            }
        </script>