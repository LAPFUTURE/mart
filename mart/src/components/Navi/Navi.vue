<template>
<div >
    <el-row>
      <el-col :span="24"  class="head">
          <el-col :span="3">
            <el-row style="margin-top:7px">
              <label class="head-time" style="margin-left:14px;">09:18</label>
            </el-row>
            <el-row >
              <label class="head-date" style="margin-left:14px">2018 年 08 月 11 日</label>
            </el-row>
          </el-col>
          <el-col :span="1">
            <img class="logo" src="@/assets/logo1.jpg">
          </el-col>
          <el-col :span="7" style="margin-left:-8px">
            <el-row class="head-company" style="margin-top:8px;">
              <span >乐礼（福建）集团有限公司</span>
            </el-row>
            <el-row class="head-team">
              <span >创意礼品事业部</span>
            </el-row>
          </el-col>
          <el-col :span="3" :offset="7" style="margin-top:18px">
              <el-input
                size="small"
                suffix-icon="el-icon-search"
                style="background-color: rgb(255, 255, 255); width: 250px; height: 30px; border-radius: 15px; border-width: 1px; border-color: rgb(102, 102, 102); border-style: solid; box-sizing: border-box; font-size: 12px; font-weight: 400; font-style: normal; text-decoration: none; font-family: 微软雅黑; color: rgb(0, 0, 0); line-height: 30px; text-align: left; left: 0px; top: 0px; overflow: hidden; z-index: 74;"
               >
              </el-input>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:70px"  v-if="activeIndex=='cardIssue'">
            <el-row >
            <img src="@/assets/addCard.jpg" style="margin-left:16px" @click="dialogFormVisible=true">
            </el-row>
            <el-row>
            <span style="color: #ffffff;">添加卡券</span>
            </el-row>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:70px"    v-if="activeIndex=='sysOrder'">
            <el-row >
           <el-switch
             v-model="peopeleOff"
             active-color="#13ce66"
             inactive-color="#ff4949"
             style="margin-left:16px">
           </el-switch>
            </el-row>
            <el-row>
            <span style="color: #ffffff;">人工核销</span>
            </el-row>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:70px"   v-if="activeIndex=='sendInfo'">
            <el-row >
              <img src="@/assets/sendConfig.jpg" style="margin-left:16px" >
            </el-row>
            <el-row>
            <span style="color: #ffffff;">配送设置</span>
            </el-row>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:70px"  v-if="activeIndex=='supplier'">
            <el-row >
            <img src="@/assets/addCard.jpg" style="margin-left:24px"  @click="supplierFormVisible=true">
            </el-row>
            <el-row>
            <span style="color: #ffffff;">添加供应商</span>
            </el-row>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:70px"  v-if="activeIndex=='goodsForm'">
            <el-row >
            <img src="@/assets/addCard.jpg" style="margin-left:16px" @click="goodsFormVisible=true">
            </el-row>
            <el-row>
            <span style="color: #ffffff;">添加商品</span>
            </el-row>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:70px"  v-if="activeIndex=='teamManager'">
            <el-row >
            <img src="@/assets/addCard.jpg" style="margin-left:16px" @click="peopleFormVisible=true">
            </el-row>
            <el-row>
            <span style="color: #ffffff;">添加人员</span>
            </el-row>
          </el-col>
          <el-col :span="2" style="margin-top:12px;margin-left:50px" v-if="activeIndex=='goodsOutIn'">
            <el-row>
            <img src="@/assets/outin.png" style="margin-left:18px;height:26px" @click="outInFormVisible=true">
            <img src="@/assets/out.png" style="margin-left:40px;height:26px" @click="outFormVisible=true">
            </el-row>
            <el-row>
            <span style="color: #ffffff;">退货入库</span>
            <span style="color: #ffffff;margin-left:6px">退货出仓</span>
            </el-row>
          </el-col>
      </el-col>
    </el-row>
    <el-row>
    <el-col :span="3" style="background-color:#515151;height:800px">

    <el-col :span="18" :offset="3" style="background-color:#515151;border-bottom: 1px solid #909399;">
      <el-row style="margin-top:8px">
      <img class="user-head" src="@/assets/logo1.jpg" style="height:40px;width:40px">
      <label class="user-name">王小平</label>
      <label class="user-name">超级管理员</label>
      </el-row>
      <el-row style="margin-bottom:8px">
      <img src="@/assets/star.jpg" >
      <el-button size="mini" type="primary" style="padding:0 6px;margin-left:8px"  plain>注销</el-button>
      <el-button size="mini" type="primary" style="padding:0 6px" plain>编辑</el-button>
      </el-row>
    </el-col>
    <el-col :span="24">
    <el-menu :default-active="activeIndex"   background-color="#515151" text-color="#fff"  active-text-color="#fff"  @select="handleSelect" router>
      <el-submenu index="1">
        <template slot="title">
          <span>卡券管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="cardIssue">卡券发行</el-menu-item>
          <el-menu-item index="cardOff">卡券核销</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="2">
        <template slot="title">
          <span>订单管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="telephoneOrder">话务订单</el-menu-item>
          <el-menu-item index="sysOrder">系统订单</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="3">
        <template slot="title">
          <span>配送管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="sendInfo">配送信息</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="4">
        <template slot="title">
          <span>采购管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="orderManager">订单管理</el-menu-item>
          <el-menu-item index="supplier">供应商</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="5">
        <template slot="title">
          <span>商品管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="goodsInfo">商品信息</el-menu-item>
          <el-menu-item index="goodsOutIn">商品出入</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="6">
        <template slot="title">
          <span>数据分析</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="1-1">商品分析</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="7">
        <template slot="title">
          <span>系统管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="teamManager">团队管理</el-menu-item>
          <el-menu-item index="1-3">系统日志</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
      <el-submenu index="8">
        <template slot="title">
          <span>财务管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="pay">应付款项</el-menu-item>
          <el-menu-item index="receive">应收款项</el-menu-item>
        </el-menu-item-group>
      </el-submenu>
    </el-menu>
    </el-col>
    </el-col>
    <el-col :span="21">
    <div >
        <router-view></router-view>
    </div>
    </el-col>
    </el-row>
    <el-dialog title="卡券信息" :visible.sync="dialogFormVisible" center>
      <el-form :model="cardIssueInfo" class="form">
        <el-form-item label="客户名称" label-width="120px">
          <el-col :span="24">
          <el-input v-model="cardIssueInfo.客户名称" auto-complete="off"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="联系电话" label-width="120px">
          <el-col :span="10">
          <el-input v-model="cardIssueInfo.联系电话" auto-complete="off"></el-input>
          </el-col>
          <el-col :span="2" :offset="1">
            联系人
          </el-col>
          <el-col :span="10">
            <el-input v-model="cardIssueInfo.联系人" auto-complete="off"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="礼券名称" label-width="120px">
          <el-input v-model="cardIssueInfo.礼券名称" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="礼券类型" label-width="120px">
          <el-input v-model="cardIssueInfo.卡券类型" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="发行数量" label-width="120px">
          <el-col :span="10">
          <el-input v-model="cardIssueInfo.发行数量" auto-complete="off"> <template slot="append">份</template></el-input>
          </el-col>
          <el-col :span="2" :offset="1">
            销售单价
          </el-col>
          <el-col :span="10">
            <el-input v-model="cardIssueInfo.销售单价" auto-complete="off"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="折扣率" label-width="120px">
          <el-col :span="10">
          <el-input v-model="cardIssueInfo.销售折扣" auto-complete="off"> <template slot="append">%</template></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="有效周期" label-width="120px">
          <el-col :span="10">
          <el-input v-model="cardIssueInfo.有效周期" auto-complete="off"> <template slot="append">天</template></el-input>
          </el-col>
          <el-col :span="2" :offset="1">
            有效期至
          </el-col>
          <el-col :span="10">
            <el-date-picker
              v-model="cardIssueInfo.有效期至"
              format="yyyy年MM月dd日"
              value-format="yyyy年MM月dd日"
              type="date"
              placeholder="选择日期">
            </el-date-picker>
          </el-col>
        </el-form-item>
        <el-form-item label="计时规则" label-width="120px">
            <el-radio v-model="cardIssueInfo.计时规则" label="发行日起记"></el-radio>
            <el-radio v-model="cardIssueInfo.计时规则" label="激活日起记"></el-radio>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button type="success"  @click="addCardIssue">保存</el-button>
      </div>
    </el-dialog>
    <el-dialog title="供应商编辑" :visible.sync="supplierFormVisible" center>
      <el-form :model="supplierForm" class="form">
        <el-form-item label="主体名称" label-width="120px">
          <el-col :span="24">
          <el-input v-model="supplierForm.主体名称" auto-complete="off"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="联系地址" label-width="120px">
          <el-col :span="10">
          <el-select v-model="address.省" placeholder="省" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="12">
          <el-select v-model="address.市" placeholder="市" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="10">
          <el-select v-model="address.区" placeholder="区/县" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="12">
          <el-select v-model="address.街道" placeholder="街道" filterable allow-create>
            <el-option label="类型一" value="shanghai"></el-option>
            <el-option label="类型二" value="beijing"></el-option>
          </el-select>
          </el-col>
          <el-col :span="24">
          <el-input v-model="address.详细地址" auto-complete="off"  placeholder="详细地址   道路名称/门牌号/小区名称 楼号 房间号"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="通讯信息" label-width="120px">
          <el-col :span="10">
            <el-input v-model="supplierForm.负责人" auto-complete="off"  placeholder="联系人"></el-input>
          </el-col>
          <el-col :span="12">
            <el-input v-model="supplierForm.联系电话" auto-complete="off"  placeholder="联系电话"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="supplierForm.电子邮箱" auto-complete="off"  placeholder="电子邮箱"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="账号信息" label-width="120px">
          <el-col :span="24">
          <el-input v-model="supplierForm.收款帐户" auto-complete="off"  placeholder="收款帐户"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="supplierForm.开户行" auto-complete="off"  placeholder="开户行"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="supplierForm.收款人" auto-complete="off"  placeholder="收款人"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="法人信息" label-width="120px">
          <el-col :span="12">
          <el-input v-model="supplierForm.法人姓名" auto-complete="off"  placeholder="法人姓名"></el-input>
          </el-col>
          <el-col :span="24">
          <el-input v-model="supplierForm.身份证号" auto-complete="off"  placeholder="身份证号"></el-input>
          </el-col>
        </el-form-item>
        <el-form-item label="合同信息" label-width="120px">
          <el-col :span="10">
            <el-date-picker
              v-model="supplierForm.签署时间"
              format="yyyy年MM月dd日"
              value-format="yyyy年MM月dd日"
              type="date"
              placeholder="签署时间">
            </el-date-picker>
          </el-col>
          <el-col :span="12">
          <el-select v-model="supplierForm.有效周期" placeholder="有效周期">
            <el-option label="1年" value="1年"></el-option>
            <el-option label="2年" value="2年"></el-option>
            <el-option label="3年" value="3年"></el-option>
          </el-select>
          </el-col>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button type="success"  @click="addSupplier">保存</el-button>
      </div>
    </el-dialog>
    <el-dialog title="商品编辑" :visible.sync="goodsFormVisible" center>
          <el-form :model="goodsForm" class="form">
            <el-form-item label="商品名称" label-width="120px">
              <el-col :span="24">
              <el-input v-model="goodsForm.商品名称" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="商品条码" label-width="120px">
              <el-col :span="24">
              <el-input v-model="goodsForm.商品条码" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="规格型号" label-width="120px">
              <el-col :span="24">
              <el-input v-model="goodsForm.规格型号" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="商品品类" label-width="120px">
              <el-col :span="10">
              <el-select v-model="goodsForm.商品品类" placeholder="">
                <el-option label="时令生鲜" value="时令生鲜"></el-option>
                <el-option label="汽车电子" value="汽车电子"></el-option>
                <el-option label="时尚3C" value="时尚3C"></el-option>
              </el-select>
              </el-col>
              <el-col :span="2">
                销售单位
              </el-col>
              <el-col :span="10">
              <el-select v-model="goodsForm.销售单位" placeholder="">
                <el-option label="个" value="个"></el-option>
                <el-option label="套" value="套"></el-option>
                <el-option label="件" value="件"></el-option>
              </el-select>
              </el-col>
            </el-form-item>
            <el-form-item label="出厂包装" label-width="120px">
              <el-col :span="10">
              <el-select v-model="goodsForm.出厂包装" placeholder="">
                <el-option label="塑料箱" value="塑料箱"></el-option>
                <el-option label="纸箱" value="纸箱"></el-option>
                <el-option label="中性纸盒" value="中性纸盒"></el-option>
                <el-option label="PP袋" value="PP袋"></el-option>
              </el-select>
              </el-col>
              <el-col :span="2">
                商品属性
              </el-col>
              <el-col :span="10">
              <el-select v-model="goodsForm.商品属性" placeholder="">
                <el-option label="赠品" value="赠品"></el-option>
                <el-option label="正价商品" value="正价商品"></el-option>
              </el-select>
              </el-col>
            </el-form-item>
            <el-form-item label="警戒库存" label-width="120px">
              <el-col :span="12">
              <el-input v-model="goodsForm.警戒库存" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="供应商" label-width="120px">
              <el-col :span="24">
              <el-select v-model="goodsForm.供应商" placeholder="">
                <el-option label="类型一" value="shanghai"></el-option>
                <el-option label="类型二" value="beijing"></el-option>
              </el-select>
              </el-col>
              <el-col :span="10">
                 <el-input v-model="goodsForm.供货价B" auto-complete="off" placeholder="供货价"></el-input>
              </el-col>
              <el-col :span="10" :offset="2">
                 <el-input v-model="goodsForm.出货周期" auto-complete="off" placeholder="出货周期"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="成本控制" label-width="120px">
              <el-col :span="10">
              <el-input v-model="goodsForm.运输费用A" auto-complete="off" placeholder="运输费用"></el-input>
              </el-col>
              <el-col :span="10" :offset="2">
              <el-input v-model="goodsForm.包装费用" auto-complete="off" placeholder="包装费用"></el-input>
              </el-col>
              <el-col :span="24" >
              产品成本价<span style="color:blue;margin-left:4px">9999</span>
              </el-col>
              <el-col :span="10">
              <el-input v-model="goodsForm.零售价E" auto-complete="off" placeholder="零售价"></el-input>
              </el-col>
              <el-col :span="10" :offset="2">
              <el-input v-model="goodsForm.利润率C" auto-complete="off" placeholder="利润率"></el-input>
              </el-col>
            </el-form-item>
          </el-form>
          <div slot="footer" class="dialog-footer">
            <el-button type="success"  @click="dialogFormVisible = false">保存</el-button>
          </div>
        </el-dialog>
    <el-dialog title="添加成员" :visible.sync="peopleFormVisible" center>
          <el-form :model="cardForm" class="form">
            <el-form-item label="真实姓名" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.name" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="联系电话" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.name" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="电子邮箱" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.name" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
            <el-form-item label="就职部门" label-width="120px">
              <el-col :span="10">
              <el-select v-model="cardForm.region" placeholder="">
                <el-option label="类型一" value="shanghai"></el-option>
                <el-option label="类型二" value="beijing"></el-option>
              </el-select>
              </el-col>
              <el-col :span="2">
                就职岗位
              </el-col>
              <el-col :span="10">
              <el-select v-model="cardForm.region" placeholder="">
                <el-option label="类型一" value="shanghai"></el-option>
                <el-option label="类型二" value="beijing"></el-option>
              </el-select>
              </el-col>
            </el-form-item>
            <el-form-item label="职位岗级" label-width="120px">
              <el-col :span="10">
              <el-select v-model="cardForm.region" placeholder="">
                <el-option label="类型一" value="shanghai"></el-option>
                <el-option label="类型二" value="beijing"></el-option>
              </el-select>
              </el-col>
              <el-col :span="2">
                合同周期
              </el-col>
              <el-col :span="10">
              <el-select v-model="cardForm.region" placeholder="">
                <el-option label="类型一" value="shanghai"></el-option>
                <el-option label="类型二" value="beijing"></el-option>
              </el-select>
              </el-col>
            </el-form-item>
            <el-form-item label="第三方ID" label-width="120px">
              <el-col :span="24">
              <el-input v-model="cardForm.name" auto-complete="off"></el-input>
              </el-col>
            </el-form-item>
          </el-form>
          <div slot="footer" class="dialog-footer">
            <el-button type="success"  @click="dialogFormVisible = false">保存</el-button>
          </div>
        </el-dialog>

        <el-dialog title="退货入库" :visible.sync="outInFormVisible" center>
          <el-col :span="24">
          <el-form :model="form" class="form">
            <el-col :span="12" :offset="4">
            <el-form-item label="卡券编码" label-width="120px">
             <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="商品条码" label-width="120px">
             <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="用户名称" label-width="120px">
              阳澄湖大闸蟹
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="联系电话" label-width="120px">
             <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="商品名称" label-width="120px">
              20180302059100001
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="规格型号" label-width="120px">
              200g x 5
            </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
            <el-form-item label="商品品类" label-width="120px">
              时令生鲜
            </el-form-item>
            </el-col>
            <el-col :span="5" >
            <el-form-item label="销售单位" label-width="120px">
              个
            </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
            <el-form-item label="出厂包装" label-width="120px">
              塑料筐
            </el-form-item>
            </el-col>
            <el-col :span="6" >
            <el-form-item label="商品属性" label-width="120px">
              正价商品
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="供应商" label-width="120px">
              苏州苏状元商行
            </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
            <el-form-item label="订单数量" label-width="120px">
              <span style="color:blue">9999 件</span>
            </el-form-item>
            </el-col>
            <el-col :span="6" >
            <el-form-item label="退货数量" label-width="120px">
              <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
          </el-form>
          </el-col>
          <div slot="footer" class="dialog-footer">
            <el-button type="success" @click="dialogFormVisible = false">确 定</el-button>
          </div>
        </el-dialog>
        <el-dialog title="退货出仓" :visible.sync="outFormVisible" center>
          <el-col :span="24">
          <el-form :model="form" class="form">
            <el-col :span="12" :offset="4">
            <el-form-item label="卡券编码" label-width="120px">
             <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="商品条码" label-width="120px">
             <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="商品名称" label-width="120px">
              20180302059100001
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="规格型号" label-width="120px">
              200g x 5
            </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
            <el-form-item label="商品品类" label-width="120px">
              时令生鲜
            </el-form-item>
            </el-col>
            <el-col :span="5" >
            <el-form-item label="销售单位" label-width="120px">
              个
            </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
            <el-form-item label="出厂包装" label-width="120px">
              塑料筐
            </el-form-item>
            </el-col>
            <el-col :span="6" >
            <el-form-item label="商品属性" label-width="120px">
              正价商品
            </el-form-item>
            </el-col>
            <el-col :span="12" :offset="4">
            <el-form-item label="供应商" label-width="120px">
              苏州苏状元商行
            </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
            <el-form-item label="订单数量" label-width="120px">
              <span style="color:blue">9999 件</span>
            </el-form-item>
            </el-col>
            <el-col :span="6" >
            <el-form-item label="退货数量" label-width="120px">
              <el-input v-model="num" auto-complete="off"></el-input>
            </el-form-item>
            </el-col>
          </el-form>
          </el-col>
          <div slot="footer" class="dialog-footer">
            <el-button type="success" @click="dialogFormVisible = false">确 定</el-button>
          </div>
        </el-dialog>
     </div>
