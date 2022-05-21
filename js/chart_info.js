const chart_dashboard = document.getElementById('myChart_dashboard');


function level() {
    fetch('http://localhost:1109/pemWeb/btcAdmin/api/chart_info.php')
        .then(response => response.json())
        .then(data => {
            console.log(data)
            data.forEach((value) => {
                let level = value.level
                let tanggal = value.tanggal
                // console.log(level);
            });

            // renderChartLevelTanggal(data);
        });
}
level();


// const labels = ['crash1', 'crash2', 'crash3', 'recover1', 'recover2', 'recover3'];
const labels = ["Crash1", "Wajar2", "Recover1", "Recover2", "Moon1", "Wajar1", "Moon2", "SuperMoon1", "sama", "Crash2", "SuperCrash1", "SuperCrash2", "MegaCrash1", "MegaCrash2", "UltraCrash1", "UltraCrash2", "GoldenCrash1", "GoldenCrash2", "DiamondCrash", "SuperMoon2", "MegaMoon1", "MegaMoon2", "UltraMoon1", "UltraMoon2"]
const data = [111, 33, 44, 22, 55, 7];

const myChart = new Chart(
    chart_dashboard,
    {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: data,
            }]
        },
        options: {}
    }
);

