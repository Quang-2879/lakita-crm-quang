<html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages: ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Density", {role: "style"}],
                    ["Copper", 8.94, "#2C944A"],
                    ["Silver", 10.49, "#2C944A"],
                    ["Gold", 19.30, "#2C944A"],
                    ["Platinum", 21.45, "#2C944A"]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"},
                    2]);

                var options = {
                    title: "Density of Precious Metals, in g/cm^3",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "70%"},
                    legend: {position: "none"}
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }
        </script>
</head>
<body>
     <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
</body>
</html>