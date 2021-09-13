<div id="tagscontent" class="right_box">

<form name="typeform" method="post" action="<?php echo front::$uri;?>" 	onsubmit="return returnform(this);">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>
<tr>
	<td width="19%" align="right">{lang_admin('area')}</span></td>
	<td width="1%">&nbsp;</td>
                        <td width="70%"><?php echo form::select('province_id',
    get('province_id') ? get('province_id') : 0, area::province_option()); ?>
<?php echo form::select('city_id', get('city_id') ? get('scity_id') : 0,
        area::city_option()); ?>
<?php echo form::select('section_id', get('section_id') ? get('section_id') : 0, area::section_option()); ?>
&nbsp;&nbsp;
            <input  name="submit" value="1" type="hidden">
            <?php echo form::submit(lang_admin('update')); ?>
    </td></tr></tbody>
</table>
</form>
</div>