<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <?= $this->session->flashdata('success'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('info')): ?>
  <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
    <?= $this->session->flashdata('info'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('danger')): ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <?= $this->session->flashdata('danger'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
<?php endif; ?>