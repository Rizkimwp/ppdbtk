<!-- Modal untuk menampilkan detail siswa -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="font-bold"> Data Siswa </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" id="nik" class="form-control " />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" id="nama_lengkap" name="nama_lengkap"
                                                    class="form-control  " />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Panggilan</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control "
                                                    id="nama_panggilan" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Umur</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control " id="umur" />
                                            </div>
                                            @error('umur')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control  "
                                                    id="tempat_lahir" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="tanggal_lahir" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="jenis_kelamin" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Anak Ke</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control " id="anak_ke" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status Dikeluarga</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control "
                                                    id="status_dalam_keluarga" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Agama</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control " id="id_agama" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="customRange3" class="col-sm-3 col-form-label">Tinggi
                                                Badan</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control" id="tinggi_badan"
                                                    name="tinggi_badan">
                                                <!-- Awalnya diatur ke nilai tengah -->
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="customRange2" class="col-sm-3 col-form-label">Berat
                                                Badan</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control" id="berat_badan">


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <h4 class="font-bold"> Data Orang Tua </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Ayah</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control "
                                                    id="nama_ayah" />
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Ibu</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" id="nama_ibu" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="pekerjaan_ayah_id">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="pekerjaan_ibu_id">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pendidikan Ayah</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="pendidikan_ayah_id">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="pendidikan_ibu_id">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tahun Kelahiran Ayah</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="tahun_lahir_ayah" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tahun Kelahiran Ibu</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="tahun_lahir_ibu" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Penghasilan Orangtua</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control " id="penghasilan_orang_tua_id">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <h4 class="font-bold">Data Wali Siswa</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Wali</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control "
                                                    id="nama_wali" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pekerjaan Wali</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control" id="pekerjaan_wali_id">


                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nomor Telepon Wali</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control"
                                                    id="nomor_wali" />
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <h4 class="font-bold"> Alamat Lengkap </h4>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" id="telepon"
                                                    name="telepon" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control "
                                                    id="email" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">



                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control "
                                                    id="alamat" />
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <h4 class="font-bold"> Berkas Persyaratan </h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="berkas-container"></div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function showSiswaDetail(
        nik, namaLengkap, namaPanggilan, umur, tempatLahir, tanggalLahir, jenisKelamin, anakKe, statusDalamKeluarga,
        idAgama, tinggiBadan, beratBadan,
        namaAyah, namaIbu, pekerjaanAyahId, pekerjaanIbuId, pendidikanAyahId, pendidikanIbuId, tahunLahirAyah,
        tahunLahirIbu, penghasilanOrangTuaId, namaWali, pekerjaanWaliId, nomorWali, telepon, email, alamat, berkas

    ) {
        document.getElementById('nik').value = nik;
        document.getElementById('nama_lengkap').value = namaLengkap;
        document.getElementById('nama_panggilan').value = namaPanggilan;
        document.getElementById('umur').value = umur;
        document.getElementById('tempat_lahir').value = tempatLahir;
        document.getElementById('tanggal_lahir').value = tanggalLahir;
        document.getElementById('jenis_kelamin').value = jenisKelamin;
        document.getElementById('anak_ke').value = anakKe;
        document.getElementById('status_dalam_keluarga').value = statusDalamKeluarga;
        document.getElementById('id_agama').value = idAgama;
        document.getElementById('tinggi_badan').value = tinggiBadan;
        document.getElementById('berat_badan').value = beratBadan;
        document.getElementById('nama_ayah').value = namaAyah;
        document.getElementById('nama_ibu').value = namaIbu;
        document.getElementById('pekerjaan_ayah_id').value = pekerjaanAyahId;
        document.getElementById('pekerjaan_ibu_id').value = pekerjaanIbuId;
        document.getElementById('pendidikan_ayah_id').value = pendidikanAyahId;
        document.getElementById('pendidikan_ibu_id').value = pendidikanIbuId;
        document.getElementById('tahun_lahir_ayah').value = tahunLahirAyah;
        document.getElementById('tahun_lahir_ibu').value = tahunLahirIbu;
        document.getElementById('penghasilan_orang_tua_id').value = penghasilanOrangTuaId;
        document.getElementById('nama_wali').value = namaWali;
        document.getElementById('pekerjaan_wali_id').value = pekerjaanWaliId;
        document.getElementById('nomor_wali').value = nomorWali;
        document.getElementById('telepon').value = telepon;
        document.getElementById('email').value = email;
        document.getElementById('alamat').value = alamat;


        function displayBerkas(data) {
            const container = document.getElementById('berkas-container');
            container.innerHTML = ''; // Kosongkan container sebelum memapping data baru

            // Cek jika data adalah string JSON, lalu parse menjadi objek JavaScript
            let berkasArray = [];
            try {
                berkasArray = JSON.parse(data);
            } catch (error) {
                console.error('Gagal parse data JSON:', error);
                return;
            }

            if (!Array.isArray(berkasArray)) {
                console.error('Data bukan array setelah parsing:', berkasArray);
                return;
            }

            berkasArray.forEach((berkas, index) => {
                const div = document.createElement('div');
                div.className = 'col-md-6 mb-2 ';
                const namaBerkas = findNamaBerkasById(window.berkasData, berkas.list_berkas_id);

                const buttonText = namaBerkas ? namaBerkas : `Berkas ${berkas.list_berkas_id}`;

                const button = document.createElement('button');
                button.className = 'btn btn-primary';
                button.textContent = buttonText;
                button.onclick = function() {
                    // Mengarahkan browser ke link berkas saat tombol ditekan
                    window.open(berkas.file_path, '_blank');
                };

                div.appendChild(button);
                container.appendChild(div);
            });
        }

        // Panggil function dengan data berkas
        displayBerkas(berkas);
    }

    axios.get('/findBerkas')
        .then(response => {
            const berkasData = response.data; // Data berkas dari server
            console.log(berkasData);

            // Lakukan sesuatu dengan data, misalnya menyimpannya untuk digunakan di tempat lain
            window.berkasData = berkasData; // Menyimpan data ke window untuk akses global
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

    function findNamaBerkasById(data, id) {
        const berkas = data.find(item => item.id === id);
        return berkas ? ` Berkas ${berkas.nama_berkas}` : null;
    }
</script>
