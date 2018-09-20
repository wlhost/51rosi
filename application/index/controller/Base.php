<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/7/8
 * Time: 16:18
 */

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Request;
use app\index\model\Site as SiteModel;
use app\admin\model\Linkship as LinkModel;

class Base extends Controller
{
    protected $site = '';
    protected $links = [];
    public function __construct(Request $request = null)
    {
        $this->site = SiteModel::get(0)->cache(true,600)->find();
        if (Cache::get('link')){
            $this->links = Cache::get('link');
        }else{
            $this->links = LinkModel::all();
            Cache::set('link',$this->links);
        }

        parent::__construct($request);
        $this->assign('links',$this->links);
        $this->assign('site',$this->site);
    }
}