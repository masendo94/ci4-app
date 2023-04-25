<?= $this->extend('template/layout_karyawan') ?>

<?= $this->section('content') ?>
        
<div class="section" id="user-section">
<div id="user-detail">
  <div class="avatar">
    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
   </div>
    <div id="user-info">
        <h2 id="user-name"><?= strtoupper(session()->get('username')) ?></h2>
        <span id="user-role">Orang Biasa</span>
    </div>
</div>
</div>

<div class="section" id="menu-section">
<div class="card">
    <div class="card-body text-center">
        <div class="list-menu">
            <div class="item-menu text-center">
                <div class="menu-icon">
                    <a href="" class="green" style="font-size: 40px;">
                        <ion-icon name="person-sharp"></ion-icon>
                    </a>
                </div>
                <div class="menu-name">
                    <span class="text-center">Profil</span>
                </div>
            </div>
            <div class="item-menu text-center">
                <div class="menu-icon">
                    <a href="" class="danger" style="font-size: 40px;">
                        <ion-icon name="calendar-number"></ion-icon>
                    </a>
                </div>
                <div class="menu-name">
                    <span class="text-center">Cuti</span>
                </div>
            </div>
            <div class="item-menu text-center">
                <div class="menu-icon">
                    <a href="" class="warning" style="font-size: 40px;">
                        <ion-icon name="document-text"></ion-icon>
                    </a>
                </div>
                <div class="menu-name">
                    <span class="text-center">Histori</span>
                </div>
            </div>
            <div class="item-menu text-center">
                <div class="menu-icon">
                    <a href="" class="orange" style="font-size: 40px;">
                        <ion-icon name="location"></ion-icon>
                    </a>
                </div>
                <div class="menu-name">
                    Lokasi
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="section mt-2" id="presence-section">
<div class="todaypresence">
    <div class="row">
        <div class="col-6">
            <div class="card gradasigreen">
                <div class="card-body">
                    <div class="presencecontent">
                        <div class="iconpresence">
                        <div class="avatar">
                            <?php
                            $image = base_url('assets/img/sample/avatar/avatar1.jpg');
                                if($user){
                                    $image = base_url('assets/img/presensi/'.$user['foto_masuk']);
                                }
                            ?>
                                <img src="<?= $image ?>"  class="imaged rounded" width="40px">
                            </div>
                        </div>
                        <div class="presencedetail">
                            <h4 class="presencetitle">Masuk</h4>
                            <span><?=(!$user)?'--:--:--' : $user['jam_masuk']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card gradasired">
                <div class="card-body">
                    <div class="presencecontent">
                        <div class="iconpresence">
                            <?php
                            $image = base_url('assets/img/sample/avatar/avatar1.jpg');
                                if($user){
                                    $image = base_url('assets/img/presensi/'.$user['foto_pulang']);
                                }
                            ?>
                            <img src="<?= $image ?>"  class="imaged rounded" width="40px">
                        </div>
                        <div class="presencedetail">
                            <h4 class="presencetitle">Pulang</h4>
                            <span><?=(!$user) ? '--:--:--' : $user['jam_pulang']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="presencetab mt-2">
    <div class="tab-pane fade show active" id="pilled" role="tabpanel">
        <ul class="nav nav-tabs style1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                    HARI INI <?= date('Y-m-d H:i:s')?>
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content mt-2" style="margin-bottom:100px;">
        <div class="tab-pane fade show active" id="home" role="tabpanel">
            <ul class="listview image-listview">
            <?php for($i=1; $i<10; $i++) :?>
                <li>
                    <div class="item"> 
                        <div class="icon-box bg-primary">
                            <div class="avatar">
                                <img src="assets/img/sample/avatar/avatar1.jpg"  class="imaged rounded" width="40px">
                            </div>
                        </div>
                        <div class="in">
                            <div>ENDO</div>
                            <span class="badge badge-success">08:00</span>
                        </div>
                    </div>
                </li>
                <?php endfor; ?>
            </ul>
        </div>

    </div>
</div>
</div>

<?= $this->endSection() ?>


    