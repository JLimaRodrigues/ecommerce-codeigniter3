<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Compre seu estilo</h1>
            <p class="lead fw-normal text-white-50 mb-0">Um ecommerce moderno</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div id="lista-produtos" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        </div>
    </div>
</section>

<?php
$scripts = $this->load->view('scripts/home', [], true);
$this->load->view('templates/footer', compact('scripts')); 
?>