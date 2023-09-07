<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dashboard';

?>
<link rel="stylesheet" href="/web/css/style.css">
<link rel="stylesheet" href="/web/css/media.css">
<style>
    .spidometr{
        margin: 20px 0;
    }
</style>

<div class="site-about">
   <!-- Диаграмма Ганта -->
   <div class="chart-wrapper">
        <ul class="chart-values">
            <div class="datepicker">
                <div class="dates">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                    <li>10</li>
                    <li>11</li>
                    <li>12</li>
                    <li>13</li>
                    <li>14</li>
                    <li>15</li>
                    <li>16</li>
                    <li>17</li>
                    <li>18</li>
                    <li>19</li>
                    <li>20</li>
                    <li>21</li>
                    <li>22</li>
                    <li>23</li>
                    <li>24</li>
                    <li>25</li>
                    <li>26</li>
                    <li>27</li>
                    <li>28</li>
                    <li>29</li>
                    <li>30</li>
                    <li>31</li>
                </div>
                <div class="slider"></div>
            </div>
        </ul>
        <ul class="chart-bars">
            <?php foreach ($tasks as $tasks):?>
            <li data-duration="<?= $tasks->datestart?>-<?= $tasks->dateofdelivery?>" data-color="#b03532"><?= $tasks->title?></li>
            <?php endforeach;?>      
        </ul>
    </div>
</div>


<div class="spidometr">
    <div id="container"></div>
    <div class="content">
        <div class="attendances">
            <div class="attendance-text">
                <p>Присутствовало</p>
                <p>Отсутствовало</p>
            </div>
            <div class="attendance">
                <?php foreach ($attendanceCount as $attendance):?>
                    <div class="number"><?= $attendance['totalCount']?></div>
                <?php endforeach;?> 
            </div>  
        </div>
    </div>
</div>

<div class="table">
        <table>
        <tr><th>Группа</th><th>ФИО студента</th></tr>
        <?php foreach ($students as $students):?>
            <tr><td><?= $students->group->name?></td><td><?= $students->name?></td></tr>
        <?php endforeach;?>  
    </table>
</div>







    <script>
function createChart(e) {
    const days = document.querySelectorAll(".chart-values li");
    const tasks = document.querySelectorAll(".chart-bars li");
    const daysArray = [...days];

    tasks.forEach(el => {
        const duration = el.dataset.duration.split("-");
        const startDay = duration[0];
        const endDay = duration[1];
        let left = 0,
            width = 0;

        if (startDay.endsWith("½")) {
            const filteredArray = daysArray.filter(day => day.textContent == startDay.slice(0, -1));
            left = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth / 2;
        } else {
            const filteredArray = daysArray.filter(day => day.textContent == startDay);
            left = filteredArray[0].offsetLeft;
        }

        if (endDay.endsWith("½")) {
            const filteredArray = daysArray.filter(day => day.textContent == endDay.slice(0, -1));
            width = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth / 2 - left;
        } else {
            const filteredArray = daysArray.filter(day => day.textContent == endDay);
            width = filteredArray[0].offsetLeft + filteredArray[0].offsetWidth - left;
        }

        // apply css
        el.style.left = `${left}px`;
        el.style.width = `${width}px`;
        if (e.type == "load") {
            el.style.backgroundColor = el.dataset.color;
            el.style.opacity = 1;
        }
    });
}

window.addEventListener("load", createChart);
window.addEventListener("resize", createChart);





const dates = document.querySelectorAll('.dates li');
const slider = document.querySelector('.slider');
const today = new Date();
const currentDay = today.getDate();

/* Устанавливаем ползунок на текущую дату */
slider.style.left = `${dates[currentDay - 1].offsetLeft + dates[currentDay - 1].offsetWidth / 2}px`;

/* Добавляем обработчик клика на каждую дату */
dates.forEach((date, index) => {
    date.addEventListener('click', () => {
        slider.style.left = `${date.offsetLeft + date.offsetWidth / 2}px`;
    });
});






    Highcharts.chart('container', {

chart: {
    type: 'solidgauge'
},

title: {
    text: 'Average Mark'
},

tooltip: {
    enabled: false
},

pane: {
    startAngle: -90,
    endAngle: 90,
    background: [{
        // Track for Average Mark
        outerRadius: '112%',
        innerRadius: '88%',
        backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.3).get(),
        borderWidth: 0
    }]
},

yAxis: {
    min: 0,
    max: 10,
    lineColor: '#0f0f0f',
    lineWidth: 0,
    minorTickInterval: null,
    tickPixelInterval: 400,
    tickWidth: 0,
    labels: {
        y: 16
    }
},

plotOptions: {
    solidgauge: {
        dataLabels: {
            enabled: true,
            y: -35,
            borderWidth: 0,
            useHTML: true
        }
    }
},

credits: {
    enabled: false
},

series: [{
    name: 'Average Mark',
    data: [4.5],
    dataLabels: {
        format: '<div style="text-align:center"><span style="font-size:25px;color:black">{y:.1f}</span><br/>' +
            '<span style="font-size:12px;color:silver">out of 10</span></div>'
    },
    tooltip: {
        valueSuffix: ' out of 10'
    }
}]
});

</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="/web/js/script.js"></script>


