<?php 

namespace App\Controllers\Admin;

use  System\Controller;


class  SettingsController extends Controller{
      
      /**
       * Display Settings Form
       *
       * @return mixed
       */
	   public function index(){
          
          
           $this->html->setTitle('Settings');
          

           $data['settings'] = $this->load->model('Settings')->all();

           $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

          $view = $this->view->render('admin/settings/form' , $data);
          
          return  $this->adminLayout->render($view);

           
	   }

    
    
     /**
      * Display Form
      *
      * @param \stdClass $adsGroup
      */
     private function form($ad = null){

         if($ad){
            //editing form
            $data['target'] = 'edit-ad-' . $ad->id;
            $data['action'] = $this->url->link('admin/ads/save/' . $ad->id);
            $data['heading'] = 'Edit ' . $ad->title;

          }else{
             // adding form
             $data['target'] = 'add-ad-form' ;
             $data['action'] = $this->url->link('/admin/ads/submit');
             $data['heading'] = 'Add New ad';

          }

          $ad = (array) $ad;

          $data['link'] = array_get($ad , 'link');
          $data['name'] = array_get($ad , 'name');
          $data['ad_page']  = array_get($ad , 'page');
          $data['status']  = array_get($ad , 'status' , 'enabled');
          
          $data['start_at'] = ! empty($ad['start_at']) ? date('d-m-Y', $ad['start_at']) : false;
          $data['end_at'] = ! empty($ad['end_at']) ? date('d-m-Y', $ad['end_at']) : false;
          $data['image'] = '';


          if(! empty($ad['image'])){
             //default path to upload ad image : public/images
             $data['image'] = $this->url->link('public/images/'. $ad['image']);
          }

          $data['pages'] = $this->getPermissionPages();

          return $this->view->render('admin/ads/form', $data);
         
     }

     
     /**
      * Validate the form
      * 
      * @param int $id
      * @return bool
      */
     private function isValid($id = null){

         $this->validator->required('name');
         $this->validator->required('link');
         $this->validator->required('page');
         $this->validator->required('start_at');
         $this->validator->required('end_at');
        
         if(is_null($id)){
            
             // if the id is null
            //  then method is called to create new ad
            //  so we will validate the password as it should be required
           
            $this->validator->requiredFile('image')
                            ->image('image');

         }else{

            $this->validator->image('image'); 
         }

         return $this->validator->passes(); 
     }


}

