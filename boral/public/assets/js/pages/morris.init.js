!(function (e) {
  "use strict";
  var a = function () {};
  (a.prototype.createLineChart = function (e, a, r, t, i, o, b, s, y) {
    Morris.Line({
      element: e,
      data: a,
      xkey: r,
      ykeys: t,
      labels: i,
      fillOpacity: o,
      pointFillColors: b,
      pointStrokeColors: s,
      behaveLikeLine: !0,
      gridLineColor: "rgba(108, 120, 151, 0.1)",
      hideHover: "auto",
      lineWidth: "3px",
      pointSize: 0,
      preUnits: "$",
      resize: !0,
      lineColors: y,
    });
  }),
    (a.prototype.createAreaChart = function (e, a, r, t, i, o, b, s) {
      Morris.Area({
        element: e,
        pointSize: 0,
        lineWidth: 0,
        data: t,
        xkey: i,
        ykeys: o,
        labels: b,
        hideHover: "auto",
        resize: !0,
        gridLineColor: "rgba(108, 120, 151, 0.1)",
        lineColors: s,
      });
    }),
    (a.prototype.createAreaChartDotted = function (
      e,
      a,
      r,
      t,
      i,
      o,
      b,
      s,
      y,
      n
    ) {
      Morris.Area({
        element: e,
        pointSize: 3,
        lineWidth: 1,
        data: t,
        xkey: i,
        ykeys: o,
        labels: b,
        hideHover: "auto",
        pointFillColors: s,
        pointStrokeColors: y,
        resize: !0,
        smooth: !1,
        gridLineColor: "rgba(108, 120, 151, 0.1)",
        lineColors: n,
      });
    }),
    (a.prototype.createBarChart = function (e, a, r, t, i, o) {
      Morris.Bar({
        element: e,
        data: a,
        xkey: r,
        ykeys: t,
        labels: i,
        hideHover: "auto",
        resize: !0,
        gridLineColor: "rgba(108, 120, 151, 0.1)",
        barSizeRatio: 0.4,
        xLabelAngle: 35,
        barColors: o,
      });
    }),
    (a.prototype.createStackedChart = function (e, a, r, t, i, o) {
      Morris.Bar({
        element: e,
        data: a,
        xkey: r,
        ykeys: t,
        stacked: !0,
        labels: i,
        hideHover: "auto",
        resize: !0,
        gridLineColor: "rgba(108, 120, 151, 0.1)",
        barColors: o,
      });
    }),
    (a.prototype.createDonutChart = function (e, a, r) {
      Morris.Donut({ element: e, data: a, resize: !0, colors: r });
    }),
    (a.prototype.init = function () {
      this.createLineChart(
        "morris-line-example",
        [
          { y: "2008", a: 50, b: 0 },
          { y: "2009", a: 75, b: 50 },
          { y: "2010", a: 30, b: 80 },
          { y: "2011", a: 50, b: 50 },
          { y: "2012", a: 75, b: 10 },
          { y: "2013", a: 50, b: 40 },
          { y: "2014", a: 75, b: 50 },
          { y: "2015", a: 100, b: 70 },
        ],
        "y",
        ["a", "b"],
        ["Series A", "Series B"],
        ["0.1"],
        ["#ffffff"],
        ["#999999"],
        ["#188ae2", "#4bd396"]
      );
      this.createAreaChart(
        "morris-area-example",
        0,
        0,
        [
          { y: "2009", a: 10, b: 20 },
          { y: "2010", a: 75, b: 65 },
          { y: "2011", a: 50, b: 40 },
          { y: "2012", a: 75, b: 65 },
          { y: "2013", a: 50, b: 40 },
          { y: "2014", a: 75, b: 65 },
          { y: "2015", a: 90, b: 60 },
        ],
        "y",
        ["a", "b"],
        ["Series A", "Series B"],
        ["#8d6e63", "#bdbdbd"]
      );
      this.createAreaChartDotted(
        "morris-area-with-dotted",
        0,
        0,
        [
          { y: "2009", a: 10, b: 20 },
          { y: "2010", a: 75, b: 65 },
          { y: "2011", a: 50, b: 40 },
          { y: "2012", a: 75, b: 65 },
          { y: "2013", a: 50, b: 40 },
          { y: "2014", a: 75, b: 65 },
          { y: "2015", a: 90, b: 60 },
        ],
        "y",
        ["a", "b"],
        ["Series A", "Series B"],
        ["#ffffff"],
        ["#999999"],
        ["#6b5fb5", "#bdbdbd"]
      );
      this.createBarChart(
        "morris-bar-example",
        [
          { y: "2009", a: 100, b: 90, c: 40 },
          { y: "2010", a: 75, b: 65, c: 20 },
          { y: "2011", a: 50, b: 40, c: 50 },
          { y: "2012", a: 75, b: 65, c: 95 },
          { y: "2013", a: 50, b: 40, c: 22 },
          { y: "2014", a: 75, b: 65, c: 56 },
          { y: "2015", a: 100, b: 90, c: 60 },
        ],
        "y",
        ["a", "b", "c"],
        ["Series A", "Series B", "Series C"],
        ["#3ac9d6", "#ff9800", "#f5707a"]
      );
      this.createStackedChart(
        "morris-bar-stacked",
        [
          { y: "2005", a: 45, b: 180 },
          { y: "2006", a: 75, b: 65 },
          { y: "2007", a: 100, b: 90 },
          { y: "2008", a: 75, b: 65 },
          { y: "2009", a: 100, b: 90 },
          { y: "2010", a: 75, b: 65 },
          { y: "2011", a: 50, b: 40 },
          { y: "2012", a: 75, b: 65 },
          { y: "2013", a: 50, b: 40 },
          { y: "2014", a: 75, b: 65 },
          { y: "2015", a: 100, b: 90 },
        ],
        "y",
        ["a", "b"],
        ["Series A", "Series B"],
        ["#26a69a", "#ebeff2"]
      );
      this.createDonutChart(
        "morris-donut-example",
        [
          { label: "Electricity", value: 12 },
          { label: "Financial", value: 30 },
          { label: "Markets", value: 20 },
        ],
        ["#4bd396", "#ebeff2", "#3ac9d6"]
      );
    }),
    (e.MorrisCharts = new a()),
    (e.MorrisCharts.Constructor = a);
})(window.jQuery),
  (function (e) {
    "use strict";
    window.jQuery.MorrisCharts.init();
  })();
