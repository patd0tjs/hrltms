<script src="https://code.highcharts.com/highcharts.js"></script>

<div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light">
        Employee count:
     <a href="<?= base_url()?>admin/employees" style="text-decoration: none; color: black; font-weight: bold;"> <?= count($employees)?></a>
     </div>
    </div>
    <div class="col">
      <div class="p-3 border bg-light">
      Leave count:
      <a href="<?= base_url()?>admin/leaves" style="text-decoration: none; color: black; font-weight: bold;"> <?= count($leaves)?></a>
      </div>
    </div>
    <div class="col">
      <div class="p-3 border bg-light">
      Tardy count:
      <a href="<?= base_url()?>admin/tardy" style="text-decoration: none; color: black; font-weight: bold;"> <?= count($tardies)?></a>
      </div>
    </div>
  </div>
</div>

<figure class="highcharts-figure">
  <div id="container"></div>
</figure>

<script>

Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Overall count'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Count',
    colorByPoint: true,
    data: [{
      name: 'Employees',
      y: <?= count($employees)?>,
      sliced: true,
      selected: true
    }, {
      name: 'Approved Leaves',
      y: <?= count($leaves)?>
    },  {
      name: 'Tardies',
      y: <?= count($tardies)?>
    }]
  }]
});
</script>