<?php defined('ROOT') or exit('Can\'t Access !'); ?>

<?php if(file_exists(ROOT."/lib/table/statdetail.php")) { ?>
<script>var stat_catid=<?php echo isset($catid)?$catid:0; ?>;var stat_aid=<?php echo isset($archive)?$archive['aid']:0; ?></script>
<script src="<?php echo $base_url;?>/common/plugins/cmseasy_stat/cmseasy_stat.js"></script>
<?php } ?>
