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