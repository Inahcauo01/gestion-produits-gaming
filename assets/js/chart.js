google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['categorie', 'nombre des jeux'],
        ['Action',     11],
        ['Sport',      2],
        ['Strategie',  2],
        ['Puzzele', 2],
        ['Combat',    7]
    ]);

    var options = {
        title: 'Le nombre des jeux par categorie'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}