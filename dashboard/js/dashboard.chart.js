
// Themes begin
am4core.useTheme(am4themes_animated);
am4core.useTheme(am4themes_kelly);

var chart = am4core.create("chartData", am4charts.XYChart3D);

chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.data = [
    {
        date: "2020-02-20",
        cisco: 24,
        mcsa: 12,
        mcp: 19,
        eth: 32
    },
    {
        date: "2020-02-19",
        cisco: 34,
        mcsa: 11,
        mcp: 15,
        eth: 31
    },
    {
        date: "2020-02-18",
        cisco: 35,
        mcsa: 22,
        mcp: 10,
        eth: 31
    },
    {
        date: "2020-02-17",
        cisco: 14,
        mcsa: 6,
        mcp: 3,
        eth: 12
    },
];

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "date";
categoryAxis.title.text = "Courses per Date";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.calculateTotals = true;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Number of Students";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "cisco";
series.dataFields.categoryX = "date";
series.name = "CCNA";
series.tooltipText = "{name}: [bold]{valueY}[/]";
series.stacked = true;

var series2 = chart.series.push(new am4charts.ColumnSeries3D());
series2.dataFields.valueY = "mcsa";
series2.dataFields.categoryX = "date";
series2.name = "MCSA";
series2.tooltipText = "{name}: [bold]{valueY}[/]";
series2.stacked = true;

var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "eth";
series3.dataFields.categoryX = "date";
series3.name = "Ethical Hanking";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.stacked = true;

// Add cursor
chart.cursor = new am4charts.XYCursor();