// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}

fetch('admin_dashboarddata.php')
  .then(response => response.json())
  .then(data => {
    // Extract prices from the response
    const intermentPrices = data.intermentPrices;
    const torPrices = data.torPrices;

    // Labels for the months from January to December
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Determine the max value for the y-axis
    const maxIntermentPrice = Math.max(...intermentPrices);
    const maxTorPrice = Math.max(...torPrices);
    const maxYAxisValue = Math.max(maxIntermentPrice, maxTorPrice);

    // Initialize the chart with fetched data
    const areaChartOptions = {
      series: [
        {
          name: 'Interment Orders',
          data: intermentPrices,
        },
        {
          name: 'ToR Orders',
          data: torPrices,
        },
      ],
      chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false,
        },
      },
      colors: ['#3da542', '#f5b74f'],
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: 'smooth',
      },
      labels: months,
      markers: {
        size: 0,
      },
      yaxis: [
        {
          title: {
            text: 'Interment Orders',
          },
          labels: {
            formatter: function (value) {
              return `₱${value.toLocaleString()}`;
            },
          },
          min: 0,
          max: maxYAxisValue + 1000, // Adding some padding
        },
        {
          opposite: true,
          title: {
            text: 'ToR Orders',
          },
          labels: {
            formatter: function (value) {
              return `₱${value.toLocaleString()}`;
            },
          },
          min: 0,
          max: maxYAxisValue + 1000, // Adding some padding
        },
      ],
      tooltip: {
        shared: true,
        intersect: false,
        y: {
          formatter: function (value) {
            return `₱${value.toLocaleString()}`;
          },
        },
      },
    };

    const areaChart = new ApexCharts(
      document.querySelector('#area-chart'),
      areaChartOptions
    );
    areaChart.render();
  })
  .catch(error => console.error('Error fetching data:', error));
