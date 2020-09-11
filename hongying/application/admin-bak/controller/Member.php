<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

vendor('./phpexcel/PHPExcel');

class Member extends Common
{
    //会员列表
    public function index(){
        //按照关键字从进行搜索
        $keyword=input('search');
        $search = [];
        if ($keyword) {
            $search['mobile|name'] = ['like', "%{$keyword}%"];
        }
        //按照价格区间
        $time_min=input('time_min');
        $time_min=strtotime($time_min);
        $time_max=input('time_max');
        $time_max=strtotime($time_max);
        if ($time_min){
            $time=['time'=>['between',[$time_min,$time_max]]];
        }else{
            $time=[];
        }
        $userRes=Db::name('Member')
            ->where($search)
            ->where($time)
            ->order('id desc')
//            ->paginate(15,false,['query'=>[
//                'time_min'=>$time_min,
//                'time_max'=>$time_max,
//                'search'=>$search,
//            ]]);
            ->select();
        $this->assign([
           'userRes'=>$userRes,
           'time_min'=>$time_min,
           'time_max'=>$time_max,
           'keyword'=>$keyword,
        ]);
        return view();
    }


    /**
     *  数据表格
     */
    public function dataTable(){

        //request()->post('键名/a')

        $keyword=request()->get('key/a');
        //dump($keyword);die;
        $keyword=$keyword['search'];
        if ($keyword) {
            $search['mobile|name'] = ['like', "%{$keyword}%"];
        }else{
            $search=[];
        }

        $times=request()->get('keytime/a');
        $time_min=$times['time_min'];
        $time_min=strtotime($time_min);
        $time_max=$times['time_max'];
        $time_max=strtotime($time_max);
        //dump($time_min);
        //dump($time_max);die;
        if ($time_min){
            $time=['time'=>['between',[$time_min,$time_max]]];
        }else{
            $time=[];
        }


        $page=input('get.page',1);
        $limit=input('get.limit',10);
        $logRes=Db::name('Member')->where($search)->where($time)->order('id desc')->page($page,$limit)->select();
        $arr=[];
        foreach ($logRes as $key=>$value){
            $arr[]=$value;
            $arr[$key]['time']=date("Y/m/d H:i:s",$value['time']);
            if ($arr[$key]['status']==1){
                $arr[$key]['status']="正常";
            }else{
                $arr[$key]['status']="异常";
            }

        }
        $counts=Db::name('Member')->where($search)->where($time)->count();
        return json(['code'=>0,'msg'=>'','count'=>$counts,'data'=>$arr]);
    }

