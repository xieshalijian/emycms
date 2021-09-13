var conn = '',tmpStore='',year=0,aid='';
var client = new hprose.HttpClient("index.php?case=hprose&act=copyright", [
        'chkMoney','BuyCopyright'
    ]
);

client.timeout(120000);

function setInfo(msg) {
    $('.alertinfo').html(msg);
}

function setProgInfo(msg) {
    $('#buyModal .modal-body').html(msg);
}

function setSuccessInfo(msg) {
    $('#buyModal .modal-body').html('<p>' + msg + '</p>');
}

$('#buyModal').on('hide.bs.modal', function () {
    setProgInfo(tmpStore,false);
    $('#btn_buy').prop('disabled',false);
    //$(this).removeData('bs.modal');
});


function apply(domain, year,aid) {

    tmpStore = $('#buyModal .modal-body').html();
    $('#btn_buy').prop('disabled',true);

    setProgInfo('<div class="progress">\n' +
        '\t\t\t\t\t<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\n' +
        '\t\t\t\t\t\t<span class="alertinfo">正在购买版权</span>\n' +
        '\t\t\t\t\t</div>\n' +
        '\t\t\t\t</div>');

    client.BuyCopyright(domain,year,aid,shopingtype).then(function (res) {
        console.info(res);
        if (res['code'] != 0) {
            setInfo(res['msg']);
            return Promise.reject(res);
        } else {
            setSuccessInfo('<center><h4 class="modal-title" id="buyModalLabel">版权购买成功！</h4><br><a href="index.php?case=copyright&act=getmycr&id='+res.data.id+'" target="_blank" class="shoppingcart">点击下载版权文件</a></center>');
        }
    }).catch(function (err) {
        $('.progress-bar').removeClass('active');
        setInfo(err.msg);
        console.error(err);
    });
}

$('#buyModal').on('shown.bs.modal', function () {
    for (var i = 0; i < shopingtype.length; i++) {
        savenameArry = shopingtype[i].split(","); //字符分割
        if (savenameArry[0] == "my_fuwu") {
            year = savenameArry[1].split(':')[0];
        }
    }
    $('#domain').focus();
});


function doBuy(aid){
    if ($('#domain').val() == '') {
        alert('请输入域名');
        $('#domain').focus();
        return;
    }
    apply($('#domain').val(),year, aid);
}

function goBuy(id) {
    client.chkMoney(id,shopingtype,function(res){
        if(res == true){
            $('#buyModal').modal();
        }else{
            alert('账户余额不足，请先充值');
            window.location.href = 'index.php?case=archive&act=consumption&aid='+id;
        }
    });

}