<div class="main-right-box">
    <h5>{lang_admin('hot_keyword_list')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">
        <div class="homecon">

            <div class="alert alert-info" role="alert">
                <ul class="nav nav-pills" role="tablist">
                    <?php
                    if (front::get('change')) {
                        $path=ROOT.'/data/hotsearch_'.lang::getisadmin().'/'.front::post('kfile');
                        $keywordcount=intval(front::post('keywordcount'));
                        file_put_contents($path, $keywordcount);
                        if ($_GET['site'] != 'default') {
                            $ftp=new nobftp();
                            $ftpconfig=config::getadmin('website');
                            $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
                            $ftperror=$ftp->returnerror();
                            if ($ftperror) {
                                exit($ftperror);
                            }
                            else {
                                $ftp->nobchdir($ftpconfig['ftppath']);
                                $ftp->nobput($ftpconfig['ftppath'].'/data/hotsearch_'.lang::getisadmin().'/'.front::post('kfile'), $path);
                            }
                        }
                        echo "<script>gotoinurl(".url::create('index/hotsearch/save/1').");</script>";
                    }
                    else {
                        if (front::get('keyword') && !front::post('keyword'))
                            front::$post['keyword']=front::get('keyword');

                        front::check_type(front::post('keyword'), 'safe');

                        if (front::post('keyword')) {
                            $_keyword=trim(front::post('keyword'));
                            session::set('keyword', $_keyword);
                        }
                        else {
                            session::set('keyword', null);
                            $_keyword=session::get('keyword');
                        }


                        if (front::get('keywordcount') && !front::post('keywordcount'))
                            front::$post['keywordcount']=front::get('keywordcount');

                        front::check_type(front::post('keywordcount'), 'safe');

                        if (front::post('keywordcount')) {
                            $_keywordcount=trim(front::post('keywordcount'));
                            session::set('keywordcount', $_keywordcount);
                        }
                        else {
                            session::set('keywordcount', null);
                            $_keywordcount=session::get('keywordcount');
                        }
                    }




                    if ($_GET['site'] != 'default') {
                        $ftp=new nobftp();
                        $ftpconfig=config::getadmin('website');
                        $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
                        $ftperror=$ftp->returnerror();
                        if ($ftperror) {
                            exit($ftperror);
                        }
                        else {
                            $ftp->nobchdir($ftpconfig['ftppath']);
                            $hotkeywordlist=$ftp->nobnlist($ftpconfig['ftppath'].'/data/hotsearch_'.lang::getisadmin());
                        }
                        if (is_array($hotkeywordlist)) {
                            foreach ($hotkeywordlist as $val) {
                                $val=str_replace($ftpconfig['ftppath'], config::getadmin('site_url'), $val);
                                $keywordcount=@file_get_contents($val);
                                $valtmp=str_replace(config::getadmin('site_url'), '', $val);
                                $valtmp=str_replace('/data/hotsearch_'.lang::getisadmin(), '', $valtmp);
                                $valtmp=str_replace('/', '', $valtmp);
                                $valtmp=str_replace('\\', '', $valtmp);
                                $keyword=urldecode(substr($valtmp, 0, -4));
                                if ($_keyword) {
                                    if ($_keyword != $keyword) {
                                        $path1=ROOT.'/data/hotsearch_'.lang::getisadmin().'/'.urlencode($_keyword).'.txt';
                                        file_put_contents($path1, $_keywordcount);

                                        $ftp->nobchdir($ftpconfig['ftppath']);
                                        $ftp->nobput($ftpconfig['ftppath'].'/data/hotsearch_'.lang::getisadmin().'/'.urlencode($_keyword).'.txt', $path1);

                                        echo "<script>gotoinurl(".url::create('index/hotsearch/post/1').");</script>";
                                    }
                                }
                                echo '<li role="presentation" class="active"><a href="'.config::getadmin('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank">'.$keyword.'&nbsp;<span class="badge">'.$keywordcount.')</span></a>';
                                $koption .= '<option value="'.$valtmp.'">'.$keyword.'</option>';
                            }
                        }
                    }
                    else {

                        $path=ROOT.'/data/hotsearch_'.lang::getisadmin();
                        $dir=opendir($path);
                        $i=0;

                        $files=-2;
                        $dir2=opendir($path);
                        while ($file=readdir($dir2)) {
                            $files++;
                        }
                        $koption='<option value="">"' . lang_admin('choose_keywords') . '"...</option>';
                        while ($file=readdir($dir)) {
                            if ($file != '..' && $file != '.' && !is_dir($path.'/'.$file) || $files == 0) {
                                if ($files == 0)
                                    $keyword=null;
                                else
                                    $keyword=urldecode(substr($file, 0, -4));
                                if ($_keyword) {
                                    if ($_keyword != $keyword) {
                                        $path1=ROOT.'/data/hotsearch_'.lang::getisadmin().'/'.urlencode($_keyword).'.txt';
                                        file_put_contents($path1, $_keywordcount);
                                        echo "<script>gotoinurl(".url::create('index/hotsearch/post/1').");</script>";
                                    }
                                }
                                $keywordcount = @file_get_contents($path.'/'.$file);
                                echo '<li role="presentation" class="active"><a href="#" onclick="gotourl(this)"   data-dataurl="'.config::getadmin('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank">'.$keyword.'&nbsp;<span class="badge">'.$keywordcount.'</span></a></li><li><a onclick="if(confirm(\'' . lang_admin('delete') . '\')){gotourl(this);};" href="#"   data-dataurl="'.url::create('index/hotdel/key/'.$keyword).'" class="search-del" title="' . lang_admin('delete') . '">x</a></li> ';
                                $koption .= '<option value="'.$file.'">'.$keyword.'</option>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="blank30"></div>

            <form action="{url::create('index/hotsearch/change/1')}" method="post" name="form2" onsubmit="return returnform(this);">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('modify')}</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <select name="kfile" value="" class="form-control select"><?php echo $koption; ?></select>
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('search_times_changed_to')}</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <div class="input-group">
                        <input name="keywordcount" type="text" class="form-control" value=""  />
                        <div class="input-group-addon"><?php echo lang_admin('second');?> </div>
                    </div>
                        <div class="clearfix blank20"></div>
                        <input name="{lang_admin('determine')}" type="submit" value="{lang_admin('determine')}" class="btn btn-gray" />
                    </div>
                </div>
                <div class="clearfix blank20"></div>
            </form>
            <form action="{url::create('index/hotsearch/save/1')}" method="post" name="form2" onsubmit="return returnform(this);">

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('key_word')}</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input name="keyword" class="form-control" type="text" />
                    </div>
                </div>
                <div class="clearfix blank20"></div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('search_times')}</div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <div class="input-group">
                        <input name="keywordcount" type="text" value="" class="form-control" />
                            <div class="input-group-addon"><?php echo lang_admin('second');?> </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <input name="{lang_admin('add_to')}" type="submit" value="{lang_admin('add_to')}" class="btn btn-gray" />
                    </div>
                </div>
                <div class="clearfix blank20"></div>
            </form>


            <div class="blank30"></div>
        </div>
    </div>
</div>