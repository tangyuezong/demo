<?php
namespace app\admin\controller;

use think\Controller;

class Project extends Common
{
    public function index()
    {
        $keyword=input('search');
        $search = [];
        if ($keyword) {
            $search['name'] = ['like', "%{$keyword}%"];
        }
        $projectRes=db('project')->where($search)->order('id DESC')
            //->paginate(15,false,['query'=>['search'=>$search]]);
            ->select();
        $this->assign([
            'projectRes'=>$projectRes,
            'keyword'=>$keyword,
        ]);
        return view();
    }

    public function sort()
    {
        if (request()->isPost()) {
            $data = input('post.');
            foreach ($data['sort'] as $k => $v) {
                db('project')->where('id', $k)->update(['sort' => $v]);
            }
            $this->success('排序成功！', 'index');
        }
    }


    //ajax异步修改栏目显示状态（显示/隐藏）
    public function changestatus(){
        if (request()->isAjax()){
            $id = input('id');
            $status=db('project')->field('status')->where('id',$id)->find();//查询字段
            $status=$status['status'];
            if ($status==1){
                db('project')->where('id',$id)->update(['status'=>0]);//执行数据库状态操作
                echo 1;//有显示改为隐藏
            }else{
                db('project')->where('id',$id)->update(['status'=>1]);//执行数据库状态操作
                echo 2;//有隐藏改为显示
            }
        }else{
            $this->error("非法操作，你真的很危险啊！");
        }

    }

    public function add()
    {
        if (request()->isPost()){
            $data=input('post.');
            //dump($data);die;
            //添加数据判断是否有加http://,若没有则加上 http://
                     //validata验证机制
            $validate=validate('project');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            //dump($data);die;
            //处理图片上传 ['tmp_name']代表是否有图片
            if ($_FILES['thumb']['tmp_name']){
                $data['thumb']=$this->upload();
            }
            $add=db('project')->insert($data);
            if ($add){
                $this->success("添加项目成功",'index');
            }else{
                $this->error('添加项目失败');
            }
            return;
        }
        return view();
    }

    public function edit()
    {
        if (request()->isPost()){
            $data=input('post.');
            //dump($data);die;
            //添加数据判断是否有加http://,若没有则加上 http://
            if ($data['link_url'] && stripos($data['link_url'],'http://') === false){
                $data['link_url']='http://'.$data['link_url'];
            }
            //validata验证机制
            $validate=validate('project');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            //处理图片上传 ['tmp_name']代表是否有图片
            if ($_FILES['thumb']['tmp_name']){
                //先查找是否有图片->如果有图片则执行删除
                $oldprojects=db('project')->field('thumb')->find($data['id']);//获取原图地址
                $oldprojectImg=IMG_UPLOADS.$oldprojects['thumb'];//拼装完整地址
                //dump($oldprojectImg);die;
                if (file_exists($oldprojectImg)){
                    @unlink($oldprojectImg);//执行删除
                }
                $data['thumb']=$this->upload();
            }
            $save=db('project')->update($data);
            if ($save !== false){
                $this->success("修改项目成功",'index');
            }else{
                $this->error('修改项目失败');
            }
            return;
        }
        //编辑时候,查询数据并分配模板
        $id=input('id');
        $projects=db('project')->find($id);
        $this->assign([
            'projects' =>$projects,
        ]);
        return view();
    }

    public function del($id)
    {
        /*执行删除时先查找是否有缩略图->如果有图片则执行删除*/
        $oldprojects=db('project')->field('thumb')->find($id);//获取原图地址
        $oldprojectImg=IMG_UPLOADS.$oldprojects['thumb'];//拼装完整地址
        //dump($oldprojectImg);die;
        if (file_exists($oldprojectImg)){
            @unlink($oldprojectImg);//执行删除
        }
        $del=db('project')->delete($id);
        if ($del){
            $this->success('删除项目成功！',url('index'));
        }else{
            $this->error('删除项目失败！');
        }

    }

    //上传图片操作
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('thumb');//数据表字段名
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS . 'uploads');//上传路径
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                return $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }


}
