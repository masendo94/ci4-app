<?= $this->extend('template/layout_karyawan') ?>


<?= $this->section('content') ?>

<!-- App Header -->
<div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/home" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E-Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

    <div class="section full mt-2">
            <div class="row" style="margin-top:65px;">
                <div class="col">
                    <input type="hidden" name="lokasi" id="lokasi">
                    <div class="webcame"> </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button class="btn btn-primary btn-block" id="absensi"> <ion-icon name="camera-outline"></ion-icon> Absen Masuk</button>
                </div>
            </div>

            
            <div class="row">
                <div class="col mt-2">
                    <div id="map"></div>
                </div>
            </div>

        </div>

    

<?= $this->endSection() ?>