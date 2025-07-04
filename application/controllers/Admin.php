<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';
use Dompdf\Dompdf;


class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_sudah_masuk();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();

        $data['total_user'] = $this->db->from('user_data')->count_all_results();
        $data['total_role'] = $this->db->from('user_role')->count_all_results();
        $data['total_menu'] = $this->db->from('user_menu')->count_all_results();
        $data['total_sub_menu'] = $this->db->from('user_sub_menu')->count_all_results();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/topbar');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/index');
        $this->load->view('layout/footer');
    }

    public function role()
    {
        $data['title'] = 'Role Akses';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.role]', [
            'required' => 'Nama Role tidak boleh kosong',
            'is_unique' => 'Role ' . $this->input->post('role') .  ' sudah ada!'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/topbar');
            $this->load->view('layout/sidebar');
            $this->load->view('admin/role', $data);
            $this->load->view('layout/footer');
        } else {
            $role_name = $this->input->post('role');
            $this->db->insert('user_role', ['role' => $role_name]);
            $this->session->set_flashdata('message', '<div class="alert alert-success neu-brutalism mb-4">Role <b>' . $role_name . '</b> berhasil ditambahkan!</div>');
            redirect('admin/role');
        }
    }

    public function role_akses($role_id)
    {
        $data['title'] = 'Role Akses';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // URL
        // $currentURI = $this->uri->uri_string();
        // $data['segments'] = explode('/', $currentURI);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/topbar');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/role_akses', $data);
        $this->load->view('layout/footer');
    }

    public function role_ubah()
    {
        $data['title'] = 'Role Akses';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', "Role", 'required|is_unique[user_role.role]', [
            'required' => 'Nama Role tidak boleh kosong',
            'is_unique' => 'Role ' . $this->input->post('role') .  ' sudah ada!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('layout/footer');
        } else {
            $id = $this->input->post('id');
            $role = $this->input->post('role');
            $roleSebelum = $this->db->get_where('user_role', ['id' => $id])->row_array();

            $this->db->where('id', $id);
            $this->db->update('user_role', ['role' => $role]);

            $this->session->set_flashdata('message', '<div class="alert alert-warning neu-brutalism mb-4">Role <b>' . $roleSebelum['role'] . '</b> berhasil diubah menjadi <b>' . $role . '</b>!</div>');
            redirect('admin/role');
        }
    }

    public function role_hapus()
    {
        $role_id = $this->uri->segment(3);
        $role_name = $this->db->get_where('user_role', ['id' => $role_id])->row_array()['role'];
        $this->db->where('id', $role_id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-danger neu-brutalism mb-4">Role <b>' . $role_name . '</b> berhasil dihapus!</div>');
        redirect("admin/role");
    }

    public function ubah_akses()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success neu-brutalism mb-4">Akses berhasil diubah!</div>');
        redirect("admin/role_akses/" . $role_id);
    }

    public function get_role($id)
    {
        $menu = $this->db->query('SELECT * FROM user_role WHERE id = ' . $id . '')->row();
        exit(json_encode((array)$menu));
    }

    public function role_user()
    {
        $data['title'] = 'Role User';
        $data['user'] = $this->db->get_where('user_data', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('User_model', 'user');
        $data['users'] = $this->user->getAllUserRole();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/topbar');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/role_user', $data);
        $this->load->view('layout/footer');
    }

    public function role_user_ubah()
    {
        $this->load->model('User_model', 'user');
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $role_id = $this->input->post('role_id');

        $this->db->where('id', $id);
        $this->db->update('user_data', ['role_id' => $role_id]);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success neu-brutalism mb-4">User <b>' . $nama . '</b> berhasil diubah rolenya menjadi <b>' . $this->user->getRoleName($role_id)->role . '</b>!</div>'
        );
        redirect("admin/role_user");
    }

    public function get_user_role($id)
    {
        $this->load->model('User_model', 'user');
        $user = $this->user->getUserRole($id);

        $roles = $this->db->query('SELECT id, role FROM user_role')->result();

        $user->roles = $roles;
        exit(json_encode((array)$user));
    }
    public function kelola_pendaftaran()
{
    $data['title'] = 'Kelola Pendaftaran Pasien';
    $data['user'] = $this->db->get_where('user_data', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Ambil semua pendaftaran
    $data['pendaftaran'] = $this->db->get('pendaftaran')->result_array();

    $this->load->view('layout/header', $data);
    $this->load->view('layout/topbar');
    $this->load->view('layout/sidebar');
    $this->load->view('admin/kelola_pendaftaran', $data); // view baru yang akan dibuat
    $this->load->view('layout/footer');
}

public function ubah_status($id, $status)
{
    $this->db->set('status', $status);
    $this->db->where('id', $id);
    $this->db->update('pendaftaran');

    $this->session->set_flashdata('message', '<div class="alert alert-success neu-brutalism">Status berhasil diperbarui.</div>');
    redirect('admin/kelola_pendaftaran');
}
public function data_pasien()
{
    $data['title'] = 'Data Pasien';
    $data['user'] = $this->db->get_where('user_data', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Gabungkan user_data dengan pendaftaran
    $data['pasien'] = $this->db->query("
        SELECT ud.id, ud.email, ud.nama, p.alamat, p.tanggal_lahir, p.no_telepon
        FROM user_data ud
        JOIN pendaftaran p ON ud.id = p.user_id
        GROUP BY ud.id
    ")->result_array();

    $this->load->view('layout/header', $data);
    $this->load->view('layout/topbar', $data);
    $this->load->view('layout/sidebar', $data);
    $this->load->view('admin/data_pasien', $data);
    $this->load->view('layout/footer');
}


public function tambah_pasien()
{
    $data = [
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'password' => password_hash('123456', PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 1,
        'date_created' => time(),
        'image' => 'default.png'
    ];

    $this->db->insert('user_data', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success">Pasien berhasil ditambahkan.</div>');
    redirect('admin/data_pasien');
}

public function edit_pasien($id)
{
    $data = [
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email')
    ];
    $this->db->where('id', $id);
    $this->db->update('user_data', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-info">Data pasien diperbarui.</div>');
    redirect('admin/data_pasien');
}

public function hapus_pasien($id)
{
    $this->db->delete('user_data', ['id' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data pasien dihapus.</div>');
    redirect('admin/data_pasien');
}
public function data_pendaftaran()
{
    $data['title'] = 'Data Pendaftaran Pasien';
    $data['user'] = $this->db->get_where('user_data', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    $data['pendaftaran'] = $this->db->get('pendaftaran')->result_array();

    $this->load->view('layout/header', $data);
    $this->load->view('layout/topbar', $data);
    $this->load->view('layout/sidebar', $data);
    $this->load->view('admin/kelola_pendaftaran', $data);
    $this->load->view('layout/footer');
}
public function jadwal_pendaftaran()
{
    $data['title'] = 'Jadwal Pendaftaran Pasien';
    $data['user'] = $this->db->get_where('user_data', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Ambil semua data pendaftaran
    $data['jadwal'] = $this->db->order_by('tanggal_kunjungan', 'ASC')
                               ->order_by('jam_kunjungan', 'ASC')
                               ->get('pendaftaran')->result_array();

    // Tampilkan halaman
    $this->load->view('layout/header', $data);
    $this->load->view('layout/topbar', $data);
    $this->load->view('layout/sidebar', $data);
    $this->load->view('admin/jadwal_pendaftaran', $data);
    $this->load->view('layout/footer');
}
public function laporan()
{
    $data['title'] = 'Laporan Pendaftaran';
    $data['user'] = $this->db->get_where('user_data', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Ambil hanya data dengan status 'disetujui'
    $data['pendaftaran'] = $this->db->get_where('pendaftaran', ['status' => 'disetujui'])->result_array();

    $this->load->view('layout/header', $data);
    $this->load->view('layout/topbar', $data);
    $this->load->view('layout/sidebar', $data);
    $this->load->view('admin/laporan', $data);
    $this->load->view('layout/footer');
}


public function export_pdf()
{
    require_once APPPATH . '../vendor/autoload.php';
    $dompdf = new Dompdf();

    $data['title'] = 'Laporan Pendaftaran';
$data['pendaftaran'] = $this->db->get_where('pendaftaran', ['status' => 'disetujui'])->result_array();


    // Load view ke dalam HTML
    $html = $this->load->view('admin/laporan_pdf', $data, true);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("laporan_pendaftaran.pdf", array("Attachment" => false));
}


}
