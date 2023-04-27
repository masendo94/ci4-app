<?= $this->extend('template/layout_karyawan') ?>


<?= $this->section('content') ?>

<link rel="manifest" href="__manifest.json">
    <style>
            .webcame, .webcame video {
            width: 100% !important;
            height: auto !important;
            margin: auto;
            display: inline-block;
            border-radius: 10px;
            }

            #map {
            height: 300px;
            }
            </style>

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
        <!-- <form action="/presensi" method="POST"> -->
            <div class="row" style="margin-top:65px;">
                <div class="col">
                    <input type="hidden" name="lokasi" id="lokasi">
                    <div class="webcame"> </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button tyoe="submit" class="btn <?= ($user) ? 'btn-danger' : 'btn-primary' ?> btn-block" id="take-apsen" > <ion-icon name="camera-outline"></ion-icon> <?= ($user) ? 'Absen Pulang' : 'Absen Masuk' ?></button>
        <!-- </form> -->
                </div>
            </div>

            
            <div class="row">
                <div class="col mt-2">
                    <div id="map"></div>
                </div>
            </div>

            <audio id="sound-masuk">
                <source src="<?= base_url() ?>assets/sound/masuk.mp3" type="audio/mpeg">
            </audio>

            <audio id="sound-pulang">
                <source src="<?= base_url() ?>assets/sound/pulang.mp3" type="audio/mpeg">
            </audio>

        </div>

        <script src="<?= base_url() ?>/assets/js/lib/jquery-3.4.1.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/lib/webcame.js"></script>
    <script src="<?= base_url() ?>/assets/maps/leaflet.js"></script>
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

            // proses presensi
            $('#take-apsen').on('click', function(){
                Webcam.snap(function(uri){
                    const image = uri;
                    const lokasi = $('#lokasi').val();
                    // console.log(image);

                    // input data dengan ajax
                    $.ajax({
                        url : '<?= base_url() ?>/presensi',
                        method : 'POST',
                        data : {
                            image : image,
                            lokasi : lokasi
                        },
                        dataType : 'JSON',
                        success : (hasil) => {
                            const sound = document.getElementById(`sound-${hasil.jenis}`);
                            sound.play();
                            Swal.fire(
                                  hasil.status,
                                  hasil.pesan,
                                  hasil.icon
                                ).then(result => {
                                    if(result.isConfirmed){
                                        window.location.href = `<?= base_url() ?>/home`;
                                    }
                                })
                            // setTimeout(
                            //     window.location.href = '<?= base_url() ?>/home' ,10000)
                        },
                        error : () => {
                            alert('gagal')
                        }

                    })
                })
            })
      })
    </script>

<?= $this->endSection() ?>