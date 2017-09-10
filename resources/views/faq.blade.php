@extends('layouts.header')
@section('content')
<div class="container" id="content">
    <div class="row">
    <br>
        <div class="col s10 push-s1">
            <div class="card-panel">
                <div class="row">
                    <div class=" col s12 center-align hide-on-med-and-up">
                        <h5>Daftar Pertanyaan Umum</h5>
                    </div>

                    <div class=" col m6 l6 left-align hide-on-small-only">
                        <h5>Daftar Pertanyaan Umum</h5>
                    </div>
                </div>
                <div class="divider"></div>
                <br>
                <div class="row">
                    <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Apa Itu AdVotes</div>
                            <div class="collapsible-body"><span>AdVotes adalah sebuah sistem menejemen yang bertujuan membantu proses administrasi Pemilihan Raya UI</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Siapa saja yang dapat mengakses AdVotes</div>
                            <div class="collapsible-body"><span>Orang yang berhak masuk ke dalam sistem Advotes adalah admin perpemilihan yaitu orang yang ditunjuk oleh panitia Pemilihan Raya UI</span></div>
                        </li>
                    </ul>               
                    <div class="row">
                        <div class=" col s12 center-align hide-on-med-and-up">
                            <h5>Daftar Pertanyaan Khusus</h5>
                        </div>

                        <div class=" col m6 l6 left-align hide-on-small-only">
                            <h5>Daftar Pertanyaan Khusus</h5>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <br>
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Kenapa tidak ada organisasi yang dipilih di halaman utama?</div>
                            <div class="collapsible-body"><span>Jika demikian, maka artinya Anda belum di-assign untuk sebuah pemilihan. Anda bisa menambahkan pemilihan yang di bawah tanggung jawab Anda.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara menambahkan pemilihan sebuah organisasi?</div>
                            <div class="collapsible-body"><span>Anda dapat menge-klik button dengan ikon plus yang ada di pojok kanan atas untuk menambahkan sebuah pemilihan. Silakan isi data yang dibutuhkan lalu submit form.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Tidak bisa memilih tanggal untuk sebuah pemilihan, bagaimana cara mengatasinya?</div>
                            <div class="collapsible-body"><span>Refresh laman, lalu klik pada bagian tanggal mulai/tanggal selesai hingga muncul pop-up kalendar. Pilih tanggal sesuai pemilihan.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Tidak muncul pilihan organisasi ketika menambahkan pemilihan. Apa yang harus saya lakukan?</div>
                            <div class="collapsible-body"><span>Jika demikian, maka artinya pemilihan tersebut sudah di-assign kepada admin lain. Silakan hubungi atasan Anda untuk mengatasi hal tersebut. </span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara menambahkan data kandidat pada sebuah pemilihan?</div>
                            <div class="collapsible-body"><span>Anda dapat menuju section “Kandidat” dengan scroll ke bawah dan menge-klik button dengan ikon plus di sebelah kanan, sejajar dengan judul section yaitu “Kandidat”. Silakan isi data yang dibutuhkan lalu submit form</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Mengapa foto kandidat yang diunggah menjadi kosong disalah satunya?</div>
                            <div class="collapsible-body"><span>Hal itu menandakan kandidat yang Anda lihat merupakan calon individu, bukanlah pasangan</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Mengapa foto kandidat yang saya unggah tidak nampak?</div>
                            <div class="collapsible-body"><span>Jika demikian, maka Anda dapat me-refresh halaman yang sedang dibuka.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara menambahkan Daftar Pemilih Tetap (DPT) secara manual?</div>
                            <div class="collapsible-body"><span>Anda dapat menuju section “Daftar Pemilih Tetap”  yang ada dibagian bawah, lalu ke pilih navigasi bar “Tambah Manual”. Isi form sesuai kebutuhan Anda lalu klik “Tambah DPT”.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara menambahkan Daftar Pemilih Tetap (DPT) menggunakan file excel?</div>
                            <div class="collapsible-body"><span>Jika Anda sudah memiliki file excel yang berisi Daftar Pemilih Tetap maka Anda dapat langsung mengklik button “File” dan pilih file excel yang ingin diunggah lalu klik button “Upload”. </span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Saya tidak tahu mengenai isi/format file excel yang dapat diunggah. Apakah ada format tertentu?</div>
                            <div class="collapsible-body"><span>Ya, ada format khusus untuk file excel yang dapat diunggah. Anda dapat mengunduh template file excel yang ada dibawah button “Upload”</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara melihat seluruh list pemilihan yang saya pegang?</div>
                            <div class="collapsible-body"><span>Setelah berhasil login maka pada tampilan utama Anda dapat mengklik button "list" yang berwarna coklat di ujung kanan atas</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara menuju section penjaga TPS?</div>
                            <div class="collapsible-body"><span>Setelah berhasil login maka pada tampilan utama, Anda dapat mengklik button navbar di kiri atas lalu pilih "Penjaga TPS"</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header blue-grey darken-4 white-text">Bagaimana cara menambahkan penjaga TPS?</div>
                            <div class="collapsible-body"><span>Setelah berhasil masuk ke section penjaga TPS maka Anda harus mengklik "Tambah Penjaga". Lalu isi sesuai kebutuhan Anda</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
