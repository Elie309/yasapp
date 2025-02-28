<div class="container-main max-w-6xl">

    <h2 class="main-title-page">Dashboard</h2>

    <div class="my-8 bg-white p-10 shadow-md rounded-md min-w-full overflow-auto">

        <div class="grid grid-cols-2 gap-4">
            <div class="chart-container">
                <canvas id="requestsByStatusChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="requestsByPriorityChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="requestsByCityChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="requestsOverTimeChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="averageRequestBudgetByPriorityChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="propertyStatusDistributionChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="propertyListingsByCityChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="propertyTypeBreakdownChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="saleVsRentPropertiesChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="averagePropertyPriceByCityChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="propertySizeDistributionChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="employeeRoleDistributionChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="employeeCountOverTimeChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    async function fetchData(url) {
        const response = await fetch(url);
        return response.json();
    }

    async function renderChart(url, ctx, type, labelsKey, dataKey) {
        const data = await fetchData(url);
        const labels = data.map(item => item[labelsKey]);
        const values = data.map(item => item[dataKey]);

        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: ctx.id,
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderChart('/charts/requests/status', document.getElementById('requestsByStatusChart'), 'bar', 'request_state', 'total');
        renderChart('/charts/requests/priority', document.getElementById('requestsByPriorityChart'), 'pie', 'request_priority', 'total');
        renderChart('/charts/requests/city', document.getElementById('requestsByCityChart'), 'bar', 'city_name', 'total_requests');
        renderChart('/charts/requests/overtime', document.getElementById('requestsOverTimeChart'), 'line', 'date', 'total_requests');
        renderChart('/charts/requests/average-budget', document.getElementById('averageRequestBudgetByPriorityChart'), 'bar', 'request_priority', 'avg_budget');
        renderChart('/charts/listings/status', document.getElementById('propertyStatusDistributionChart'), 'pie', 'property_status_name', 'total');
        renderChart('/charts/listings/city', document.getElementById('propertyListingsByCityChart'), 'bar', 'city_name', 'total_properties');
        renderChart('/charts/listings/type', document.getElementById('propertyTypeBreakdownChart'), 'bar', 'type', 'count');
        renderChart('/charts/listings/sale-vs-rent', document.getElementById('saleVsRentPropertiesChart'), 'pie', 'type', 'count');
        renderChart('/charts/listings/average-price', document.getElementById('averagePropertyPriceByCityChart'), 'bar', 'city_name', 'avg_price');
        renderChart('/charts/listings/size-distribution', document.getElementById('propertySizeDistributionChart'), 'bar', 'property_size', 'total_properties');
        renderChart('/charts/employees/role-distribution', document.getElementById('employeeRoleDistributionChart'), 'pie', 'employee_role', 'total');
        renderChart('/charts/employees/count-overtime', document.getElementById('employeeCountOverTimeChart'), 'line', 'date', 'total_employees');
    });
</script>