<?php
include('../../autoload/Autoload.php');

//================== check login

if (!Auth::user()) {

    Redirect::url('admin/account/login.php');
}
$currentYear = date("Y");
$sql = " SELECT count(id) as data , sum(tongtien) as tongtien , CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear 
FROM donhang
WHERE YEAR(created_at) = $currentYear 
GROUP BY monthyear
ORDER BY monthyear ASC ";

$data = $DB->query($sql);


$data_thu = [];
$i = 1;
while ($i <= 12) {
    $data_thu[] = 0;
    $i++;
}

foreach ($data_thu as $key => $value) {
    foreach ($data as $item) {
        if ($key == substr($item->monthyear, 0, strpos($item->monthyear, '-'))) {
            $data_thu[$key - 1] =  $item->tongtien;
        }
    }
}


$title = "Báo cáo tồn kho";
include('../../layouts/admin/header.php');

?>
<div class="d-flex justify-content-between mb-4">
    <h4>Báo cáo doanh thu </h4>
</div>
<div class="col-md-6">
    <div class="col-md-12 showcase_content_area px-0">
        <select class="custom-select" id="order-group">
            <option selected="">Chọn thời gian</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
        </select>
    </div>
    <div class="grid">
        <div class="grid-body">
            <h2 class="grid-title">Bar Chart</h2>
            <div class="item-wrapper">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                <canvas id="chartjs-bar-chart" width="637" height="425" class="chartjs-render-monitor" style="display: block; height: 340px; width: 510px;"></canvas>
            </div>
        </div>
    </div>
</div>
<?php
include('../../layouts/admin/footer.php');
?>

<script>
    if ($("#chartjs-bar-chart").length) {
        var BarData = {
            labels: ["tháng 1", "tháng 2", "tháng 3", "tháng 4", "tháng 5", "tháng 6", "tháng 7", "tháng 8", "tháng 10", "tháng 11", "tháng 12"],
            datasets: [{
                label: '# of Votes',
                data: <?= json_encode($data_thu) ?>,
                backgroundColor: chartColors,
                borderColor: chartColors,
                borderWidth: 0
            }]
        };
        var barChartCanvas = $("#chartjs-bar-chart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: BarData,
            options: {
                legend: false
            }
        });

        var url = "ajax-getsales.php";
        var orderGroup = document.querySelector('#order-group');
        orderGroup.addEventListener('change', function() {

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        groupYear: orderGroup.value
                    })
                })
                .then(response => response.json())
                .then(data => {

                    var BarData = {
                        labels: ["tháng 1", "tháng 2", "tháng 3", "tháng 4", "tháng 5", "tháng 6", "tháng 7", "tháng 8", "tháng 10", "tháng 11", "tháng 12"],
                        datasets: [{
                            label: '# of Votes',
                            data: data,
                            backgroundColor: chartColors,
                            borderColor: chartColors,
                            borderWidth: 0
                        }]
                    };
                    var barChartCanvas = $("#chartjs-bar-chart").get(0).getContext("2d");
                    var barChart = new Chart(barChartCanvas, {
                        type: 'bar',
                        data: BarData,
                        options: {
                            legend: false
                        }
                    });


                })
                .catch((err) => {
                    console.log(err);
                })

        })

    }
</script>