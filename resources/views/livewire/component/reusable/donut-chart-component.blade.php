<div wire:ignore>
    <canvas id="statistics-chart"></canvas>
</div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script>

    const data = $wire.data;
    console.log(data);

    const ctx = document.getElementById('statistics-chart');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Clocked In',
                'Not Clocked In',
                'Clocked Out',
                'On Vacation Leave',
                'On Sick Leave'
            ],
            datasets: [{
                label: 'Employees',
                data: [1,2,3,0,0],
                backgroundColor: [
                    '#2196F3',
                    '#FF6174',
                    '#EFE30A',
                    '#FF6600',
                    '#0F901B'
                ],
                hoverOffset: 10
            },]
        },
        options: {
            responsive: true,
            maintainAspectRation: false,
            context: '2d',
            plugins: {
                legend: {
                    display: false
                }
            }
            
        }
    });
</script>
