
<!-- 模块样例一 -->
<div class="content-form-title">
    <h4><?php echo lang_admin('myform_name');?></h4>
    <p>Form List</p>
</div>
<div class="content-form-content">
    <table class="table table-hover table-striped">
        <tr>
            <td>
                <?php echo lang_admin('one_line_text');?>
            </td>
            <td>
                <input type="text" value="" class="form-control"/>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo lang_admin('multi_selection');?>
            </td>
            <td>
                <select class="form-control" class="form-control select">
                    <option value="1"><?php echo lang_admin('selection_class');?></option>
                    <option value="2"><?php echo lang_admin('selection_class');?></option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo lang_admin('field_name');?>
            </td>
            <td>
                <input type="text" value="" class="form-control"/>
            </td>
        </tr>

        <tr>
            <td>
                <?php echo lang_admin('multi_line_text');?>
            </td>
            <td>
                <textarea class="form-control textarea" rows="4" ></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type='hidden' id="aid" name="aid" value="50"/>
            </td>
            <td align="left">
                <input type="submit" name="submit" value=" <?php echo lang_admin('submitted');?> " class="btn btn-primary content-form-btn">
            </td>
        </tr>
    </table>
</div>
<!-- 模块样例一结束 -->