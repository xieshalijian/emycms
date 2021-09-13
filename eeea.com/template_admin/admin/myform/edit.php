<div class="main-right-box">
    <h5>{lang_admin('form_data')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">
        <style type="text/css">
            tr {margin:5px 0px;}
        </style>

        <script type="text/javascript">
            <!--
            $(document).ready(function() {
                $('#tagscontent').disable();
            });
            //-->
        </script>
        <?php helper::filterField($field,$fieldlimit); ?>


        <input type="button" name="Submit" value="{lang_admin('return')}" class="btn btn-success" onclick="gotourl(this)"   data-dataurl="{url('form/listform')}">
        <div class="blank30"></div>
        <div class="line"></div>
        <div class="blank30"></div>

        <form method="post" name="form1" action="" onsubmit="return returnform(this);">

            <div id="tagscontent" class="right_boxtable-responsive">
                <table class="table table-hover">
                    <tbody>

                    {loop $field $f}
                    <?php
                    $name=$f['name'];
                    if(!isset($data[$name])) $data[$name]='';
                    if($name==$primary_key) continue; ?>

                    <tr>
                        <td width="19%" align="right">{$name|lang}</td>
                        <td width="1%">&nbsp;</td>
                        <td width="70%">
                            {form::getform($name,$form,$field,$data)}
                        </td>
                    </tr>

                    {/loop}

                    </tbody>
                </table>
            </div>
            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <input  name="submit" value="1" type="hidden">
            <input type="submit"  value=" {lang_admin('submitted')} " class="btn btn-primary" />

        </form>
        <div class="blank30"></div>
    </div>
</div>