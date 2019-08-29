<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ion_auth_model');
		$this->load->library('ion_auth');
		$this->load->model('Konfigurasi_model');
		if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('auth/login');
        }
	}

	public function index()
	{
		$this->load->view('konfigurasi/umum');
	}

	public function user()
	{
		$data['user'] = $this->Konfigurasi_model->list_user();
		$this->load->view('konfigurasi/user',$data);
	}

	public function user_delete($email)
	{
		$users = $this->session->userdata('emailbro');
		$cek_users = $this->ion_auth_model->getnama($email);

		if ($this->ion_auth->is_admin()) {
			if ($cek_users) {
				if ($email == $users) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
		            <i class="icon fa fa-check"></i>Tidak bisa menghapus diri sendiri!</div>');
				} else {
					$this->Konfigurasi_model->delete_user($email);
			        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
			            <i class="icon fa fa-check"></i>User berhasil dihapus</div>');
				}
			} else {
				 $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
			            <i class="icon fa fa-check"></i>Nampaknya terjadi kesalahan</div>');
			}
		} else {
			 $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
			            <i class="icon fa fa-check"></i>Hanya Administrator yang dapat melakukan ini Ferguso!</div>');
		}
	        redirect(site_url('konfigurasi/user'));
	}

	public function update_avatar()
	{
		$error = '';

			// If the upload form is submitted
			if(isset($_POST["upload"])){
			    // Get the file information
			    $fileName   = $_FILES["image"]["name"];
			    $fileTmp    = $_FILES["image"]["tmp_name"];
			    $fileType   = $_FILES["image"]["type"];
			    $fileSize   = $_FILES["image"]["size"];
			    $fileExt    = substr($fileName, strrpos($fileName, ".") + 1);
			    $nama = $this->session->userdata('emailbro').'.'.$fileExt;
			    
			    // Specify the images upload path
			    $largeImageLoc = 'assets/upload/profil/'.$this->session->userdata('emailbro').'.'.$fileExt;
			    $thumbImageLoc = 'assets/upload/profil/thumb/'.$this->session->userdata('emailbro').'.'.$fileExt;

			    // Check and validate file extension
			    if((!empty($_FILES["image"])) && ($_FILES["image"]["error"] == 0)){
			        if($fileExt != "jpg" && $fileExt != "jpeg" && $fileExt != "png" && $fileExt != "gif"){
			            $error = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
			        }
			    }else{
			        $error = "Select an image file to upload.";
			    }
			 
			    // If everything is ok, try to upload file
			    if(empty($error) && !empty($fileName)){
			        if(move_uploaded_file($fileTmp, $largeImageLoc)){
			            // File permission
			            chmod($largeImageLoc, 0777);
			            
			            // Get dimensions of the original image
			            list($width_org, $height_org) = getimagesize($largeImageLoc);
			            
			            // Get image coordinates
			            $x = (int) $_POST['x'];
			            $y = (int) $_POST['y'];
			            $width = (int) $_POST['w'];
			            $height = (int) $_POST['h'];

			            // Define the size of the cropped image
			            $width_new = $width;
			            $height_new = $height;
			            
			            // Create new true color image
			            $newImage = imagecreatetruecolor($width_new, $height_new);
			            
			            // Create new image from file
			            switch($fileType) {
			                case "image/gif":
			                    $source = imagecreatefromgif($largeImageLoc); 
			                    break;
			                case "image/pjpeg":
			                case "image/jpeg":
			                case "image/jpg":
			                    $source = imagecreatefromjpeg($largeImageLoc); 
			                    break;
			                case "image/png":
			                case "image/x-png":
			                    $source = imagecreatefrompng($largeImageLoc); 
			                    break;
			            }
			            
			            // Copy and resize part of the image
			            imagecopyresampled($newImage, $source, 0, 0, $x, $y, $width_new, $height_new, $width, $height);
			            
			            // Output image to file
			            switch($fileType) {
			                case "image/gif":
			                    imagegif($newImage, $thumbImageLoc); 
			                    break;
			                case "image/pjpeg":
			                case "image/jpeg":
			                case "image/jpg":
			                    imagejpeg($newImage, $thumbImageLoc, 90); 
			                    break;
			                case "image/png":
			                case "image/x-png":
			                    imagepng($newImage, $thumbImageLoc);  
			                    break;
			            }
			            
			            // Destroy image
			            imagedestroy($newImage);
			            $this->ion_auth_model->update_avatar($this->session->userdata('emailbro'),$nama);
			            redirect('','refresh');
			        }else{
			            $error = "Sorry, there was an error uploading your file.";
			        }
			    }
			}

			// Display error
			echo $error;
				}
			
}

/* End of file Konfigurasi.php */
/* Location: ./application/controllers/Konfigurasi.php */