</template>

    <script>
      let moment=require("moment")
      export default {
        data() {
          return {
      contextPath:"",
            dialogFormVisible:false,
            supplierFormVisible:false,
            goodsFormVisible:false,
            peopleFormVisible:false,
            outInFormVisible:false,
            outFormVisible:false,
            peopeleOff:true,
            address:{},
            cardIssueInfo:{
             },
             supplierForm:{
             },
             goodsForm:{
             },
            cardForm:{
              checkList:[],
            },
            form:{},
            num:"",
          };
        },
        computed:{
          activeIndex(){
            return this.$route.path.replace('/','')
          }
        },
        methods: {
          addCardIssue:function(){
            var self=this;
            self.cardIssueInfo.发行编码=moment().format("YYYYMMDD")+self.cardIssueInfo.联系电话.substring(0,4)
            self.cardIssueInfo.发行编码=moment().format("YYYYMMDD")+self.cardIssueInfo.联系电话.substring(0,4)
            self.cardIssueInfo.实付单价=(100-parseFloat(self.cardIssueInfo.销售折扣))*self.cardIssueInfo.销售单价/100
            self.cardIssueInfo.累计金额=self.cardIssueInfo.发行数量*self.cardIssueInfo.实付单价
            self.cardIssueInfo.激活状态="已激活"
            var param=self.cardIssueInfo;
            this.$axios.post(this.contextPath + "/api/cardPublish/add",param).then(function(res){
              if(res.data.status==1){
                self.$message({
                          showClose: true,
                          message: '操作成功',
                          type: 'success'
                        });
                self.dialogFormVisible=false
              }else{
            self.$message({
                      showClose: true,
                      message: res.data.message,
                      type: 'error'
                    });
              }
            });
          },
          addSupplier:function(){
            var self=this;
            self.supplierForm.状态="正常"
            self.supplierForm.合同有效期=parseInt(self.supplierForm.签署时间.substring(0,4))+parseInt(self.supplierForm.有效周期)+self.supplierForm.签署时间.substring(4)
            self.supplierForm.联系地址=self.address.省+self.address.市+self.address.区+self.address.街道+self.address.详细地址
            this.$axios.post(this.contextPath + "/api/supplier/add",JSON.stringify(self.supplierForm)).then(function(res){
              if(res.data.status==1){
              self.$message({
                        showClose: true,
                        message: '操作成功',
                        type: 'success'
                      });
                self.supplierFormVisible=false
              }else{
            self.$message({
                      showClose: true,
                      message: res.data.message,
                      type: 'error'
                    });
              }
            });
          },
          addGoods:function(){
            var self=this;
            this.$axios.post(this.contextPath + "/api/commodity/add",JSON.stringify(self.goodsForm)).then(function(res){
              if(res.data.status==1){
                self.$message({
                          showClose: true,
                          message: '操作成功',
                          type: 'success'
                        });
                self.goodsFormVisible=false
              }else{
            self.$message({
                      showClose: true,
                      message: res.data.message,
                      type: 'error'
                    });
              }
            });
          },
          handleSelect(key, keyPath) {
            console.log(key, keyPath);
          },
        }
      }
    </script>
