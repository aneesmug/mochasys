<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use Config\Services;

class Item extends BaseController
{
    public function __construct()
    {
        $this->ItemModel            = new ItemModel();
        $this->validation           = Services::validation();
    }

    public function index()
    {

    }


    public function items_list()
    {
        $data = [
            'items'             => $this->ItemModel
                                            ->menu_item_list()
                                            ->get()
                                            ->getResultArray(),
            'menu_category'     => $this->ItemModel
                                            ->menu_category_list()
                                            ->orderBy("name_eng REGEXP '^[^A-Za-z]' ASC, name_eng")
                                            ->get()
                                            ->getResultArray(),
            'itemAssignGroup'   => $this->db->table('menu_item')
                                            ->select('menu_category.name_eng')
                                            ->selectCount('`menu_item`.`category_id`')
                                            ->join('menu_category','menu_category.id=menu_item.category_id')
                                            ->groupBy('`menu_item`.`category_id`')
                                            ->get()
                                            ->getResultArray(),
            ];

            // dd($data['itemAssignGroup']);
            // exit();

        return view('items/items', $data);
    }

    public function itemAdd()
    {
        if ($this->request->getPost()) {
            
            // Upload Item Image start
            if ($this->request->getFile('iimage')) {
                $image          = $this->request->getFile('iimage');
                $validated      = $this->validate(
                    [
                        'file' => [
                            'uploaded[iimage]',
                            'mime_in[iimage,image/jpg,image/jpeg,image/png]',
                            'max_size[iimage,2048]',
                        ],
                    ],
                    [   // Errors
                        'file' => [
                            'mime_in'   => 'Please select only IMAGE.',
                            'max_size'  => 'This file is too large of a file. Maximum allow only 2MB',
                        ],
                    ]
                );
                if (!$validated) {
                    $this->session->setFlashData('error', $this->validation->getErrors()['file']);
                    return redirect()->to(base_url('/item/list/'));
                } else {
                    $name = $image->getRandomName(); // Generate a new secure name
                    $path = './app-assets/assets/qr_menu/';
                    $image->move($path,$name);
                }
            }
            // Upload Item Image end

            $data = [
                'name_eng'      => $this->request->getPost('name_eng'),
                'name_ar'       => $this->request->getPost('name_ar'),
                'big_price'     => $this->request->getPost('big_price'),
                'small_price'   => $this->request->getPost('small_price'),
                'big_cal'       => $this->request->getPost('big_cal'),
                'small_cal'     => $this->request->getPost('small_cal'),
                'price_level'   => $this->request->getPost('price_level'),
                'category_id'   => $this->request->getPost('category_id'),
                'image'         => $name,
                'status'        => 1,
                'created_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->ItemModel->menu_item_create($data)) {
                $this->session->setFlashData('error','Item not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Item',
                'action_done'       =>  'Add new item',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','item are added successfully!');
            return redirect()->to('/item/list');
        }
    }


    public function itemEdit()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('itemid');

            // Upload Item Image start
            if ($this->request->getFile('file') != "") {
                $image          = $this->request->getFile('file');
                $validated      = $this->validate(
                    [
                        'file' => [
                            'uploaded[file]',
                            'mime_in[file,image/jpg,image/jpeg,image/png]',
                            'max_size[file,2048]',
                        ],
                    ],
                    [   // Errors
                        'file' => [
                            'mime_in'   => 'Please select only IMAGE.',
                            'max_size'  => 'This file is too large of a file. Maximum allow only 2MB',
                        ],
                    ]
                );
                if (!$validated) {
                    $this->session->setFlashData('error', $this->validation->getErrors()['file']);
                    return redirect()->to(base_url('/item/list/'));
                } else {
                    $name = $image->getRandomName(); // Generate a new secure name
                    $path = './app-assets/assets/qr_menu/';
                    $image->move($path,$name);
                }
            }
            // Upload Item Image end

            $data = [
                'name_eng'      => $this->request->getPost('name_eng'),
                'name_ar'       => $this->request->getPost('name_ar'),
                'big_price'     => $this->request->getPost('big_price'),
                'small_price'   => $this->request->getPost('small_price'),
                'big_cal'       => $this->request->getPost('big_cal'),
                'small_cal'     => $this->request->getPost('small_cal'),
                'price_level'   => $this->request->getPost('price_level'),
                'category_id'   => $this->request->getPost('category_id'),
                'image'         => ($this->request->getFile('file') != "") ? $name : $this->request->getPost('iimage'),
                'status'        => $this->request->getPost('status'),
                'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->ItemModel->menu_item_update($data, $id)) {
                $this->session->setFlashData('error','Item not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Item',
                'action_done'       =>  'Edit Item',
                'remarks'           =>  'Item id :'. $id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Item are updated successfully!');
            return redirect()->to('/item/list');
        }
    }

    public function itemDelete($id)
    {

        // $item = $this->ItemModel->menu_item_list()->where('menu_item.id',$id)->get()->getRowArray();
        $item = $this->db->table('menu_item')->where('id',$id)->get()->getRowArray();
        unlink("./app-assets/assets/qr_menu/".$item['image']);
        
        if ($this->ItemModel->menu_item_delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Item',
                'action_done'       =>  'Delete Item',
                'remarks'           =>  'User id :'.$id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $data = [
                'status'    => 'success',
                'message'   => 'Record Deleted Successfully ...',
                'token'     => csrf_hash()
            ];
        } else {
            $data = [
                'status'        => 'error',
                'message'       => 'Unable to delete this record ...',
                'token'         => csrf_hash()
            ];
        }
        return $this->response->setJSON($data);
    }


    public function categoryAdd()
    {
        if ($this->request->getPost()) {
            $data = [
                'name_eng'      => $this->request->getPost('name_eng'),
                'name_ar'       => $this->request->getPost('name_ar'),
                'desc_eng'      => $this->request->getPost('desc_eng'),
                'desc_ar'       => $this->request->getPost('desc_ar'),
                'status'        => 1,
                'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->ItemModel->menu_category_create($data)) {
                $this->session->setFlashData('error','Category not registerd, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Item',
                'action_done'       =>  'Add new Category',
                'remarks'           =>  $this->db->insertID(),
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Category are added successfully!');
            return redirect()->to('/item/list');
        }
    }

    public function categoryEdit()
    {
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');

            $data = [
                'name_eng'      => $this->request->getPost('name_eng'),
                'name_ar'       => $this->request->getPost('name_ar'),
                'desc_eng'      => $this->request->getPost('desc_eng'),
                'desc_ar'       => $this->request->getPost('desc_ar'),
                'status'        => $this->request->getPost('status'),
                'updated_at'    => (!empty($id)?date('Y-m-d H:i:s'):''),
            ];

            if (!$this->ItemModel->menu_category_update($data, $id)) {
                $this->session->setFlashData('error','Category not updated, becuse there are some error!');
                return redirect()->back()->withInput();
            }
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Item',
                'action_done'       =>  'Edit Category',
                'remarks'           =>  'Category id :'. $id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $this->session->setFlashData('success','Category are updated successfully!');
            return redirect()->to('/item/list');
        }
    }

    public function categoryDelete($id)
    { 
        if ($this->ItemModel->menu_category_delete($id)) {
            /*Start Insert log history*/
            $accesslog = array(
                'action_page'       =>  'Item',
                'action_done'       =>  'Delete Category',
                'remarks'           =>  'User id :'.$id,
                'user_name'         =>  $this->session->get('user')['id'],
                'entry_date'        =>  date('Y-m-d H:i:s'),
            );
            $this->db->table('accesslog')->insert($accesslog);
            /*End Insert log history*/
            $data = [
                'status'    => 'success',
                'message'   => 'Record Deleted Successfully ...',
                'token'     => csrf_hash()
            ];
        } else {
            $data = [
                'status'        => 'error',
                'message'       => 'Unable to delete this record ...',
                'token'         => csrf_hash()
            ];
        }
        return $this->response->setJSON($data);
    }

    


    



}