    //手动添加会员
    public function add(){
        if (request()->isPost()){
            $data=input('post.');
            $validate = validate('User');
            if (!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=Db::name('user')->insert($data);
            if ($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败');
            }
        }
        return view();
    }

    //修改会员信息
    public function edit(){
        if (request()->isPost()){
            $data=input('post.');
//            $validate = validate('User');
//            if (!$validate->scene('edit')->check($data)){
//                $this->error($validate->getError());
//            }

            if ($data['password']){
                $data['password']=md5($data['password']);
            }else{
                unset($data['password']);
            }

            $edit=Db::name('Member')->update($data);
            if ($edit !==false){
                $this->success('编辑成功','index');
            }else{
                $this->error('更新失败');
            }
        }
        $id=input('id');
        $users=Db::name('Member')->find($id);
        if (!$users){
            $this->error("该会员不存在");
        }else{
            $this->assign('users',$users);
        }
        return view();
    }

    public function exportexecl(){
        $phpexcel=new \PHPExcel();
        $phpexcel->setActiveSheetIndex(0);
        $sheet=$phpexcel->getActiveSheet();
        $res=Db::name('Member')
            ->field("id,mobile,password,name,status,agent,ip,time")
            ->select();
        $arr=[
            'id'=>"ID",
            'mobile'=>"手机号",
            'password'=>"会员密码",
            'name'=>"姓名",
            'status'=>"状态",
            'agent'=>"代理商",
            'ip'=>"注册IP",
            'time'=>"注册时间戳",
        ];
        array_unshift($res,$arr);
        $currow=0;
        foreach ($res as $key=>$v){
            $currow=$key+1;
            $sheet->setCellValue('A'.$currow,$v['id'])
                ->setCellValue('B'.$currow,$v['mobile'])
                ->setCellValue('C'.$currow,$v['password']."\t")
                ->setCellValue('D'.$currow,$v['name'])
                ->setCellValue('E'.$currow,$v['status'])
                ->setCellValue('F'.$currow,$v['agent'])
                ->setCellValue('G'.$currow,$v['ip'])
                ->setCellValue('H'.$currow,strtotime($v['time']));
        }
        $phpexcel->getActiveSheet()->getStyle('A1:H'.$currow)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="会员信息.xlsx"');
        header('Cache-Control: max-age=0');
        $phpwriter = new \PHPExcel_Writer_Excel2007($phpexcel);
        $phpwriter->save('php://output');
        return;
    }
    public function leadingin(){
        if (request()->isAjax()){
            $file = request()->file('fileexcel');
            $fileinfo=$this->upload($file);
            if(!$fileinfo['code']){
                return json($fileinfo['info']);
            }
            $inputFileType= \PHPExcel_IOFactory::identify($fileinfo['info']);
            $objReader=\PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExecl=$objReader->load($fileinfo['info']);
            $sheet=$objPHPExecl->getSheet(0);
            $rows=$sheet->getHighestRow();
            $column=$sheet->getHighestColumn();
            $columns=\PHPExcel_Cell::columnIndexFromString($column);
            $field=['mobile','password','name','status','ip','agent','time'];
            $ExcelNum=count($field);
            //dump($ExcelNum);die;
            if ($columns != $ExcelNum){
                return json(['msg'=>'抱歉!数据表格式不正确,无法进行导入']);
            }
            $data=[];
	 $shared=new \PHPExcel_Shared_Date();
            for ($row=2;$row<=$rows;$row++){
                $row_data=[];
                for ($col=0;$col<$columns;$col++){
                    $value=$sheet->getCellByColumnAndRow($col,$row)->getValue();
                    if ($field[$col]=="time"){
                        //$value=time();
 			$value=$shared ->ExcelToPHP($value);
                        $value=$value-3600*8;

                    }
                    $row_data[$field[$col]]=$value;
                }
                $data[]=$row_data;
            }
            $adds=db('Member')->insertAll($data);
            if ($adds){
                if (file_exists($fileinfo['info'])){
                    unlink($fileinfo['info']);
                }
                return json(['msg'=>'数据导入成功']);
            }else{
                return json(['msg'=>'数据导入异常']);
            }
        }
        return view();
    }

    protected function upload($file)
    {
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        $msg=[];
        if($info){
            $msg['code']=1;
            $msg['info']=ROOT_PATH . 'public' . DS . 'uploads'.DS.$info->getSaveName();

        }else{
            $msg['code']=0;
            $msg['info']=$file->getError();
        }
        return $msg;

    }

    //删除会员
    public function del(){
        $id=input('id');
        $del=Db::name('Member')->delete($id);
        if ($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败');
        }

    }

    //批量删除
    public function delAll(){
        if (request()->isPost()) {
            $data = input('post.');
            if (empty($data['id'])){
                return ['code'=>0,'msg'=>'请选择要删除的内容'];
            }
            foreach ($data as $k=>$v){
                Db::name('Member')->delete($v);
            }
            return ['code'=>1,'msg'=>'批量删除成功'];
        }
    }

//    public function alldel(){
//        if (request()->isPost()) {
//            $data = input('post.');
//            //判断是否有提交的数据
//            if (empty($data['id'])){
//                $this->error('请选择要删除的内容');
//            }
//            foreach ($data as $k=>$v){
//                //dump($v);die;
//                Db::name('Member')->delete($v);
//            }
//            $this->success('批量删除成功','index');
//        }
//    }

      public function deltableall(){

        // $all=Db::name('Member')->select();
        // foreach ($all as $k=>$v){
        //     Db::name('Member')->delete($v['id']);
        // }
        $queryDb="truncate table tp_member";
        Db::query($queryDb);
        $this->success('清空表全部数据成功','index');
    }

    public function adeltableall(){
       Db::name('Member')->delete();
    }

    public function deltablealls(){
        $all=Db::name('Member')->delete();
        foreach ($all as $k=>$v){
            Db::name('Member')->delete($v['id']);
        }
    }

}
