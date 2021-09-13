<?php


$search_data=
    array(
        '后台首页'=>'./index.php?admin_dir='.get('admin_dir',true).'&site=default',
        '首页'=>'./index.php?admin_dir='.get('admin_dir',true).'&site=default',
        '添加内容'=>'./index.php?case=table&act=add&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '内容添加'=>'./index.php?case=table&act=add&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '添加栏目'=>'./index.php?case=table&act=add&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '内容管理'=>'./index.php?case=table&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '管理内容'=>'./index.php?case=table&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '栏目管理'=>'./index.php?case=table&act=list&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '管理栏目'=>'./index.php?case=table&act=list&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '图库'=>'./index.php?case=image&act=listdir&admin_dir='.get('admin_dir',true).'&site=default',
        '图片库'=>'./index.php?case=image&act=listdir&admin_dir='.get('admin_dir',true).'&site=default',
        'URL规则'=>'./index.php?case=table&act=htmlrule&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '友情链接'=>'./index.php?case=table&act=list&table=friendlink&admin_dir='.get('admin_dir',true).'&site=default',
        '熊掌号'=>'./index.php?case=xiongzhang&act=index&admin_dir='.get('admin_dir',true).'&site=default',
        '微信公众号'=>'./index.php?case=weixin&act=list&admin_dir='.get('admin_dir',true).'&site=default',
        '群发'=>'./index.php?case=table&act=send&table=user&admin_dir='.get('admin_dir',true).'&site=default',
        '热门关键词'=>'./index.php?case=index&act=hotsearch&admin_dir='.get('admin_dir',true).'&site=default',
        '热门标签'=>'./index.php?case=config&act=hottag&admin_dir='.get('admin_dir',true).'&site=default',
        '选择模板'=>'./index.php?case=config&act=system&set=template&admin_dir='.get('admin_dir',true).'&site=default',
        '在线模板'=>'./index.php?case=template&act=downlist&admin_dir='.get('admin_dir',true).'&site=default',
        'banner'=>'./index.php?case=config&act=system&set=slide&admin_dir='.get('admin_dir',true).'&site=default',
        '模板标签'=>'./index.php?case=table&act=list&table=templatetag&tagfrom=content&admin_dir='.get('admin_dir',true).'&site=default',
        '推荐位'=>'./index.php?case=table&act=setting&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '编辑模板'=>'./index.php?case=template&act=edit&admin_dir='.get('admin_dir',true).'&site=default',
        '用户列表'=>'./index.php?case=table&act=list&table=user&admin_dir='.get('admin_dir',true).'&site=default',
        '用户组'=>'./index.php?case=table&act=list&table=usergroup&admin_dir='.get('admin_dir',true).'&site=default',
        '邀请码'=>'./index.php?case=invite&act=list&admin_dir='.get('admin_dir',true).'&site=default',
        '安全防护'=>'./index.php?case=filecheck&act=filecheck&action=file_check&admin_dir='.get('admin_dir',true).'&site=default',
        '管理数据'=>'./index.php?case=database&act=baker&admin_dir='.get('admin_dir',true).'&site=default',
        '在线升级'=>'./index.php?case=update&act=index&admin_dir='.get('admin_dir',true).'&site=default',
        '设置'=>'./index.php?case=config&act=index&admin_dir='.get('admin_dir',true).'&site=default',
        '可视化'=>'./index.php?case=template&act=visual&admin_dir='.get('admin_dir',true).'&site=default',
        '动静态设置'=>'./index.php?case=config&act=system&set=dynamic&admin_dir='.get('admin_dir',true).'&site=default',
        '电脑版静态'=>'./index.php?case=cache&act=make_show&admin_dir='.get('admin_dir',true).'&site=default',
        '手机版静态'=>'./index.php?case=wapcache&act=make_show&admin_dir='.get('admin_dir',true).'&site=default',
        '更新缓存'=>'./index.php?case=config&act=remove&admin_dir='.get('admin_dir',true).'&site=default',
        '编辑语言'=>'./index.php?case=language&act=list&admin_dir='.get('admin_dir',true).'&site=default',
        '审核内容'=>'./index.php?case=table&act=list&table=archive&needcheck=1&admin_dir='.get('admin_dir',true).'&site=default',
        '回收站'=>'./index.php?case=table&act=list&table=archive&deletestate=1&page=1&admin_dir='.get('admin_dir',true).'&site=default',
        '内容排序'=>'./index.php?case=table&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '批量移动内容'=>'./index.php?case=table&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',

        '批量移动栏目'=>'./index.php?case=table&act=list&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '复制栏目'=>'./index.php?case=table&act=list&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '复制内容'=>'./index.php?case=table&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '编辑栏目'=>'./index.php?case=table&act=list&table=category&admin_dir='.get('admin_dir',true).'&site=default',
        '编辑内容'=>'./index.php?case=table&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',

        '添加友情链接'=>'./index.php?case=table&act=add&table=friendlink&admin_dir='.get('admin_dir',true).'&site=default',
        '添加公众号'=>'./index.php?case=weixin&act=add&admin_dir='.get('admin_dir',true).'&site=default',
        '群发邮件'=>'./index.php?case=table&act=send&table=user&admin_dir='.get('admin_dir',true).'&site=default',
        '群发会员'=>'./index.php?case=table&act=mail&table=user&admin_dir='.get('admin_dir',true).'&site=default',
        '订阅群发'=>'./index.php?case=table&act=send&table=user&type=subscription&admin_dir='.get('admin_dir',true).'&site=default',
        '短信群发'=>'./index.php?case=table&act=sendsms&table=user&admin_dir='.get('admin_dir',true).'&site=default',
        '站内通知'=>'./index.php?case=table&act=notification&table=user&admin_dir='.get('admin_dir',true).'&site=default',
        '公告'=>'./index.php?case=table&act=list&table=announcement&admin_dir='.get('admin_dir',true).'&site=default',
        '评论'=>'./index.php?case=table&act=list&table=comment&admin_dir='.get('admin_dir',true).'&site=default',
        '自定义字段'=>'./index.php?case=field&act=list&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '第三方代码'=>'./index.php?case=thirdparty&act=index&admin_dir='.get('admin_dir',true).'&site=default',
        '内容过滤'=>'./index.php?case=config&act=system&set=security&admin_dir='.get('admin_dir',true).'&site=default',
        '批量导入'=>'./index.php?case=table&act=import&table=archive&admin_dir='.get('admin_dir',true).'&site=default',
        '日志'=>'./index.php?case=adminlogs&act=manage&admin_dir='.get('admin_dir',true).'&site=default',
        '替换字符串'=>'./index.php?case=database&act=str_replace&admin_dir='.get('admin_dir',true).'&site=default',
        '自定义设置'=>'./index.php?case=config&act=system&set=websitesite&admin_dir='.get('admin_dir',true).'&site=default',
        '联系方式'=>'./index.php?case=config&act=system&set=information&admin_dir='.get('admin_dir',true).'&site=default',
        '手机版'=>'./index.php?case=config&act=system&set=phonesite&admin_dir='.get('admin_dir',true).'&site=default',
        '客服'=>'./index.php?case=config&act=system&set=customer&admin_dir='.get('admin_dir',true).'&site=default',
        '验证码'=>'./index.php?case=config&act=system&set=verification&admin_dir='.get('admin_dir',true).'&site=default',
        '附件'=>'./index.php?case=config&act=system&set=upload&admin_dir='.get('admin_dir',true).'&site=default',
        '邮件'=>'./index.php?case=config&act=system&set=mail&admin_dir='.get('admin_dir',true).'&site=default',
        '地图'=>'./index.php?case=config&act=system&set=ditu&admin_dir='.get('admin_dir',true).'&site=default',
        '多点地图'=>'./index.php?case=config&act=atlas&admin_dir='.get('admin_dir',true).'&site=default',

    );
    //提取商品
    if(file_exists(ROOT."/lib/table/shopping.php")) {
        $search_data['添加商品']='./index.php?case=table&act=add&table=archive&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['商品添加']='./index.php?case=table&act=add&table=archive&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['添加商品栏目']='./index.php?case=table&act=add&table=category&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['商品管理']='./index.php?case=table&act=list&table=archive&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['管理商品']='./index.php?case=table&act=list&table=archive&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['订单']='./index.php?case=table&act=list&table=orders&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['管理订单']='./index.php?case=table&act=list&table=orders&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['订单管理']='./index.php?case=table&act=list&table=orders&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['快递']='./index.php?case=express&act=index&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['优惠券']='./index.php?case=table&act=list&table=coupon&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['复制商品']='./index.php?case=table&act=list&table=archive&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['配货设置']='./index.php?case=logistics&act=list&table=logistics&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['订单设置']='./index.php?case=config&act=system&set=orders&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['新增订单']='./index.php?case=table&act=add&table=orders&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['快递设置']='./index.php?case=express&act=config&table=expressconfig&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['添加优惠券']='./index.php?case=table&act=add&table=coupon&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['支付']='./index.php?case=pay&act=list&table=pay&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['充值记录']='./index.php?case=table&act=list&table=consumption&=&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['批量改价']='./index.php?case=table&act=list&table=archive&shopping=1&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['批量打印']='./index.php?case=table&act=list&table=orders&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取分类
    if(file_exists(ROOT."/lib/table/type.php")) {
        $search_data['添加分类']='./index.php?case=table&act=add&table=type&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['分类管理']='./index.php?case=table&act=list&table=type&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['管理分类']='./index.php?case=table&act=list&table=type&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['编辑分类']='./index.php?case=table&act=list&table=type&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取专题
    if(file_exists(ROOT."/lib/table/special.php")) {
        $search_data['添加专题']='./index.php?case=table&act=add&table=special&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['专题管理']='./index.php?case=table&act=list&table=special&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['管理专题']='./index.php?case=table&act=list&table=special&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['编辑专题']='./index.php?case=table&act=list&table=special&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取蜘蛛
    if(file_exists(ROOT."/lib/table/stats.php")) {
        $search_data['蜘蛛']='./index.php?case=stats&act=list&table=stats&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取内链
    if(file_exists(ROOT."/lib/table/linkword.php")) {
        $search_data['内链']='./index.php?case=table&act=list&table=linkword&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['添加内链']='./index.php?case=table&act=add&table=linkword&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['seo']='./index.php?case=table&act=list&table=linkword&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取推广模块
    if(file_exists(ROOT."/lib/table/union.php")) {
        $search_data['推广模块']='./index.php?case=union&act=config&table=union&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取登录API
    if(file_exists(ROOT."/lib/table/ologin.php")) {
        $search_data['登录API']='./index.php?case=ologin&act=list&table=ologin&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取留言
    if(file_exists(ROOT."/lib/table/guestbook.php")) {
        $search_data['留言']='./index.php?case=table&act=list&table=guestbook&admin_dir='.get('admin_dir',true).'&site=default';
        $search_data['留言字段设置']='./index.php?case=table&act=list&table=guestbookfield&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取投票
    if(file_exists(ROOT."/lib/table/guestbook.php")) {
        $search_data['投票']='./index.php?case=table&act=list&table=ballot&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取表单
    if(file_exists(ROOT."/lib/admin/form_admin.php")) {
        $search_data['表单']='./index.php?case=form&act=listform&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取水印
    if(file_exists(ROOT."/lib/table/watermark.php")) {
        $search_data['水印']='./index.php?case=config&act=system&set=image&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取短信
    if(file_exists(ROOT."/lib/admin/sms_admin.php")) {
        $search_data['短信']='./index.php?case=config&act=system&set=sms&admin_dir='.get('admin_dir',true).'&site=default';
    }
    //提取多点登录
    if(file_exists(ROOT."/lib/admin/website_admin.php")) {
        $search_data['多点登录']='./index.php?case=website&act=listwebsite&admin_dir='.get('admin_dir',true).'&site=default';
    }
return $search_data;

?>