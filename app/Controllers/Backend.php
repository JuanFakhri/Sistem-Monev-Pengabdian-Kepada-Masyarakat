<?php

namespace App\Controllers;

use App\Models\M_Siswa;


class Backend extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Siswa();
    }


    public function monev_pkm()
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'Pengabdian kepada Masyarakat',
            'penel' => $model->getAllData2(),

        ];
        return view("m_pkm/monev_pkm", $data);
    }


    public function excel()
    {
        $model = new M_Siswa();
        $data = [
            'penel' => $model->getAllData2(),
        ];
        echo view('m_pkm/excel', $data);
    }
    public function view_pdf($id_file)
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'Peta Jalan PKM',
            'file' => $model->detail_Data2($id_file),
        ];
        return view("m_pkm/view_pdf", $data);
    }


    public function view_pdf_sesuaipetajalan($id_file)
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'PKM Sesuai Peta Jalan ',
            'file' => $model->detail_Data2($id_file),
        ];
        return view("m_pkm/view_pdf_sesuaipetajalan", $data);
    }

    public function view_pdf_evaluasipkm($id_file)
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'Bukti Evaluasi PKM',
            'file' => $model->detail_Data2($id_file),
        ];
        return view("m_pkm/view_pdf_evaluasipenelitian", $data);
    }


    public function view_pdf_evaluasipkm_tindaklanjut($id_file)
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'Bukti Evaluasi PKM',
            'file' => $model->detail_Data2($id_file),
        ];
        return view("m_pkm/view_pdf_evaluasipkm", $data);
    }

    public function dashboard()
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'Homepage',
            'data_penelitian' => $model->gerafikpenelitian(),
            'data_penelitian_d' => $model->grafikpenelitian_d(),
        ];
        echo view("layout/v_header", $data);
        echo view("layout/v_sidebar");
        echo view("layout/v_topbar");
        echo view("/dashboard");
        echo view("layout/v_footer");
    }
    public function tambah_data2()
    {
        if (isset($_POST['tambah'])) {
            $val = $this->validate(
                [
                    'tahun' => [
                        'label' => 'Tahun Penelitian',

                        'rules' => 'required|numeric|min_length[4]|max_length[5]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'numeric' => '{field} haya boleh angka',
                            'max_length' => '{field} tidak boleh lebih dari 5',
                            'min_length' => '{field} minimal 4 angka'
                        ]

                    ],
                    'judulkegiatan' => [
                        'label' => 'Judul Penelitian',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]

                    ],
                    'namahasiswa' => [
                        'label' => 'Nama Mahasiswa',
                        'rules' => 'required|alpha_space',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'alpha_space' => '{field} tidak boleh numeric',
                        ]

                    ],
                    'namadosen' => [
                        'label' => 'Nama Dosen',
                        'rules' => 'required|alpha_space',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'alpha_space' => '{field} tidak boleh numeric',
                        ]

                    ],
                    'peta_jalan' => [
                        'label' => 'Petajalan',
                        'rules' => 'uploaded[peta_jalan]|max_size[peta_jalan,2000]|ext_in[peta_jalan,pdf]',
                        'errors' => [
                            'uploaded' => '{field} tidak boleh kosong',
                            'max_size' => '{field} Maksimul pdf 2mb',
                            'ext_in' => 'File yang dimasukan bukan pdf'
                        ]
                    ], 'sesuaipetajalan' => [
                        'label' => 'Sesuai petajalan',
                        'rules' => 'uploaded[sesuaipetajalan]|max_size[sesuaipetajalan,2000]|ext_in[sesuaipetajalan,pdf]',
                        'errors' => [
                            'uploaded' => '{field} tidak boleh kosong',
                            'max_size' => '{field} Maksimul pdf 2mb',
                            'ext_in' => 'File yang dimasukan bukan pdf'
                        ]
                    ],
                    'evaluasi_pkm' => [
                        'label' => 'Sesuai petajalan',
                        'rules' => 'max_size[evaluasi_pkm,2000]|ext_in[evaluasi_pkm,pdf]',
                        'errors' => [
                            'max_size' => '{field} Maksimul pdf 2mb',
                            'ext_in' => 'File yang dimasukan bukan pdf'
                        ]
                    ],
                    'evaluasi_pkm_tindaklanjut' => [
                        'label' => 'Sesuai petajalan',
                        'rules' => 'max_size[evaluasi_pkm_tindaklanjut,2000]|ext_in[evaluasi_pkm_tindaklanjut,pdf]',
                        'errors' => [
                            'max_size' => '{field} Maksimul pdf 2mb',
                            'ext_in' => 'File yang dimasukan bukan pdf'
                        ]
                    ],

                    'prodi' => 'required',

                ]
            );

            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url("/monev_pkm"));
            } else {
                $peta_jalan = $this->request->getFile('peta_jalan');
                if ($peta_jalan->isValid() && !$peta_jalan->hasMoved()) {
                    $peta_jalan->move('public/upload/file_coba_petajalan');
                }
                $file_peta_jalan = $peta_jalan->getName();

                $sesuai_peta_jalan = $this->request->getFile('sesuaipetajalan');
                if ($sesuai_peta_jalan->isValid() && !$sesuai_peta_jalan->hasMoved()) {
                    $sesuai_peta_jalan->move('public/upload/file_sesuai_petajalan');
                }
                $file_sesuai_peta_jalan = $sesuai_peta_jalan->getName();


                $evaluasi_penelitian = $this->request->getFile('evaluasi_pkm');
                if ($evaluasi_penelitian->isValid() && !$evaluasi_penelitian->hasMoved()) {
                    $evaluasi_penelitian->move('public/upload/file_evaluasipenelitian');
                }
                $file_evaluasi_penelitian = $evaluasi_penelitian->getName();


                $evaluasi_pkm_tindaklanjut = $this->request->getFile('evaluasi_pkm_tindaklanjut');
                if ($evaluasi_pkm_tindaklanjut->isValid() && !$evaluasi_pkm_tindaklanjut->hasMoved()) {
                    $evaluasi_pkm_tindaklanjut->move('public/upload/file_evaluasi_pkm_tindaklanjut');
                }
                $file_evaluasi_pkm_tindaklanjut = $evaluasi_pkm_tindaklanjut->getName();

                $data = [
                    'tahun' => $this->request->getPost('tahun'),
                    'judulkegiatan' => $this->request->getPost('judulkegiatan'),
                    'namamahasiswa' => $this->request->getPost('namahasiswa'),
                    'namadosen' => $this->request->getPost('namadosen'),
                    "prodi" => $this->request->getPost("prodi"),

                    'peta_jalan' =>  $file_peta_jalan,
                    'sesuaipetajalan' =>  $file_sesuai_peta_jalan,
                    'evaluasi_pkm' =>  $file_evaluasi_penelitian,
                    'evaluasi_pkm_tindaklanjut' =>  $file_evaluasi_pkm_tindaklanjut,
                ];

                // insert Data
                $success = $this->model->tambah2($data);
                if ($success) {
                    session()->setFlashdata('message', 'Ditambahkan');
                    return redirect()->to(base_url("/monev_pkm"));
                }
            }
        } else {
            return redirect()->to(base_url("/monev_pkm"));
        }
    }

    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url("/home_anggota"));
        }
    }

    public function hapus2($id, $file_peta_jalan, $file_sesuai_petajalan)
    {
        $success = $this->model->hapus2($id, $file_peta_jalan, $file_sesuai_petajalan);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url("/monev_pkm"));
        }
    }


    public function ubah_data2()
    {
        if (isset($_POST['ubah'])) {



            $val = $this->validate(
                [
                    'ubah_tahun' => [
                        'label' => 'Tahun Kegiatan',

                        'rules' => 'required|numeric|min_length[4]|max_length[5]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'numeric' => '{field} haya boleh angka',
                            'max_length' => '{field} tidak boleh lebih dari 5',
                            'min_length' => '{field} minimal 4 angka'
                        ]

                    ],
                    'ubah_judulkegiatan' => [
                        'label' => 'Judul Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]

                    ],
                    'ubah_namahasiswa' => [
                        'label' => 'Nama Mahasiswa',
                        'rules' => 'required|alpha_space',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'alpha_space' => '{field} tidak boleh numeric',
                        ]

                    ],

                    'ubah_namadosen' => [
                        'label' => 'Nama Dosen',
                        'rules' => 'required|alpha_space',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'alpha_space' => '{field} tidak boleh numeric',
                        ]

                    ],

                    'ubah_prodi' => 'required',
                ]
            );


            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url("/monev_pkm"));
            } else {
                $id = $this->request->getPost('id');
                $data = [
                    'tahun' => $this->request->getPost('ubah_tahun'),
                    'judulkegiatan' => $this->request->getPost('ubah_judulkegiatan'),
                    'namamahasiswa' => $this->request->getPost('ubah_namahasiswa'),
                    'namadosen' => $this->request->getPost('ubah_namadosen'),
                    "prodi" => $this->request->getPost("ubah_prodi"),
                ];

                // update Data
                $success = $this->model->ubah2($data, $id);
                if ($success) {
                    session()->setFlashdata('message', 'Ditambahkan');
                    return redirect()->to(base_url("/monev_pkm"));
                }
            }
        } else {
            return redirect()->to(base_url("/monev_pkm"));
        }
    }

    public function profile($id)
    {
        $model = new M_Siswa();
        $data = [
            'judul' => 'Profile',

            'profile_user' => $model->get_id_user($id),

        ];
        return view("m_pkm/profile", $data);
    }
}
