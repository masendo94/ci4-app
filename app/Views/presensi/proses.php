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

        <script>
      $(function(){
         //untuk webcam
         Webcam.set({
          height : 860,
          width: 670,
          image_format: 'jpg',
          jpeg_quality: 80    
        })

        Webcam.attach('.webcame');

        // untuk locasi
        if( navigator.geolocation ){
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }else{
            alert('gagal');
        }

        function successCallback(data){
            const lokasi = data.coords.latitude +',' + data.coords.longitude;
            $('#lokasi').val(lokasi);
            const map = L.map('map').setView([data.coords.latitude, data.coords.longitude], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

            // menambahkan marker posisi
            const marker = L.marker([data.coords.latitude, data.coords.longitude]).addTo(map);

            // menambahkan lingkaran radius
            // latitude dan longitude diisi dengan lokasi kantor
            const circle = L.circle([data.coords.latitude, data.coords.longitude], {
                        color: 'green',
                        fillColor: 'green',
                        fillOpacity: 0.5,
                        radius: 30 // satuan dalam meter
                    }).addTo(map);

            }

            function errorCallback(){

            }
      })
    </script>

<?= $this->endSection() ?>