<div class="main-right-box">
    <h5>{lang_admin('adding_distribution')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">

        <input class="btn btn-primary" type="button" value=" {lang_admin('distribution_list')} " name="add" onclick="gotourl(this)"   data-dataurl="<?php echo url('logistics/list/table/logistics',true);?>'"/>

        <div class="blank30"></div>

        <form method="post" action="{uri()}" name="form1" id="form1" onsubmit="return returnform(this);">

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('distribution_mode')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="text" name="title" id="title" value="<?php echo isset($data['title'])?$data['title']:"";?>" class="form-control"  />
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('describe')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <textarea name="content" id="content" class="form-control"><?php echo isset($data['content'])?$data['content']:"";?></textarea>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('distribution_price')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="text" name="price" id="price" value="<?php echo isset($data['price'])?$data['price']:"";?>" class="form-control" />
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('overweight_price')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="text" name="overweight" id="overweight" value="<?php echo isset($data['overweight'])?$data['overweight']:"";?>" class="form-control" />
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('cash_on_delivery')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                    <label class="checkbox-inline">
                        <input type="radio" value="1" class="radio" name="cashondelivery" checked>
                    </label>
                    {lang_admin('enabling')}
                    <label class="checkbox-inline">
                        <input type="radio" value="0" class="radio" name="cashondelivery">
                    </label>
                    {lang_admin('close')}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('if_enabled_the_cost_of_this_mode_of_distribution_is_not_included_in_online_payment')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('is_it_insured')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <label class="checkbox-inline">
                        <input type="radio" value="1" class="radio" name="insure" checked>
                    </label>
                    {lang_admin('enabling')}
                    <label class="checkbox-inline">
                        <input type="radio" value="0" class="radio" name="insure">
                    </label>
                    {lang_admin('close')}

                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('guarantee_ratio')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                            <input type="text" name="insureproportion" id="insureproportion" value="<?php echo isset($data['overweight'])?$data['overweight']:"";?>" class="form-control" />
                        </div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            %
                        </div>
                    </div>
                </div>

                <div class="clearfix blank20"></div>

            </div>

            <input type="hidden"  name="pay_id"       value="<?php echo isset($data['pay']['pay_id'])?$data['pay']['pay_id']:"";?>" />
            <input type="hidden"  name="pay_code"     value="<?php echo isset($data['pay']['pay_code'])?$data['pay']['pay_code']:"";?>" />
            <input type="hidden"  name="is_cod"       value="<?php echo isset($data['pay']['is_cod'])?$data['pay']['is_cod']:"";?>" />
            <input type="hidden"  name="is_online"    value="<?php echo isset($data['pay']['is_online'])?$data['pay']['is_online']:"";?>" />

            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"  value=" {lang_admin('submitted')} " class="btn btn-primary btn-lg" />
                </div>
            </div>

        </form>

        <div class="blank30"></div>
    </div>
</div>