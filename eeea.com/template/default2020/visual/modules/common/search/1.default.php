
    <link href="{$template_path}/visual/modules/common/search/css/style.css" rel="stylesheet">

    <div class="col-md-12">
        <div class="search-container search-container-1 column text-center">
            <h3 class="cmseasyedit">
                请输入查询信息！    </h3>
            <form name="search" action="/index.php?case=archive&amp;act=search" method="post">
                <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-default" name="submit" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
                    <input name="keyword" type="text" class="form-control" placeholder="请输入查询信息！">
                </div>
            </form>
            <p>
            </p><h5 class="cmseasyedit">
                热门关键词    </h5>
            <p></p>
        </div>
    </div>

    <style type="text/css">

        @media (min-width: 486px) {
            .search-container {
                width: 60%;
                margin: 0px auto;
            }
        }

        .search-box {
            background:$_background-color;
            border-color:$_background-border-color;

        }

        .search-box:hover
        {
            background:$_background-hover-color;
            border-color:$_background-border-hover-color;
        }
        .search-container-1 h3 {
            font-size:22px;
            color:#000000;
        }

        .search-container-1 h3:hover {
            color:#000000;
        }

        .search-container-1 .input-group .input-group-btn button.btn-default {
            font-size:14px;
            color:#ffffff;
            border-color:#06276a;
            border-radius: 0px;
            background:#06276a;
        }
        .search-container-1 .input-group .input-group-btn button.btn-default:hover {
            color:#ffffff;
            border-color:#06276a;
            border-radius: 0px;
            background:#06276a;
        }

        .search-container-1 .input-group .form-control {
            font-size:14px;
            color:#999999;
            border-color:#999999;
            border-radius: 0px;
            background:#ffffff;
        }

        .search-container-1 .input-group .form-control:hover {
            color:#999999;
            border-color:#999999;
            border-radius: 0px;
            background:#ffffff;
        }

        .search-container-1 p a {
            font-size:14px;
            color:#333333;
            border-color:rgba(255, 255, 255, 0);
            border-radius: 0px;
            background:rgba(255, 255, 255, 0);
        }
        .search-container-1 p a:hover {
            color:#333333;
            border-color:rgba(255, 255, 255, 0);
            border-radius: 0px;
            background:rgba(255, 255, 255, 0);
        }
    </style>

