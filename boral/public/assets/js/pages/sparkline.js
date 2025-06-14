function hexToRGB(o, i) {
    var l = parseInt(o.slice(1, 3), 16),
        e = parseInt(o.slice(3, 5), 16),
        o = parseInt(o.slice(5, 7), 16);
    return i ? "rgba(" + l + ", " + e + ", " + o + ", " + i + ")" : "rgb(" + l + ", " + e + ", " + o + ")"
}
$(document).ready(function () {
    function i() {
        var o = ["#00acc1", "#1abc9c"],
            i = $("#sparkline1").data("colors"),
            o = (i && (o = i.split(",")), $("#sparkline1").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 50,
                lineColor: o[0],
                fillColor: hexToRGB(o[0], .3),
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)",
                maxSpotColor: !1,
                minSpotColor: !1,
                spotColor: !1,
                lineWidth: 1
            }), $("#sparkline1").sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 40,
                lineColor: o[1],
                fillColor: hexToRGB(o[1], .3),
                composite: !0,
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)",
                maxSpotColor: !1,
                minSpotColor: !1,
                spotColor: !1,
                lineWidth: 1
            }), ["#4a81d4"]),
            o = ((i = $("#sparkline2").data("colors")) && (o = i.split(",")), $("#sparkline2").sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
                type: "bar",
                height: "165",
                barWidth: "10",
                barSpacing: "3",
                barColor: o
            }), ["#4fc6e1", "#f7b84b", "#e3eaef", "#f1556c"]),
            o = ((i = $("#sparkline3").data("colors")) && (o = i.split(",")), $("#sparkline3").sparkline([20, 40, 30, 10], {
                type: "pie",
                width: "165",
                height: "165",
                sliceColors: o
            }), ["#2d7bf4", "#4eb7eb"]),
            o = ((i = $("#sparkline4").data("colors")) && (o = i.split(",")), $("#sparkline4").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 50,
                lineColor: o[0],
                fillColor: "transparent",
                lineWidth: 2,
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)",
                maxSpotColor: !1,
                minSpotColor: !1,
                spotColor: !1
            }), $("#sparkline4").sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 40,
                lineColor: o[1],
                fillColor: "transparent",
                composite: !0,
                lineWidth: 2,
                maxSpotColor: !1,
                minSpotColor: !1,
                spotColor: !1,
                highlightLineColor: "rgba(0,0,0,1)",
                highlightSpotColor: "rgba(0,0,0,1)"
            }), ["#e3eaef", "#6c757d"]),
            o = ((i = $("#sparkline6").data("colors")) && (o = i.split(",")), $("#sparkline6").sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
                type: "line",
                width: "100%",
                height: "165",
                lineColor: o[0],
                lineWidth: 2,
                fillColor: "rgba(227,234,239,0.3)",
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)"
            }), $("#sparkline6").sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
                type: "bar",
                height: "165",
                barWidth: "10",
                barSpacing: "5",
                composite: !0,
                barColor: o[1]
            }), ["#36404c"]),
            o = ((i = $("#sparkline7").data("colors")) && (o = i.split(",")), $("#sparkline7").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7], {
                type: "discrete",
                width: "280",
                height: "165",
                lineColor: o
            }), ["#64c5b1", "#5553ce"]),
            o = ((i = $("#sparkline8").data("colors")) && (o = i.split(",")), $("#sparkline8").sparkline([10, 12, 12, 9, 7], {
                type: "bullet",
                width: "280",
                height: "80",
                targetColor: o[0],
                performanceColor: o[1]
            }), ["#00acc1", "#1abc9c"]),
            o = ((i = $("#sparkline9").data("colors")) && (o = i.split(",")), $("#sparkline9").sparkline([4, 27, 34, 52, 54, 59, 61, 68, 78, 82, 85, 87, 91, 93, 100], {
                type: "box",
                width: "280",
                height: "80",
                boxLineColor: o[0],
                boxFillColor: "transparent",
                whiskerColor: o[1],
                medianColor: o[1],
                targetColor: o[1]
            }), ["#0acf97", "#e3eaef", "#ff679b"]);
        (i = $("#sparkline10").data("colors")) && (o = i.split(",")), $("#sparkline10").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
            height: "80",
            width: "100%",
            type: "tristate",
            posBarColor: o[0],
            negBarColor: o[1],
            zeroBarColor: o[2],
            barWidth: 8,
            barSpacing: 3,
            zeroAxis: !1
        })
    }

    function l() {
        function e() {
            var o, i, l = (new Date).getTime();
            r && r != l && (o = Math.round(a / (l - r) * 1e3), n.push(o), 30 < n.length && n.splice(0, 1), a = 0, o = ["#f1556c"], (i = $("#sparkline5").data("colors")) && (o = i.split(",")), $("#sparkline5").sparkline(n, {
                tooltipSuffix: " pixels per second",
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 77,
                maxSpotColor: !1,
                minSpotColor: !1,
                spotColor: !1,
                lineWidth: 1,
                lineColor: o,
                fillColor: hexToRGB(o[0], .3),
                highlightLineColor: "rgba(24,147,126,.1)",
                highlightSpotColor: "rgba(24,147,126,.2)"
            })), r = l, setTimeout(e, 500)
        }
        var r, l = -1,
            t = -1,
            a = 0,
            n = [];
        $("html").mousemove(function (o) {
            var i = o.pageX,
                o = o.pageY; - 1 < l && (a += Math.max(Math.abs(i - l), Math.abs(o - t))), l = i, t = o
        }), setTimeout(e, 500)
    }
    var e;
    i(), l(), $(window).resize(function (o) {
        clearTimeout(e), e = setTimeout(function () {
            i(), l()
        }, 300)
    })
});
