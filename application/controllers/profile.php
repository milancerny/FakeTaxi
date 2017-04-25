<?php
/**
 * Created by PhpStorm.
 * User: pazit
 * Date: 21.4.2017
 * Time: 22:43
 */

if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Profile extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('');
        $this->load->model('');
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Profile';

        $this->load->model('user_model');

        $this->global['profile'] = $this->user_model->get_userProfile();


        $this->loadViews('profile', $this->global, NULL, NULL);
    }

    public function profilePicture()
    {

        $this->global['pageTitle'] = 'Profile';

        $this->load->model('user_model');

        $this->global['profile'] = $this->user_model->get_userProfile();

        $this->loadViews('profilePicture', $this->global, NULL, NULL);

    }

    function add()
    {
        if ($this->input->post('userSubmit')) {

            //Check whether user upload picture
            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = 'uploads/image/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }

            //Prepare array of user data
            $userData = array(
                'pictureProfile' => $this->input->post('pictureName'),
                'picture' => $picture
            );

            //Pass user data to model
            $insertUserData = $this->user_model->insert($userData);

            //Storing insertion status message.
            if ($insertUserData) {
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
        }
        //Form for adding user data
        $this->loadViews('profilePicture');

    }

}


