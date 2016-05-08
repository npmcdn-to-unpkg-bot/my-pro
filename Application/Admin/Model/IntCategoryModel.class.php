<?php
/**
*
*文件名:IntCategroyModel.class.php
* ==============================================
*文件用途
*接口管理-分类管理Model类
*
* ==============================================
* @添加时间: 2016年4月21日 上午11:43:18
* @作者: yaoyuan
* @版本：
*/
namespace Admin\Model;

use Think\Model;
use PhpConsole;
use Common\Util;
use Admin\Common\CommonModel;
use Think\Exception;

class IntCategoryModel extends CommonModel{
	
	/**
	* 用途:根据分类ID获取分类详情
	* @时间: 2016年4月23日 上午10:21:36
	* @作者: yaoyuan
	* @参数:分类ID
	* @返回:
	*/
	public function getIntCategoryById($id){
		try{
			return $this -> where("ID = '".$id."'") ->find();
		}
		catch (Exception $e){
			
		}
		
	}
	
	/**
	* 用途:获取所有父级分类
	* @时间: 2016年4月23日 下午4:00:53
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function getTopCategory(){
		try{
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), MODE_PATH);
		}
	}
	
	/**
	* 用途:单挑/批量删除
	* @时间: 2016年4月25日 下午10:06:33
	* @作者: yaoyuan
	* @参数:ids[]
	* @返回:boolean
	*/
	public function deleteData($id){
		try{
			if( 1 < count(split(',', $id)))
				return $this -> deleteByIds(split(',', $id));
			else 
				return $this -> deleteById($id);
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), MODE_PATH);
		}
	}
	
	/**
	* 用途:删除单条记录
	* @时间: 2016年4月25日 下午10:09:02
	* @作者: yaoyuan
	* @参数:id
	* @返回:boolean
	*/
	private function deleteById($id){
		try{
			//类型判断
			if(0 < count($this -> where("pid = '".$id."' and state = '00A'") -> select())){
				//如果被删除分类为父类，则禁止删除
				return "top";
			}
			else{
				$data['ID'] = $id;
				$data['STATE'] = '00B';
				return $this -> where("id='".$id."'") -> save($data);
			}
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), MODE_PATH);
		}
	}
	
	/**
	 * 用途:删除多条记录
	 * @时间: 2016年4月25日 下午10:09:02
	 * @作者: yaoyuan
	 * @参数:id
	 * @返回:boolean
	 */
	private function deleteByIds($id){
		try{
			$whereSearch = "pid in ('".$id[0]."'";
			$whereUpdate = "id in ('".$id[0]."'";
			for($i = 1 ; $i < count($id)-1 ; $i++){
				$whereSearch .= ",'" . $id[$i] . "'";
				$whereUpdate .= ",'" . $id[$i] . "'";
			}
			
			$whereSearch .= ",'".$id[count($id)-1]."') and state = '00A'";
			$whereUpdate .= ",'".$id[count($id)-1]."') and state = '00A'";
			if(0 < count($this -> where($whereSearch) -> select()))
				return "top";
			else{
				$data['STATE'] = '00B';
				$this -> where($whereUpdate) -> save($data);
			}
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), MODE_PATH);
		}
	}
	
	/**
	* 用途:获取所有有效分类并构建父子关系
	* @时间: 2016年4月27日 下午3:24:12
	* @作者: yaoyuan
	* @参数:array
	* @返回:
	*/
	public function getCategoryWithRelationship(){
		try{
			$topCat = $this -> field('id , name') -> where("pid is null and state='00A'") -> order('sort desc') -> select();
			for($i = 0 ; $i < count($topCat) ; $i++){
				$topCat[$i]['children'] = $this -> field('id , name') -> where("pid = '".$topCat[$i]['id']."' and state='00A'") -> order('sort desc') -> select();
			}
			return $topCat;
		}
		catch(Exception $e){
			$this->debug($e -> getMessage(), 'Exception');
		}
	}

}

