<?php 

$this->db->data([
             'name' => 'Brown',
             'age'  => 34
          ])->insert('users');

$this->db->data([
  'name' => 'Brown',
  'age'  => 34
])->table('users')->insert();

$this->db->data('name', 'Jean')->data('age', 13);

$this->db->query('SELECT * FROM users WHERE id > ? AND id < ?', [1, 300]);

$this->db->query('INSERT INTO users SET email = ? , SET status = ?', 'jeanyao@ymail.com', 'enabled');
// ou
$this->db->query('INSERT INTO users SET email = ? , SET status = ?', ['jeanyao@ymail.com', 'enabled']);


/*
echo $this->db->data([
 'email' => 'yaomichel@yahoo.fr',
 'image'  => '<b>welcome</b>'
])->insert('users')->lastId();
*/

$user = $this->db->query('SELECT * FROM users WHERE id = ?', 4)->fetch();

// pre($user);
echo $user->image;


$user =  $this->db
              ->select('*')
              ->from('users')
              ->orderBy('id')
              ->fetch();



$users =  $this->db->select('*')
                            ->from('users')
                            ->where('id > ? AND id < ?', 1, 4)
                            ->fetchAll();
         

pre($this->db->where('id != ?', 2)->fetchAll('users'));
echo $this->db->rows();
pre($this->db->fetchAll('users'));


$user = $this->load->model('Users');
         // pre($user->all());

pre($user->get(1));