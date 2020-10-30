<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('uploadImage'))
{
   function uploadImage($name, $path) 
   {
     $CI =& get_instance();

     $config['upload_path'] = $path;
     $config['allowed_types'] = 'jpg|png|jpeg|PNG|ico';
     $config['max_size']  = '2048';
     $config['remove_space'] = TRUE;
     $config['encrypt_name'] = TRUE;
    
     $CI->upload->initialize($config);
     $CI->load->library('upload', $config); 
     if($CI->upload->do_upload($name)){ 
       $return = array('success' => true, 'file' => $CI->upload->data(), 'error' => '');
       return $return;
     }else{
       $return = array('success' => false, 'file' => '', 'error' => $CI->upload->display_errors());
       return $return;
     }
   }
}

if ( ! function_exists('putImage'))
{

   function putImage($img, $path, $type=null){

      $image = base64_decode($img, true);

      if($image){
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
        $ext = explode('/', $mime_type)[1];
        if($type == 'ico')
          $ext = 'ico';
        
        $image_name = md5(uniqid(rand(), true));
        $filename = $image_name . '.' . $ext;
        file_put_contents($path . $filename, $image);

        $data['filename'] = $filename;
        $data['status'] = true;
        return $data;
      }
      else{

        $data['status'] = false;
        return $data;
      }
   }
}

if ( ! function_exists('getStatus'))
{
   function getStatus($status){
    switch ($status) {
      case '1':
        # code...
        $result = 'Enable';
        break;
      case '0':
        # code...
        $result = 'Disable';
        break;
      
      default:
        # code...
        break;
    }

    return $result;
   }
}

if ( ! function_exists('getRole'))
{
   function getRole($role){
    switch ($role) {
      case '1':
        # code...
        $result = 'Super Admin';
        break;
      
      case '2':
        # code...
        $result = 'Admin';
        break;

      case '3':
        # code...
        $result = 'User';
        break;
      default:
        # code...
        break;
    }

    return $result;
   }
}

if ( ! function_exists('nullString'))
{
  function nullString($string){
    if($string == "")
      $string = 'null';

    return $string;
  }
}

if ( ! function_exists('accessData'))
{
  function accessData($access){
    $CI =& get_instance();

    $idUser = $CI->session->userdata('userId');
    $role = $CI->session->userdata('role');

    switch ($access) {
      case 'agency':
        # code...
        switch ($role) {
          case '1':
            # code...
            $string = " ";
            break;
          
          case '2':
            # code...
            $string = " join users on agency.id = users.agencyId where users.id = '".$idUser."' ";
            break;

          case '3':
            # code...
            $string = " where agency.id = '' ";
            break;
          default:
            # code...
            break;
        }

        break;
      
      case 'advertiser':
        # code...
        switch ($role) {
          case '1':
            # code...
            $string = " ";
            break;
          
          case '2':
            # code...
            $string = " JOIN users on users.agencyId = advertiserView.agencyId where users.id = '".$idUser."' ";
            break;

          case '3':
            # code...
            $string = " JOIN users on users.advertiserId = advertiserView.id where users.id = '".$idUser."' ";
            break;
          default:
            # code...
            break;
        }
        break;

      case 'users':
        # code...
        switch ($role) {
          case '1':
            # code...
            $string = " ";
            break;
          
          case '2':
            # code...
            $string = " WHERE agencyId = (SELECT agencyId FROM users WHERE id = '".$idUser."')";
            break;

          case '3':
            # code...
            $string = " WHERE advertiserId = (SELECT advertiserId FROM users WHERE id = '".$idUser."') AND role = 3 ";
            break;
          default:
            # code...
            break;
        }
        break;

      default:
        # code...
        break;
    }

    return $string;
  }
}

if ( ! function_exists('accessButton'))
{
  function accessButton($access){
    $CI =& get_instance();

    $idUser = $CI->session->userdata('userId');
    $role = $CI->session->userdata('role');

    switch ($access) {
      case 'agency':
        # code...
        switch ($role) {
          case '1':
            # code...
            $string = " ";
            break;
          
          case '2':
            # code...
            $string = " disabled ";
            break;

          case '3':
            # code...
            $string = " disabled ";
            break;
          default:
            # code...
            break;
        }

        break;

      case 'users':
        # code...
        switch ($role) {
          case '1':
            # code...
            $string = " ";
            break;
          
          case '2':
            # code...
            $string = " ";
            break;

          case '3':
            # code...
            $string = " disabled ";
            break;
          default:
            # code...
            break;
        }

        break;
      
      default:
        # code...
        break;
    }

    return $string;
  }
}

