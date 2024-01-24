@section('judul', 'Dashboard')

<section class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <br>
                    <h5><strong>Simpan Pinjam PKK</strong></h5>
                    <h6>Sistem Informasi Simpan Pinjam Pemberdayaan
                        Kesejahteraan Keluarga (PKK) Kelurahan Kalitirto, Berbah, Sleman</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>{{ $countmember }}</h3>
                <p>Data Anggota</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('dataanggota') }}" class="small-box-footer">Lihat Anggota <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $countsaving }}</h3>
                <p>Data Simpanan</p>
            </div>
            <div class="icon">
                <i class="ion ion-folder"></i>
            </div>
            <a href="{{ route('datasimpanan') }}" class="small-box-footer">Lihat Info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $countcredit }}</h3>
                <p>Data Pinjaman</p>
            </div>
            <div class="icon">
                <i class=" ion ion-email-unread"></i>
            </div>
            <a href="{{ route('datapinjaman') }}" class="small-box-footer">Lihat Info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $countinstalment }}</h3>
                <p>Data Angsuran</p>
            </div>
            <div class="icon">
                <i class="ion ion-compose"></i>
            </div>
            <a href="{{ route('dataangsuran') }}" class="small-box-footer">Lihat Info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<section class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <br>
                    <h5><strong>Selamat datang, {{ auth()->user()->name }}</strong></h5>
                    <p>
                        PKK adalah organisasi kemasyarakatan yang memberdayakan wanita untuk turut berpartisipasi dalam
                        pembangunan Indonesia. Secara umum tentunya tidak asing dengan sebutan ibu-ibu PKK, yang
                        biasanya memiliki berbagai kegiatan positif, salah satunya adalah kegiatan simpan pinjam uang.
                        Kegiatan simpan pinjam uang adalah salah satu kebutuhan manusia. Dimana simpan pinjam uang
                        sebagai sesuatu yang sangat diperlukan untuk mendukung perkembangan kegiatan perekonomian dan
                        meningkatkan taraf kehidupan. Selain itu PKK juga bisa disebut dengan suatu gerakan nasional
                        dalam pembangunan masyarakat yang tumbuh dari bawah, dimana pengelolaannya dilakukan oleh
                        lingkungan masyarakat untuk kesejahteraan bersama.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
