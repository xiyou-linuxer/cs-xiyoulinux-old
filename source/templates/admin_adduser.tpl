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

          <form class="form-horizontal" method="post" action="server/admin_adduser.php">
            <div class="form-group col-sm-6">
              <label class="col-sm-2 control-label">姓名</label>
              <div class="col-sm-10">
                <input name="name" type="text" class="form-control" placeholder="姓名" required />
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
                <input name="telphone" type="text" class="form-control" placeholder="手机号"></div>
            </div>

            <div class="form-group col-sm-6">
              <label class="col-sm-2 control-label">籍贯</label>
              <div class="col-sm-10">
                <select name="native" style="width:260px" class="chosen-select">
                  <optgroup label="">
                    <option value="北京市">北京市</option>
                    <option value="天津市">天津市</option>
                    <option value="河北省">河北省</option>
                    <option value="河南省">河南省</option>
                    <option value="山西省">山西省</option>
                    <option value="山东省">山东省</option>
                    <option value="青海省">青海省</option>
                    <option value="甘肃省">甘肃省</option>
                    <option value="陕西省">陕西省</option>
                    <option value="黑龙江省">黑龙江省</option>
                    <option value="吉林省">吉林省</option>
                    <option value="辽宁省">辽宁省</option>
                    <option value="四川省">四川省</option>
                    <option value="重庆省">重庆省</option>
                    <option value="贵州省">贵州省</option>
                    <option value="云南省">云南省</option>
                    <option value="上海市">上海市</option>
                    <option value="江苏省">江苏省</option>
                    <option value="浙江省">浙江省</option>
                    <option value="安徽省">安徽省</option>
                    <option value="福建省">福建省</option>
                    <option value="江西省">江西省</option>
                    <option value="湖南省">湖南省</option>
                    <option value="湖北省">湖北省</option>
                    <option value="广东省">广东省</option>
                    <option value="海南省">海南省</option>
                    <option value="台湾省">台湾省</option>
                    <option value="香港">香港特别行政区</option>
                    <option value="澳门">澳门特别行政区</option>
                    <option value="西藏">西藏自治区</option>
                    <option value="广西">广西壮族自治区</option>
                    <option value="宁夏">宁夏回族自治区</option>
                    <option value="内蒙古">内蒙古自治区</option>
                    <option value="新疆">新疆维吾尔族自治区</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

            <div class="form-group col-sm-6">
              <label class="col-sm-2 control-label">QQ</label>
              <div class="col-sm-10">
                <input name="QQnum" type="text" class="form-control" placeholder="QQ号"></div>
            </div>

            <div class="form-group col-sm-6">
              <label class="col-sm-2 control-label">专业</label>
              <div class="col-sm-10">
                <select name="major" style="width:260px" class="chosen-select">
                  <optgroup label="计算机学院">
                    <option value="计算机科学与技术">计算机科学与技术</option>
                    <option value="软件工程">软件工程</option>
                    <option value="网络工程">网络工程</option>
                  </optgroup>
                  <optgroup label="通信与信息工程学院">
                    <option value="通信工程">通信工程</option>
                    <option value="信息工程">信息工程</option>
                    <option value="信息安全">信息安全</option>
                    <option value="电子信息科学与技术">电子信息科学与技术</option>
                    <option value="信息对抗技术">信息对抗技术</option>
                    <option value="广播电视工程">广播电视工程</option>
                    <option value="物联网工程">物联网工程</option>
                  </optgroup>
                  <optgroup label="电子工程学院">
                    <option value="电子信息工程">电子信息工程</option>
                    <option value="电子科学与技术">电子科学与技术</option>
                    <option value="光电信息工程">光电信息工程</option>
                    <option value="光信息科学与技术">光信息科学与技术</option>
                    <option value="微电子">微电子</option>
                    <option value="集成电路设计与集成系统">集成电路设计与集成系统</option>
                    <option value="电磁场与无线技术">电磁场与无线技术</option>
                  </optgroup>
                  <optgroup label="自动化学院">
                    <option value="测控技术与仪器">测控技术与仪器</option>
                    <option value="电气工程及其自动化">电气工程及其自动化</option>
                    <option value="自动化">自动化</option>
                    <option value="智能科学与技术">智能科学与技术</option>
                    <option value="智能传感网络">智能传感网络</option>
                  </optgroup>
                  <optgroup label="经济与管理学院">
                    <option value="物流管理">物流管理</option>
                    <option value="经济学">经济学</option>
                    <option value="工商管理">工商管理</option>
                    <option value="人力资源管理">人力资源管理</option>
                    <option value="市场营销">市场营销</option>
                    <option value="商务策划与管理">商务策划与管理</option>
                    <option value="会计学">会计学</option>
                    <option value="财务管理">财务管理</option>
                    <option value="信息管理与信息系统">信息管理与信息系统</option>
                    <option value="国际经济与贸易">国际经济与贸易</option>
                    <option value="电子商务">电子商务</option>
                    <option value="工程管理">工程管理</option>
                    <option value="工业工程">工业工程</option>
                  </optgroup>
                  <optgroup label="理学院">
                    <option value="信息与计算科学">信息与计算科学</option>
                    <option value="应用物理">应用物理</option>
                  </optgroup>
                  <optgroup label="人文社科学院">
                    <option value="行政管理">行政管理</option>
                    <option value="公共事业管理">公共事业管理</option>
                    <option value="社会工作">社会工作</option>
                  </optgroup>
                  <optgroup label="外国语学院">
                    <option value="英语">英语</option>
                    <option value="商务英语">商务英语</option>
                  </optgroup>
                  <optgroup label="数字艺术学院">
                    <option value="数字媒体艺术">数字媒体艺术</option>
                    <option value="广播电视编导">广播电视编导</option>
                  </optgroup>
                </select>
              </div>
            </div>
            <div class="line line-dashed b-b line-lg pull-in col-sm-12"></div>

            <div class="form-group col-sm-6">
              <label class="col-sm-2 control-label">邮箱</label>
              <div class="col-sm-10">
                <input name="email" type="text" class="form-control" placeholder="邮箱"></div>
            </div>

            <div class="form-group col-sm-6">
              <label class="col-sm-2 control-label">级别</label>
              <div class="col-sm-10">
                <select name="grade" style="width:260px" class="chosen-select">
                  <optgroup label="">
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
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
<script type="text/javascript" src="js/adduser.js"></script>
<{include file="footer.tpl"}>
