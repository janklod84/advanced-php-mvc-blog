<?php 
namespace App\Models;


use System\Model;


class AdsModel extends Model
{
	
    /** 
     * Table name
     *
     *
     * @var string
    */
     protected $table = 'ads';


      /**
      * Create New Ads Groups Record
      *
      * @return void
      */
     public function create()
     {
        
        $image = $this->uploadImage();

        if($image){
            $this->data('image', $image);
        }
        
        $this->data('link', $this->request->post('link'))
             ->data('name', $this->request->post('name'))
             ->data('start_at', strtotime($this->request->post('start_at')))
             ->data('end_at', strtotime($this->request->post('end_at')))
             ->data('status', $this->request->post('status'))
             ->data('page', $this->request->post('page'))
             ->data('created', time())
             ->insert('ads');
      
     }

     /**
      * Upload Ad Image
      *
      * @return string
      */ 
     private function uploadImage()
     {

         $image = $this->request->file('image');

         if(! $image->exists()){

            return '';
         }

         return $image->moveTo($this->app->file->toPublic('images'));
     }


     /**
      * Update  Ad Record By Id
      *
      * @param int $id
      * @return void
      */
     
     public function update($id)
     {

        $image = $this->uploadImage();

        if($image){
            $this->data('image', $image);
        }

      
         $this->data('name', $this->request->post('name'))
              ->data('link', $this->request->post('link'))
              ->data('start_at', strtotime($this->request->post('start_at')))
              ->data('end_at', strtotime($this->request->post('end_at')))
              ->data('status', $this->request->post('status'))
              ->data('page', $this->request->post('page'))
              ->data('created', time())
              ->where('id=?', $id)
              ->update('ads');

     }





}