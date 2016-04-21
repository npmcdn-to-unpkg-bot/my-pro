<?php
namespace Home\Controller;
use think\Controller;

class FormController extends Controller{
	public function add() {
		$form = M('form');
		$data = $form->select();
		$this -> assign('data',$data);
		$this -> display();
	}
	
	public function insert(){
        $Form   =   D('form');
        if($Form->create()) {
            $result =   $Form->add();
            if($result) {
                $this->success('数据添加成功！');
            }else{
                $this->error('数据添加错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }
    
    public function ajaxTest(){
    	$retData['name'] = 'yaoyuan';
    	$retData['arr']['school-1']='yongdeng school-1';
    	$retData['arr']['school-2']='yongdeng school-2';
    	$this -> ajaxReturn($retData );
    }
}