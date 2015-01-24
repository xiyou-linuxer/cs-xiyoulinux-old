<{include file="header.tpl"}>
<link rel="stylesheet" href="js/chosen/chosen.css" type="text/css" />
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>
<!-- /.aside -->
<section id="content">
<section class="hbox stretch">
<section class="vbox">
<section class="scrollable wrapper-lg" id="bjax-target">
<!-- 最新动态内容 index_content.html -->
<div class="row">
<section>
<h4 class="m-t-none">填写信息</h4>
<div class="line line-dashed b-b line-lg pull-in"></div>
<div class="panel-body">

<form class="form-horizontal" >
<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" placeholder="姓名(必填)" required />
    </div>
</div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">性别</label>
    <div class="m-b-sm col-sm-6">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-sm btn-info active">
                <input name="sex" type="radio" value="1"> <i class="fa fa-check text-active"></i>
                男
            </label>
            <label class="btn btn-sm btn-primary">
                <input name="sex" type="radio" value="0"> <i class="fa fa-check text-active"></i>
                女
            </label>
        </div>
    </div>
</div>

<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">手机</label>
    <div class="col-sm-10">
        <input name="telphone" type="text" class="form-control" placeholder="手机号(选填)" required="required" />
        <!--<label class=" control-label"><p class="text-danger">该邮箱已被注册。</p></label>-->
    </div>
</div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">籍贯</label>
    <div class="col-sm-10">
        <select name="native" style="width:260px" class="chosen-select">
            <optgroup label="">
                <option value="AZ">北京市</option>
                <option value="CO">天津市</option>
                <option value="AL">河北省</option>
                <option value="AL">河南省</option>
                <option value="AL">山西省</option>
                <option value="AL">山东省</option>
                <option value="TN">青海省</option>
                <option value="TN">甘肃省</option>
                <option value="TN">陕西省</option>
                <option value="AR">黑龙江省</option>
                <option value="IL">吉林省</option>
                <option value="IA">辽宁省</option>
                <option value="NE">四川省</option>
                <option value="NM">重庆省</option>
                <option value="KS">贵州省</option>
                <option value="KY">云南省</option>
                <option value="MO">上海市</option>
                <option value="OK">江苏省</option>
                <option value="SD">浙江省</option>
                <option value="TX">安徽省</option>
                <option value="TN">福建省</option>
                <option value="WI">江西省</option>
                <option value="CT">湖南省</option>
                <option value="MO">湖北省</option>
                <option value="OK">广东省</option>
                <option value="SD">海南省</option>
                <option value="TX">台湾省</option>
                <option value="WI">香港特别行政区</option>
                <option value="CT">澳门特别行政区</option>
                <option value="LA">西藏自治区</option>
                <option value="AL">广西壮族自治区</option>
                <option value="ND">宁夏回族自治区</option>
                <option value="WY">内蒙古自治区</option>
                <option value="MS">新疆维吾尔族自治区</option>
            </optgroup>
        </select>
    </div>
</div>

<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">QQ</label>
    <div class="col-sm-10">
        <input name="QQnum" type="text" class="form-control" placeholder="QQ号(选填)"></div>
</div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">专业</label>
    <div class="col-sm-10">
        <select name="major" style="width:260px" class="chosen-select">
            <optgroup label="计算机学院">
                <option value="HI">计算机科学与技术</option>
                <option value="AK">软件工程</option>
                <option value="HI">网络工程</option>
            </optgroup>
            <optgroup label="通信与信息工程学院">
                <option value="NV">通信工程</option>
                <option value="OR">信息工程</option>
                <option value="WA">信息安全</option>
                <option value="CA">电子信息科学与技术</option>
                <option value="CA">信息对抗技术</option>
                <option value="CA">广播电视工程</option>
                <option value="CA">物联网工程</option>
            </optgroup>
            <optgroup label="电子工程学院">
                <option value="AZ">电子信息工程</option>
                <option value="CO">电子科学与技术</option>
                <option value="ID">光电信息工程</option>
                <option value="MT">光信息科学与技术</option>
                <option value="NE">微电子</option>
                <option value="NM">集成电路设计与集成系统</option>
                <option value="ND">电磁场与无线技术</option>
            </optgroup>
            <optgroup label="自动化学院">
                <option value="AL">测控技术与仪器</option>
                <option value="AR">电气工程及其自动化</option>
                <option value="IL">自动化</option>
                <option value="IA">智能科学与技术</option>
                <option value="KS">智能传感网络</option>
            </optgroup>
            <optgroup label="经济与管理学院">
                <option value="CT">物流管理</option>
                <option value="DE">经济学</option>
                <option value="FL">工商管理</option>
                <option value="GA">人力资源管理</option>
                <option value="IN">市场营销</option>
                <option value="ME">商务策划与管理</option>
                <option value="MD">会计学</option>
                <option value="MA">财务管理</option>
                <option value="MI">信息管理与信息系统</option>
                <option value="NH">国际经济与贸易</option>
                <option value="NY">电子商务</option>
                <option value="NC">工程管理</option>
                <option value="OH">工业工程</option>
            </optgroup>
            <optgroup label="理学院">
                <option value="CT">信息与计算科学</option>
                <option value="DE">应用物理</option>
            </optgroup>
            <optgroup label="人文社科学院">
                <option value="CT">行政管理</option>
                <option value="DE">公共事业管理</option>
                <option value="FL">社会工作</option>
            </optgroup>
            <optgroup label="外国语学院">
                <option value="CT">英语</option>
                <option value="DE">商务英语</option>
            </optgroup>
            <optgroup label="数字艺术学院">
                <option value="CT">数字媒体艺术</option>
                <option value="DE">广播电视编导</option>
            </optgroup>
        </select>
    </div>
</div>
<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
        <input name="email" type="text" class="form-control" placeholder="邮箱(必填)"></div>
</div>

<div class="form-group col-sm-6">
    <label class="col-sm-2 control-label">级别</label>
    <div class="col-sm-10">
        <select name="grade" style="width:260px" class="chosen-select">
            <optgroup label="">
                <option value="AZ">2004</option>
                <option value="CO">2005</option>
                <option value="AL">2006</option>
                <option value="AL">2007</option>
                <option value="AL">2008</option>
                <option value="AL">2009</option>
                <option value="TN">2010</option>
                <option value="TN">2011</option>
                <option value="TN">2012</option>
                <option value="AR">2013</option>
                <option value="IL">2014</option>
                <option value="IA">2015</option>
                <option value="NE">2016</option>
                <option value="NM">2017</option>
                <option value="KS">2018</option>
                <option value="KY">2019</option>
                <option value="MO">2020</option>
                <option value="OK">2021</option>
                <option value="SD">2022</option>
                <option value="TX">2023</option>
                <option value="TN">2024</option>
            </optgroup>
        </select>
    </div>
</div>
<div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

<div class="col-sm-6"></div>

<div class="form-group col-sm-6">
    <div class="col-sm-offset-4">
        <button type="button" class="btn btn-s-md btn-success" id="adduser">提交</button>
    </div>
</div>
</form>
</div>
</section>
<!-- line:2 div --> </div>

<!-- section id="bjax-target" --> </section>
<!-- section class="vbox" --> </section>

</section>
</section>

<{include file="chat.tpl"}>
<{include file="script.tpl"}>
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/admin_adduser.js"></script>
<{include file="footer.tpl"}>
