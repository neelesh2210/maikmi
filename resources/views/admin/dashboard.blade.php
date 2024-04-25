@extends('admin.layouts.app')
@section('content')
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }

        #chartdiv1 {
            width: 100%;
            height: 500px;
        }
    </style>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
        <form action="{{route('admin.dashboard')}}">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="flatpickr-date-range">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" name="search_date" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
                </div>
                <div>
                    <button class="btn btn-primary"><i class="bi bi-search pe-2"></i>Fillter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Users</h6>
                    <p>{{$total_users}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Shops</h6>
                    <p>{{$total_shops}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Products</h6>
                    <p>{{$total_products}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cardinfo">
                <div class="card-body">
                    <h6>Services</h6>
                    <p>{{$total_services}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Order Stats</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-end">
                            <b>Pending Order</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-warning" title="Pending Order">{{$total_pending_orders}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Completed Order</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-success" title="Completed Order">{{$total_completed_orders}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Order</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">{{$total_orders}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Order Amount</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">₹ {{$total_order_amount}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Booking Stats</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-end">
                            <b>Pending Booking</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-warning" title="Pending Order">{{$total_pending_bookings}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Completed Booking</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-success" title="Completed Order">{{$total_completed_bookings}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Booking</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">{{$total_bookings}}</span>
                        </div>
                        <div class="col-md-4 text-end">
                            <b>Total Booking Amount</b>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>:</b>
                        </div>
                        <div class="col-md-4 text-left">
                            <span class="badge bg-primary" title="Completed Order">₹ {{$total_booking_amount}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Last 7 days Order </h4>
                </div>
                <div class="card-body">
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Last 7 days Booking </h4>
                </div>
                <div class="card-body">
                    <div id="chartdiv1"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        am5.ready(function() {

            var root = am5.Root.new("chartdiv");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: false,
                wheelY: false,
                pinchZoomX: true,
                paddingLeft:0,
                paddingRight:1
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "date",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
            series.columns.template.adapters.add("fill", function (fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function (stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            var data = [
                @foreach ($week_dates as $key=>$week_date)
                    {
                        date: "{{$week_date}}",
                        value: {{$orders[$key]}}
                    },
                @endforeach
            ];

            xAxis.data.setAll(data);
            series.data.setAll(data);

            series.appear(1000);
            chart.appear(1000, 100);

        });

        am5.ready(function() {

            var root = am5.Root.new("chartdiv1");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: false,
                wheelY: false,
                pinchZoomX: true,
                paddingLeft:0,
                paddingRight:1
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "date",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
            series.columns.template.adapters.add("fill", function (fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function (stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            var data = [
                @foreach ($week_dates as $key=>$week_date)
                    {
                        date: "{{$week_date}}",
                        value: {{$bookings[$key]}}
                    },
                @endforeach
            ];

            xAxis.data.setAll(data);
            series.data.setAll(data);

            series.appear(1000);
            chart.appear(1000, 100);

        });
    </script>
@endsection
