<?php 
namespace App\Models;

use System\Model;


class PostsModel extends Model
{
	

    /** 
     * Table name
     *
     *
     * @var string
    */

     protected $table = 'posts';

     /**
      * Get All posts
      *
      * @return array
      */
      public function all()
      {

        	  return $this->select('p.*' , 'c.name AS `category`', 'u.first_name', 'u.last_name')
        	                ->from('posts p')
        	                ->join('LEFT JOIN categories c ON p.category_id=c.id')
                          ->join('LEFT JOIN users u ON p.user_id=u.id')
        	                ->fetchAll();
      	  
      }


      /**
      * Create New posts Groups Record
      *
      * @return void
      */
     public function create()
     {
        
          $image = $this->uploadImage();

          if($image){
              $this->data('image', $image);
          }
          
          $user = $this->load->model('Login')->user();

          $this->data('title', $this->request->post('title'))
               ->data('details', $this->request->post('details'))
               ->data('category_id', $this->request->post('category_id'))
               ->data('user_id', $user->id)
               ->data('tags', $this->request->post('tags'))
               ->data('status', $this->request->post('status'))
               ->data('related_posts', implode(',', array_filter((array)$this->request->post('related_posts'), 'is_numeric')))
               ->data('created', $now = time())
               ->insert('posts');
      
     }

     /**
      * Upload post Image
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
      * Update  post Record By Id
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

          $this->data('title', $this->request->post('title'))
               ->data('details', $this->request->post('details'))
               ->data('category_id', $this->request->post('category_id'))
               ->data('tags', $this->request->post('tags'))
               ->data('status', $this->request->post('status'))
               ->data('related_posts', implode(',', array_filter((array)$this->request->post('related_posts'), 'is_numeric')))
               ->where('id=?', $id)
               ->update('posts');

     }





}