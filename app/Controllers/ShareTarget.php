<?php

namespace App\Controllers;

use App\Models\ShareModel;
use CodeIgniter\Controller;
use Illuminate\Http\Request;

class ShareTarget extends BaseController
{
	protected $shareModel;
	function __construct()
	{
		$this->db = db_connect();
		$this->shareModel = new ShareModel();
	}

	public function index()
	{
		$dt = new ShareModel();

		$data = [
			'tampil' => $dt->tampil()->getResult()
		];

		echo view("shareView", $data);
	}

	public function formtambah()
	{
		session();
		helper('form');
		$data = [
			'validation' => \Config\Services::validation()
		];
		echo view('viewFormTambah', $data);
		//return view('shareTarget/viewFormTambah', $data); 
	}

	public function simpandata()
	{
		if (!$this->validate([
			//'nama' =>'required|is_unique[aktivitas.user]'
			'nama' => [
				'rules' => 'required|is_unique[aktivitas.user]',
				'errors' => [
					'required' => '{field} user harus diisi.',
					'is_unique' => '{field} user sudah terdaftar.'
				]
			]
		])) {
			$validation = \Config\Services::validation();
			//dd($validation);
			//return redirect()->to('/ShareTarget/formtambah');

			return redirect()->to('/ShareTarget/formtambah')->withInput()->with('validation', $validation);
		}

		// if(!$this->validate([
		//     'upload' => [
		//         'rule' => 'uploaded[upload]|max_size[upload,1024]|is_image[upload]|mine_in[upload,image/jpg,image/jpeg,image/png]', 
		//         'errors' =>[
		//             'uploaded' =>'Pilih file terlebih dahulu', 
		//             'max_size' =>'Ukuran terlalu besar', 
		//             'is_image' =>'File yang ada pilih bukan gambar', 
		//             'min_in' =>'Yang ada pilih bukan gambar'
		//             ]
		//     ]])){
		//         //$validation= \Config\Services::validation(); 

		//         return redirect()->to('/shareTarget/formtambah')->withInput();  
		//     }

		//ambil file
		$fileUpload = $this->request->getFile('upload');

		//generate nama sampul
		//$namaUpload = $fileUpload->getRandomName(); 

		//pindahkan file ke asset
		$fileUpload->move('assets/uploads/files');

		//ambil nama file
		$namaUpload = $fileUpload->getName();


		$data = [
			'id_user' => $this->request->getpost('user_id'),
			'user' => $this->request->getpost('nama'),
			'kategori' => $this->request->getpost('kate'),
			'kegiatan' => $this->request->getpost('kegi'),
			'tempat' => $this->request->getpost('instansi'),
			'tanggal' => $this->request->getpost('date'),
			'angka_kredit' => $this->request->getpost('kredit'),
			'upload_file' => $namaUpload
		];

		$dt = new ShareModel();

		$simpan = $dt->simpan($data);

		if ($simpan) {
			return redirect()->to('/shareTarget/index');
		}
	}

	function hapus()
	{
		$uri = service('uri');
		$user_id = $uri->getSegment('3');

		$dt = new ShareModel();

		$dt->hapusdata($user_id);

		session()->setFlashdata('pesan', 'Data berhasil dihapus.');

		return redirect()->to('/shareTarget/index');
	}

	public function formedit($user_id)
	{
		helper('form');
		$data = [
			'title' => ""
		];
	}

	public function detail($id_user)
	{
		//$komik = $this->komikModel->where(['slug' => $slug])->first();
		//$komik = $this->komikModel->getKomik($slug);
		//echo $slug;
		//dd($komik);
		$data = [
			'title' => 'Detail Aktivitas',
			'aktivitas' => $this->shareModel->getData($id_user)
		];

		//jika komik tidak ada di table
		if (empty($data['aktivitas'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Aktivitas user ' . $$id_user . ' tidak ditemukan');
		}

		return view('detail', $data);
	}


	public function uploadfile()
	{

		// return $this->db->table('aktivitas')->getWhere(['upload_file' => $upload]); 

		// dd($fileUpload); 

		return redirect()->to('shareTarget/formtambah');
	}

	function upload()
	{
		helper('form');
		$uri = service('uri');
		$upload = $uri->getSegment('3');

		//dd($upload);

		// $upload = $this->db->table('aktivitas')->getWhere('upload_file');
		// echo view('parts/upload.js', $upload);

		$dt = new ShareModel();

		$dt->uploadFile($upload);

		//return redirect()->to('/shareTarget/formdata/#upload');
	}
}
?>

<!-- <!DOCTYPE html>
<html>

<head>
	<link rel="manifest" href="manifest.json">
</head>

<body>
	<script>
		window.addEventListener('load', () => {
			const parsedUrl = new URL(window.location);
			const {
				searchParams
			} = parsedUrl;
			console.log("Title shared:", searchParams.get('title'));
			console.log("Text shared:", searchParams.get('text'));
			console.log("URL shared:", searchParams.get('url'));
		});
	</script>
	<script>
		addEventListener('fetch', event => {
			// ignore all requests with are not of method POST and which are not the URL we defined in in share_target as action
			if (event.request.method !== 'POST' || event.request.url.startsWith('https://fadil.website/shareTarget/formtambah/#upload') === false) {
				return;
			}

			function handleFileShare(event) {
				event.respondwith(Response.redirect('https://fadil.website/shareTarget/formtambah'));

				event.waitUntil(async function() {
					const data = await event.request.fromData();
					const client = await self.clients.get(event.resultingClintId);
					const file = data.get('upload');
					client.postMessage({
						file,
						action: 'load-image'
					});
				}());
			}
		});
		// navigator.serviceWorkerContainer.onmessage = (event) =>{
		// const upload = event.data.upload;}
	</script> -->
</body>